<?php  
/**
  Pack langue fr

*/
 /**
	menu 
*/
define("MENU_DISPO", "Dispo");
define("MENU_MATCHS", "Matchs");
define("MENU_OPTIONS", "Options");
define("MENU_COMMONS", "Communes");
define("MENU_PLAYER", "Joueur");
define("MENU_MESSAGES", "Messages");
define("MENU_HISTORIC", "Historique");
define("MENU_ADD", "Ajouter");
define("MENU_VIEW", "Voir");
define("MENU_LOGOUT", "Déconnexion");
/**
	login.php
*/
define("LOGIN_LANGUAGE", "Langue");
define("LOGIN_LEGEND", "Connexion");
define("LOGIN_PSEUDO", "Pseudo");
define("LOGIN_PASSWORD", "Mot de passe");
define("LOGIN_REMEMBER", "Toujours connecté");
define("LOGIN_SUBMIT", "Connexion");
/**
	container.php == index.php --> Dispo
*/
define("DISPO_ALERT", "Veuillez ajouter au moins un joueur, puis vous logger avec ce pseudo.");
define("DISPO_DATE", "Date");
define("DISPO_AT", "à");
define("DISPO_LEAGUE", "League");
define("DISPO_TEAM", "Team");
define("DISPO_MAPS", "Maps");
define("DISPO_PLAYERS", "Joueur dispo");
define("DISPO_MISSING", "Manque");
define("DISPO_LAST_DAY", "Dim");
define("MONDAY", "Lun");
define("TUESDAY", "Mar");
define("WEDNESDAY", "Mer");
define("THURSDAY", "Jeu");
define("FRIDAY", "Ven");
define("SATURDAY", "Sam");
define("SUNDAY", "Dim");
define("DISPO_NO_MATCHES", "Pas de match programmé.");

/**
	matchs.php
*/
define("DATEPICKER_LANGUAGE", "fr"); // refer to https://github.com/eternicode/bootstrap-datepicker/tree/master/js/locales 
define("MATCHS_SET_LEGEND", "Programmer un match");
define("MATCHS_DATE", "Date");
define("MATCHS_TIME", "Heure");
define("MATCHS_LEAGUE", "League");
define("MATCHS_TEAM", "Team");
define("MATCHS_MAP1", "Map 1");
define("MATCHS_MAP2", "Map 2");
define("MATCHS_SET_SUBMIT", "Programmer");
define("MATCHS_UNSET_LEGEND", "Supprimer un match");
define("MATCHS_LIST", "Liste des matchs");
define("MATCHS_UNSET_SUBMIT", "Supprimer");
define("MATCHS_SCHEDULE_SUCCESS", "Le match à bien été programmé");
define("MATCHS_SCHEDULE_FAILURE", "Un match est déjà programmé pour ce jour et à cette heure");
/**
	settings.php --> options communes
*/
define("COMMON_ADD_PLAYER_LEGEND", "Ajouter un joueur");
define("COMMON_ADD_PLAYER_PSEUDO", "Pseudo");
define("COMMON_ADD_PLAYER_INFO", "Mot de passe = Pseudo");
define("COMMON_ADD_PLAYER_SUBMIT", "Ajouter");
define("COMMON_DELETE_PLAYER_LEGEND", "Supprimer un joueur");
define("COMMON_DELETE_PLAYER_LIST", "Liste des joueurs");
define("COMMON_DELETE_PLAYER_SUBMIT", "Supprimer");
define("COMMON_ADD_LEAGUE_LEGEND", "Ajouter une league");
define("COMMON_ADD_LEAGUE_NAME", "Nom de la league");
define("COMMON_ADD_LEAGUE_SUBMIT", "Ajouter");
define("COMMON_DELETE_LEAGUE_LEGEND", "Supprimer une league");
define("COMMON_DELETE_LEAGUE_LIST", "Liste des leagues");
define("COMMON_DELETE_LEAGUE_SUBMIT", "Supprimer");
define("COMMON_ADD_MAP_LEGEND", "Ajouter une map");
define("COMMON_ADD_MAP_NAME", "Nom de la map");
define("COMMON_ADD_MAP_SUBMIT", "Ajouter");
define("COMMON_DELETE_MAP_LEGEND", "Supprimer une map");
define("COMMON_DELETE_MAP_LIST", "Liste des maps");
define("COMMON_DELETE_MAP_SUBMIT", "Supprimer");
define("ADD_PLAYER_FAILURE_PRE", "Le joueur");
define("ADD_PLAYER_FAILURE_POST", "existe déjà.");
define("ADD_PLAYER_SUCCESS_PRE", "Le joueur ");
define("ADD_PLAYER_SUCCESS_POST", " à été ajouté.");
define("ADD_PLAYER_SPECIAL_CHARS", "Les caractères spéciaux sont interdits");
define("ADD_LEAGUE_PRE", " La league");
define("ADD_LEAGUE_FAILURE_POST", " existe déjà.");
define("ADD_LEAGUE_POST", " à été ajouté.");
define("ADD_MAP_PRE", " La map .");
define("ADD_MAP_FAILURE_POST", " existe déjà.");
define("ADD_MAP_POST", " à été ajoutée.");
/**
	player_settings.php --> options joueur
*/
define("PLAYER_DISPO_LEGEND", "Dispo par défaut");
define("PLAYER_MON", "Lundi");
define("PLAYER_TUE", "Mardi");
define("PLAYER_WED", "Mercredi");
define("PLAYER_THU", "Jeudi");
define("PLAYER_FRI", "Vendredi");
define("PLAYER_SAT", "Samedi");
define("PLAYER_SUN", "Dimanche");
define("PLAYER_YES", "Oui");
define("PLAYER_NO", "Non");
define("PLAYER_IDK", "Idk");
define("PLAYER_UNSET", "∅");
define("PLAYER_DISPO_SUBMIT", "Programmer");
define("PLAYER_CLASS_LEGEND", "Choisir une classe");
define("PLAYER_CLASS_SUBMIT", "Valider");
define("PLAYER_PASSWORD_LEGEND", "Changer de mot de passe");
define("PLAYER_PASSWORD_NEW", "Nouveau mot de passe");
define("PLAYER_PASSWORD_CONFIRM", "Confirmez le mot de passe");
define("PLAYER_PASSWORD_SUBMIT", "Changer");
define("PLAYER_AVATAR_LEGEND", "Avatar");
define("PLAYER_AVATAR_BROWSE", "Parcourir");
define("PLAYER_AVATAR_SUBMIT", "Valider");
define("PLAYER_LANGUAGE_LEGEND", "Changer la langue");
define("PLAYER_LANGUAGE_SUBMIT", "Changer");
define("CHANGE_PASSWORD_SUCCESS", "Le mot de passe à été changé avec succès.");
define("DEFAULT_DISPO_SUCCESS", " Les dispos par défaut ont été changées.");
define("CLASS_UPDATE_SUCCESS", " Votre classe à été changée.");
define("FILE_NOT_FOUND", " Image non trouvée.");
define("SUPPORTED_EXTENTION", " Formats supportés : png gif jpg jpeg.");
define("MAX_SIZE", " Taille max : 100Ko");
define("AVATAR_CHANGED", " Avatar mis à jour.");
/**
	message
*/
define("MESSAGE_SEND", "Envoyer");
define("MESSAGE_BOLD", "Gras");
define("MESSAGE_UNDERLINE", "Souligner");
define("MESSAGE_ITALIC", "Italique");
define("MESSAGE_IMAGE", "Insérer une image");
define("MESSAGE_LINK", "Insérer un lien");
define("MESSAGE_QUOTE_FORM", "Insérer une citation");
define("MESSAGE_FORBIDEN", "Vous n'êtes pas autorisé à modifier ce message");
define("MESSAGE_ERROR", "Le message ne peut être vide");
define("CLASS_MESSAGE_MODIFY", "Modifier");
define("CLASS_MESSAGE_QUOTE", "Citer");
define("CLASS_MESSAGE_TODAY", "Aujourd'hui");
define("CLASS_MESSAGE_YESTERDAY", "Hier");
define("CLASS_MESSAGE_QUOTED", "Citation");
define("CLASS_MESSAGE_NO_MESSAGE", "Pas de message.");
/**
	historic.php -> historique ajouter
*/
define("HISTORIC_ADD_DATE", "Date");
define("HISTORIC_ADD_TIME", "Heure");
define("HISTORIC_ADD_LEAGUE", "League");
define("HISTORIC_ADD_TEAM", "Team");
define("HISTORIC_ADD_MAP1", "Map 1");
define("HISTORIC_ADD_SCORE", "Score");
define("HISTORIC_ADD_SCORE_OPPONENT", "Score adversaire");
define("HISTORIC_ADD_LOGS_MAP1", "Logs map 1");
define("HISTORIC_ADD_MAP2", "Map 2");
define("HISTORIC_ADD_LOGS_MAP2", "Logs map 2");
define("HISTORIC_ADD_COMMENT", "Commentaire");
define("HISTORIC_ADD_SUBMIT", "Ajouter à l'historique");
/**
	historique voir
*/
define("HISTORIC_VIEW_DATE", "Date");
define("HISTORIC_VIEW_TIME", "Heure");
define("HISTORIC_VIEW_LEAGUE", "League");
define("HISTORIC_VIEW_TEAM", "Team");
define("HISTORIC_VIEW_SCORE", "Score");
define("HISTORIC_VIEW_MAPS", "Map");
define("HISTORIC_VIEW_LOGS", "Logs");
define("HISTORIC_VIEW_INFO", "Info");
define("HISTORIC_VIEW_CONFIRM_MESSAGE", "'Supprimer match?'"); //  /!\  keep the simple quote
/**
	login
*/
define("LOGIN_PRE", " Le joueur ");
define("LOGIN_POST", " n'existe pas, ou le mot de passe est incorrect.");
?>