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

$messages['en'] = array(
	'score-abc2lynotexecutable' => 'ABC to LilyPond converter could not be executed: $1 is not an executable file. Make sure <code>$wgScoreAbc2Ly</code> is set correctly.',
	'score-abcconversionerr' => 'Unable to convert ABC file to LilyPond format:
$1',
	'score-chdirerr' => 'Unable to change to directory $1',
	'score-cleanerr' => 'Unable to clean out old files before re-rendering',
	'score-compilererr' => 'Unable to compile LilyPond input file:
$1',
	'score-backend-error' => 'Unable to copy the generated files to their final location:
$1',
	'score-desc' => 'Adds a tag for rendering musical scores with LilyPond',
	'score-getcwderr' => 'Unable to obtain current working directory',
	'score-invalidlang' => 'Invalid score language lang="<nowiki>$1</nowiki>". Currently recognised languages are lang="lilypond" (the default) and lang="ABC".',
	'score-invalidoggoverride' => 'The file "<nowiki>$1</nowiki>" you specified with override_ogg is invalid. Please specify the file name only, omit <nowiki>[[…]]</nowiki> and the "{{ns:file}}:" prefix.',
	'score-midioverridenotfound' => 'The file "<nowiki>$1</nowiki>" you specified with override_midi could not be found. Please specify the file name only, omit <nowiki>[[…]]</nowiki> and the "{{ns:file}}:" prefix.',
	'score-noabcinput' => 'ABC source file $1 could not be created.',
	'score-noimages' => 'No score images were generated. Please check your score code.',
	'score-noinput' => 'Failed to create LilyPond input file $1.',
	'score-noogghandler' => 'Ogg/Vorbis conversion requires an installed and configured OggHandler extension, see [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'No MIDI file generated despite being requested. If you are working in raw LilyPond mode, make sure to provide a proper \midi block.',
	'score-nooutput' => 'Failed to create output directory $1.',
	'score-notexecutable' => 'Could not execute LilyPond: $1 is not an executable file. Make sure <code>$wgScoreLilyPond</code> is set correctly.',
	'score-oggconversionerr' => 'Unable to convert MIDI to Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'The file "<nowiki>$1</nowiki>" you specified with override_ogg does not exist.',
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
	'score-vorbisoverrideogg' => 'You cannot request Ogg/Vorbis rendering and specify override_ogg at the same time.',
);

/** Message documentation (Message documentation)
 */
$messages['qqq'] = array(
	'score-abc2lynotexecutable' => 'Displayed if the ABC to LilyPond converter could not be executed. $1 is the path to the abc2ly binary.',
	'score-abcconversionerr' => 'Displayed if the ABC to LilyPond conversion failed. $1 is the error (generally big block of text in a pre tag)',
	'score-chdirerr' => 'Displayed if the extension cannot change its working directory. $1 is the path to the target directory.',
	'score-cleanerr' => 'Displayed if an old file cleanup operation fails.',
	'score-compilererr' => 'Displayed if the LilyPond code could not be compiled. $1 is the error (generally big block of text in a pre tag)',
	'score-desc' => '{{desc}}',
	'score-getcwderr' => 'Displayed if the extension cannot obtain the current working directory.',
	'score-invalidlang' => 'Displayed if the lang="…" attribute contains an unrecognised score language. $1 is the unrecognised language.',
	'score-invalidoggoverride' => 'Displayed if the file specified with the override_ogg="…" attribute is invalid. $1 is the value of the override_ogg attribute.',
	'score-midioverridenotfound' => 'Displayed if the file specified with the override_midi="…" attribute could not be found. $1 is the value of the override_midi attribute.',
	'score-noabcinput' => 'Displayed if an ABC source file could not be created for lang="ABC". $1 is the path to the file that could not be created.',
	'score-noimages' => 'Displayed if no score images were rendered.',
	'score-noinput' => 'Displayed if the LilyPond input file cannot be created. $1 is the path to the input file.',
	'score-noogghandler' => 'Displayed if Ogg/Vorbis rendering was requested without the OggHandler extension installed.',
	'score-nomidi' => 'Displayed if MIDI file generation was requested but no MIDI file was generated.',
	'score-nooutput' => 'Displayed if an output directory could not be created. $1 is the name of the directory.',
	'score-notexecutable' => 'Displayed if LilyPond binary cannot be executed. $1 is the path to the LilyPond binary.',
	'score-oggconversionerr' => 'Displayed if the MIDI to Ogg/Vorbis conversion failed. $1 is the error (generally big block of text in a pre tag)',
	'score-oggoverridenotfound' => 'Displayed if the file specified with the override_ogg="…" attribute could not be found. $1 is the value of the override_ogg attribute.',
	'score-page' => 'The word "Page" as used in pagination. $1 is the page number',
	'score-pregreplaceerr' => 'Displayed if a PCRE regular expression replacement failed.',
	'score-readerr' => 'Displayed if the extension could not read a file. $1 is the path to the file that could not be read.',
	'score-timiditynotexecutable' => 'Displayed if TiMidity++ could not be executed. $1 is the path to the TiMidity++ binary.',
	'score-renameerr' => 'Displayed if moving the resultant files from the working environment to the upload directory fails.',
	'score-trimerr' => 'Displayed if the extension failed to trim an output image. $1 is the error (generally big block of text in a pre tag)',
	'score-versionerr' => 'Displayed if the extension failed to obtain the version string of LilyPond. $1 is the LilyPond stdout output generated by the attempt.',
	'score-vorbisoverrideogg' => 'Displayed if both vorbis="1" and override_ogg="…" were specified.',
);

/** Asturian (asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'score-abc2lynotexecutable' => 'Nun se pudo executar el convertidor ABC a LilyPond: "$1" nun ye un ficheru executable. Asegurate de que <code>$wgScoreAbc2Ly</code> ta configuráu correutamente.',
	'score-abcconversionerr' => 'Non se pudo convertir el ficheru ABC al formatu LilyPond:
$1',
	'score-chdirerr' => 'Nun se pudo cambiar al direutoriu "$1"',
	'score-cleanerr' => 'Non se pudieron llimpiar los ficheros vieyos enantes de volver a renderizar',
	'score-compilererr' => "Nun se pudo compilar el ficheru d'entrada LilyPond:
$1",
	'score-backend-error' => 'Nun se pudieron copiar los ficheros xeneraos al so destín final:
$1',
	'score-desc' => 'Amiesta una etiqueta pa renderizar partitures musicales con LilyPond',
	'score-getcwderr' => 'Nun se pudo saber el direutoriu de trabayu actual',
	'score-invalidlang' => 'La llingua de la partitura lang="<nowiki>$1</nowiki>" ye inválida. Les llingües reconocíes nesti momentu son lang="lilypond" (predeterminada) y lang="ABC".',
	'score-invalidoggoverride' => "El ficheru «<nowiki>$1</nowiki>» qu'especificasti con override_ogg ye inválidu. Conseña namái el nome de ficheru, y omiti <nowiki>[[…]]</nowiki> y el prefixu «{{ns:file}}:».",
	'score-midioverridenotfound' => "El ficheru «<nowiki>$1</nowiki>» qu'especificasti con override_midi nun se pudo alcontrar. Conseña namái el nome de ficheru, y omiti <nowiki>[[…]]</nowiki> y el prefixu «{{ns:file}}:».",
	'score-noabcinput' => 'Nun se pudo crear el ficheru fonte ABC "$1".',
	'score-noimages' => 'Nun se xeneró denguna imaxe de partitura. Comprueba el códigu de la partitura.',
	'score-noinput' => "Hebo un fallu al crear el ficheru d'entrada de LilyPond $1.",
	'score-noogghandler' => 'La conversión Ogg/Vorbis necesita la estensión OggHandler instalada y configurada, visita [https://www.mediawiki.org/wiki/Extension:OggHandler Extensión:OggHandler].',
	'score-nomidi' => 'Nun se xeneró dengún ficheru MIDI anque se pidió. Si tas trabayando en mou LilyPond en bruto, asegurate de dar un bloque \\midi afayadizu.',
	'score-nooutput' => 'Hebo un fallu al crear el direutoriu de salida $1.',
	'score-notexecutable' => 'Nun se pudo executar LilyPond: $1 nun ye un ficheru executable. Asegurate de que <code>$wgScoreLilyPond</code> ta configuráu de mou correutu.',
	'score-oggconversionerr' => 'Nun se pudo convertir el MIDI a Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => "El ficheru «<nowiki>$1</nowiki>» qu'especificasti con override_ogg nun esiste.",
	'score-page' => 'Páxina $1',
	'score-pregreplaceerr' => 'Falló la sustitución de la espresión regular PCRE',
	'score-readerr' => 'Nun se pudo lleer el ficheru $1.',
	'score-timiditynotexecutable' => 'TiMidity++ nun se pudo executar: $1 nun ye un ficheru executable. Asegurate de que <code>$wgScoreTimidity</code> ta configuráu de mou correutu.',
	'score-renameerr' => 'Error al mover los ficheros de partitures al direutoriu de xubíes.',
	'score-trimerr' => 'Nun se pudo recortar la imaxe:
$1
Configura <code>$wgScoreTrim=false</code> si el problema persiste.',
	'score-versionerr' => 'Nun se pudo saber la versión de LilyPond:
$1',
	'score-vorbisoverrideogg' => 'Nun pues solicitar una renderización Ogg/Vorbis y especificar override_ogg al mesmu tiempu.',
);

/** Belarusian (Taraškievica orthography) (беларуская (тарашкевіца)‎)
 * @author EugeneZelenko
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'score-abc2lynotexecutable' => 'Пераўтваральнік з ABC у LilyPond ня можа быць выкліканы: $1 не зьяўляецца выканальным файлам. Праверце, ці <code>$wgScoreAbc2Ly</code> устаноўлены слушна.',
	'score-abcconversionerr' => 'Немагчыма пераўтварыць ABC-файл у фармат LilyPond:
$1',
	'score-chdirerr' => 'Немагчыма зьмяніць дырэкторыю $1',
	'score-cleanerr' => 'Немагчыма ачысьціць старыя файлы перад паказам',
	'score-compilererr' => 'Немагчыма скампіляваць зыходны файл LilyPond:
$1',
	'score-desc' => 'Дадае тэг для паказу музычных нот праз LilyPond',
);

/** Breton (brezhoneg)
 * @author Fulup
 */
$messages['br'] = array(
	'score-page' => 'Pajenn $1',
);

/** Danish (dansk)
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
	'score-invalidlang' => 'lang="<nowiki>$1</nowiki>" er et ugyldigt partitursprog. De sprog, der kan genkendes i øjeblikket, er lang="lilypond" (standardværdien) og lang="ABC".',
	'score-invalidoggoverride' => 'Filen "<nowiki>$1</nowiki>", som du angav med override_ogg, er ugyldig. Angiv venligst kun filnavnet og udelad <nowiki>[[…]]</nowiki> og "{{ns:file}}:"-præfikset.',
	'score-midioverridenotfound' => 'Kunne ikke finde filen "<nowiki>$1</nowiki>", som du angav med override_midi. Angiv venligst kun filnavnet og udelad <nowiki>[[…]]</nowiki> og "{{ns:file}}:"-præfikset.',
	'score-noabcinput' => 'Kunne ikke oprette ABC-kildefilen $1.',
	'score-noimages' => 'Ingen partiturbilleder blev dannet. Kontroller venligst om din kode er korrekt.',
	'score-noinput' => 'Kunne ikke oprette inddatafil til LilyPond, $1.',
	'score-noogghandler' => 'Omdannelse til Ogg/Vorbis kræver at udvidelsen OggHandler er installeret og sat op, se [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Ingen MIDI blev dannet på trods af anmodning. Hvis du arbejder i rå LilyPond-tilstand, sørg for at angive en passende \\midi-blok.',
	'score-nooutput' => 'Kunne ikke oprette folderen $1 til uddata.',
	'score-notexecutable' => 'Kunne ikke køre LilyPond: $1 er ikke en eksekverbar fil. Kontroller at <code>$wgScoreLilyPond</code> er sat korrekt.',
	'score-oggconversionerr' => 'Kunne ikke omdanne MIDI til Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Filen "<nowiki>$1</nowiki>", som du angav med override_ogg, findes ikke.',
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
	'score-vorbisoverrideogg' => 'Du kan ikke anmode om omdannelse til Ogg/Vorbis og bruge override_ogg samtidigt.',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'score-abc2lynotexecutable' => 'Der Konverter von ABC nach LilyPond konnte nicht ausgeführt werden: $1 ist keine ausführbare Datei. Es muss sichergestellt sein, dass <code>$wgScoreAbc2Ly</code> in der Konfigurationsdatei richtig eingestellt wurde.',
	'score-abcconversionerr' => 'Die ABC-Datei konnte nicht in das LilyPond-Format konvertiert werden:
$1',
	'score-chdirerr' => 'Es konnte nicht zum Verzeichnis $1 gewechselt werden',
	'score-cleanerr' => 'Die alten Dateien konnten vor dem erneuten Rendern nicht bereinigt werden',
	'score-compilererr' => 'Die Eingabedatei von LilyPond konnte nicht kompiliert werden:
$1',
	'score-backend-error' => 'Die erzeugten Dateien konnten nicht an ihren Zielort kopiert werden:
$1',
	'score-desc' => 'Ergänzt ein Tag, welches das Rendern und Einbetten von Partituren mit LilyPond ermöglicht',
	'score-getcwderr' => 'Das aktuelle Arbeitsverzeichnis konnte nicht aufgerufen werden',
	'score-invalidlang' => 'Die für die Partitur verwendete Sprache <code>lang="<nowiki>$1</nowiki>"</code> ist ungültig. Die derzeit verwendbaren Sprache sind <code>lang="lilypond"</code> (Standardeinstellung) und <code>lang="ABC"</code>.',
	'score-invalidoggoverride' => 'Die zu <code>override_ogg</code> angegebene Datei „<nowiki>$1</nowiki>“ ist ungültig. Bitte nur den Dateinamen angeben und dabei <nowiki>[[…]]</nowiki> sowie das Prefix „{{ns:file}}:“ weglassen.',
	'score-midioverridenotfound' => 'Die zu <code>override_midi</code> angegebene Datei „<nowiki>$1</nowiki>“ konnte nicht gefunden werden. Bitte nur den Dateinamen angeben und dabei <nowiki>[[…]]</nowiki> sowie das Prefix „{{ns:file}}:“ weglassen.',
	'score-noabcinput' => 'Die ABC-Quelldatei $1 konnte nicht erstellt werden.',
	'score-noimages' => 'Es wurden keine Bilder zur Partitur generiert. Bitte prüfe den Code zur Partitur.',
	'score-noinput' => 'Die Eingabedatei $1 für LilyPond konnte nicht erstellt werden.',
	'score-noogghandler' => 'Um eine Ogg-Vorbnis-Konvertierung durchführen zu können, muss eine Erweiterung zur Nutzung von Ogg installiert sein. Siehe hierzu die [https://www.mediawiki.org/wiki/Extension:OggHandler Erweiterung OggHandler].',
	'score-nomidi' => 'Ungeachtet einer entsprechenden Anforderung wurde keine MIDI-Datei generiert. Sofern der reine LilyPond-Modus genutzt wird, muss ein richtiger „\\midi“-Block angegeben werden.',
	'score-nooutput' => 'Das Ausgabeverzeichnis $1 konnte nicht erstellt werden.',
	'score-notexecutable' => 'LilyPond konnte nicht ausgeführt werden: $1 ist eine nicht ausführbare Datei. Es muss sichergestellt sein, dass <code>$wgScoreLilyPond</code> in der Konfigurationsdatei richtig eingestellt wurde.',
	'score-oggconversionerr' => 'MIDI konnte nicht in Ogg-Vorbis konvertiert werden:
$1',
	'score-oggoverridenotfound' => 'Die zu <code>override_ogg</code> angegebene Datei „<nowiki>$1</nowiki>“ ist nicht vorhanden.',
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
	'score-vorbisoverrideogg' => 'Es kann kein Ogg-Vorbis-Rendern angefordert und gleichzeitig <code>override_ogg</code> angegeben werden.',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'score-noimages' => 'Es wurden keine Bilder zur Partitur generiert. Bitte prüfen Sie den Code zur Partitur.',
);

/** Zazaki (Zazaki)
 * @author Erdemaslancan
 */
$messages['diq'] = array(
	'score-page' => 'Pela $1',
);

/** Spanish (español)
 * @author Armando-Martin
 * @author Dalton2
 */
$messages['es'] = array(
	'score-abc2lynotexecutable' => 'No se pudo ejecutar el conversor ABC a LilyPond: "$1" no es un archivo ejecutable. Asegúrese de que <code>$wgScoreAbc2Ly</code> está definido correctamente.',
	'score-abcconversionerr' => 'No se ha podido convertir el archivo ABC a formato LilyPond:
$1',
	'score-chdirerr' => 'No se pudo cambiar al directorio $1',
	'score-cleanerr' => 'No se han podido limpiar los archivos antiguos antes de volver a generar la imagen (renderizar)',
	'score-compilererr' => 'No se pudo compilar el archivo de entrada LilyPond:
$1',
	'score-backend-error' => 'No se pueden copiar los archivos generados en su ubicación final:
$1',
	'score-desc' => 'Agrega una etiqueta para renderizar partituras musicales con LilyPond',
	'score-getcwderr' => 'No se ha podido obtener el directorio de trabajo actual',
	'score-invalidlang' => 'El idioma de la partitura lang="<nowiki>$1</nowiki>" es incorrecto. Los únicos idiomas reconocidos en estos momentos son lang="lilypond" (predeterminado) e lang="ABC".',
	'score-invalidoggoverride' => 'El archivo "<nowiki>$1</nowiki>" que ha especificado con override_ogg no es válido. Especifique únicamente el nombre del archivo, omita <nowiki>[[…]]</nowiki> y el prefijo "{{ns:file}}:".',
	'score-midioverridenotfound' => 'El archivo "<nowiki>$1</nowiki>" que ha especificado con override_midi no pudo ser encontrado. Especifique únicamente el nombre del archivo, omita <nowiki>[[…]]</nowiki> y el prefijo "{{ns:file}}:".',
	'score-noabcinput' => 'No se pudo crear el archivo fuente ABC "$1".',
	'score-noimages' => 'No se generó ninguna imagen de partitura. Compruebe su código de partitura.',
	'score-noinput' => 'Error al crear el archivo de entrada "$1" de LilyPond.',
	'score-noogghandler' => 'La conversión Ogg/Vorbis necesita una extensión OggHandler instalada y configurada, ver [https://www.mediawiki.org/wiki/Extension:OggHandler Extensión:OggHandler].',
	'score-nomidi' => 'No se generó el archivo MIDI a pesar de que fue solicitado. Si está a trabajando en modo LilyPond en bruto, asegúrese de proporcionar un bloque \\midi adecuado.',
	'score-nooutput' => 'Error al crear el directorio de salida "$1".',
	'score-notexecutable' => 'No se pudo ejecutar LilyPond: "$1" no es un archivo ejecutable. Asegúrese de que <code>$wgScoreLilyPond</code> está definido correctamente.',
	'score-oggconversionerr' => 'No se pudo converter de MIDI a Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'El archivo "<nowiki>$1</nowiki>" que ha especificado con override_ogg no existe.',
	'score-page' => 'Página $1',
	'score-pregreplaceerr' => 'Falló la substitución de la expresión regular PCRE',
	'score-readerr' => 'No se pudo leer el archivo "$1".',
	'score-timiditynotexecutable' => 'No se pudo ejecutar TiMidity++: $1 no es un archivo ejecutable. Asegúrese de que <code>$wgScoreTimidity</code> está definido correctamente.',
	'score-renameerr' => 'Error al trasladar los archivos de partituras al directorio de cargas.',
	'score-trimerr' => 'No se pudo ajustar la imagen:
$1
Defina <code>$wgScoreTrim=false</code> si persiste el problema.',
	'score-versionerr' => 'No se pudo obtener la versión de LilyPond:
$1',
	'score-vorbisoverrideogg' => 'No puede solicitar una renderización Ogg/Vorbis y especificar override_ogg al mismo tiempo.',
);

/** Finnish (suomi)
 * @author Crt
 */
$messages['fi'] = array(
	'score-page' => 'Sivu $1',
);

/** French (français)
 * @author Crochet.david
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
	'score-backend-error' => 'Impossible de copier les fichiers générés vers leur emplacement cible:
$1',
	'score-desc' => 'Ajoute une balise pour le rendu d’extraits musicaux avec LilyPond',
	'score-getcwderr' => 'Impossible d’obtenir le répertoire de travail actuel',
	'score-invalidlang' => 'Langage de partition invalide lang="<nowiki>$1</nowiki>". Les langages actuellement reconnus sont lang="lilypond" (par défaut) et lang="ABC".',
	'score-invalidoggoverride' => 'Le fichier "<nowiki>$1</nowiki>" que vous avez spécifié avec override_ogg n\'est pas valide. Veuillez spécifier uniquement le nom du fichier, omettez <nowiki>[[…]]</nowiki> et le préfixe "{{ns:file}}:".',
	'score-midioverridenotfound' => 'Le fichier "<nowiki>$1</nowiki>" que vous avez spécifié avec override_midi est introuvable. Veuillez spécifier uniquement le nom du fichier, sans <nowiki>[[…]]</nowiki> et le préfixe "{{ns:file}}:".',
	'score-noabcinput' => "Le fichier source ABC $1 n'a pas pu être créé.",
	'score-noimages' => "Aucune image de résultat n'a été générée. Veuillez vérifier votre code de résultat.",
	'score-noinput' => 'Erreur lors de la création du fichier d’entrée $1 LilyPond',
	'score-noogghandler' => 'La conversion Ogg/Vorbis nécessite une extension OggHandler installée et configurée, voir [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Pas de fichier MIDI généré malgré la demande. Si vous travaillez en mode brut de LilyPond, assurez-vous de fournir un bloc \\midi correct.',
	'score-nooutput' => 'Erreur lors de la création du répertoire de sortie $1.',
	'score-notexecutable' => 'Impossible d’exécuter LilyPond: $1 n\'est pas un fichier exécutable. Vérifiez que <code>$wgScoreLilyPond</code> est correctement configuré.',
	'score-oggconversionerr' => 'Impossible de convertir de MIDI en Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Le fichier "<nowiki>$1</nowiki>" que vous avez spécifié avec override_ogg n’existe pas.',
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
	'score-vorbisoverrideogg' => 'Vous ne peut pas demander de rendu de Ogg/Vorbis et spécifier override_ogg en même temps.',
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'score-page' => 'Pâge $1',
	'score-readerr' => 'Empossiblo de liére lo fichiér $1.',
);

/** Galician (galego)
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
	'score-backend-error' => 'Non se puideron copiar os ficheiros xerados á súa localización final:
$1',
	'score-desc' => 'Engade unha etiqueta para renderizar partituras musicais co LilyPond',
	'score-getcwderr' => 'Non se puido obter o directorio de traballo actual',
	'score-invalidlang' => 'A lingua da partitura lang="<nowiki>$1</nowiki>" é incorrecta. As linguas recoñecidas nestes momentos son lang="lilypond" (predeterminada) e lang="ABC".',
	'score-invalidoggoverride' => 'O ficheiro "<nowiki>$1</nowiki>" que especificou con override_ogg non é válido. Especifique unicamente o nome do ficheiro, omita <nowiki>[[…]]</nowiki> e o prefixo "{{ns:file}}:".',
	'score-midioverridenotfound' => 'O ficheiro "<nowiki>$1</nowiki>" que especificou con override_midi non se puido atopar. Especifique unicamente o nome do ficheiro, omita <nowiki>[[…]]</nowiki> e o prefixo "{{ns:file}}:".',
	'score-noabcinput' => 'Non se puido crear o ficheiro de fonte ABC "$1".',
	'score-noimages' => 'Non se xerou ningunha imaxe de partitura. Comprobe o código.',
	'score-noinput' => 'Erro ao crear o ficheiro de entrada "$1" do LilyPond.',
	'score-noogghandler' => 'Para a conversión Ogg/Vorbis cómpre unha extensión OggHandler instalada e configurada; olle [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Non se xerou ficheiro MIDI ningún malia a solicitude. Se está a traballar no modo LilyPond en bruto asegúrese de proporcionar un bloque \\midi axeitado.',
	'score-nooutput' => 'Erro ao crear o directorio de saída "$1".',
	'score-notexecutable' => 'Non se puido executar o LilyPond: "$1" non é un ficheiro executable. Asegúrese de que <code>$wgScoreLilyPond</code> está definido correctamente.',
	'score-oggconversionerr' => 'Non se puido converter o MIDI a Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'O ficheiro "<nowiki>$1</nowiki>" que especificou con override_ogg non existe.',
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
	'score-vorbisoverrideogg' => 'Non pode solicitar unha renderización Ogg/Vorbis e asemade especificar override_ogg.',
);

/** Hebrew (עברית)
 * @author Amire80
 */
$messages['he'] = array(
	'score-abc2lynotexecutable' => 'המרה מ־ABC ל־LilyPond לא יכלה להתבצע: $1 אינו קובץ בר־הרצה. נא לודא שהמשתנה <code>$wgScoreAbc2Ly</code> מוגדר נכון.',
	'score-abcconversionerr' => 'לא ניתן להמיר את קובץ ה־ABC לתסדיר LilyPond:
$1',
	'score-chdirerr' => 'לא ניתן לעבור את התיקייה $1',
	'score-cleanerr' => 'לא ניתן לנקות קבצים ישנים לפני ציור מחדש',
	'score-compilererr' => 'לא ניתן לקמפל קובץ קלט של LilyPond:
$1',
	'score-backend-error' => 'לא ניתן להעתיק את הקבצים שנוצרו ליעדם הסופי:
$1',
	'score-desc' => 'הוספת תג להצגת תווים מוזיקליים באמצעות LilyPond',
	'score-getcwderr' => 'לא ניתן לקבל את התיקייה הנוכחית',
	'score-invalidlang' => 'שפת תווים מוזיקליים בלתי־תקינה <span dir="ltr">lang="<nowiki>$1</nowiki>"</span>. כרגע השפות המוּכרות הן <span dir="ltr">lang="lilypond"</span> ו־<span dir="ltr">lang="<nowiki>ABC</nowiki>"</span>.',
	'score-invalidoggoverride' => 'הקובץ "<nowiki>$1</nowiki>" שציינת עם override_ogg אינו תקין. נא לציין את שם הקובץ בלבד, להשמיט את <nowiki>[[…]]</nowiki> ואת התחילית "{{ns:file}}:".',
	'score-midioverridenotfound' => 'הקובץ "<nowiki>$1</nowiki>" שציינת עם override_midi אינו תקין. נא לציין את שם הקובץ בלבד, להשמיט את <nowiki>[[…]]</nowiki> ואת התחילית "{{ns:file}}:".',
	'score-noabcinput' => 'קובץ $1 עם קוד המקור של ABC לא יכול היה להיווצר.',
	'score-noimages' => 'לא נוצרו תמונות של תווים. נא לבדוק את קוד התווים שלך.',
	'score-noinput' => 'יצירת הקובץ $1 עם קלט של LilyPond לא הצליחה.',
	'score-noogghandler' => "המרת Ogg/Vorbis דורשת התקנה והגדרה של ההרחבה OggHandler, ר' [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].",
	'score-nomidi' => 'לא נוצר שום קובץ MIDI, למקות ש התבקש כזה. אם זה מצב LilyPond טהור, יש לספק גוש <span dir="ltr">\\midi</span> מתאים.',
	'score-nooutput' => 'לא ניתן היה ליצור את תיקיית הפלט $1.',
	'score-notexecutable' => 'לא ניתן להריץ את LilyPond: הקובץ $1 אינו בר־הרצה. נא לוודא שנמשתנה <code>$wgScoreLilyPond</code> מוגדר נכון.',
	'score-oggconversionerr' => 'לא ניתן להמיר קובץ MIDI ל־Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'הקובץ "<nowiki>$1</nowiki>" שהציינת עם override_ogg אינו קיים.',
	'score-page' => 'עמוד $1',
	'score-pregreplaceerr' => 'החלפה ביטויים רגולריים עם PCRE נכשלה',
	'score-readerr' => 'לא ניתן לקרוא את הקובץ $1.',
	'score-timiditynotexecutable' => 'לא ניתן להריץ את <span dir="ltr">TiMidity++</span>: הקובץ $1 אינו בר־הרצה. נא לוודא שנמשתנה <code>$wgScoreLilyPond</code> מוגדר נכון.',
	'score-renameerr' => 'שגיאה בהעברת קובצי תווים לתיקיית ההעלאה.',
	'score-trimerr' => 'לא ניתן לקצץ את התמונה:
$1
יש להגדיר <code dir="ltr">$wgScoreTrim=false</code> אם הבעיה ממשיכה.',
	'score-versionerr' => 'לא ניתן לקבל את גרסת LilyPond:
$1',
	'score-vorbisoverrideogg' => 'לא ניתן לקבל הצגה כ־Ogg/Vorbis ולציין override_ogg באותו הזמן.',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'score-abcconversionerr' => 'ABC-dataja njeda so do formata LilyPond konwertować: $1',
	'score-chdirerr' => 'Njejo móžno do zapisa $1 přeńć',
	'score-compilererr' => 'Zapodawanska dataja LilyPond njeda so kompilować:
$1',
	'score-noabcinput' => 'Žórłowa ABC-dataja $1 njeda so wutworić.',
	'score-noinput' => 'Zapodawanska dataja LilyPond $1 njeda so wutworić.',
	'score-nooutput' => 'Wudawanski zapis $1 njeda so wutworić.',
	'score-oggconversionerr' => 'MIDI njeda so do Ogg/Vorbis konwertować:
$1',
	'score-oggoverridenotfound' => 'Dataja "<nowiki>$1</nowiki>", kotruž sy z override_ogg podał, njeeksistuje.',
	'score-page' => 'Strona $1',
	'score-readerr' => 'Dataja $1 njeda so čitać.',
	'score-versionerr' => 'Wersija LilyPond njeda so zwěsćić:
$1',
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'score-abc2lynotexecutable' => 'Le convertitor ABC a LilyPond non poteva esser executate: $1 non es un file executabile. Assecura te que <code>$wgScoreAbc2Ly</code> es definite correctemente.',
	'score-abcconversionerr' => 'Impossibile converter le file ABC al formato LilyPond:
$1',
	'score-chdirerr' => 'Impossibile cambiar al directorio $1',
	'score-cleanerr' => 'Impossibile rader le vetere files ante de regenerar',
	'score-compilererr' => 'Impossibile compilar le file de entrata LilyPond:
$1',
	'score-desc' => 'Adde un etiquetta pro le rendition de partituras musical con LilyPond',
	'score-getcwderr' => 'Impossibile obtener le directorio de labor actual',
	'score-invalidlang' => 'Linguage de partitura invalide: lang="<nowiki>$1</nowiki>". Le linguages actualmente recognoscite es lang="lilypond" (le predefinition) e lang="ABC".',
	'score-invalidoggoverride' => 'Le file "<nowiki>$1</nowiki>" que tu specificava con override_ogg es invalide. Per favor specifica le nomine del file solmente, omittente <nowiki>[[…]]</nowiki> e le prefixo "{{ns:file}}:".',
	'score-midioverridenotfound' => 'Le file "<nowiki>$1</nowiki>" que tu specificava con override_ogg non poteva esser trovate. Per favor specifica le nomine del file solmente, omittente <nowiki>[[…]]</nowiki> e le prefixo "{{ns:file}}:".',
	'score-noabcinput' => 'Le file de fonte ABC $1 non poteva esser create.',
	'score-noimages' => 'Nulle imagine de partitura ha essite generate. Per favor verifica tu codice de partitura.',
	'score-noinput' => 'Le creation del file de entrata LilyPond $1 ha fallite.',
	'score-noogghandler' => 'Le conversion in Ogg/Vorbis require un extension OggHandler installate e configurate, vide [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Nulle file MIDI ha essite generate, malgrado que illo esseva requestate. Si tu travalia in modo LilyPond brute, assecura te de fornir un bloco \\midi correcte.',
	'score-nooutput' => 'Le creation del directorio de output $1 ha fallite.',
	'score-notexecutable' => 'Impossibile executar LilyPond: $1 non es un file executabile. Assecura te que <code>$wgScoreLilyPond</code> es definite correctemente.',
	'score-oggconversionerr' => 'Impossibile converter MIDI in Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Le file "<nowiki>$1</nowiki>" que tu specificava con override_ogg non existe.',
	'score-page' => 'Pagina $1',
	'score-pregreplaceerr' => 'Le reimplaciamento del expression regular PCRE ha fallite',
	'score-readerr' => 'Impossibile leger le file $1.',
	'score-timiditynotexecutable' => 'TiMidity++ non poteva esser executate: $1 non es un file executabile. Assecura te que <code>$wgScoreTimidity</code> es definite correctemente.',
	'score-renameerr' => 'Error durante le displaciamento de files de partitura al directorio de incargamento.',
	'score-trimerr' => 'Le imagine non poteva esser taliate:
$1
Defini <code>$wgScoreTrim=false</code> si iste problema persiste.',
	'score-versionerr' => 'Impossibile obtener le version de LilyPond:
$1',
	'score-vorbisoverrideogg' => 'Tu non pote requestar un rendition in Ogg/Vorbis e specificar override_ogg al mesme tempore.',
);

/** Italian (italiano)
 * @author Beta16
 * @author F. Cosoleto
 * @author Gianfranco
 */
$messages['it'] = array(
	'score-abc2lynotexecutable' => 'Il convertitore ABC a LilyPond non può essere eseguito: $1 non è un file eseguibile. Assicurarsi che <code>$wgScoreAbc2Ly</code> è configurato correttamente.',
	'score-abcconversionerr' => 'Impossibile convertire file ABC al formato LilyPond:
$1',
	'score-chdirerr' => 'Impossibile cambiare alla directory: $1',
	'score-cleanerr' => 'Impossibile ripulire i vecchi file prima di rifare il rendering',
	'score-compilererr' => "Compilazione del file d'input LilyPond fallita:
$1",
	'score-backend-error' => 'Impossibile copiare i file generati nella loro destinazione finale:
$1',
	'score-desc' => 'Aggiunge un tag per il rendering di spartiti musicali con LilyPond',
	'score-getcwderr' => 'Impossibile accedere alla directory di lavoro corrente',
	'score-invalidlang' => 'Risultato non valido per il linguaggio lang="<nowiki>$1</nowiki>". I linguaggi attualmente riconosciuti sono lang="lilypond" (predefinito) e lang="ABC".',
	'score-invalidoggoverride' => 'Il file "<nowiki>$1</nowiki>" che hai specificato con override_ogg non è valido. Per favore, specifica solo il nome del file, ometti <nowiki>[[…]]</nowiki> e il prefisso "{{ns:file}}:".',
	'score-midioverridenotfound' => 'Il file "<nowiki>$1</nowiki>" che hai specificato con override_midi non è stato trovato. Per favore, specifica solo il nome del file, ometti <nowiki>[[…]]</nowiki> e il prefisso "{{ns:file}}:".',
	'score-noabcinput' => 'Non è stato possibile creare $1, file sorgente ABC.',
	'score-noimages' => 'Non si possono generare immagini di partiture, controllare il codice della partitura.',
	'score-noinput' => "Creazione del file d'input LilyPond $1 non riuscita.",
	'score-noogghandler' => "La conversione OGG/Vorbis richiede un'estensione OggHandler installata e configurata, vedere [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].",
	'score-nomidi' => 'Nessun file MIDI generato sebbene sia richiesto. Se si lavora manualmente con codice LilyPond, assicurarsi della presenza di un corretto blocco \\midi.',
	'score-nooutput' => 'Creazione della directory di output $1 non riuscita.',
	'score-notexecutable' => 'LilyPond non può essere eseguito:  $1 non è un file eseguibile. Assicurarsi che <code>$wgScoreLilyPond</code> sia configurato correttamente.',
	'score-oggconversionerr' => 'Conversione da MIDI a Ogg/Vorbis non riuscita:
$1',
	'score-oggoverridenotfound' => 'Il file "<nowiki>$1</nowiki>" indicato con override_ogg non esiste.',
	'score-page' => 'Pagina $1',
	'score-pregreplaceerr' => 'La sostituzione con espressione regolare PCRE non è riuscita',
	'score-readerr' => 'Lettura del file $1 fallita.',
	'score-timiditynotexecutable' => 'TiMidity++ non può essere eseguito: $1 non è un file eseguibile. Assicurarsi che <code>$wgScoreTimidity</code> sia configurato correttamente.',
	'score-renameerr' => 'Errore nello spostamento dei file di partitura alla directory di upload.',
	'score-trimerr' => 'Non si è potuto ritagliare questa immagine:
$1
Definisci <code>$wgScoreTrim=false</code> se il problema persiste.',
	'score-versionerr' => 'Impossibile ottenere la versione di LilyPond:
$1',
	'score-vorbisoverrideogg' => 'Non è possibile richiedere un rendering Ogg/Vorbis e specificare override_ogg allo stesso tempo.',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'score-abc2lynotexecutable' => 'ABC から LilyPond へのコンバーターを実行できません: $1 は実行可能ファイルではありません。<code>$wgScoreAbc2Ly</code> が正しく設定されているか確認してください。',
	'score-abcconversionerr' => 'ABC ファイルを LilyPond 形式に変換できません:
$1',
	'score-chdirerr' => '現在のディレクトリを $1 に変更できません',
	'score-cleanerr' => '再レンダリングの前に、古いファイルを消去できませんでした',
	'score-compilererr' => 'LilyPond 入力ファイルをコンパイルできません:
$1',
	'score-backend-error' => '生成したファイルを最終的な出力先にコピーできません:
$1',
	'score-desc' => 'LilyPond で楽譜を描画する、タグを追加する',
	'score-getcwderr' => '現在のディレクトリを取得できません',
	'score-invalidlang' => '楽譜の言語 lang="<nowiki>$1</nowiki>" は無効です。現在認識できる言語は lang="lilypond" (既定) および lang="ABC" です。',
	'score-invalidoggoverride' => 'override_ogg に指定されたファイル「<nowiki>$1</nowiki>」は無効です。<nowiki>[[…]]</nowiki> や「{{ns:file}}:」を省略して、ファイル名のみを指定してください。',
	'score-midioverridenotfound' => 'override_midi で指定されたファイル「<nowiki>$1</nowiki>」が見つかりません。<nowiki>[[…]]</nowiki> や「{{ns:file}}:」を省略して、ファイル名のみを指定してください。',
	'score-noabcinput' => 'ABC ソース ファイル $1 を作成できませんでした。',
	'score-noimages' => '楽譜画像を生成できませんでした。ソースコードを確認してください。',
	'score-noinput' => 'LilyPond 入力ファイル $1 の作成に失敗しました。',
	'score-noogghandler' => 'Ogg/Vorbis 変換には、OggHandler 拡張機能のインストール/設定が必要です。[https://www.mediawiki.org/wiki/Extension:OggHandler/ja Extension:OggHandler/ja] をご覧ください。',
	'score-nooutput' => '出力ディレクトリ $1 の作成に失敗しました。',
	'score-notexecutable' => 'LilyPond を実行できませんでした: $1 は実行可能ファイルではありません。<code>$wgScoreLilyPond</code> が正しく設定されているか確認してください。',
	'score-oggconversionerr' => 'MIDI を Ogg/Vorbis に変換できません:
$1',
	'score-oggoverridenotfound' => 'override_ogg で指定されたファイル「$1」は存在しません。',
	'score-page' => 'ページ $1',
	'score-pregreplaceerr' => 'PCRE 正規表現置換に失敗しました',
	'score-readerr' => 'ファイル $1 から読み取れません。',
	'score-timiditynotexecutable' => 'TiMidity++ を実行できませんでした: $1 は実行可能ファイルではありません。<code>$wgScoreTimidity</code> が正しく設定されているか確認してください。',
	'score-renameerr' => '楽譜ファイルをアップロードディレクトリに移動する際にエラーが発生しました。',
	'score-trimerr' => '画像をトリミングできませんでした:
$1
この問題が続く場合は、<code>$wgScoreTrim=false</code> を設定してください。',
	'score-versionerr' => 'LilyPond のバージョンを取得できません:
$1',
	'score-vorbisoverrideogg' => 'Ogg/Vorbis のレンダリングの要求と override_ogg の指定は、同時にはできません。',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'score-page' => 'გვერდი $1',
);

/** Korean (한국어)
 * @author 아라
 */
$messages['ko'] = array(
	'score-abc2lynotexecutable' => 'ABC에서 LilyPond로의 변환기를 실행할 수 없습니다. $1(은)는 실행 파일이 아닙니다. <code>$wgScoreAbc2Ly</code>가 올바르게 설정되어 있는지 확인하세요.',
	'score-abcconversionerr' => 'ABC 파일을 LilyPond 형식으로 변환할 수 없습니다:
$1',
	'score-chdirerr' => '$1 디렉토리를 바꿀 수 없습니다',
	'score-cleanerr' => '다시 렌더링하기 전에 오래된 파일을 지울 수 없습니다',
	'score-compilererr' => 'LilyPond 입력 파일을 컴파일할 수 없습니다:
$1',
	'score-backend-error' => '생성한 파일을 최종 위치에 복사할 수 없습니다:
$1',
	'score-desc' => 'LilyPond로 악보를 그리는 태그 추가',
	'score-getcwderr' => '현재 작업 디렉토리를 얻을 수 없습니다',
	'score-invalidlang' => 'lang="<nowiki>$1</nowiki>" 악보 언어가 잘못되었습니다. 현재 인식한 언어는 lang="lilypond" (기본값)과 lang="ABC" 입니다.',
	'score-invalidoggoverride' => 'override_ogg로 지정한 "<nowiki>$1</nowiki>" 파일이 잘못되었습니다. <nowiki>[[…]]</nowiki>와 "{{ns:file}}:" 접두어를 생략하고 파일 이름만 지정하세요.',
	'score-midioverridenotfound' => 'override_midi로 지정한 "<nowiki>$1</nowiki>" 파일을 찾을 수 없습니다. <nowiki>[[…]]</nowiki>와 "{{ns:file}}:" 접두어를 생략하고 파일 이름만 지정하세요.',
	'score-noabcinput' => '$1 ABC 원본 파일을 만들 수 없습니다.',
	'score-noimages' => '악보 그림을 생성할 수 없습니다. 악보 코드를 확인하세요.',
	'score-noinput' => '$1 LilyPond 입력 파일을 만드는 데 실패했습니다.',
	'score-noogghandler' => 'Ogg/Vorbis 변환기는 OggHandler 확장 기능을 설치와 설정이 필요합니다, [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler]를 참고하삽시오.',
	'score-nomidi' => '요청했음에도 생성한 MIDI 파일이 없습니다. 원본 LilyPond 모드에서 작업하려면 적절한 \\midi 블록을 제공해야 합니다.',
	'score-nooutput' => '$1 출력 디렉토리를 만드는 데 실패했습니다.',
	'score-notexecutable' => 'LilyPond를 실행할 수 없습니다: $1(은)는 실행 파일이 아닙니다. <code>$wgScoreLilyPond</code>가 올바르게 설정되어 있는지 확인하세요.',
	'score-oggconversionerr' => 'MIDI를 Ogg/Vorbis로 변환할 수 없습니다:
$1',
	'score-oggoverridenotfound' => 'override_ogg로 지정한 "<nowiki>$1</nowiki>" 파일이 존재하지 않습니다.',
	'score-page' => '문서 $1개',
	'score-pregreplaceerr' => 'PCRE 정규 표현식을 대체하는 데 실패했습니다',
	'score-readerr' => '$1 파일을 읽을 수 없습니다.',
	'score-timiditynotexecutable' => 'TiMidity++를 실행할 수 없습니다: $1(은)는 실행 파일이 아닙니다. <code>$wgScoreTimidity</code>가 올바르게 설정되어 있는지 확인하세요.',
	'score-renameerr' => '업로드 디렉토리로 악보 파일을 이동하는 중 오류가 났습니다.',
	'score-trimerr' => '그림을 자를 수 없습니다:
$1
이 문제가 계속되면 <code>$wgScoreTrim=false</code>를 설정하세요.',
	'score-versionerr' => 'LilyPond 버전을 얻을 수 없습니다:
$1',
	'score-vorbisoverrideogg' => 'Ogg/Vorbis 렌더링을 요청하고 동시에 override_ogg를 지정할 수 없습니다.',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'score-chdirerr' => 'Et konnt net op de Repertoire $1 gewiesselt ginn',
	'score-cleanerr' => 'Déi al Fichiere konnten net geläscht ginn ier se nei generéiert goufen',
	'score-oggconversionerr' => 'MIDI konnt net an Ogg/Vorbis ëmgewandelt ginn:
$1',
	'score-oggoverridenotfound' => 'De Fichier "<nowiki>$1</nowiki>" deen Dir mat override_ogg uginn hutt  gëtt et net.',
	'score-page' => 'Säit $1',
	'score-readerr' => 'De Fichier $1 konnt net geliest ginn.',
);

/** Macedonian (македонски)
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
	'score-backend-error' => 'Не можам да ги ставам создадените податотеки на нивното конечно место:
$1',
	'score-desc' => 'Додава ознака за испис на музички партитури со LilyPond',
	'score-getcwderr' => 'Не можам да го добијам тековниот работен директориум',
	'score-invalidlang' => 'lang="<nowiki>$1</nowiki>" не е важечки јазик за партитурата. Моментално се признаваат јазиците lang="lilypond" (основниот) и lang="ABC".',
	'score-invalidoggoverride' => 'Податотеката „<nowiki>$1</nowiki>“ што ја укажавте со override_ogg е неважечка. Укажете го само нејзиното име, изоставувајќи го <nowiki>[[…]]</nowiki> и префиксот „{{ns:file}}:“.',
	'score-midioverridenotfound' => 'Податотеката „<nowiki>$1</nowiki>“ што ја укажавте со override_midi не е пронајдена. Укажете го само нејзиното име, изоставувајќи го <nowiki>[[…]]</nowiki> и префиксот „{{ns:file}}:“.',
	'score-noabcinput' => 'Не можев да ја создадам изворната ABC податотека $1.',
	'score-noimages' => 'Не создадов партитурни слики. Проверете го кодот.',
	'score-noinput' => 'Не можев да ја создадам влезната податотека $1 за LilyPond.',
	'score-noogghandler' => 'Претворањето во Ogg/Vorbis бара инсталиран и наместен додаток OggHandler. Погл. [https://www.mediawiki.org/wiki/Extension:OggHandler?uselang=mk Extension:OggHandler].',
	'score-nomidi' => 'Не е создадена MIDI податотека и покрај барањето. Ако работите во сиров режим на LilyPond, не заборавајте да ставите соодветен \\midi блок.',
	'score-nooutput' => 'Не можев да го создадам излезниот директориум $1',
	'score-notexecutable' => 'Не можев да го пуштам LilyPond. $1 не е извршна податотека. Проверете дали <code>$wgScoreLilyPond</code> е правилно наместен.',
	'score-oggconversionerr' => 'Не можам да го претворам ова MIDI во Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Податотеката „<nowiki>$1</nowiki>“ што ја укажавте со override_ogg не постои.',
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
	'score-vorbisoverrideogg' => 'Не можете истовремено да побарате испис во Ogg/Vorbis и да укажете override_ogg.',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'score-abc2lynotexecutable' => 'Penukar ABC ke LilyPond tidak boleh dilaksanakan: $1 bukan fail yang boleh dilaksanakan. Pastikan <code>$wgScoreAbc2Ly</code> diset dengan betul.',
	'score-abcconversionerr' => 'Fail ABC tidak dapat ditukarkan ke format LilyPond:
$1',
	'score-chdirerr' => 'Tidak dapat diubah ke direktori $1',
	'score-cleanerr' => 'Fail-fail lama tidak dapat dibersihkan sebelum persembahan semula',
	'score-compilererr' => 'Fail input LilyPond tidak dapat dikompilkan:
$1',
	'score-backend-error' => 'Fail-fail yang dihasilkan tidak dapat disalin ke lokasi akhirnya:
$1',
	'score-desc' => 'Membubuh teg untuk mempersembahkan skor muzik dengan LilyPond',
	'score-getcwderr' => 'Direktori berfungsi semasa tidak dapat diperoleh',
	'score-invalidlang' => 'Bahasa skor lang="<nowiki>$1</nowiki>" tidak sah. Bahasa-bahasa yang dikenali kini adalah lang="lilypond" (azali) dan lang="ABC".',
	'score-invalidoggoverride' => 'Fail "<nowiki>$1</nowiki>" yang anda nyatakan dengan override_ogg tidak sah. Sila nyatakan nama fail sahaja, gugurkan <nowiki>[[…]]</nowiki> dan awalan "{{ns:file}}:".',
	'score-midioverridenotfound' => 'Fail "<nowiki>$1</nowiki>" yang anda nyatakan dengan override_midi tidak dapat dijumpai. Sila nyatakan nama fail sahaja, gugurkan <nowiki>[[…]]</nowiki> dan awalan "{{ns:file}}:".',
	'score-noabcinput' => 'Fail sumber ABC $1 tidak dapat diwujudkan.',
	'score-noimages' => 'Tiada imej skor dihasilkan. Sila semak kod skor anda.',
	'score-noinput' => 'Fail input LilyPond $1 tidak dapat dicipta.',
	'score-noogghandler' => 'Penukaran Ogg/Vorbis memerlukan sambungan OggHandler yang terpasang dan terkonfigurasi, oleh itu rujuk [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Tiada fail MIDI yang dihasilkan biarpun dipohon. Jika anda menggunakan ragam LilyPond mentah, jangan lupa untuk menyediakan blok \\midi yang betul.',
	'score-nooutput' => 'Direktori output $1 tidak dapat dicipta.',
	'score-notexecutable' => 'LilyPond tidak dapat dilaksanakan: $1 bukan fail yang boleh dilaksanakan. Pastikan <code>$wgScoreLilyPond</code> diset dengan betul.',
	'score-oggconversionerr' => 'MIDI tidak dapat ditukarkan kepada Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Fail "<nowiki>$1</nowiki>" yang anda nyatakan dengan override_ogg tidak wujud.',
	'score-page' => 'Halaman $1',
	'score-pregreplaceerr' => 'Ungkapan nalar PCRE gagal digantikan',
	'score-readerr' => 'Fail $1 tidak dapat dibaca.',
	'score-timiditynotexecutable' => 'TiMidity++ tidak boleh dilaksanakan: $1 bukan fail yang boleh dilaksanakan. Pastikan <code>$wgScoreTimidity</code> diset dengan betul.',
	'score-renameerr' => 'Ralat ketika memindahkan fail skor ke direktori muat naik.',
	'score-trimerr' => 'Imej tidak dapat dirapikan:
$1
Setkan <code>$wgScoreTrim=false</code> jika masalah ini berterusan.',
	'score-versionerr' => 'Versi LilyPond tidak dapat diperoleh:
$1',
	'score-vorbisoverrideogg' => 'Anda tidak boleh memohon persembahan Ogg/Vorbis dan menyatakan override_ogg pada masa yang sama.',
);

/** Dutch (Nederlands)
 * @author Patio
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
	'score-backend-error' => 'Het was niet mogelijk de gemaakte bestanden naar hun uiteindelijke plaats te kopiëren:
$1',
	'score-desc' => 'Voegt een label toe voor het weergeven van bladmuziek met LilyPond',
	'score-getcwderr' => 'Het was niet mogelijk de ingestelde werkmap te gebruiken',
	'score-invalidlang' => 'Er is een onjuiste taal voor bladmuziek aangegeven (lang="<nowiki>$1</nowiki>"). Op dit moment worden lang="lilypond" (standaard) en lang="ABC" ondersteund.',
	'score-invalidoggoverride' => 'Het bestand "<nowiki>$1</nowiki>" dat u hebt opgegeven met "override_ogg" is ongeldig. Geef alleen de bestandsnaam op, laat <nowiki>[[…]]</nowiki> en het voorvoegsel "{{ns:file}}:" weg.',
	'score-midioverridenotfound' => 'Het bestand "<nowiki>$1</nowiki>" dat u hebt opgegeven met "override_midi" kon niet gevonden worden. Geef alleen de bestandsnaam op, laat <nowiki>[[…]]</nowiki> en het voorvoegsel "{{ns:file}}:" weg.',
	'score-noabcinput' => 'Het ABC-bronbestand $1 kon niet aangemaakt worden',
	'score-noimages' => 'Er zijn geen afbeeldingen met bladmuziek aangemaakt. Controleer uw notatie.',
	'score-noinput' => 'Het was niet mogelijk het invoerbestand $1 voor LilyPond aan te maken',
	'score-noogghandler' => 'Voor het omzetten naar Ogg/Vorbis moet de uitbreiding OggHandler geïnstalleerd en ingesteld zijn. Zie [https://www.mediawiki.org/wiki/Extension:OggHandler Extension:OggHandler].',
	'score-nomidi' => 'Ondank een verzoek, is er geen MIDI-bestand aangemaakt. Als u in de modus LilyPond ruw werkt, zorg dan dat u een correcte opmaak van het onderdeel "\\midi" hebt.',
	'score-nooutput' => 'Het was niet mogelijk de uitvoermap $1 aan te maken',
	'score-notexecutable' => 'Het was niet mogelijk om LilyPond uit te voeren: $1 is geen uitvoerbaar bestand. Zorg dat de instelling <code>$wgScoreLilyPond</code> correct is.',
	'score-oggconversionerr' => 'Het was niet mogelijk MIDI naar Ogg/Vorbis om te zetten:
$1',
	'score-oggoverridenotfound' => 'Het bestand "<nowiki>$1</nowiki>" dat u hebt opgegeven met "override_ogg" bestaat niet.',
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
	'score-vorbisoverrideogg' => 'U kunt niet vragen om Ogg/Vorbisrendering en tegelijkertijd "override_ogg" gebruiken.',
);

/** Polish (polski)
 * @author BeginaFelicysym
 */
$messages['pl'] = array(
	'score-chdirerr' => 'Nie można zmienić do katalogu $1',
	'score-cleanerr' => 'Nie można usunąć starych plików przed ponownym wyrenderowaniem',
	'score-nooutput' => 'Nie można utworzyć katalogu docelowego  $1 .',
	'score-oggconversionerr' => 'Nie można przekonwertować MIDI na Ogg/Vorbis:
$1',
	'score-page' => 'Strona $1',
	'score-readerr' => 'Nie można odczytać pliku  $1 .',
);

/** Romanian (română)
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'score-page' => 'Pagina $1',
);

/** Swahili (Kiswahili)
 * @author Stephenwanjau
 */
$messages['sw'] = array(
	'score-page' => 'Ukurasa $1',
);

/** Tamil (தமிழ்)
 * @author Karthi.dr
 */
$messages['ta'] = array(
	'score-readerr' => 'கோப்பு $1 ஐப் படிக்க முடியவில்லை.',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'score-abc2lynotexecutable' => 'Hindi maisakatuparan ang pampalit ng ABC upang maging LilyPond: Ang $1 ay hindi isang talaksang maisasakatuparan. Tiyakin na nakatakda nang tama ang <code>$wgScoreAbc2Ly</code>.',
	'score-abcconversionerr' => 'Hindi nagawang palitan ang talaksan ng ABC upang maging nasa anyo ng LilyPond:
$1',
	'score-chdirerr' => 'Hindi nagawang palitan upang maging direktoryo ng $1',
	'score-cleanerr' => 'Hindi nagawang maglinis ng lumang mga talaksan bago muling iharap',
	'score-compilererr' => 'Hindi nagawang tipunin ang talaksan ng pagpapasok ng LilyPond:
$1',
	'score-desc' => 'Nagdaragdag ng isang tatak para sa paghaharap ng mga iskor na pangtutugtugin sa pamamagitan ng LilyPond',
	'score-getcwderr' => 'Hindi nagawang makamtan ang pangkasalukuyang direktoryong pangtrabaho',
	'score-invalidlang' => 'Hindi katanggap-tanggap na wika ng iskor="<nowiki>$1</nowiki>". Ang pangkasalukuyang nakikilalang mga wika ay ang wika="lilypond" (ang likas na katakdaan) at wika="ABC".',
	'score-invalidoggoverride' => 'Hindi katanggap-tanggap ang talaksang "<nowiki>$1</nowiki>" na tinukoy mo na mayroong override_ogg. Paki tukuyin ang pangalan ng talaksan lamang, huwag isama ang <nowiki>[[…]]</nowiki> at ang unlaping "{{ns:file}}:".',
	'score-midioverridenotfound' => 'Hindi matagpuan ang talaksang "<nowiki>$1</nowiki>" tinukoy mo na mayroong override_midi. Paki tukuyin ang pangalan ng talaksan lamang, huwag isama ang <nowiki>[[…]]</nowiki> at ang unlaping "{{ns:file}}:".',
	'score-noabcinput' => 'Hindi malikha ang talaksang pinagmulan ng ABC na $1.',
	'score-noimages' => 'Walang malikha na mga imahe ng iskor. Paki siyasatin ang iyong kodigo ng iskor.',
	'score-noinput' => 'Nabigo sa paglikha ng talaksan ng pagpapasok na $1 ng LilyPond.',
	'score-noogghandler' => 'Ang pagpapalit ng Ogg/Vorbis ay nangangailangan ng isang naitalaga at naisaayos na dugtong ng OggHandler, tingnan ang  [https://www.mediawiki.org/wiki/Extension:OggHandler Dugtong:OggHandler].',
	'score-nomidi' => 'Walang nalikha na talaksan ng MIDI kahit na hinihiling. Kung nagtatrabaho ka na nasa gawi ng hilaw na LilyPond, paki tiyakin na makapagbigay ka ng isang naaangkop na tipak ng \\midi.',
	'score-nooutput' => 'Nabigo sa paglikha ng direktoryo ng kinalabasan na $1.',
	'score-notexecutable' => 'Hindi maisakatuparan ang LilyPond: Ang $1 ay isang hindi naisasakatuparang talaksan. Paki tiyakin na nakatakda nang tama ang <code>$wgScoreLilyPond</code>',
	'score-oggconversionerr' => 'Hindi nagawang palitan ang MIDI upang maging Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Hindi umiiral ang tinukoy mong talaksan na "<nowiki>$1</nowiki>" na mayroong override_ogg.',
	'score-page' => 'Pahinang $1',
	'score-pregreplaceerr' => 'Nabigo ang pagpapalit ng karaniwang pagsasaad ng PCRE',
	'score-readerr' => 'Hindi nagawang basahin ang talaksang $1.',
	'score-timiditynotexecutable' => 'Hindi maisakatuparan ang TiMidity++: Ang $1 ay hindi isang talaksang maisasakatuparan. Tiyakin na nakatakda nang tama ang <code>$wgScoreTimidity</code>.',
	'score-renameerr' => 'Kamalian sa paglilipat ng mga talaksan ng puntos papunta sa direktoryo ng pagkakargang papaitaas.',
	'score-trimerr' => 'Hindi magupitan ang imahe:
$1
Itakda ang <code>$wgScoreTrim=false</code> kapag nagtagal ang suliraning ito.',
	'score-versionerr' => 'Hindi nagawang makamtan ang bersiyon ng LilyPond: $1',
	'score-vorbisoverrideogg' => 'Hindi mo mahihiling nang sabayan ang paghaharap ng Ogg/Vorbis at ang pagtukoy ng override_ogg.',
);

/** Ukrainian (українська)
 * @author Steve.rusyn
 */
$messages['uk'] = array(
	'score-page' => 'Сторінка $1',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'score-abc2lynotexecutable' => 'Không thể thực thi trình chuyển đổi ABC qua LilyPond: $1 không phải là một tập tin thực thi. Hãy chắc chắn rằng <code>$wgScoreAbc2Ly</code> có giá trị chính xác.',
	'score-abcconversionerr' => 'Không thể chuyển đổi tập tin ABC qua định dạng LilyPond:
$1',
	'score-chdirerr' => 'Không thể chuyển đến thư mục $1',
	'score-cleanerr' => 'Không thể xóa sạch các tập tin cũ trước khi kết xuất lại',
	'score-compilererr' => 'Không thể biên dịch tập tin đầu vào LilyPond:
$1',
	'score-backend-error' => 'Không thể sao chép các tập tin được tạo ra vào vị trí cuối cùng:
$1',
	'score-desc' => 'Cung cấp thẻ để vẽ tài liệu âm nhạc dùng LilyPond',
	'score-getcwderr' => 'Không thể lấy thư mục làm việc hiện tại',
	'score-invalidlang' => 'Ngôn ngữ nốt nhạc lang="<nowiki>$1</nowiki>" không hợp lệ. Các ngôn ngữ đang được chấp nhận là lang="lilypond" (mặc định) và lang="ABC".',
	'score-invalidoggoverride' => 'Tập tin “<nowiki>$1</nowiki>” mà bạn chỉ định override_ogg không hợp lệ. Xin vui lòng chỉ đưa vào tên tập tin; bỏ qua <nowiki>[[…]]</nowiki> và tiền tố “{{ns:file}}:”.',
	'score-midioverridenotfound' => 'Tập tin “<nowiki>$1</nowiki>” mà bạn chỉ định override_midi không hợp lệ. Xin vui lòng chỉ đưa vào tên tập tin; bỏ qua <nowiki>[[…]]</nowiki> và tiền tố “{{ns:file}}:”.',
	'score-noabcinput' => 'Không thể tạo ra tập tin mã nguồn ABC $1.',
	'score-noimages' => 'Các hình tài liệu âm nhạc không được tạo ra. Xin vui lòng kiểm tra lại mã nguồn.',
	'score-noinput' => 'Thất bại trong việc tạo ra tập tin đầu vào LilyPond $1.',
	'score-noogghandler' => 'Tính năng chuyển đổi Ogg/Vorbis cần cài đặt và thiết lập phần mở rộng OggHandler; xem [https://www.mediawiki.org/wiki/Extension:OggHandler/vi?uselang=vi Extension:OggHandler].',
	'score-nomidi' => 'Tập tin MIDI đã yêu cầu không được tạo ra. Nếu bạn đang làm việc trong chế độ LilyPond nguyên văn, hãy chắc chắn cung cấp một khối \\midi hợp lệ.',
	'score-nooutput' => 'Thất bại trong việc tạo ra thư mục đầu ra $1.',
	'score-notexecutable' => 'Không thể thực thi LilyPond: $1 không phải là một tập tin thực thi. Hãy chắc chắn rằng <code>$wgScoreLilyPond</code> có giá trị chính xác.',
	'score-oggconversionerr' => 'Không thể chuyển đổi MIDI qua Ogg/Vorbis:
$1',
	'score-oggoverridenotfound' => 'Tập tin “<nowiki>$1</nowiki>” mà bạn chỉ định override_ogg không tồn tại.',
	'score-page' => 'Trang $1',
	'score-pregreplaceerr' => 'Thất bại trong việc thay thế theo biểu thưc chính quy PCRE',
	'score-readerr' => 'Không thể đọc tập tin $1.',
	'score-timiditynotexecutable' => 'Không thể thực thi TiMidity++: $1 không phải là một tập tin thực thi. Hãy chắc chắn rằng <code>$wgScoreTimidity</code> có giá trị chính xác.',
	'score-renameerr' => 'Lỗi khi di chuyển các tập tin tài liệu âm nhạc sang thư mục tải lên.',
	'score-trimerr' => 'Không thể tỉa hình:
$1
Nếu vấn đề này vẫn còn xuất hiện, hãy đặt <code>$wgScoreTrim=false</code>.',
	'score-versionerr' => 'Không thể lấy phiên bản của LilyPond:
$1',
	'score-vorbisoverrideogg' => 'Bạn không thể yêu cầu kết xuất Ogg/Vorbis và định override_ogg cùng lúc.',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Shirayuki
 */
$messages['zh-hans'] = array(
	'score-page' => '页面$1',
);
