CREATE TABLE  `membership`.`users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`first_name` VARCHAR( 100 ) NOT NULL ,
`last_name` VARCHAR( 100 ) NOT NULL ,
`email` VARCHAR( 255 ) NOT NULL ,
`salt` VARCHAR( 40 ) NOT NULL ,
`password` VARCHAR( 40 ) NOT NULL ,
`bio` TEXT NULL ,
UNIQUE (
`email`
)
) ENGINE = MYISAM ;