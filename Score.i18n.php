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

$messages = array();

/* English */
$messages['en'] = array(
	'score-chdirerr' => 'Unable to change directory',
	'score-cleanerr' => 'Unable to clean out old files before re-rendering',
	'score-compilererr' => 'Unable to compile LilyPond input file:
$1',
	'score-desc' => 'Adds a tag for rendering musical scores with LilyPond',
	'score-getcwderr' => 'Unable to obtain current working directory',
	'score-nooutput' => 'Failed to create LilyPond image directory',
	'score-nofactory' => 'Failed to create LilyPond factory directory',
	'score-noinput' => 'Failed to create LilyPond input file',
	'score-page' => 'Page $1',
	'score-renameerr' => 'Error moving score files to upload directory',
	'score-trimerr' => 'Image could not be trimmed. Set $wgScoreTrim=false if this problem persists.',
	'score-notexecutable' => 'Could not execute LilyPond. Make sure <code>$wgLilyPond</code> is set correctly.',
);

/* Descriptish */
$messages['qqq'] = array(
	'score-chdirerr' => 'Displayed if the extension cannot change its working directory.',
	'score-cleanerr' => 'Displayed if an old file cleanup operation fails.',
	'score-compilererr' => 'Displayed if the LilyPond code could not be compiled. $1 is the error (generally big block of text in a pre tag)',
	'score-desc' => '{{desc}}',
	'score-getcwderr' => 'Displayed if the extension cannot obtain the CWD.',
	'score-nooutput' => 'Displayed if the LilyPond image/midi dir cannot be created.',
	'score-nofactory' => 'Displayed if the LilyPond/ImageMagick working directory cannot be created.',
	'score-noinput' => 'Displayed if the LilyPond input file cannot be created.',
	'score-page' => 'The word "Page" as used in pagination. $1 is the page number',
	'score-renameerr' => 'Displayed if moving the resultant files from the working environment to the upload directory fails.',
	'score-trimerr' => 'Displayed if the extension failed to trim an output image.',
	'score-notexecutable' => 'Displayed if LilyPond binary can\'t be executed.',
);

