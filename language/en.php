<?php  
/**
  Pack language en

*/

 /**
	menu 
*/
define("MENU_DISPO", "Availability");
define("MENU_MATCHS", "Match");
define("MENU_OPTIONS", "Settings");
define("MENU_COMMONS", "Commons");
define("MENU_PLAYER", "Player");
define("MENU_MESSAGES", "Message board");
define("MENU_HISTORIC", "Historic");
define("MENU_ADD", "Add");
define("MENU_VIEW", "View");
define("MENU_LOGOUT", "Logout");
/**
	login.php
*/
define("LOGIN_LANGUAGE", "Language");
define("LOGIN_LEGEND", "Login");
define("LOGIN_PSEUDO", "Nickname");
define("LOGIN_PASSWORD", "Password");
define("LOGIN_REMEMBER", "Remember me");
define("LOGIN_SUBMIT", "Login");
/**
	container.php == index.php --> Dispo
*/
define("DISPO_ALERT", "Please add at least one player, and relog with this nickname.");
define("DISPO_DATE", "Date");
define("DISPO_AT", "at");
define("DISPO_LEAGUE", "League");
define("DISPO_TEAM", "Team");
define("DISPO_MAPS", "Maps");
define("DISPO_PLAYERS", "Available's players");
define("DISPO_MISSING", "Missing");
define("DISPO_LAST_DAY", "Sat");
define("MONDAY", "Mon");
define("TUESDAY", "Tue");
define("WEDNESDAY", "Wed");
define("THURSDAY", "Thu");
define("FRIDAY", "Fri");
define("SATURDAY", "Sat");
define("SUNDAY", "Sun");
define("DISPO_NO_MATCHES", "No matches scheduled.");
/**
	matchs.php
*/
define("DATEPICKER_LANGUAGE", "en"); // refer to https://github.com/eternicode/bootstrap-datepicker/tree/master/js/locales
define("MATCHS_SET_LEGEND", "Schedule a match");
define("MATCHS_DATE", "Date");
define("MATCHS_TIME", "Time");
define("MATCHS_LEAGUE", "League");
define("MATCHS_TEAM", "Team");
define("MATCHS_MAP1", "Map 1");
define("MATCHS_MAP2", "Map 2");
define("MATCHS_SET_SUBMIT", "Schedule it");
define("MATCHS_UNSET_LEGEND", "Unschedule a match");
define("MATCHS_LIST", "Matches list");
define("MATCHS_UNSET_SUBMIT", "Unschedule");
define("MATCHS_SCHEDULE_SUCCESS", "The game has been programmed");
define("MATCHS_SCHEDULE_FAILURE", "A match is already scheduled for this day and hour");
/**
	settings.php --> Settings commons
*/
define("COMMON_ADD_PLAYER_LEGEND", "Add player");
define("COMMON_ADD_PLAYER_PSEUDO", "Nickname");
define("COMMON_ADD_PLAYER_INFO", "Password = Nickname");
define("COMMON_ADD_PLAYER_SUBMIT", "Add");
define("COMMON_DELETE_PLAYER_LEGEND", "Remove Player");
define("COMMON_DELETE_PLAYER_LIST", "Players list");
define("COMMON_DELETE_PLAYER_SUBMIT", "Remove");
define("COMMON_ADD_LEAGUE_LEGEND", "Add league");
define("COMMON_ADD_LEAGUE_NAME", "League's name");
define("COMMON_ADD_LEAGUE_SUBMIT", "Add");
define("COMMON_DELETE_LEAGUE_LEGEND", "Add league");
define("COMMON_DELETE_LEAGUE_LIST", "Leagues list");
define("COMMON_DELETE_LEAGUE_SUBMIT", "Remove");
define("COMMON_ADD_MAP_LEGEND", "Add map");
define("COMMON_ADD_MAP_NAME", "Map's name");
define("COMMON_ADD_MAP_SUBMIT", "Add");
define("COMMON_DELETE_MAP_LEGEND", "Remove map");
define("COMMON_DELETE_MAP_LIST", "Maps list");
define("COMMON_DELETE_MAP_SUBMIT", "Remove");
define("ADD_PLAYER_FAILURE_PRE", "Player ");
define("ADD_PLAYER_FAILURE_POST", " already exists.");
define("ADD_PLAYER_SUCCESS_PRE", "Player ");
define("ADD_PLAYER_SUCCESS_POST", " has been added.");
define("ADD_PLAYER_SPECIAL_CHARS", "Special characters are not allowed.");
define("ADD_LEAGUE_PRE", "The ");
define("ADD_LEAGUE_FAILURE_POST", " league already exists.");
define("ADD_LEAGUE_POST", " league has been added.");
define("ADD_MAP_PRE", " The map ");
define("ADD_MAP_FAILURE_POST", " already exists.");
define("ADD_MAP_POST", " has been added.");
/**
	player_settings.php --> settings player
*/
define("PLAYER_DISPO_LEGEND", "Default disponibilities");
define("PLAYER_MON", "Monday");
define("PLAYER_TUE", "Tuesday");
define("PLAYER_WED", "Wednesday");
define("PLAYER_THU", "Thursday");
define("PLAYER_FRI", "Friday");
define("PLAYER_SAT", "Saturday");
define("PLAYER_SUN", "Sunday");
define("PLAYER_YES", "Yes");
define("PLAYER_NO", "No");
define("PLAYER_IDK", "Idk");
define("PLAYER_UNSET", "∅");
define("PLAYER_DISPO_SUBMIT", "Schedule it");
define("PLAYER_CLASS_LEGEND", "Choose a class");
define("PLAYER_CLASS_SUBMIT", "Validate");
define("PLAYER_PASSWORD_LEGEND", "Change password");
define("PLAYER_PASSWORD_NEW", "New password");
define("PLAYER_PASSWORD_CONFIRM", "Confirm password");
define("PLAYER_PASSWORD_SUBMIT", "Change");
define("PLAYER_AVATAR_LEGEND", "Avatar");
define("PLAYER_AVATAR_BROWSE", "Browse");
define("PLAYER_AVATAR_SUBMIT", "Validate");
define("PLAYER_LANGUAGE_LEGEND", "Change language");
define("PLAYER_LANGUAGE_SUBMIT", "Change");
define("CHANGE_PASSWORD_SUCCESS", "Password successfully changed.");
define("DEFAULT_DISPO_SUCCESS", " Your default disponibilities has been changed.");
define("CLASS_UPDATE_SUCCESS", " Your class has been changed.");
define("FILE_NOT_FOUND", " File not found.");
define("SUPPORTED_EXTENTION", " supported extension: png gif jpg jpeg.");
define("MAX_SIZE", " Max size : 100Ko");
define("AVATAR_CHANGED", "Avatar updated");
/**
	Message board
*/
define("MESSAGE_SEND", "Send");
define("MESSAGE_BOLD", "Bold");
define("MESSAGE_UNDERLINE", "Underline");
define("MESSAGE_ITALIC", "Italic");
define("MESSAGE_IMAGE", "Insert picture");
define("MESSAGE_LINK", "Insert link");
define("MESSAGE_QUOTE_FORM", "Insert quote");
define("CLASS_MESSAGE_MODIFY", "Modify");
define("CLASS_MESSAGE_QUOTE", "Quote");
define("CLASS_MESSAGE_TODAY", "Today");
define("CLASS_MESSAGE_YESTERDAY", "Yesterday");
define("CLASS_MESSAGE_QUOTED", "Quote");
define("CLASS_MESSAGE_NO_MESSAGE", "No message.");
/**
	historic.php -> Historic add
*/
define("HISTORIC_ADD_DATE", "Date");
define("HISTORIC_ADD_TIME", "Time");
define("HISTORIC_ADD_LEAGUE", "League");
define("HISTORIC_ADD_TEAM", "Team");
define("HISTORIC_ADD_MAP1", "Map 1");
define("HISTORIC_ADD_SCORE", "Score");
define("HISTORIC_ADD_SCORE_OPPONENT", "Opponents score");
define("HISTORIC_ADD_LOGS_MAP1", "Logs map 1");
define("HISTORIC_ADD_MAP2", "Map 2");
define("HISTORIC_ADD_LOGS_MAP2", "Logs map 2");
define("HISTORIC_ADD_COMMENT", "Comment");
define("HISTORIC_ADD_SUBMIT", " Add to historic");
/**
	historic view
*/
define("HISTORIC_VIEW_DATE", "Date");
define("HISTORIC_VIEW_TIME", "Time");
define("HISTORIC_VIEW_LEAGUE", "League");
define("HISTORIC_VIEW_TEAM", "Team");
define("HISTORIC_VIEW_SCORE", "Score");
define("HISTORIC_VIEW_MAPS", "Map");
define("HISTORIC_VIEW_LOGS", "Logs");
define("HISTORIC_VIEW_INFO", "Comment");
define("HISTORIC_VIEW_CONFIRM_MESSAGE", "'Delete match?'"); //  /!\  keep the simple quote
/**
	login
*/
define("LOGIN_PRE", " The player ");
define("LOGIN_POST", " does not exist, or the password is incorrect.");
?>