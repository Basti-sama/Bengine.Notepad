CREATE TABLE `bengine_note` (
`note_id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`user_id` INT( 11 ) UNSIGNED NOT NULL,
`time_created` INT( 11 ) UNSIGNED NOT NULL,
`title` VARCHAR( 250 ) NOT NULL DEFAULT '',
`note_text` TEXT NOT NULL DEFAULT '',
INDEX ( `user_id` )
) ENGINE = INNODB;

ALTER TABLE  `bengine_note` ADD FOREIGN KEY ( `user_id` ) REFERENCES `bengine_user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE ;

INSERT INTO `bengine_phrasesgroups` (`phrasegroupid`, `title`) VALUES ('83', 'Notepad');

INSERT INTO `bengine_phrases` (`languageid`, `phrasegroupid`, `title`, `content`) VALUES
('1', '1', 'MENU_NOTEPAD', 'Notizblock'),
('1', '83', 'NOTEPAD', 'Notizblock'),
('1', '83', 'SUBJECT', 'Betreff'),
('1', '83', 'DATE', 'Datum'),
('1', '83', 'DELETE', 'L&ouml;schen'),
('1', '83', 'DELETE_MARKED', 'Markierte l&ouml;schen'),
('1', '83', 'CREATE', 'Notiz anlegen'),
('1', '83', 'SAVE', 'Speichern'),
('1', '83', 'CANCEL', 'Abbrechen'),
('1', '83', 'NOTE_TEXT', 'Text'),
('1', '83', 'EDIT_NOTE', 'Notiz bearbeiten'),
('1', '83', 'NOTE_DOES_NOT_EXIST', 'Die Notiz existiert nicht.'),
('1', '83', 'NOTE_SUCCESSFULLY_SAVED', 'Die Notiz wurde erfolgreich gespeichert.'),
('1', '83', 'NOTE_TITLE_INVALID', 'Der Betreff ist zu kurz oder lang.'),
('1', '83', 'NOTE_TEXT_INVALID', 'Der Text ist zu kurz oder zu lang.');