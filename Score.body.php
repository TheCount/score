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
 * Helper class for mixing profiling with code that throws exceptions.
 * It produces matching wfProfileIn/Out calls for scopes.
 * This class would be superfluous if PHP had a try-finally construct.
 */
class Score_ScopedProfiling {
	/**
	 * Profiling ID such as a method name.
	 */
	private $id;

	/**
	 * Creates new scoped profiling.
	 * The new scoped profiling will profile out as soon as its destructor
	 * is called (normally when the variable holding the created object
	 * goes out of scope).
	 *
	 * @param $id string profiling ID, most commonly a method name.
	 */
	public function __construct( $id ) {
		$this->id = $id;
		wfProfileIn( $id );
	}

	/**
	 * Out-profiles on end of scope.
	 */
	public function __destruct() {
		wfProfileOut( $this->id );
	}
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
			'div',
			array( 'class' => 'errorbox' ),
			$this->getMessage()
		);
	}
}

/**
 * Score class.
 */
class Score {
	/**
	 * Default audio player width.
	 */
	const DEFAULT_PLAYER_WIDTH = 300;

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
	 * FileBackend instance cache
	 */
	private static $backend;

	/**
	 * Throws proper ScoreException in case of failed shell executions.
	 *
	 * @param $message Message to display.
	 * @param $output collected output from wfShellExec().
	 * @param $factoryDir The factory directory to replace with "..."
	 *
	 * @throws ScoreException always.
	 */
	private static function throwCallException( $message, $output, $factoryDir = false ) {
		/* clean up the output a bit */
		if ( $factoryDir ) {
			$output = str_replace( $factoryDir, '...', $output );
		}
		throw new ScoreException(
			$message->rawParams(
				Html::rawElement( 'pre',
					array(),
					htmlspecialchars( $output )
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
		global $wgScoreLilyPond;

		$prof = new Score_ScopedProfiling( __METHOD__ );

		if ( !is_executable( $wgScoreLilyPond ) ) {
			throw new ScoreException( wfMessage( 'score-notexecutable', $wgScoreLilyPond ) );
		}

		$cmd = wfEscapeShellArg( $wgScoreLilyPond ) . ' --version 2>&1';
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
	 * Creates the specified local directory if it does not exist yet.
	 * Otherwise does nothing.
	 *
	 * @param $path string Local path to directory to be created.
	 * @param $mode integer Chmod value of the new directory.
	 *
	 * @throws ScoreException if the directory does not exist and could not
	 * 	be created.
	 */
	private static function createDirectory( $path, $mode = null ) {
		if ( !is_dir( $path ) ) {
			$rc = wfMkdirParents( $path, $mode, __METHOD__ );
			if ( !$rc ) {
				throw new ScoreException( wfMessage( 'score-nooutput', $path ) );
			}
		}
	}

	private static function getBaseUrl() {
		global $wgScorePath, $wgUploadPath;
		if ( $wgScorePath === false ) {
			return "{$wgUploadPath}/lilypond";
		} else {
			return $wgScorePath;
		}
	}

	/**
	 * @return FileBackend
	 */
	private static function getBackend() {
		global $wgScoreFileBackend;

		if ( $wgScoreFileBackend ) {
			return FileBackendGroup::singleton()->get( $wgScoreFileBackend );
		} else {
			if ( !self::$backend ) {
				global $wgScoreDirectory, $wgUploadDirectory;
				if ( $wgScoreDirectory === false ) {
					$dir = "{$wgUploadDirectory}/lilypond";
				} else {
					$dir = $wgScoreDirectory;
				}
				self::$backend = new FSFileBackend( array(
					'name'           => 'score-backend',
					'lockManager'    => 'nullLockManager',
					'containerPaths' => array( 'score-render' => $dir ),
					'fileMode'       => 0777
				) );
			}
			return self::$backend;
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
		global $wgTmpDirectory;

		$prof = new Score_ScopedProfiling( __METHOD__ );

		try {
			$baseUrl = self::getBaseUrl();
			$baseStoragePath = self::getBackend()->getRootStoragePath() . '/score-render';

			$options = array(); // options to self::generateHTML()

			/* temporary working directory to use */
			$fuzz = md5( mt_rand() );
			$options['factory_directory'] = $wgTmpDirectory . "/MWLP.$fuzz";

			/* Score language selection */
			if ( array_key_exists( 'lang', $args ) ) {
				$options['lang'] = $args['lang'];
			} else {
				$options['lang'] = 'lilypond';
			}
			if ( !in_array( $options['lang'], self::$supportedLangs ) ) {
				throw new ScoreException( wfMessage( 'score-invalidlang',
					htmlspecialchars( $options['lang'] ) ) );
			}

			/* Override MIDI file? */
			if ( array_key_exists( 'override_midi', $args ) ) {
				$file = wfFindFile( $args['override_midi'] );
				if ( $file === false ) {
					throw new ScoreException( wfMessage( 'score-midioverridenotfound',
						htmlspecialchars( $args['override_midi'] ) ) );
				}
				$parser->getOutput()->addImage( $file->getName() );
				$options['override_midi'] = true;
				$options['midi_file'] = $file;
				/* Set OGG stuff in case Vorbis rendering is requested */
				$sha1 = $file->getSha1();
				$oggRelDir = "override-midi/{$sha1[0]}/{$sha1[1]}";
				$oggRel = "$oggRelDir/$sha1.ogg";
				$options['ogg_storage_dir'] = "$baseStoragePath/$oggRelDir";
				$options['ogg_storage_path'] = "$baseStoragePath/$oggRel";
				$options['ogg_url'] = "$baseUrl/$oggRel";
			} else {
				$options['override_midi'] = false;
			}

			// Raw rendering?
			$options['raw'] = array_key_exists( 'raw', $args );

			// Input for cache key
			$cacheOptions = array(
				'code' => $code,
				'lang' => $options['lang'],
				'raw'  => $options['raw'],
			);

			/* image file path and URL prefixes */
			$imageCacheName = wfBaseConvert( sha1( serialize( $cacheOptions ) ), 16, 36, 31 );
			$imagePrefixEnd = "{$imageCacheName[0]}/" .
				"{$imageCacheName[1]}/$imageCacheName";
			$options['dest_storage_path'] = "$baseStoragePath/$imagePrefixEnd";
			$options['dest_url'] = "$baseUrl/$imagePrefixEnd";
			$options['file_name_prefix'] = substr( $imageCacheName, 0, 8 );

			/* Midi linking? */
			if ( array_key_exists( 'midi', $args ) ) {
				$options['link_midi'] = $args['midi'];
			} else {
				$options['link_midi'] = false;
			}

			/* Override OGG file? */
			if ( array_key_exists( 'override_ogg', $args ) ) {
				$t = Title::newFromText( $args['override_ogg'], NS_FILE );
				if ( is_null( $t ) ) {
					throw new ScoreException( wfMessage( 'score-invalidoggoverride',
						htmlspecialchars( $args['override_ogg'] ) ) );
				}
				if ( !$t->isKnown() ) {
					throw new ScoreException( wfMessage( 'score-oggoverridenotfound',
						htmlspecialchars( $args['override_ogg'] ) ) );
				}
				$options['override_ogg'] = true;
				$options['ogg_name'] = $args['override_ogg'];
			} else {
				$options['override_ogg'] = false;
			}

			/* Vorbis rendering? */
			if ( array_key_exists( 'vorbis', $args ) ) {
				$options['generate_ogg'] = $args['vorbis'];
			} else {
				$options['generate_ogg'] = false;
			}
			if ( $options['generate_ogg']
				&& !( class_exists( 'OggHandler' ) && class_exists( 'OggAudioDisplay' ) ) )
			{
				throw new ScoreException( wfMessage( 'score-noogghandler' ) );
			}
			if ( $options['generate_ogg'] && ( $options['override_ogg'] !== false ) ) {
				throw new ScoreException( wfMessage( 'score-vorbisoverrideogg' ) );
			}

			$html = self::generateHTML( $parser, $code, $options );
		} catch ( ScoreException $e ) {
			$html = "$e";
		}

		// Mark the page as using the score extension, it makes easier
		// to track all those pages.
		$parser->getOutput()->setProperty( 'score' , true );

		return $html;
	}

	/**
	 * Generates the HTML code for a score tag.
	 *
	 * @param $parser Parser MediaWiki parser.
	 * @param $code string Score code.
	 * @param $options array of rendering options.
	 * 	The options keys are:
	 * 	- factory_directory: string Path to directory in which files
	 * 		may be generated without stepping on someone else's
	 * 		toes. The directory may not exist yet. Required.
	 * 	- generate_ogg: bool Whether to create an Ogg/Vorbis file in
	 * 		an OggHandler. If set to true, the override_ogg option
	 * 		must be set to false. Required.
	 *  - dest_storage_path: The path of the destination directory relative to 
	 *  	the current backend. Required.
	 *  - dest_url: The default destination URL. Required.
	 *  - file_name_prefix: The filename prefix used for all files
	 *  	in the default destination directory. Required.
	 * 	- lang: string Score language. Required.
	 * 	- link_midi: bool Whether to link to a MIDI file. Required.
	 * 	- override_midi: bool Whether to use a user-provided MIDI file.
	 * 		Required.
	 * 	- midi_file: If override_midi is true, MIDI file object.
	 * 	- ogg_storage_dir: If override_midi and generate_ogg are true, the
	 * 		backend directory in which the Ogg file is to be stored.
	 * 	- ogg_storage_path: string If override_midi and generate_ogg are true,
	 * 		the backend path at which the generated Ogg file is to be
	 * 		stored.
	 * 	- ogg_url: string If override_midi and generate_ogg is true,
	 * 		the URL corresponding to ogg_storage_path
	 * 	- override_ogg: bool Whether to generate a wikilink to a
	 * 		user-provided OGG file. If set to true, the vorbis
	 * 		option must be set to false. Required.
	 * 	- ogg_name: string If override_ogg is true, the Ogg file name
	 * 	- raw: bool Whether to assume raw LilyPond code. Ignored if the
	 * 		language is not lilypond, required otherwise.
	 *
	 * @return string HTML.
	 *
	 * @throws ScoreException if an error occurs.
	 */
	private static function generateHTML( &$parser, $code, $options ) {
		global $wgOut;

		$prof = new Score_ScopedProfiling( __METHOD__ );
		try {
			$backend = self::getBackend();
			$fileIter = $backend->getFileList( 
				array( 'dir' => $options['dest_storage_path'], 'topOnly' => true ) );
			$existingFiles = array();
			foreach ( $fileIter as $file ) {
				$existingFiles[$file] = true;
			}

			/* Generate PNG and MIDI files if necessary */
			$imageFileName = "{$options['file_name_prefix']}.png";
			$multi1FileName = "{$options['file_name_prefix']}-1.png";
			$midiFileName = "{$options['file_name_prefix']}.midi";
			if (
				( 
					!isset( $existingFiles[$imageFileName] ) 
					&& !isset( $existingFiles[$multi1FileName] ) 
				) 
				|| !isset( $existingFiles[$midiFileName] ) )
			{
				$existingFiles += self::generatePngAndMidi( $code, $options );
			}

			/* Generate Ogg/Vorbis file if necessary */
			if ( $options['generate_ogg']  ) {
				if ( $options['override_midi'] ) {
					$oggUrl = $options['ogg_url'];
					$exists = $backend->fileExists( array( 'src' => $options['ogg_storage_path'] ) );
					if ( !$exists ) {
						$backend->prepare( array( 'dir' => $options['ogg_storage_dir'] ) );
						$sourcePath = $options['midi_file']->getLocalRefPath();
						self::generateOgg(
							$sourcePath,
							$options['factory_directory'],
							$options['ogg_storage_path'] );
					}
				} else {
					$oggFileName = "{$options['file_name_prefix']}.ogg";
					$oggUrl = "{$options['dest_url']}/$oggFileName";
					if ( !isset( $existingFiles[$oggFileName] ) ) {
						// Maybe we just generated it
						$sourcePath = "{$options['factory_directory']}/file.midi";
						if ( !file_exists( $sourcePath ) ) {
							// No, need to fetch it from the backend
							$sourceFileRef = $backend->getLocalReference( 
								array( 'src' => "{$options['dest_storage_path']}/$midiFileName" ) );
							$sourcePath = $sourceFileRef->getPath();
						}
						self::generateOgg(
							$sourcePath,
							$options['factory_directory'],
							"{$options['dest_storage_path']}/$oggFileName" );
					}
				}
			}

			/* return output link(s) */
			if ( isset( $existingFiles[$imageFileName] ) ) {
				$link = Html::rawElement( 'img', array(
					'src' => "{$options['dest_url']}/$imageFileName",
					'alt' => $code,
				) );
			} elseif ( isset( $existingFiles[$multi1Path] ) ) {
				$link = '';
				for ( $i = 1; ; ++$i ) {
					$fileName = "{$options['file_name_prefix']}-$i.png";
					if ( !isset( $existingFiles[$fileName] ) ) {
						break;
					}
					$link .= Html::rawElement( 'img', array(
						'src' => "{$options['dest_url']}/$fileName",
						'alt' => wfMessage( 'score-page' )
							->inContentLanguage()
							->numParams( $i )
							->plain()
					) );
				}
			} else {
				/* No images; this may happen in raw mode or when the user omits the score code */
				throw new ScoreException( wfMessage( 'score-noimages' ) );
			}
			if ( $options['link_midi'] ) {
				if ( $options['override_midi'] ) {
					$url = $options['midi_file']->getUrl();
				} else {
					$url = "{$options['dest_url']}/{$options['file_name_prefix']}.midi";
				}
				$link = Html::rawElement( 'a', array( 'href' => $url ), $link );
			}
			if ( $options['generate_ogg'] ) {
				$oh = new OggHandler();
				$oh->parserTransformHook( $parser, false );
				$player = new OggHandlerPlayer( array(
					'type' => 'audio',
					'defaultAlt' => '',
					'videoUrl' => $oggUrl,
					'thumbUrl' => false,
					'width' => self::DEFAULT_PLAYER_WIDTH,
					'height' => 0,
					'length' => 0,
					'showIcon' => false,
				) );
				$link .= $player->toHtml();
			}
			if ( $options['override_ogg'] !== false ) {
				$link .= $parser->recursiveTagParse( "[[File:{$options['ogg_name']}]]" );
			}
		} catch ( Exception $e ) {
			self::eraseFactory( $options['factory_directory'] );
			throw $e;
		}

		self::eraseFactory( $options['factory_directory'] );

		return $link;
	}

	/**
	 * Generates score PNG file(s) and a MIDI file.
	 *
	 * @param $code string Score code.
	 * @param $options array Rendering options. They are the same as for
	 * 	Score::generateHTML().
	 *
	 * @return Array of file names placed in the remote dest dir, with the 
	 * 	file names in each key.
	 *
	 * @throws ScoreException on error.
	 */
	private static function generatePngAndMidi( $code, $options ) {
		global $wgScoreLilyPond, $wgScoreTrim;

		$prof = new Score_ScopedProfiling( __METHOD__ );

		if ( !is_executable( $wgScoreLilyPond ) ) {
			throw new ScoreException( wfMessage( 'score-notexecutable', $wgScoreLilyPond ) );
		}

		/* Create the working environment */
		$factoryDirectory = $options['factory_directory'];
		self::createDirectory( $factoryDirectory, 0700 );
		$factoryLy = "$factoryDirectory/file.ly";
		$factoryMidi = "$factoryDirectory/file.midi";
		$factoryImage = "$factoryDirectory/file.png";
		$factoryImageTrimmed = "$factoryDirectory/file-trimmed.png";

		/* Generate LilyPond input file */
		if ( $options['lang'] == 'lilypond' ) {
			if ( $options['raw'] ) {
				$lilypondCode = $code;
			} else {
				$lilypondCode = self::embedLilypondCode( $code );
			}
			$rc = file_put_contents( $factoryLy, $lilypondCode );
			if ( $rc === false ) {
				throw new ScoreException( wfMessage( 'score-noinput', $factoryLy ) );
			}
		} else {
			$options['lilypond_path'] = $factoryLy;
			self::generateLilypond( $code, $options );
		}

		/* generate lilypond output files in working environment */
		$oldcwd = getcwd();
		if ( $oldcwd === false ) {
			throw new ScoreException( wfMessage( 'score-getcwderr' ) );
		}
		$rc = chdir( $factoryDirectory );
		if ( !$rc ) {
			throw new ScoreException( wfMessage( 'score-chdirerr', $factoryDirectory ) );
		}
		$cmd = wfEscapeShellArg( $wgScoreLilyPond )
			. ' ' . wfEscapeShellArg( '-dsafe=#t' )
			. ' -dbackend=eps --png --header=texidoc '
			. wfEscapeShellArg( $factoryLy )
			. ' 2>&1';
		$output = wfShellExec( $cmd, $rc2 );
		$rc = chdir( $oldcwd );
		if ( !$rc ) {
			throw new ScoreException( wfMessage( 'score-chdirerr', $oldcwd ) );
		}
		if ( $rc2 != 0 ) {
			self::throwCallException( wfMessage( 'score-compilererr' ), $output, $options );
		}
		if ( !file_exists( $factoryMidi ) ) {
			throw new ScoreException( wfMessage( 'score-nomidi' ) );
		}

		/* trim output images if wanted */
		if ( $wgScoreTrim ) {
			if ( file_exists( $factoryImage ) ) {
				self::trimImage( $factoryImage, $factoryImageTrimmed );
			} else {
				for ( $i = 1; ; ++$i ) {
					$src = "$factoryDirectory/file-$i.png";
					if ( !file_exists( $src ) ) {
						break;
					}
					$dest = "$factoryDirectory/file-$i-trimmed.png";
					self::trimImage( $src, $dest );
				}
			}
		}

		// Create the destination directory if it doesn't exist
		$backend = self::getBackend();
		$status = $backend->prepare( array( 'dir' => $options['dest_storage_path'] ) );
		if ( !$status->isOK() ) {
			throw new ScoreException( wfMessage( 'score-backend-error', $status->getWikiText() ) );
		}

		// File names of generated files
		$newFiles = array();
		// Backend operation batch
		$ops = array();

		// Add the MIDI file to the batch
		$ops[] = array(
			'op' => 'store',
			'src' => $factoryMidi,
			'dst' => "{$options['dest_storage_path']}/{$options['file_name_prefix']}.midi" );
		$newFiles["{$options['file_name_prefix']}.midi"] = true;
		if ( !$status->isOK() ) {
			throw new ScoreException( wfMessage( 'score-backend-error', $status->getWikiText() ) );
		}

		// Add the PNGs
		if ( file_exists( $factoryImageTrimmed ) ) {
			if ( $wgScoreTrim ) {
				$src = $factoryImageTrimmed;
			} else {
				$src = $factoryImage;
			}
			$dstFileName = "{$options['file_name_prefix']}.png";
			$ops[] = array(
				'op' => 'store',
				'src' => $src,
				'dst' => "{$options['dest_storage_path']}/$dstFileName" );

			$newFiles[$dstFileName] = true;
		} else {
			for ( $i = 1; ; ++$i ) {
				if ( $wgScoreTrim ) {
					$src = "$factoryDirectory/file-$i-trimmed.png";
				} else {
					$src = "$factoryDirectory/file-$i.png";
				}
				if ( !file_exists( $src ) ) {
					break;
				}
				$dstFileName = "{$options['file_name_prefix']}-$i.png";
				$dest = "{$options['dest_storage_path']}/$dstFileName";
				$ops[] = array(
					'op' => 'store',
					'src' => $src,
					'dst' => $dest );
				$newFiles[$dstFileName] = true;
			}
		}
		// Execute the batch
		$status = $backend->doQuickOperations( $ops );
		if ( !$status->isOK() ) {
			throw new ScoreException( wfMessage( 'score-backend-error', $status->getWikiText() ) );
		}
		return $newFiles;
	}

	/**
	 * Embeds simple LilyPond code in a score block.
	 *
	 * @param $lilypondCode string Simple LilyPond code.
	 *
	 * @return string Raw lilypond code.
	 *
	 * @throws ScoreException if determining the LilyPond version fails.
	 */
	private static function embedLilypondCode( $lilypondCode ) {
		/* Get LilyPond version if we don't know it yet */
		if ( self::$lilypondVersion === null ) {
			self::getLilypondVersion();
		}
		$version = self::$lilypondVersion;

		/* Raw code. In Scheme, ##f is false and ##t is true. */
		/* Set the default MIDI tempo to 100, 60 is a bit too slow */
		$raw = <<<LILYPOND
			\\header {
				tagline = ##f
			}
			\\paper {
				raggedright = ##t
				raggedbottom = ##t
				indent = 0\mm
			}
			\\version "$version"
			\\score {
				$lilypondCode
				\\layout { }
				\\midi {
					\\context {
						\\Score
						tempoWholesPerMinute = #(ly:make-moment 100 4)
					}
				}
			}
LILYPOND;

		return $raw;
	}

	/**
	 * Generates an Ogg/Vorbis file from a MIDI file using timidity.
	 *
	 * @param $sourceFile The local filename of the MIDI file
	 * @param $factoryDir The local temporary directory
	 * @param $remoteDest The backend storage path to upload the Ogg file to
	 *
	 * @throws ScoreException if an error occurs.
	 */
	private static function generateOgg( $sourceFile, $factoryDir, $remoteDest ) {
		global $wgScoreTimidity;

		$prof = new Score_ScopedProfiling(  __METHOD__ );

		if ( !is_executable( $wgScoreTimidity ) ) {
			throw new ScoreException( wfMessage( 'score-timiditynotexecutable', $wgScoreTimidity ) );
		}

		/* Working environment */
		self::createDirectory( $factoryDir, 0700 );
		$factoryOgg = "$factoryDir/file.ogg";

		/* Run timidity */
		$cmd = wfEscapeShellArg( $wgScoreTimidity )
			. ' -Ov' // Vorbis output
			. ' ' . wfEscapeShellArg( '--output-file=' . $factoryOgg )
			. ' ' . wfEscapeShellArg( $sourceFile )
			. ' 2>&1';
		$output = wfShellExec( $cmd, $rc );

		if ( ( $rc != 0 ) || !file_exists( $factoryOgg ) ) {
			self::throwCallException( wfMessage( 'score-oggconversionerr' ), $output, $factoryDir );
		}

		/* Move resultant file to proper place */
		$status = self::getBackend()->quickStore( array(
			'src' => $factoryOgg,
			'dst' => $remoteDest ) );
		if ( !$status->isOK() ) {
			throw new ScoreException( wfMessage( 'score-backend-error', $status->getWikiText() ) );
		}
	}

	/**
	 * Generates LilyPond code.
	 *
	 * @param $code string Score code.
	 * @param $options array Rendering options. They are the same as for
	 * 	Score::generateHTML(), with the following addition:
	 * 	* lilypond_path: local path to the LilyPond file that is to be
	 * 		generated.
	 *
	 * @throws ScoreException if an error occurs.
	 */
	private static function generateLilypond( $code, $options ) {
		$prof = new Score_ScopedProfiling( __METHOD__ );

		/* Delete old file if necessary */
		self::cleanupFile( $options['lilypond_path'] );

		/* Generate LilyPond code by score language */
		switch ( $options['lang'] ) {
		case 'ABC':
			self::generateLilypondFromAbc( 
				$code, $options['factory_directory'], $options['lilypond_path'] );
			break;
		case 'lilypond':
			throw new MWException( 'lang="lilypond" in ' . __METHOD__ . ". " .
				"This should not happen.\n" );
		default:
			throw new MWException( 'Unknown score language in ' . __METHOD__ . ". " .
				"This should not happen.\n" );
		}

	}

	/**
	 * Runs abc2ly, creating the LilyPond input file.
	 *
	 * @param $code string ABC code.
	 * @param $factoryDirectory Local temporary directory
	 * @param $destFile string Local destination path
	 *
	 * @throws ScoreException if the conversion fails.
	 */
	private static function generateLilypondFromAbc( $code, $factoryDirectory, $destFile ) {
		global $wgScoreAbc2Ly;

		$prof = new Score_ScopedProfiling( __METHOD__ );

		if ( !is_executable( $wgScoreAbc2Ly ) ) {
			throw new ScoreException( wfMessage( 'score-abc2lynotexecutable', $wgScoreAbc2Ly ) );
		}

		/* File names */
		$factoryAbc = "$factoryDirectory/file.abc";

		/* Create ABC input file */
		$rc = file_put_contents( $factoryAbc, $code );
		if ( $rc === false ) {
			throw new ScoreException( wfMessage( 'score-noabcinput', $factoryAbc ) );
		}

		/* Convert to LilyPond file */
		$cmd = wfEscapeShellArg( $wgScoreAbc2Ly )
			. ' -s'
			. ' ' . wfEscapeShellArg( '--output=' . $destFile )
			. ' ' . wfEscapeShellArg( $factoryAbc )
			. ' 2>&1';
		$output = wfShellExec( $cmd, $rc );
		if ( ( $rc != 0 ) || !file_exists( $destFile ) ) {
			self::throwCallException( wfMessage( 'score-abcconversionerr' ), $output, $factoryDir );
		}

		/* The output file has a tagline which should be removed in a wiki context */
		$lyData = file_get_contents( $destFile );
		if ( $lyData === false ) {
			throw new ScoreException( wfMessage( 'score-readerr', $destFile ) );
		}
		$lyData = preg_replace( '/^(\s*tagline\s*=).*/m', '$1 ##f', $lyData );
		if ( $lyData === null ) {
			throw new ScoreException( wfMessage( 'score-pregreplaceerr' ) );
		}
		$rc = file_put_contents( $destFile, $lyData );
		if ( $rc === false ) {
			throw new ScoreException( wfMessage( 'score-noinput', $destFile ) );
		}
	}

	/**
	 * Trims an image with ImageMagick.
	 *
	 * @param $source string Local path to the source image.
	 * @param $dest string Local path to the target (trimmed) image.
	 *
	 * @throws ScoreException on error.
	 */
	private static function trimImage( $source, $dest ) {
		global $wgImageMagickConvertCommand;

		$prof = new Score_ScopedProfiling( __METHOD__ );

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
	 * Deletes a local directory with no subdirectories with all files in it.
	 *
	 * @param $dir string Local path to the directory that is to be deleted.
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
	 * Deletes a local file if it exists.
	 *
	 * @param $path string Local path to the file to be deleted.
	 *
	 * @throws ScoreException if the file specified by $path exists but
	 * 	could not be deleted.
	 */
	private static function cleanupFile( $path ) {
		if ( file_exists( $path ) ) {
			$rc = unlink( $path );
			if ( !$rc ) {
				throw new ScoreException( wfMessage( 'score-cleanerr' ) );
			}
		}
	}

	/**
	 * Writes the specified message to the Score debug log.
	 *
	 * @param $msg string message to log.
	 */
	private static function debug( $msg ) {
		wfDebugLog( 'Score', $msg );
	}

}
