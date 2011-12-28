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
	'score-abc2lynotexecutable' => 'ABC to LilyPond converter could not be executed: $1 is not an executable file. Make sure <code>$wgScoreAbc2Ly</code> is set correctly.',
	'score-abcconversionerr' => 'Unable to convert ABC file to LilyPond format:
$1',
	'score-chdirerr' => 'Unable to change to directory $1',
	'score-cleanerr' => 'Unable to clean out old files before re-rendering',
	'score-compilererr' => 'Unable to compile LilyPond input file:
$1',
	'score-desc' => 'Adds a tag for rendering musical scores with LilyPond',
	'score-getcwderr' => 'Unable to obtain current working directory',
	'score-invalidlang' => 'Invalid score language lang="$1". Currently recognised languages are lang="lilypond" (the default) and lang="ABC".',
	'score-noabcinput' => 'ABC source file $1 could not be created.',
	'score-nofactory' => 'Failed to create LilyPond factory directory.',
	'score-noinput' => 'Failed to create LilyPond input file $1.',
	'score-noogghandler' => 'Ogg/Vorbis conversion requires an installed and configured OggHandler extension, see [//www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'No MIDI file generated despite being requested. If you are working in raw LilyPond mode, make sure to provide a proper \midi block.',
	'score-nooutput' => 'Failed to create LilyPond image directory $1.',
	'score-notexecutable' => 'Could not execute LilyPond: $1 is not an executable file. Make sure <code>$wgScoreLilyPond</code> is set correctly.',
	'score-novorbislink' => 'Unable to generate Ogg/Vorbis link: $1',
	'score-oggconversionerr' => 'Unable to convert MIDI to Ogg/Vorbis:
$1',
	'score-page' => 'Page $1',
	'score-pregreplaceerr' => 'PCRE regular expression replacement failed',
	'score-readerr' => 'Unable to read file $1.',
	'score-timiditynotexecutable' => 'TiMidity++ could not be executed: $1 is not an executable file. Make sure <code>$wgScoreTimidity</code> is set correctly.',
	'score-renameerr' => 'Error moving score files to upload directory.',
	'score-trimerr' => 'Image could not be trimmed:
$1
Set <code>$wgScoreTrim=false</code> if this problem persists.',
	'score-versionerr' => 'Unable to obtain LilyPond version:
$1',
);

/** Message documentation (Message documentation) */
$messages['qqq'] = array(
	'score-abc2lynotexecutable' => 'Displayed if the ABC to LilyPond converter could not be executed. $1 is the path to the abc2ly binary.',
	'score-abcconversionerr' => 'Displayed if the ABC to LilyPond conversion failed. $1 is the error (generally big block of text in a pre tag)',
	'score-chdirerr' => 'Displayed if the extension cannot change its working directory. $1 is the path to the target directory.',
	'score-cleanerr' => 'Displayed if an old file cleanup operation fails.',
	'score-compilererr' => 'Displayed if the LilyPond code could not be compiled. $1 is the error (generally big block of text in a pre tag)',
	'score-desc' => '{{desc}}',
	'score-getcwderr' => 'Displayed if the extension cannot obtain the current working directory.',
	'score-invalidlang' => 'Displayed if the lang="…" attribute contains an unrecognised score language. $1 is the unrecognised language.',
	'score-noabcinput' => 'Displayed if an ABC source file could not be created for lang="ABC". $1 is the path to the file that could not be created.',
	'score-nofactory' => 'Displayed if the LilyPond/ImageMagick working directory cannot be created.',
	'score-noinput' => 'Displayed if the LilyPond input file cannot be created. $1 is the path to the input file.',
	'score-noogghandler' => 'Displayed if Ogg/Vorbis rendering was requested without the OggHandler extension installed.',
	'score-nomidi' => 'Displayed if MIDI file generation was requested but no MIDI file was generated.',
	'score-nooutput' => 'Displayed if the LilyPond image/midi dir cannot be created. $1 is the name of the directory.',
	'score-notexecutable' => 'Displayed if LilyPond binary cannot be executed. $1 is the path to the LilyPond binary.',
	'score-novorbislink' => 'Displayed if an Ogg/Vorbis link could not be generated. $1 is the explanation why.',
	'score-oggconversionerr' => 'Displayed if the MIDI to Ogg/Vorbis conversion failed. $1 is the error (generally big block of text in a pre tag)',
	'score-page' => 'The word "Page" as used in pagination. $1 is the page number',
	'score-pregreplaceerr' => 'Displayed if a PCRE regular expression replacement failed.',
	'score-readerr' => 'Displayed if the extension could not read a file. $1 is the path to the file that could not be read.',
	'score-timiditynotexecutable' => 'Displayed if TiMidity++ could not be executed. $1 is the path to the TiMidity++ binary.',
	'score-renameerr' => 'Displayed if moving the resultant files from the working environment to the upload directory fails.',
	'score-trimerr' => 'Displayed if the extension failed to trim an output image. $1 is the error (generally big block of text in a pre tag)',
	'score-versionerr' => 'Displayed if the extension failed to obtain the version string of LilyPond. $1 is the LilyPond stdout output generated by the attempt.',
);

/** Danish (Dansk)
 * @author Peter Alberti
 */
$messages['da'] = array(
	'score-abc2lynotexecutable' => 'Kunne ikke køre programmet til at konvertere fra ABC til LilyPond: $1 er ikke en eksekverbar fil. Kontroller at <code>$wgScoreAbc2Ly</code> er sat korrekt.',
	'score-abcconversionerr' => 'Kunne ikke konvertere ABC-fil til LilyPond-format:
$1',
	'score-chdirerr' => 'Kunne ikke skifte folder til $1',
	'score-cleanerr' => 'Kunne ikke rense ud i gamle filer før genrendering',
	'score-compilererr' => 'Kunne ikke kompilere inddatafil til LilyPond:
$1',
	'score-desc' => 'Tilføjer et tag til at gengive partiturer ved hjælp af LilyPond',
	'score-getcwderr' => 'Kunne ikke bestemme navnet på den gældende arbejdsfolder',
	'score-invalidlang' => 'lang="$1" er et ugyldigt partitursprog. De sprog, der kan genkendes i øjeblikket, er lang="lilypond" (standardværdien) og lang="ABC".',
	'score-noabcinput' => 'Kunne ikke oprette ABC-kildefilen $1.',
	'score-nofactory' => 'Kunne ikke oprette arbejdsfolder til LilyPond',
	'score-noinput' => 'Kunne ikke oprette inddatafil til LilyPond, $1.',
	'score-noogghandler' => 'Omdannelse til Ogg/Vorbis kræver at udvidelsen OggHandler er installeret og sat op, se [//www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Ingen MIDI blev dannet på trods af anmodning. Hvis du arbejder i rå LilyPond-tilstand, sørg for at angive en passende \\midi-blok.',
	'score-nooutput' => 'Kunne ikke oprette folder til LilyPond-billeder, $1.',
	'score-notexecutable' => 'Kunne ikke køre LilyPond: $1 er ikke en eksekverbar fil. Kontroller at <code>$wgScoreLilyPond</code> er sat korrekt.',
	'score-novorbislink' => 'Kunne ikke oprette henvisning til Ogg/Vorbis: $1',
	'score-oggconversionerr' => 'Kunne ikke omdanne MIDI til Ogg/Vorbis:
$1',
	'score-page' => 'Side $1',
	'score-pregreplaceerr' => 'Erstatning med PCRE regulært udtryk lykkedes ikke',
	'score-readerr' => 'Kunne ikke læse filen $1.',
	'score-timiditynotexecutable' => 'Kunne ikke køre TiMidity++: $1 er ikke en eksekverbar fil. Kontroller at <code>$wgScoreTimidity</code> er sat korrekt.',
	'score-renameerr' => 'Der opstod en fejl under flytningen af partiturfiler til folderen for oplægning',
	'score-trimerr' => 'Billedet kunne ikke beskæres:
$1
Sæt $wgScoreTrim=false, hvis dette problem fortsætter.',
	'score-versionerr' => 'Kunne ikke bestemme LilyPonds version:
$1',
);

/** German (Deutsch)
 * @author Kghbln
 */
$messages['de'] = array(
	'score-abc2lynotexecutable' => 'Der Konverter von ABC nach LilyPond konnte nicht ausgeführt werden: $1 ist keine ausführbare Datei. Es muss sichergestellt sein, dass <code>$wgScoreAbc2Ly</code> in der Konfigurationsdatei richtig eingestellt wurde.',
	'score-abcconversionerr' => 'Die ABC-Datei konnte nicht in das LilyPond-Format konvertiert werden:
$1',
	'score-chdirerr' => 'Es konnte nicht zum Verzeichnis $1 gewechselt werden',
	'score-cleanerr' => 'Die alten Dateien konnten vor dem erneuten Rendern nicht bereinigt werden',
	'score-compilererr' => 'Die Eingabedatei von LilyPond konnte nicht kompiliert werden:
$1',
	'score-desc' => 'Ergänzt das Tag <code><score></code>, welches das Rendern und Einbetten von Partituren mit LilyPond ermöglicht',
	'score-getcwderr' => 'Das aktuelle Arbeitsverzeichnis konnte nicht aufgerufen werden',
	'score-invalidlang' => 'Die für die Partitur verwendete Sprache <code>lang="$1"</code> ist ungültig. Die derzeit verwendbaren Sprache sind <code>lang="lilypond"</code> (Standardeinstellung) und <code>lang="ABC"</code>.',
	'score-noabcinput' => 'Die ABC-Quelldatei $1 konnte nicht erstellt werden.',
	'score-nofactory' => 'Das Arbeitsverzeichnis für LilyPond konnte nicht erstellt werden',
	'score-noinput' => 'Die Eingabedatei $1 für LilyPond konnte nicht erstellt werden.',
	'score-noogghandler' => 'Um eine Ogg-Vorbnis-Konvertierung durchführen zu können, muss eine Erweiterung zur Nutzung von Ogg installiert sein. Siehe hierzu die [//www.mediawiki.org/wiki/Extension:OggHandler Erweiterung OggHandler].',
	'score-nomidi' => 'Ungeachtet einer entsprechenden Anforderung wurde keine MIDI-Datei generiert. Sofern der reine LilyPond-Modus genutzt wird, muss ein richtiger „\\midi“-Block angegeben werden.',
	'score-nooutput' => 'Das Bildverzeichnis $1 für LilyPond konnte nicht erstellt werden.',
	'score-notexecutable' => 'LilyPond konnte nicht ausgeführt werden: $1 ist eine nicht ausführbare Datei. Es muss sichergestellt sein, dass <code>$wgScoreLilyPond</code> in der Konfigurationsdatei richtig eingestellt wurde.',
	'score-novorbislink' => 'Es konnte kein Ogg-Vorbis-Link generiert werden: $1',
	'score-oggconversionerr' => 'MIDI konnte nicht in Ogg-Vorbis konvertiert werden:
$1',
	'score-page' => 'Seite $1',
	'score-pregreplaceerr' => 'Die PCRE-Musterersetzung ist gescheitert.',
	'score-readerr' => 'Die Datei $1 kann nicht gelesen werden.',
	'score-timiditynotexecutable' => 'TiMidity++ konnte nicht ausgeführt werden: $1 ist keine ausführbare Datei. Es muss sichergestellt sein, dass <code>$wgScoreTimidity</code> in der Konfigurationsdatei richtig eingestellt wurde.',
	'score-renameerr' => 'Beim Verschieben der Partiturdateien in das Verzeichnis zum Hochladen ist ein Fehler aufgetreten',
	'score-trimerr' => 'Das Bild konnte nicht zugeschnitten werden:
$1 
In der Konfigurationsdatei muss <code>$wgScoreTrim = false;</code> festgelegt werden, sofern das Problem bestehen bleibt.',
	'score-versionerr' => 'Die Version von LilyPond konnte nicht ermittelt werden:
$1',
);

/** French (Français)
 * @author Gomoko
 * @author Od1n
 * @author Seb35
 */
$messages['fr'] = array(
	'score-abc2lynotexecutable' => 'Le convertisseur ABC vers LilyPond n\'a pas pu être exécuté: $1 n\'est pas un fichier exécutable. Assurez-vous que <code>$wgScoreAbc2Ly</code> est défini correctement.',
	'score-abcconversionerr' => 'Impossible de convertir le fichier ABC au format LilyPond:
$1',
	'score-chdirerr' => 'Impossible de changer de répertoire vers $1',
	'score-cleanerr' => 'Impossible d’effacer les anciens fichiers avant de regénérer',
	'score-compilererr' => 'Impossible de compiler le fichier d’entrée LilyPond :
$1',
	'score-desc' => 'Ajoute une balise pour le rendu d’extraits musicaux avec LilyPond',
	'score-getcwderr' => 'Impossible d’obtenir le répertoire de travail actuel',
	'score-invalidlang' => 'Langage de partition invalide lang="$1". Les langages actuellement reconnus sont lang="lilypond" (par défaut) et lang="ABC".',
	'score-noabcinput' => "Le fichier source ABC $1 n'a pas pu être créé.",
	'score-nofactory' => 'Erreur lors de la création du répertoire de la fabrique LilyPond',
	'score-noinput' => 'Erreur lors de la création du fichier d’entrée $1 LilyPond',
	'score-noogghandler' => 'La conversion Ogg/Vorbis nécessite une extension OggHandler installée et configurée, voir [//www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Pas de fichier MIDI généré malgré la demande. Si vous travaillez en mode brut de LilyPond, assurez-vous de fournir un bloc \\midi correct.',
	'score-nooutput' => 'Erreur lors de la création du répertoire image $1 de LilyPond',
	'score-notexecutable' => 'Impossible d’exécuter LilyPond: $1 n\'est pas un fichier exécutable. Vérifiez que <code>$wgScoreLilyPond</code> est correctement configuré.',
	'score-novorbislink' => 'Impossible de générer un lien Ogg/Vorbis: $1',
	'score-oggconversionerr' => 'Impossible de convertir de MIDI en Ogg/Vorbis:
$1',
	'score-page' => 'Page $1',
	'score-pregreplaceerr' => "Le remplacement de l'expression régulière PCRE a échoué",
	'score-readerr' => 'Impossible de lire le fichier $1',
	'score-timiditynotexecutable' => "TiMidity++ n'a pas pu s'exécuter: \$1 n'est pas un fichier exécutable. Assurez-vous que <code>\$wgScoreTimidity</code> est défini correctement.",
	'score-renameerr' => 'Erreur lors du déplacement des fichiers de musique vers le répertoire de téléversement',
	'score-trimerr' => 'L\'image n\'a pas pu être retaillée:
$1
Paramétrez <code>$wgScoreTrim=false</code> si ce problème persiste.',
	'score-versionerr' => "Impossible d'obtenir la version de LilyPond:
$1",
);

/** Galician (Galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'score-abc2lynotexecutable' => 'Non se puido executar o conversor ABC a LilyPond: "$1" non é un ficheiro executable. Asegúrese de que <code>$wgScoreAbc2Ly</code> está definido correctamente.',
	'score-abcconversionerr' => 'Non se puido converter o ficheiro ABC ao formato LilyPond:
$1',
	'score-chdirerr' => 'Non se puido cambiar ao directorio "$1"',
	'score-cleanerr' => 'Non se puideron limpar os ficheiros vellos antes de volver renderizar',
	'score-compilererr' => 'Non se puido compilar o ficheiro de entrada LilyPond:
$1',
	'score-desc' => 'Engade unha etiqueta para renderizar partituras musicais co LilyPond',
	'score-getcwderr' => 'Non se puido obter o directorio de traballo actual',
	'score-invalidlang' => 'A lingua da partitura lang="$1" é incorrecta. As linguas recoñecidas nestes momentos son lang="lilypond" (predeterminada) e lang="ABC".',
	'score-noabcinput' => 'Non se puido crear o ficheiro de fonte ABC "$1".',
	'score-nofactory' => 'Erro ao crear o directorio do LilyPond.',
	'score-noinput' => 'Erro ao crear o ficheiro de entrada "$1" do LilyPond.',
	'score-noogghandler' => 'Para a conversión Ogg/Vorbis cómpre unha extensión OggHandler instalada e configurada; olle [//www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Non se xerou ficheiro MIDI ningún malia a solicitude. Se está a traballar no modo LilyPond en bruto asegúrese de proporcionar un bloque \\midi axeitado.',
	'score-nooutput' => 'Erro ao crear o directorio de imaxe "$1" do LilyPond.',
	'score-notexecutable' => 'Non se puido executar o LilyPond: "$1" non é un ficheiro executable. Asegúrese de que <code>$wgScoreLilyPond</code> está definido correctamente.',
	'score-novorbislink' => 'Non se puido xerar a ligazón Ogg/Vorbis: $1',
	'score-oggconversionerr' => 'Non se puido converter o MIDI a Ogg/Vorbis:
$1',
	'score-page' => 'Páxina $1',
	'score-pregreplaceerr' => 'Fallou a substitución da expresión regular PCRE',
	'score-readerr' => 'Non se puido ler o ficheiro "$1".',
	'score-timiditynotexecutable' => 'Non se puido executar o TiMidity++: "$1" non é un ficheiro executable. Asegúrese de que <code>$wgScoreTimidity</code> está definido correctamente.',
	'score-renameerr' => 'Erro ao mover os ficheiros das partituras ao directorio de cargas.',
	'score-trimerr' => 'Non se puido axustar a imaxe:
$1
Defina <code>$wgScoreTrim=false</code> se o problema persiste.',
	'score-versionerr' => 'Non se puido obter a versión do LilyPond:
$1',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'score-page' => 'Säit $1',
	'score-readerr' => 'De Fichier $1 konnt net geliest ginn.',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'score-abc2lynotexecutable' => 'Не можев да го извршам претворањето од ABC во LilyPond:$1 не е извршна податотека. Проверете дали <code>$wgScoreAbc2Ly</code> е правилно наместен.',
	'score-abcconversionerr' => 'Не можам да ја претворам ABC податотеката во формат LilyPond:
$1',
	'score-chdirerr' => 'Не можам да го сменам директориумот $1',
	'score-cleanerr' => 'Не можам да ги исчистам старите податотеки пред да извршам повторен испис',
	'score-compilererr' => 'Не можам да составам влезна податотека за LilyPond:
$1',
	'score-desc' => 'Додава ознака за испис на музички партитури со LilyPond',
	'score-getcwderr' => 'Не можам да го добијам тековниот работен директориум',
	'score-invalidlang' => 'lang="$1" не е важечки јазик за партитурата. Моментално се признаваат јазиците lang="lilypond" (основниот) и lang="ABC".',
	'score-noabcinput' => 'Не можев да ја создадам изворната ABC податотека $1.',
	'score-nofactory' => 'Не можев да создадам фабрички директориум за LilyPond',
	'score-noinput' => 'Не можев да ја создадам влезната податотека $1 за LilyPond.',
	'score-noogghandler' => 'Претворањето во Ogg/Vorbis бара инсталиран и наместен додаток OggHandler. Погл. [//www.mediawiki.org/wiki/Extension:OggHandler?uselang=mk Extension:OggHandler].',
	'score-nomidi' => 'Не е создадена MIDI податотека и покрај барањето. Ако работите во сиров режим на LilyPond, не заборавајте да ставите соодветен \\midi блок.',
	'score-nooutput' => 'Не можев да го создадам директориумот $1 за сликите на LilyPond',
	'score-notexecutable' => 'Не можев да го пуштам LilyPond. $1 не е извршна податотека. Проверете дали <code>$wgScoreLilyPond</code> е правилно наместен.',
	'score-novorbislink' => 'Не можам да создадам врска за Ogg/Vorbis: $1',
	'score-oggconversionerr' => 'Не можам да го претворам ова MIDI во Ogg/Vorbis:
$1',
	'score-page' => 'Страница $1',
	'score-pregreplaceerr' => 'Не успеа замената на регуларниот израз PCRE',
	'score-readerr' => 'Не можам да ја прочитам податотеката $1',
	'score-timiditynotexecutable' => 'TiMidity++ не може да се изврши: $1 не е извршна податотека. Проверете дали <code>$wgScoreTimidity</code> е правилно зададено.',
	'score-renameerr' => 'Грешка при преместувањето на партитурните податотеки во директориумот за подигања',
	'score-trimerr' => 'Не можев да ја скастрам сликата. 
$1
Ако проблемот продолжи да се јавува, задајте <code>$wgScoreTrim=false</code>.',
	'score-versionerr' => 'Не можам да ја добијам верзијата на LilyPond.
$1',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'score-abc2lynotexecutable' => 'Het conversieprogramma voor ABC naar LilyPond kon niet uitgevoerd worden: $1 is geen uitvoerbaar bestand. Zorg dat de instelling <code>$wgScoreAbc2Ly</code> correct is.',
	'score-abcconversionerr' => 'Het was niet mogelijk het ABC-bestand om te zetten naar LilyPond:
$1',
	'score-chdirerr' => 'Het was niet mogelijk naar de map $1 te gaan.',
	'score-cleanerr' => 'Het was niet mogelijk de oude bestanden op te ruimen voor het opnieuw aanmaken van de afbeeldingen',
	'score-compilererr' => 'Het was niet mogelijk de LilyPondinvoer te compileren:
$1',
	'score-desc' => 'Voegt een label toe voor het weergeven van bladmuziek met LilyPond',
	'score-getcwderr' => 'Het was niet mogelijk de ingestelde werkmap te gebruiken',
	'score-invalidlang' => 'Er is een onjuiste taal voor bladmuziek aangegeven (lang="$1"). Op dit moment worden lang="lilypond" (standaard) en lang="ABC" ondersteund.',
	'score-noabcinput' => 'Het ABC-bronbestand $1 kon niet aangemaakt worden',
	'score-nofactory' => 'Het was niet mogelijk de factorymap voor LilyPond aan te maken',
	'score-noinput' => 'Het was niet mogelijk het invoerbestand $1 voor LilyPond aan te maken',
	'score-noogghandler' => 'Voor het omzetten naar Ogg/Vorbis moet de uitbreiding OggHandler geïnstalleerd en ingesteld zijn. Zie [//www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Ondank een verzoek, is er geen MIDI-bestand aangemaakt. Als u in de modus LilyPond ruw werkt, zorg dan dat u een correcte opmaak van het onderdeel "\\midi" hebt.',
	'score-nooutput' => 'Het was niet mogelijk de afbeeldingenmap $1 voor LilyPond aan te maken',
	'score-notexecutable' => 'Het was niet mogelijk om LilyPond uit te voeren: $1 is geen uitvoerbaar bestand. Zorg dat de instelling <code>$wgScoreLilyPond</code> correct is.',
	'score-novorbislink' => 'Het was niet mogelijk een Ogg/Vorbis-verwijzing aan te maken: $1',
	'score-oggconversionerr' => 'Het was niet mogelijk MIDI naar Ogg/Vorbis om te zetten:
$1',
	'score-page' => 'Pagina $1',
	'score-pregreplaceerr' => 'Vervangen met behulp van een PCRE reguliere expressie is mislukt',
	'score-readerr' => 'Het bestand $1 kan niet gelezen worden.',
	'score-timiditynotexecutable' => 'TiMidity++ kon niet uitgevoerd worden: $1 is geen uitvoerbaar bestand. Zorg dat de instelling <code>$wgScoreTimidity</code> correct is.',
	'score-renameerr' => 'Er is een fout opgetreden tijdens het verplaatsen van de bladmuziekbestanden naar de uploadmap',
	'score-trimerr' => 'De afbeelding kon niet bijgesneden worden:
$1
Stel de volgende waarde in als dit probleem blijft bestaan: <code>$wgScoreTrim=false</code>.',
	'score-versionerr' => 'Het was niet mogelijk de LiliPond-versie te achterhalen:
$1',
);

