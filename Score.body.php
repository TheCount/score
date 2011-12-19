<?php
/*
	Score, a MediaWiki extension for rendering musical scores with LilyPond.
	Copyright © 2011 Alexander Klauer

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.

	To contact the author:
	<Graf.Zahl@gmx.net>
	http://en.wikisource.org/wiki/User_talk:GrafZahl
	https://github.com/TheCount/score

 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( "This file cannot be run standalone.\n" );
}

/*
 * Score ecxceptions
 */
class ScoreException extends Exception {
	/**
	 * Empty constructor.
	 */
	public function __construct( $message, $code = 0, Exception $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}
}

/*
 * Score class
 */
class Score {
	/**
	 * Renders the lilypond code in a <score>…</score> tag.
	 *
	 * @param $lilypondCode
	 * @param $args
	 * @param $parser
	 * @param $frame
	 *
	 * @return Image link HTML, and possibly anchor to MIDI file.
	 */
	public static function render( $lilypondCode, array $args, Parser $parser, PPFrame $frame ) {

		if ( array_key_exists( 'midi', $args ) ) {
			$renderMidi = $args['midi'];
		} else {
			$renderMidi = false;
		}
		if ( array_key_exists( 'raw', $args ) && $args['raw'] ) {
			return self::runRaw( $lilypondCode, $renderMidi );
		} else {
			return self::run( $lilypondCode, $renderMidi );
		}
	}

	/**
	 * Runs lilypond with the code embedded in a score block.
	 *
	 * @param $lilypondCode
	 * @param $renderMidi
	 *
	 * @return Image link HTML, and possibly anchor to MIDI file.
	 */
	private static function run( $lilypondCode, $renderMidi ) {
		/* Raw code. Note: the "strange" ##f, ##t, etc., are actually part of the lilypond code!
		 * The raw code was taken directly from the original LilyPond extension */
		$raw = "\\header {\n"
			. "\ttagline = ##f\n"
			. "}\n"
			. "\\paper {\n"
			. "\traggedright = ##t\n"
			. "\traggedbottom = ##t\n"
			. "\tindent = 0\mm\n"
			. "}\n"
			. "\\version \"2.12.3\"\n"
			. "\\score {\n"
			. $lilypondCode
			. "\t\\layout { }\n"
			. ( $renderMidi ? "\t\\midi { }\n" : "" )
			. "}\n";
		return self::runRaw( $raw, $renderMidi, $lilypondCode );
	}

	/**
	 * Runs lilypond.
	 *
	 * @param $lilypondCode
	 * @param $renderMidi
	 * @param $altText Alternate text for the score image.
	 * 	If set to false, the alt text will contain pagination instead.
	 *
	 * @return Image link HTML, and possibly anchor to MIDI file.
	 */
	private static function runRaw( $lilypondCode, $renderMidi, $altText = false ) {
		global $wgTmpDirectory, $wgUploadDirectory, $wgUploadPath, $wgLilyPond, $wgScoreTrim;

		wfProfileIn( __METHOD__ );

		/* Various paths and filenames */
		$factoryPrefix = 'MWLP.';
		$fuzz = md5( mt_rand() );
		$factoryDirectory = $wgTmpDirectory . "/$factoryPrefix$fuzz";
		$lilypondFile = $factoryDirectory . "/file.ly";
		$factoryMidi = $factoryDirectory . "/file.midi";
		$factoryImage = $factoryDirectory . "/file.png";
		$factoryImageTrimmed = $factoryDirectory . "/file-trimmed.png";
		$factoryMultiFormat = $factoryDirectory . "/file-%d.png"; // for multi-page scores
		$factoryMultiTrimmedFormat = $factoryDirectory . "/file-%d-trimmed.png";
		$lilypondDir = "lilypond";
		$rel = $lilypondDir . "/" . md5( $lilypondCode ); // FIXME: Too many files in one directory?
		$filePrefix = "$wgUploadDirectory/$rel";
		$pathPrefix = "$wgUploadPath/$rel";
		$midi = "$filePrefix.midi";
		$midiPath = "$pathPrefix.midi";
		$image = "$filePrefix.png";
		$imagePath = "$pathPrefix.png";
		$multiFormat = "$filePrefix-%d.png";
		$multiPathFormat = "$pathPrefix-%d.png";
		$multi1 = "$filePrefix-1.png";

		/* Check whether the file is already cached */
		$cached = true;
		if ( $renderMidi && !file_exists( $midi ) ) {
			self::debug( "Cache miss: File $midi does not exist and midi rendering is enabled.\n" );
			$cached = false;
		}
		if ( !file_exists( $image ) && !file_exists( $multi1 ) ) {
			self::debug( "Cache miss: Neither $image nor $multi1 exists.\n" );
			$cached = false;
		}

		/* If not cached, create the files */
		if ( !$cached ) {
			self::debug( "Regenerating files due to cache miss.\n" );

			try {
				/* delete old files if necessary */
				$rc = true;
				if ( file_exists( $midi ) ) {
					$rc = $rc && unlink( $midi );
				}
				if ( file_exists( $image ) ) {
					$rc = $rc && unlink( $image );
				}
				for ( $i = 1; file_exists( $f = sprintf( $multiFormat, $i ) ); ++$i ) {
					$rc = $rc && unlink( $f );
				}
				if ( !$rc ) {
					throw new ScoreException( 'score-cleanerr' );
				}

				/* create output directory if necessary */
				if ( !file_exists( "$wgUploadDirectory/$lilypondDir" ) ) {
					$rc = wfMkdirParents( "$wgUploadDirectory/$lilypondDir", null, __METHOD__ );
					if ( !$rc ) {
						throw new ScoreException( 'score-nooutput' );
					}
				}

				/* create working environment */
				$rc = wfMkdirParents( $factoryDirectory, 0700, __METHOD__ );
				if ( !$rc ) {
					throw new ScoreException( 'score-nofactory' );
				}

				$rc = file_put_contents( $lilypondFile, $lilypondCode );
				if ( $rc === false ) {
					throw new ScoreException( 'score-noinput' );
				}

				/* generate lilypond output files in working environment */
				$oldcwd = getcwd();
				if ( $oldcwd === false ) {
					throw new ScoreException( 'score-getcwderr' );
				}
				$rc = chdir( $factoryDirectory );
				if ( !$rc ) {
					throw new ScoreException( 'score-chdirerr' );
				}
				if ( !is_executable( $wgLilyPond ) ) {
					throw new ScoreException( 'score-notexecutable' );
				}
				$cmd = wfEscapeShellArg( $wgLilyPond )
					. " -dsafe='#t' -dbackend=eps --png --header=texidoc "
					. wfEscapeShellArg( $lilypondFile )
					. ' 2>&1'; // FIXME: This last bit is probably not portable
				$output = wfShellExec( $cmd, $rc2 );
				$rc = chdir( $oldcwd );
				if ( !$rc ) {
					throw new ScoreException( 'score-chdir' );
				}
				if ( $rc2 != 0 ) {
					self::eraseFactory( $factoryDirectory );
					wfProfileOut( __METHOD__ );
					$msg = wfMessage( 'score-compilererr' )
						->inContentLanguage()
						->rawParams(
							' ' . Html::rawElement( 'pre', array(), strip_tags( $output ) ) . "\n"
						);
					return $msg;
				}

				/* trim output images if wanted */
				if ( $wgScoreTrim ) {
					if ( file_exists( $factoryImage ) ) {
						$rc = self::trimImage( $factoryImage, $factoryImageTrimmed );
						if ( !$rc ) {
							throw new ScoreException( 'score-trimerr' );
						}
					}
					for ( $i = 1; file_exists( $f = sprintf( $factoryMultiFormat, $i ) ); ++$i ) {
						$rc = self::trimImage( $f, sprintf( $factoryMultiTrimmedFormat, $i ) );
						if ( !$rc ) {
							throw new ScoreException( 'score-trimerr' );
						}
					}
				} else {
					$factoryImageTrimmed = $factoryImage;
					$factoryMultiTrimmedFormat = $factoryMultiFormat;
				}

				/* move files to proper places */
				$rc = true;
				if ( file_exists( $factoryMidi ) ) {
					$rc = $rc && rename( $factoryMidi, $midi );
				}
				if ( file_exists( $factoryImageTrimmed ) ) {
					$rc = $rc && rename( $factoryImageTrimmed, $image );
				}
				for ( $i = 1; file_exists( $f = sprintf( $factoryMultiTrimmedFormat, $i ) ); ++$i ) {
					$rc = $rc && rename( $f, sprintf( $multiFormat, $i ) );
				}
				if ( !$rc ) {
					throw new ScoreException( 'score-renameerr' );
				}

				/* tear down working environment */
				if ( !self::eraseFactory( $factoryDirectory ) ) {
					self::debug( "Unable to delete temporary working directory.\n" );
				}
			} catch ( ScoreException $e ) {
				self::eraseFactory( $factoryDirectory );
				wfProfileOut( __METHOD__ );
				return Html::rawElement(
					'span',
					array( 'class' => 'error' ),
					wfMessage( $e->getMessage() )->inContentLanguage()->parse()
				);
			}
			wfProfileOut( __METHOD__ );
		}

		/* return output link(s) */
		if ( file_exists( $image ) ) {
			if ( $altText ) {
				$alt = $altText;
			} else {
				$alt = wfMessage( 'score-page' )->inContentLanguage()->numParams( '1' )->plain();
			}
			$link = Html::rawElement( 'img', array(
				'src' => $imagePath,
				'alt' => $alt,
			) );
		} elseif ( file_exists( $multi1 ) ) {
			$link = '';
			for ( $i = 1; file_exists( sprintf( $multiFormat, $i ) ); ++$i ) {
				if ( $altText ) {
					$alt = $altText;
				} else {
					$alt = wfMessage( 'score-page' )->inContentLanguage()->numParams( $i )->plain();
				}
				$link .= Html::rawElement( 'img', array(
					'src' => sprintf( $multiPathFormat, $i ),
					'alt' => $alt,
				) );
			}
		} else {
			self::debug( "No output images $image or $multi1!\n" );
			$link = 'No image';
		}
		if ( $renderMidi ) {
			if ( !file_exists( $midi ) ) {
				self::debug( "Midi file $midi should exist but does not!\n" );
			} else {
				$link = Html::rawElement( 'a', array( 'href' => $midiPath ), $link );
			}
		}
		wfProfileOut( __METHOD__ );
		return $link;
	}

	/**
	 * Trims an image with ImageMagick.
	 *
	 * @param $source
	 * @param $dest
	 *
	 * @return true on success, false on error.
	 */
	private static function trimImage( $source, $dest ) {
		global $wgImageMagickConvertCommand;

		$cmd = wfEscapeShellArg( $wgImageMagickConvertCommand )
			. ' -trim '
			. wfEscapeShellArg( $source ) . ' '
			. wfEscapeShellArg( $dest );
		wfShellExec( $cmd, $rc );
		if ( $rc == 0 ) {
			return true;
		}

		return false;
	}

	/**
	 * Deletes a directory with no subdirectories with all files in it.
	 *
	 * @param $dir
	 *
	 * @return true on success, false on error
	 */
	private static function eraseFactory( $dir ) {
		if( file_exists( $dir ) ) {
			array_map( 'unlink', glob( "$dir/*", GLOB_NOSORT ) );
			return rmdir( $dir );
		} else {
			/* Nothing to do */
			return true;
		}
	}

	/**
	 * Writes the specified message to the Score debug log.
	 *
	 * @param $msg
	 */
	private static function debug( $msg ) {
		wfDebugLog( 'Score', $msg );
	}

}
