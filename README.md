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
* PHP 5.4.12  
* Apache 2.4.4  
* MySQL 5.6.12  

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
 * config/teamif.ini --> allow sync match setting with ETF2L
 

--------------------------------------

**Edited on : **[http://dillinger.io/]

[Bootstrap]:http://getbootstrap.com/
[jQuery]:http://jquery.com
[Bootstrap Timepicker]:https://github.com/jdewit/bootstrap-timepicker
[Bootstrap Datepicker]:https://github.com/eternicode/bootstrap-datepicker/
[http://dillinger.io/]:http://dillinger.io/

