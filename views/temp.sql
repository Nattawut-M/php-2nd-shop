-- create table
CREATE TABLE tb_role_user (
   role_id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
   role_description varchar(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;
CREATE TABLE tb_product (
   pd_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
   pd_name varchar(255) NOT NULL,
   pd_detail varchar(255) NOT NULL,
   pd_price int(100) NOT NULL,
   pd_img varchar(255) NOT NULL,
   pd_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
   user_id int(100) NOT NULL,
   type_id int(100) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

-- insert
INSERT INTO `tb_role_user` (`role_id`, `role_description`) VALUES ('1', 'Admin'), ('2', 'users');

-- update
UPDATE `tb_role_user` SET `role_description` = 'admin' WHERE `tb_role_user`.`role_id` = 1;
