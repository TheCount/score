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

/**
 * Score exception
 */
class ScoreException extends Exception {
	/**
	 * Constructor.
	 *
	 * @param $message Message to create error message from. Should have one $1 parameter.
	 * @param $code optionally, an error code.
	 * @param $previous Exception that caused this exception.
	 */
	public function __construct( $message, $code = 0, Exception $previous = null ) {
		parent::__construct( $message->inContentLanguage()->parse(), $code, $previous );
	}

	/**
	 * Auto-renders exception as HTML error message in the wiki's content
	 * language.
	 *
	 * @return error message HTML.
	 */
	public function  __toString() {
		return Html::rawElement(
			'span',
			array( 'class' => 'error' ),
			$this->getMessage()
		);
	}
}

/**
 * Score class
 */
class Score {
	/**
	 * Cache directory name.
	 */
	const LILYPOND_DIR_NAME = 'lilypond';

	/**
	 * Supported score languages.
	 */
	private static $supportedLangs = array( 'lilypond', 'ABC' );

	/**
	 * LilyPond version string.
	 * It defaults to null and is set the first time it is required.
	 */
	private static $lilypondVersion = null;

	/**
	 * Throws proper ScoreException in case of failed shell executions.
	 *
	 * @param $message Message to display.
	 * @param $output collected output from wfShellExec().
	 *
	 * @throws ScoreException always.
	 */
	private static function throwCallException( $message, $output ) {
		throw new ScoreException(
			$message->rawParams(
				Html::rawElement( 'pre',
					array(),
					strip_tags( $output )
				)
			)
		);
	}

	/**
	 * Determines the version of LilyPond in use and writes the version
	 * string to self::$lilypondVersion.
	 *
	 * @throws ScoreException if LilyPond could not be executed properly.
	 */
	private static function getLilypondVersion() {
		global $wgLilyPond;

		if ( !is_executable( $wgLilyPond ) ) {
			throw new ScoreException( wfMessage( 'score-notexecutable', $wgLilyPond ) );
		}

		$cmd = wfEscapeShellArg( $wgLilyPond ) . ' --version 2>&1';
		$output = wfShellExec( $cmd, $rc );
		if ( $rc != 0 ) {
			self::throwCallException( wfMessage( 'score-versionerr' ), $output );
		}

		$n = sscanf( $output, 'GNU LilyPond %s', self::$lilypondVersion );
		if ( $n != 1 ) {
			self::$lilypondVersion = null;
			self::throwCallException( wfMessage( 'score-versionerr' ), $output );
		}
	}

	/**
	 * Creates the specified directory if it does not exist yet.
	 * Otherwise does nothing.
	 *
	 * @param $path path to directory to be created.
	 *
	 * @throws ScoreException if the directory does not exist and could not be created.
	 */
	private static function createFactory( $path ) {
		if ( !is_dir( $path ) ) {
			$rc = wfMkdirParents( $path, 0700, __METHOD__ );
			if ( !$rc ) {
				throw new ScoreException( wfMessage( 'score-nofactory' ) );
			}
		}
	}

	/**
	 * Renders the score code (LilyPond, ABC, etc.) in a <score>…</score> tag.
	 *
	 * @param $code score code.
	 * @param $args array of score tag attributes.
	 * @param $parser Parser of Mediawiki.
	 * @param $frame PPFrame expansion frame, not used by this extension.
	 *
	 * @return Image link HTML, and possibly anchor to MIDI file.
	 */
	public static function render( $code, array $args, Parser $parser, PPFrame $frame ) {
		try {
			$options = array();

			/* Score language selection */
			if ( array_key_exists( 'lang', $args ) ) {
				$options['lang'] = $args['lang'];
			} else {
				$options['lang'] = 'lilypond';
			}
			if ( !in_array( $options['lang'], self::$supportedLangs ) ) {
				throw new ScoreException( wfMessage( 'score-invalidlang', $options['lang'] ) );
			}

			/* Midi rendering? */
			if ( array_key_exists( 'midi', $args ) ) {
				$options['midi'] = $args['midi'];
			} else {
				$options['midi'] = false;
			}

			/* Raw rendering? */
			if ( array_key_exists( 'raw', $args ) ) {
				$options['raw'] = $args['raw'];
			} else {
				$options['raw'] = false;
			}

			$html = self::generateHTML( $code, $options );
		} catch ( ScoreException $e ) {
			$html = "$e";
		}

		return $html;
	}

	/**
	 * Generates the HTML code for a score tag.
	 *
	 * @param $code score code.
	 * @param $options array of music rendering options. Available options keys are:
	 * 	* lang: score language,
	 * 	* midi: whether to link to a MIDI file,
	 * 	* raw: whether to assume raw LilyPond code.
	 *
	 * @return HTML.
	 *
	 * @throws ScoreException if an error occurs.
	 */
	private static function generateHTML( $code, $options ) {
		global $wgUploadDirectory, $wgUploadPath;

		/* Various paths and file names */
		$cacheName = md5( $code ); /* always use MD5 of $code, regardless of language */
		$cacheSubdir = "{$cacheName[0]}/{$cacheName[0]}{$cacheName[1]}";
		$lilypondDir = $wgUploadDirectory . '/' . self::LILYPOND_DIR_NAME . '/' . $cacheSubdir;
		$lilypondPath = $wgUploadPath . '/' . self::LILYPOND_DIR_NAME . '/' . $cacheSubdir;
		$filePrefix = "$lilypondDir/$cacheName";
		$pathPrefix = "$lilypondPath/$cacheName";
		$midi = "$filePrefix.midi";
		$midiPath = "$pathPrefix.midi";
		$image = "$filePrefix.png";
		$imagePath = "$pathPrefix.png";
		$multiFormat = "$filePrefix-%d.png"; // for multi-page scores
		$multiPathFormat = "$pathPrefix-%d.png";
		$multi1 = "$filePrefix-1.png";

		/* Make sure $lilypondDir exists */
		if ( !file_exists( $lilypondDir ) ) {
			$rc = wfMkdirParents( $lilypondDir, null, __METHOD__ );
			if ( !$rc ) {
				throw new ScoreException( wfMessage( 'score-nooutput', self::LILYPOND_DIR_NAME ) );
			}
		}

		/* Generate PNG and MIDI files if necessary */
		if ( ( !file_exists( $image ) && !file_exists( $multi1 ) ) || ( $options['midi'] && !file_exists( $midi ) ) ) {
			self::generatePngAndMidi( $code, $options, $filePrefix );
		}

		/* return output link(s) */
		if ( file_exists( $image ) ) {
			$link = Html::rawElement( 'img', array(
				'src' => $imagePath,
				'alt' => $code,
			) );
		} elseif ( file_exists( $multi1 ) ) {
			$link = '';
			for ( $i = 1; file_exists( sprintf( $multiFormat, $i ) ); ++$i ) {
				$link .= Html::rawElement( 'img', array(
					'src' => sprintf( $multiPathFormat, $i ),
					'alt' => wfMessage( 'score-page' )->inContentLanguage()->numParams( $i )->plain()
				) );
			}
		} else {
			/* No images; this may actually happen in raw lilypond mode */
			self::debug( "No output images $image or $multi1!\n" );
			$link = 'No image';
		}
		if ( $options['midi'] ) {
			$link = Html::rawElement( 'a', array( 'href' => $midiPath ), $link );
		}

		return $link;
	}

	/**
	 * Generates score PNG file(s) and possibly a MIDI file.
	 *
	 * @param $code score code.
	 * @param $options rendering options, see Score::generateHTML() for explanation.
	 * @param $filePrefix prefix for the generated files.
	 *
	 * @throws ScoreException on error.
	 */
	private static function generatePngAndMidi( $code, $options, $filePrefix ) {
		global $wgTmpDirectory, $wgLilyPond, $wgScoreTrim;

		wfProfileIn( __METHOD__ );

		try {
			/* Various filenames */
			$ly = "$filePrefix.ly";
			$midi = "$filePrefix.midi";
			$image = "$filePrefix.png";
			$multiFormat = "$filePrefix-%d.png";

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
				throw new ScoreException( wfMessage( 'score-cleanerr' ) );
			}

			/* Create a working environment */
			$fuzz = md5( mt_rand() );
			$factoryDirectory = $wgTmpDirectory . "/MWLP.$fuzz";
			self::createFactory( $factoryDirectory );
			$factoryLy = "$factoryDirectory/file.ly";
			$factoryMidi = "$factoryDirectory/file.midi";
			$factoryImage = "$factoryDirectory/file.png";
			$factoryImageTrimmed = "$factoryDirectory/file-trimmed.png";
			$factoryMultiFormat = "$factoryDirectory/file-%d.png";
			$factoryMultiTrimmedFormat = "$factoryDirectory/file-%d-trimmed.png";

			/* Determine which LilyPond code to use */
			if ( $options['lang'] == 'lilypond' ) {
				if ( $options['raw'] ) {
					$lilypondCode = $code;
				} else {
					$lilypondCode = self::embedLilypondCode( $code, $options );
				}
			} else {
				wfSuppressWarnings();
				$lilypondCode = file_get_contents( $ly ); // may legitimately fail
				wfRestoreWarnings();
				if ( $lilypondCode === false ) {
					/* (re-)generate .ly file */
					$lilypondCode = self::generateLilypond( $code, $options, $filePrefix, $factoryDirectory );
				}
			}

			/* generate lilypond output files in working environment */
			if ( !file_exists( $factoryLy ) ) {
				$rc = file_put_contents( $factoryLy, $lilypondCode );
				if ( $rc === false ) {
					throw new ScoreException( wfMessage( 'score-noinput', $factoryLy ) );
				}
			}
			$oldcwd = getcwd();
			if ( $oldcwd === false ) {
				throw new ScoreException( wfMessage( 'score-getcwderr' ) );
			}
			$rc = chdir( $factoryDirectory );
			if ( !$rc ) {
				throw new ScoreException( wfMessage( 'score-chdirerr', $factoryDirectory ) );
			}
			if ( !is_executable( $wgLilyPond ) ) {
				throw new ScoreException( wfMessage( 'score-notexecutable', $wgLilyPond ) );
			}
			$cmd = wfEscapeShellArg( $wgLilyPond )
				. ' -dsafe='
				. wfEscapeShellArg( '#t' )
				. ' -dbackend=eps --png --header=texidoc '
				. wfEscapeShellArg( $factoryLy )
				. ' 2>&1';
			$output = wfShellExec( $cmd, $rc2 );
			$rc = chdir( $oldcwd );
			if ( !$rc ) {
				throw new ScoreException( wfMessage( 'score-chdirerr', $oldcwd ) );
			}
			if ( $rc2 != 0 ) {
				self::throwCallException( wfMessage( 'score-compilererr' ), $output );
			}

			/* trim output images if wanted */
			if ( $wgScoreTrim ) {
				if ( file_exists( $factoryImage ) ) {
					$rc = self::trimImage( $factoryImage, $factoryImageTrimmed );
				}
				for ( $i = 1; file_exists( $f = sprintf( $factoryMultiFormat, $i ) ); ++$i ) {
					$rc = self::trimImage( $f, sprintf( $factoryMultiTrimmedFormat, $i ) );
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
				throw new ScoreException( wfMessage( 'score-renameerr' ) );
			}
		} catch ( Exception $e ) {
			self::eraseFactory( $factoryDirectory );
			wfProfileOut( __METHOD__ );
			throw $e;
		}

		/* tear down working environment */
		self::eraseFactory( $factoryDirectory );
		wfProfileOut( __METHOD__ );
	}

	/**
	 * Embeds simple LilyPond code in a score block.
	 *
	 * @param $lilypondCode simple LilyPond code.
	 * @param $options rendering options, see Score::generateHTML() for explanation.
	 *
	 * @return Raw lilypond code.
	 *
	 * @throws ScoreException if determining the LilyPond version fails.
	 */
	private static function embedLilypondCode( $lilypondCode, $options ) {
		/* Get LilyPond version if we don't know it yet */
		if ( self::$lilypondVersion === null ) {
			self::getLilypondVersion();
		}

		/* Raw code. Note: the "strange" ##f, ##t, etc., are actually part of the lilypond code!
		 * The raw code is based on the raw code from the original LilyPond extension */
		$raw = "\\header {\n"
			. "\ttagline = ##f\n"
			. "}\n"
			. "\\paper {\n"
			. "\traggedright = ##t\n"
			. "\traggedbottom = ##t\n"
			. "\tindent = 0\mm\n"
			. "}\n"
			. '\version "' . self::$lilypondVersion . "\"\n"
			. "\\score {\n"
			. $lilypondCode
			. "\t\\layout { }\n"
			. ( $options['midi'] ? "\t\\midi { }\n" : "" )
			. "}\n";
		return $raw;
	}

	/**
	 * Generates LilyPond code.
	 *
	 * @param $code score code.
	 * @param $options rendering options, see Score::generateHTML() for explanation.
	 * @param $filePrefix prefix for the generated file.
	 * @param $factoryDirectory directory of the working environment.
	 *
	 * @return the generated LilyPond code.
	 *
	 * @throws ScoreException if an error occurs.
	 */
	private static function generateLilypond( $code, $options, $filePrefix, $factoryDirectory ) {
		$ly = "$filePrefix.ly";

		switch ( $options['lang'] ) {
		case 'ABC':
			$lilypondCode = self::generateLilypondFromAbc( $code, $factoryDirectory );
			break;
		case 'lilypond':
			throw new MWException( 'lang="lilypond" in ' . __METHOD__ . ". This should not happen.\n" );
		default:
			throw new MWException( 'Unknown score language in ' . __METHOD__ . ". This should not happen.\n" );
		}

		$rc = file_put_contents( $ly, $lilypondCode );
		if ( $rc === false ) {
			self::debug( "Unable to copy $factoryLy to $ly.\n" );
		}

		return $lilypondCode;
	}

	/**
	 * Runs abc2ly, creating the LilyPond input file.
	 *
	 * $code ABC code.
	 * $factoryDirectory Working environment. As a side-effect, the
	 * 	LilyPond input file is created as "file.ly" in this directory.
	 *
	 * @return the generated LilyPond code.
	 *
	 * @throws ScoreException if the conversion fails.
	 */
	private function generateLilypondFromAbc( $code, $factoryDirectory ) {
		global $wgAbc2Ly;

		$factoryAbc = "$factoryDirectory/file.abc";
		$factoryLy = "$factoryDirectory/file.ly";

		/* Create ABC input file */
		$rc = file_put_contents( $factoryAbc, $code );
		if ( $rc === false ) {
			throw new ScoreException( wfMessage( 'score-noabcinput', $factoryAbc ) );
		}

		/* Convert to LilyPond file */
		if ( !is_executable( $wgAbc2Ly ) ) {
			throw new ScoreException( wfMessage( 'score-abc2lynotexecutable', $wgAbc2Ly ) );
		}

		$cmd = wfEscapeShellArg( $wgAbc2Ly )
			. ' -s'
			. ' --output=' . wfEscapeShellArg( $factoryLy )
			. ' ' . wfEscapeShellArg( $factoryAbc )
			. ' 2>&1';
		$output = wfShellExec( $cmd, $rc );
		if ( $rc != 0 ) {
			self::throwCallException( wfMessage( 'score-abcconversionerr' ), $output );
		}
		if ( !file_exists( $factoryLy ) ) {
			/* Occasionally, abc2ly will return exit code 0 but not create an output file */
			self::throwCallException( wfMessage( 'score-abcconversionerr' ), $output );
		}

		/* The output file has a tagline which should be removed in a wiki context */
		$lyData = file_get_contents( $factoryLy );
		if ( $lyData === false ) {
			throw new ScoreException( wfMessage( 'score-readerr', $factoryLy ) );
		}
		$lyData = preg_replace( '/^(\s*tagline\s*=).*/m', '$1 ##f', $lyData );
		if ( $lyData === null ) {
			throw new ScoreException( wfMessage( 'score-pregreplaceerr' ) );
		}
		$rc = file_put_contents( $factoryLy, $lyData );
		if ( $rc === false ) {
			throw new ScoreException( wfMessage( 'score-noinput', $factoryLy ) );
		}

		return $lyData;
	}

	/**
	 * Trims an image with ImageMagick.
	 *
	 * @param $source path to the source image.
	 * @param $dest path to the target (trimmed) image.
	 *
	 * @throws ScoreException on error.
	 */
	private static function trimImage( $source, $dest ) {
		global $wgImageMagickConvertCommand;

		$cmd = wfEscapeShellArg( $wgImageMagickConvertCommand )
			. ' -trim '
			. wfEscapeShellArg( $source ) . ' '
			. wfEscapeShellArg( $dest )
			. ' 2>&1';
		$output = wfShellExec( $cmd, $rc );
		if ( $rc != 0 ) {
			self::throwCallException( wfMessage( 'score-trimerr' ), $output );
		}
	}

	/**
	 * Deletes a directory with no subdirectories with all files in it.
	 *
	 * @param $dir path to the directory that is to be deleted.
	 *
	 * @return true on success, false on error
	 */
	private static function eraseFactory( $dir ) {
		if( file_exists( $dir ) ) {
			array_map( 'unlink', glob( "$dir/*", GLOB_NOSORT ) );
			$rc = rmdir( $dir );
			if ( !$rc ) {
				self::debug( "Unable to remove directory $dir\n." );
			}
			return $rc;

		} else {
			/* Nothing to do */
			return true;
		}
	}

	/**
	 * Writes the specified message to the Score debug log.
	 *
	 * @param $msg message to log.
	 */
	private static function debug( $msg ) {
		wfDebugLog( 'Score', $msg );
	}

}
