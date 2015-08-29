LF Tool
========

LF Tool is a little piece of Spagetti code that helps maintaining
Language files. The script is mainly controlled by its internal Variables and some 
get parameters.(Later this gonna get an user interface)

Upload the file into your languages folder, set correct sTypes 
and call it in browser. The tool automatically converts all non ASCII chars into entities.
So translation is pretty easy just write in your native language 
characters, and then run language tool once-> all chars are converted.

Later this tool will simply convert anything to UTF8. 
But for now this is the only way. 
 

Variables: (All Vars Are displayed whith their Default value)
----------------------------------------------------------------

$sDefaultLanguage = "EN";

- This language file is used as a basis for all other files(for translation and for 
adding new language vars, usually this should not be changed)

$sLanguages ="BG,CA,CS,DA,DE,ES,ET,FI,FR,HR,HU,IT,LV,NL,NO,PL,PT,RU,SE,TR,SK";

- Language files to create and/or  process 

$sTypes ="MENU,TEXT,HEADING,MESSAGE,OVERVIEW";

- There are multiple arrays that need to be processed  These are the WB Default ones.
When using a module language section i guess you need to deactivate some or maybe the 
module uses entirely different ones.



GET Parameters
----------------------------

overwrite=yes

- Fills all language files whith default text from default file. Deletes all old 
translations. 








