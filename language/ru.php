<?php
/**
Pack langue ru
By Shog

*/
 /**
menu
*/
define("MENU_DISPO", "Пригодности");
define("MENU_MATCHS", "Матчи");
define("MENU_OPTIONS", "Опции");
define("MENU_COMMONS", "Общии");
define("MENU_PLAYER", "Игрок");
define("MENU_MESSAGES", "Сообщения");
define("MENU_HISTORIC", "История");
define("MENU_ADD", "Добавить");
define("MENU_VIEW", "Рассмотреть");
define("MENU_LOGOUT", "Выйти");
/**
login.php
*/
define("LOGIN_LANGUAGE", "Язык");
define("LOGIN_LEGEND", "Зарегистрироваться");
define("LOGIN_PSEUDO", "Логин");
define("LOGIN_PASSWORD", "Пароль");
define("LOGIN_REMEMBER", "Запомнить");
define("LOGIN_SUBMIT", "Войти");
/**
container.php == index.php --> Dispo
*/
define("DISPO_ALERT", "Добавите пожалуйста по крайней мере одного игрока.");
define("DISPO_DATE", "Дата");
define("DISPO_AT", "в");
define("DISPO_LEAGUE", "Лига");
define("DISPO_TEAM", "Команда");
define("DISPO_MAPS", "Карты");
define("DISPO_PLAYERS", "Доступные игроки");
define("DISPO_MISSING", "Отсутствие");
define("DISPO_LAST_DAY", "Вс");
define("MONDAY", "Пн");
define("TUESDAY", "Вт");
define("WEDNESDAY", "Ср");
define("THURSDAY", "Чт");
define("FRIDAY", "Пт");
define("SATURDAY", "Сб");
define("SUNDAY", "Вс");
define("DISPO_NO_MATCHES", "Нету намеченого матча");

/**
matchs.php
*/
define("DATEPICKER_LANGUAGE", "ru"); // refer to https://github.com/eternicode/bootstrap-datepicker/tree/master/js/locales
define("MATCHS_SET_LEGEND", "Наметить матч");
define("MATCHS_DATE", "Дата");
define("MATCHS_TIME", "Время");
define("MATCHS_LEAGUE", "Лига");
define("MATCHS_TEAM", "Команда");
define("MATCHS_MAP1", "Карта 1");
define("MATCHS_MAP2", "Карта 2");
define("MATCHS_SET_SUBMIT", "Наметить");
define("MATCHS_UNSET_LEGEND", "Удалить матч");
define("MATCHS_LIST", "Список матчей");
define("MATCHS_UNSET_SUBMIT", "Удалить");
define("MATCHS_SCHEDULE_SUCCESS", "Матч хорошо намечен");
define("MATCHS_SCHEDULE_FAILURE", "Один матч уже намечен на это время");
/**
settings.php --> options communes
*/
define("COMMON_ADD_PLAYER_LEGEND", "Добавить игрока");
define("COMMON_ADD_PLAYER_PSEUDO", "Имя");
define("COMMON_ADD_PLAYER_INFO", "Пяроль = Имя");
define("COMMON_ADD_PLAYER_SUBMIT", "Добавить");
define("COMMON_DELETE_PLAYER_LEGEND", "Удалить игрока");
define("COMMON_DELETE_PLAYER_LIST", "Список игроков");
define("COMMON_DELETE_PLAYER_SUBMIT", "Удалить");
define("COMMON_ADD_LEAGUE_LEGEND", "Добавить лигу");
define("COMMON_ADD_LEAGUE_NAME", "Названия лиги");
define("COMMON_ADD_LEAGUE_SUBMIT", "Добавить");
define("COMMON_DELETE_LEAGUE_LEGEND", "Удалить лигу");
define("COMMON_DELETE_LEAGUE_LIST", "Список лиг");
define("COMMON_DELETE_LEAGUE_SUBMIT", "Удалить");
define("COMMON_ADD_MAP_LEGEND", "Добавить карту");
define("COMMON_ADD_MAP_NAME", "Названия карты");
define("COMMON_ADD_MAP_SUBMIT", "Добавить");
define("COMMON_DELETE_MAP_LEGEND", "Удалить карту");
define("COMMON_DELETE_MAP_LIST", "Список карт");
define("COMMON_DELETE_MAP_SUBMIT", "Удалить");
define("ADD_PLAYER_FAILURE_PRE", "Игрок ");
define("ADD_PLAYER_FAILURE_POST", " уже существует.");
define("ADD_PLAYER_SUCCESS_PRE", "Игрок ");
define("ADD_PLAYER_SUCCESS_POST", " добавлен.");
define("ADD_PLAYER_SPECIAL_CHARS", "Специальные символы запрещены");
define("ADD_LEAGUE_PRE", " Лига");
define("ADD_LEAGUE_FAILURE_POST", " уже существует.");
define("ADD_LEAGUE_POST", " добавлена.");
define("ADD_MAP_PRE", " Карта ");
define("ADD_MAP_FAILURE_POST", " уже существует.");
define("ADD_MAP_POST", " добавлена.");
/**
player_settings.php --> options joueur
*/
define("PLAYER_DISPO_LEGEND", "Пригодности по умолчанию");
define("PLAYER_MON", "Понедельник");
define("PLAYER_TUE", "Вторник");
define("PLAYER_WED", "Среда");
define("PLAYER_THU", "Четверг");
define("PLAYER_FRI", "Пятница");
define("PLAYER_SAT", "Суббота");
define("PLAYER_SUN", "Воскресенье");
define("PLAYER_YES", "Да");
define("PLAYER_NO", "Нет");
define("PLAYER_IDK", "???");
define("PLAYER_UNSET", "∅");
define("PLAYER_DISPO_SUBMIT", "Подтвердить");
define("PLAYER_CLASS_LEGEND", "Выбрать класс");
define("PLAYER_CLASS_SUBMIT", "Подтвердить");
define("PLAYER_PASSWORD_LEGEND", "Изменить пароль");
define("PLAYER_PASSWORD_NEW", "Новый пароль");
define("PLAYER_PASSWORD_CONFIRM", "Подтвердитe пароль");
define("PLAYER_PASSWORD_SUBMIT", "Изменить");
define("PLAYER_AVATAR_LEGEND", "Аватара");
define("PLAYER_AVATAR_BROWSE", "Просматривать");
define("PLAYER_AVATAR_SUBMIT", "Подтвердить");
define("PLAYER_LANGUAGE_LEGEND", "Изменить язык");
define("PLAYER_LANGUAGE_SUBMIT", "Изменить");
define("CHANGE_PASSWORD_SUCCESS", "Пароль успешно изменён.");
define("DEFAULT_DISPO_SUCCESS", " Пригодности по умолчанию изменены.");
define("CLASS_UPDATE_SUCCESS", " Класс изменён.");
define("FILE_NOT_FOUND", " Картина не найдена.");
define("SUPPORTED_EXTENTION", " Поддерживаемые форматы : png gif jpg jpeg.");
define("MAX_SIZE", " Максимальный размер : 100Ko");
define("AVATAR_CHANGED", " Аватара обновлён.");
/**
message
*/
define("MESSAGE_SEND", "Послать");
define("MESSAGE_BOLD", "Полужирный");
define("MESSAGE_UNDERLINE", "Подчёркнутый");
define("MESSAGE_ITALIC", "Курсив");
define("MESSAGE_IMAGE", "Вставить картину");
define("MESSAGE_LINK", "Вставить связку");
define("MESSAGE_QUOTE_FORM", "Вставить цитату");
define("CLASS_MESSAGE_MODIFY", "Изменить");
define("CLASS_MESSAGE_QUOTE", "Цитировать");
define("CLASS_MESSAGE_TODAY", "Сегодня");
define("CLASS_MESSAGE_YESTERDAY", "Вчера");
define("CLASS_MESSAGE_QUOTED", "Цитата");
define("CLASS_MESSAGE_NO_MESSAGE", "Нет сообщения.");
/**
historic.php -> historique ajouter
*/
define("HISTORIC_ADD_DATE", "Дата");
define("HISTORIC_ADD_TIME", "Время");
define("HISTORIC_ADD_LEAGUE", "Лига");
define("HISTORIC_ADD_TEAM", "Команда");
define("HISTORIC_ADD_MAP1", "Карта 1");
define("HISTORIC_ADD_SCORE", "Счёт");
define("HISTORIC_ADD_SCORE_OPPONENT", "Счёт противника");
define("HISTORIC_ADD_LOGS_MAP1", "Logs карты 1");
define("HISTORIC_ADD_MAP2", "Карта 2");
define("HISTORIC_ADD_LOGS_MAP2", "Logs карты 2");
define("HISTORIC_ADD_COMMENT", "Комментарии");
define("HISTORIC_ADD_SUBMIT", "Добавить в историю");
/**
historique voir
*/
define("HISTORIC_VIEW_DATE", "Дата");
define("HISTORIC_VIEW_TIME", "Время");
define("HISTORIC_VIEW_LEAGUE", "Лига");
define("HISTORIC_VIEW_TEAM", "Команда");
define("HISTORIC_VIEW_SCORE", "Счёт");
define("HISTORIC_VIEW_MAPS", "Карта");
define("HISTORIC_VIEW_LOGS", "Logs");
define("HISTORIC_VIEW_INFO", "Информация");
define("HISTORIC_VIEW_CONFIRM_MESSAGE", "'Удалить матч?'"); // /!\ keep the simple quote
/**
login
*/
define("LOGIN_PRE", " Игрок ");
define("LOGIN_POST", " не существует или пароль не совпадает.");
?>