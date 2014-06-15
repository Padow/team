Team Dispo
=========

Team dispo is an app to set TF2 player disponibility 

  - 6vs6
  - 9vs9

Version
----

1.0

Tech
-----------

Team Dispo uses a number of open source projects to work properly:


* [Bootstrap] - great UI boilerplate for modern web apps
* [Bootstrap Timepicker] - duh
* [Bootstrap Datepicker] - duh
* [jQuery] - duh 

Server requirements
-------------------
* PHP 5.3
* Apache 2.2  
* MySQL 5  

Installation
--------------

```sh
git clone https://github.com/Padow/team.git
```
##### Deploy database.
* dispo.sql

##### Configure .ini files.
* Required
 * config/config.ini
 * config/game_mode.ini
* Optional
 * config/server.ini
 * config/liens.ini
 * config/teamid.ini --> allow sync with ETF2L for match schedule


##### Language
Default language is french. To change it remove "default.php" from "language" folder, then copy/paste the language file you wish as default and rename the copy  "default.php"

* available languages
 * french
 * english
 * russian - done by Shog

it may have  mistakes translations or some inappropriate translations, so please feel free to report them.

* Add an other translation language 
  * get your country_tag refer to [availables country tag]
  * copy/paste "en.php" from "language" folder
  * rename the copie "country_tag.php"
  * open the new file with a text editor and translate.  /!\  DO NOT CHANGE WORDS IN CAPITAL LETTERS 


##### First login
 * enter whatever you want as login and password
 * create a new player
 * then logout and relog with the new player account 


--------------------------------------

**Edited on : **[http://dillinger.io/]

[availables country tag]:https://github.com/eternicode/bootstrap-datepicker/tree/master/js/locales
[Bootstrap]:http://getbootstrap.com/
[jQuery]:http://jquery.com
[Bootstrap Timepicker]:https://github.com/jdewit/bootstrap-timepicker
[Bootstrap Datepicker]:https://github.com/eternicode/bootstrap-datepicker/
[http://dillinger.io/]:http://dillinger.io/

