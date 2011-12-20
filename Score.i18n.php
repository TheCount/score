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
	'score-abc2lynotexecutable' => 'ABC to LilyPond converter could not be executed.',
	'score-abcconversionerr' => 'Unable to convert ABC file to LilyPond format:
$1',
	'score-noabcinput' => 'ABC source file could not be created',
	'score-chdirerr' => 'Unable to change directory',
	'score-cleanerr' => 'Unable to clean out old files before re-rendering',
	'score-compilererr' => 'Unable to compile LilyPond input file:
$1',
	'score-desc' => 'Adds a tag for rendering musical scores with LilyPond',
	'score-getcwderr' => 'Unable to obtain current working directory',
	'score-invalidlang' => 'Invalid score language specified. Currently recognised languages are lang="lilypond" (the default) and lang="ABC".',
	'score-nooutput' => 'Failed to create LilyPond image directory',
	'score-nofactory' => 'Failed to create LilyPond factory directory',
	'score-noinput' => 'Failed to create LilyPond input file',
	'score-notexecutable' => 'Could not execute LilyPond. Make sure <code>$wgLilyPond</code> is set correctly.',
	'score-page' => 'Page $1',
	'score-pregreplaceerr' => 'PCRE regular expression replacement failed',
	'score-readerr' => 'Unable to read file',
	'score-renameerr' => 'Error moving score files to upload directory',
	'score-trimerr' => 'Image could not be trimmed. Set $wgScoreTrim=false if this problem persists.',
	'score-versionerr' => 'Unable to obtain LilyPond version.',
);

/** Message documentation (Message documentation) */
$messages['qqq'] = array(
	'score-abc2lynotexecutable' => 'Displayed if the ABC to LilyPond converter could not be executed.',
	'score-abcconversionerr' => 'Displayed if the ABC to LilyPond conversion failed. $1 is the error (generally big block of text in a pre tag)',
	'score-noabcinput' => 'Displayed if an ABC source file could not be created for lang="ABC".',
	'score-chdirerr' => 'Displayed if the extension cannot change its working directory.',
	'score-cleanerr' => 'Displayed if an old file cleanup operation fails.',
	'score-compilererr' => 'Displayed if the LilyPond code could not be compiled. $1 is the error (generally big block of text in a pre tag)',
	'score-desc' => '{{desc}}',
	'score-getcwderr' => 'Displayed if the extension cannot obtain the CWD.',
	'score-invalidlang' => 'Displayed if the lang="…" attribute contains an unrecognised score language.',
	'score-nooutput' => 'Displayed if the LilyPond image/midi dir cannot be created.',
	'score-nofactory' => 'Displayed if the LilyPond/ImageMagick working directory cannot be created.',
	'score-noinput' => 'Displayed if the LilyPond input file cannot be created.',
	'score-notexecutable' => "Displayed if LilyPond binary can't be executed.",
	'score-page' => 'The word "Page" as used in pagination. $1 is the page number',
	'score-pregreplaceerr' => 'Displayed if a PCRE regular expression replacement failed.',
	'score-readerr' => 'Displayed if the extension could not read a file',
	'score-renameerr' => 'Displayed if moving the resultant files from the working environment to the upload directory fails.',
	'score-trimerr' => 'Displayed if the extension failed to trim an output image.',
	'score-versionerr' => 'Displayed if the extension failed to obtain the version string of LilyPond.',
);

/** Danish (Dansk)
 * @author Peter Alberti
 */
$messages['da'] = array(
	'score-chdirerr' => 'Kunne ikke skifte folder',
	'score-noinput' => 'Kunne ikke oprette inddatafil til LilyPond',
	'score-notexecutable' => 'Kunne ikke køre LilyPond. Kontroller at <code>$wgLilyPond</code> er sat korrekt.',
	'score-page' => 'Side $1',
	'score-readerr' => 'Kunne ikke læse fil',
	'score-trimerr' => 'Billedet kunne ikke beskæres. Sæt $wgScoreTrim=false, hvis dette problem fortsætter.',
	'score-versionerr' => 'Kunne ikke bestemme LilyPonds version.',
);

/** German (Deutsch)
 * @author Kghbln
 */
$messages['de'] = array(
	'score-abc2lynotexecutable' => 'Der Konverter von ABC nach LilyPond konnte nicht ausgeführt werden.',
	'score-abcconversionerr' => 'Die ABC-Datei konnte nicht in das LilyPond-Format konvertiert werden:
$1',
	'score-noabcinput' => 'Die ABC-Quelldatei konnte nicht erstellt werden',
	'score-chdirerr' => 'Das Verzeichnis konnte nicht geändert werden',
	'score-cleanerr' => 'Die alten Dateien konnten vor dem erneuten Rendern nicht bereinigt werden',
	'score-compilererr' => 'Die Eingabedatei von LilyPond konnte nicht kompiliert werden:
$1',
	'score-desc' => 'Ergänzt das Tag <code><score></code>, welches das Rendern und Einbetten von Partituren mit LilyPond ermöglicht',
	'score-getcwderr' => 'Das aktuelle Arbeitsverzeichnis konnte nicht aufgerufen werden',
	'score-invalidlang' => 'Für die Partitur wurde eine ungültige Sprache angegeben. Die derzeit verwendbaren Sprache sind <code>lang="lilypond"</code> (Standardeinstellung) und <code>lang="ABC"</code>.',
	'score-nooutput' => 'Das Bildverzeichnis für LilyPond konnte nicht erstellt werden',
	'score-nofactory' => 'Das Arbeitsverzeichnis für LilyPond konnte nicht erstellt werden',
	'score-noinput' => 'Die Eingabedatei für LilyPond konnte nicht erstellt werden',
	'score-notexecutable' => 'LilyPond konnte nicht ausgeführt werden. Es muss sichergestellt sein, dass <code>$wgLilyPond</code> in der Konfigurationsdatei richtig eingestellt wurde.',
	'score-page' => 'Seite $1',
	'score-pregreplaceerr' => 'Die PCRE-Musterersetzung ist gescheitert.',
	'score-readerr' => 'Die Datei kann nicht gelesen werden.',
	'score-renameerr' => 'Beim Verschieben der Partiturdateien in das Verzeichnis zum Hochladen ist ein Fehler aufgetreten',
	'score-trimerr' => 'Das Bild konnte nicht zugeschnitten werden. In der Konfigurationsdatei muss <code>$wgScoreTrim = false;</code> festgelegt werden, sofern das Problem bestehen bleibt.',
	'score-versionerr' => 'Die Version von LilyPond konnte nicht ermittelt werden.',
);

/** French (Français)
 * @author Seb35
 */
$messages['fr'] = array(
	'score-chdirerr' => 'Impossible de changer de répertoire',
	'score-cleanerr' => 'Impossible d’effacer les anciens fichiers avant de regénérer',
	'score-compilererr' => 'Impossible de compiler le fichier d’entrée LilyPond :
$1',
	'score-desc' => 'Ajoute une balise pour le rendu d’extraits musicaux avec LilyPond',
	'score-getcwderr' => 'Impossible d’obtenir le répertoire de travail actuel',
	'score-nooutput' => 'Erreur lors de la création du répertoire image de LilyPond',
	'score-nofactory' => 'Erreur lors de la création du répertoire de la fabrique LilyPond',
	'score-noinput' => 'Erreur lors de la création du fichier d’entrée LilyPond',
	'score-page' => 'Page $1',
	'score-renameerr' => 'Erreur lors du déplacement des fichiers de musique vers le répertoire de téléversement',
	'score-trimerr' => 'L’image ne peut pas être redimensionnée. Configurez $wgScoreTrim=false si le problème persiste.',
	'score-notexecutable' => 'Impossible d’exécuter LilyPond. Vérifiez que <code>$wgLilyPond</code> est correctement configuré.',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'score-page' => 'Säit $1',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'score-chdirerr' => 'Не можам да го сменам директориумот',
	'score-cleanerr' => 'Не можам да ги исчистам старите податотеки пред да извршам повторен испис',
	'score-compilererr' => 'Не можам да составам влезна податотека за LilyPond:
$1',
	'score-desc' => 'Додава ознака за испис на музички партитури со LilyPond',
	'score-getcwderr' => 'Не можам да го добијам тековниот работен директориум',
	'score-nooutput' => 'Не можев да создадам директориум за сликите на LilyPond',
	'score-nofactory' => 'Не можев да создадам фабрички директориум за LilyPond',
	'score-noinput' => 'Не можев да создадам влезна податотека за LilyPond',
	'score-page' => 'Страница $1',
	'score-renameerr' => 'Грешка при преместувањето на партитурните податотеки во директориумот за подигања',
	'score-trimerr' => 'Не можев да ја скастрам сликата. Ако проблемот продолжи да се јавува, поставете $wgScoreTrim=false.',
	'score-notexecutable' => 'Не можев да го пуштам LilyPond. Проверете дали <code>$wgLilyPond</code> е исправно наместено.',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'score-abc2lynotexecutable' => 'Het omzetten van ABC naar LilyPond was niet mogelijk.',
	'score-abcconversionerr' => 'Het was niet mogelijk het ABC-bestand om te zetten naar LilyPond:
$1',
	'score-noabcinput' => 'Het ABC-bronbestand kon niet aangemaakt worden',
	'score-chdirerr' => 'Van map wisselen is niet mogelijk',
	'score-cleanerr' => 'Het was niet mogelijk de oude bestanden op te ruimen voor het opnieuw aanmaken van de afbeeldingen',
	'score-compilererr' => 'Het was niet mogelijk de LilyPondinvoer te compileren:
$1',
	'score-desc' => 'Voegt een label toe voor het weergeven van bladmuziek met LilyPond',
	'score-getcwderr' => 'Het was niet mogelijk de ingestelde werkmap te gebruiken',
	'score-invalidlang' => 'Er is een onjuiste taal voor bladmuziek aangegeven. Op dit moment worden lang="lilypond" (standaard) en lang="ABC" ondersteund.',
	'score-nooutput' => 'Het was niet mogelijk de afbeeldingenmap voor LilyPond aan te maken',
	'score-nofactory' => 'Het was niet mogelijk de factorymap voor LilyPond aan te maken',
	'score-noinput' => 'Het was niet mogelijk het invoerbestand voor LilyPond aan te maken',
	'score-notexecutable' => 'Het was niet mogelijk om LilyPond uit te voeren. Zorg dat <code>$wgLilyPond</code> correct is ingesteld.',
	'score-page' => 'Pagina $1',
	'score-pregreplaceerr' => 'Vervangen met behulp van een PCRE reguliere expressie is mislukt',
	'score-readerr' => 'Het bestand kan niet gelezen worden',
	'score-renameerr' => 'Er is een fout opgetreden tijdens het verplaatsen van de bladmuziekbestanden naar de uploadmap',
	'score-trimerr' => 'De afbeelding kon niet bijgesneden worden. Stel de volgende waarde in als dit probleem blijft bestaan: <code>$wgScoreTrim=false</code>.',
	'score-versionerr' => 'Het was niet mogelijk de LiliPond-versie te achterhalen.',
);

