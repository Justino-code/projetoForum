CREATE TABLE user_accounts(id_user int unsigned primary key auto_increment not null, email varchar(100) not null unique, user_type int null default 1, status int(2) null default 2, telefone varchar(20) null, create_date datetime not null, update_date datetime not null, last_login datetime, verify boolean null default false, post_notify boolean null default false, password varchar(260) not null);

CREATE TABLE identidade(id_ident int unsigned primary key auto_increment not null, nome varchar(100) not null, sobrenome varchar(100) not null, alcunha varchar(100) null, foto_perfil varchar(100) null, date_of_birth date null, id_user int unsigned not null, foreign key (
id_user) references user_accounts(id_user) ON DELETE CASCADE);

/*CREATE TABLE password(id_pass int unsigned primary key auto_increment not null,password varchar(260) not null unique, salt varchar(260) not null unique, id_user int UNSIGNED not null, FOREIGN KEY (id_user) REFERENCES user_accounts(id_user) ON DELETE CASCADE);*/

CREATE TABLE category (id_cat int UNSIGNED primary key auto_increment not null, nome varchar(100) not null, create_date datetime not null, update_date datetime not null);

CREATE TABLE post(id_post INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, titltle varchar(100) not null, content text not null, create_date datetime not null, update_date datetime not null, id_user int unsigned not null,
id_cat int unsigned not null, FOREIGN KEY (id_user) REFERENCES user_accounts(id_user) ON UPDATE
CASCADE, FOREIGN KEY (id_cat) REFERENCES category (id_cat) ON UPDATE CASCADE);

CREATE TABLE comment(id_com int unsigned primary key auto_increment not null, content text not null, create_date datetime not null, update_date datetime not null, id_post int unsigned not null, id_user int unsigned not null, FOREIGN KEY (id_post) REFERENCES post(id_post)ON DELETE CASCADE, FOREIGN KEY (id_user) REFERENCES user_accounts(id_user));

CREATE TABLE notification(id_notify int unsigned primary key auto_increment, notification int(1) not null, status boolean null default true, post_notify boolean null default false, id_user int unsigned not null, id_com int unsigned not null, id_post int unsigned null, FOREIGN KEY (id_user) REFERENCES user_accounts (id_user) ON DELETE CASCADE, FOREIGN KEY (id_com) REFERENCES comment(id_com), FOREIGN KEY (id_post) REFERENCES post(id_post));




