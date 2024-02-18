-- Структура данных для хранения новостей. Данный скрипт зависит от core2/db.sql.
CREATE TABLE IF NOT EXISTS `news_article` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id` int(11) UNSIGNED,
  `title` varchar(60) DEFAULT '',
  `content` TEXT DEFAULT '',
  `published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  FOREIGN KEY (`author_id`) REFERENCES `core_users` (`u_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;