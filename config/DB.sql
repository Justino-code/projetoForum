CREATE DATABASE FORUM;
USE FORUM;

DROP TABLE IF EXISTS user_accounts;
DROP TABLE IF EXISTS identidade;
DROP TABLE IF EXISTS password;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS notificacao;


CREATE TABLE user_accounts (
id_user INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
email VARCHAR(200) NOT NULL,
user_type VARCHAR NOT NULL DEFAULT 'user',
create_date DATETIME NOT NULL,
update_date DATETIME NOT NULL);

CREATE TABLE user_identity (
id_nome INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(100) NOT NULL,
sobrenome VARCHAR(100) NOT NULL,
alcunha  VARCHAR(100) NOT NULL,
id_user INT NOT NULL);

CREATE TABLE password (
id_pass INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
password VARCHAR(260) NOT NULL,
salt VARCHAR(260) NOT NULL,
id_user INT NOT NULL UNIQUE);

CREATE TABLE post (
id_post INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
title VARCHAR(100) NOT NULL,
content TEXT NOT NULL,
create_date DATETIME NOT NULL,
update_date DATETIME NOT NULL,
id_user INT NOT NULL,
id_cat INT NOT NULL);

CREATE TABLE category (
id_cat INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
name VARCHAR(100) NOT NULL,
create_date DATETIME NOT NULL,
update_date DATETIME NOT NULL);

CREATE TABLE comment (
id_coment INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
content TEXT NOT NULL,
create_date DATETIME NOT NULL,
update_date DATETIME NOT NULL,
id_user INT NOT NULL,
id_post INT NOT NULL);

CREATE TABLE notificacao (
id_notif INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
notificacao VARCHAR(100) NOT NULL,
id_user INT NOT NULL);

ALTER TABLE user_identity ADD CONSTRAINT identidade_id_user_user_id_user FOREIGN KEY (id_user) REFERENCES user_identity(id_user);
ALTER TABLE password ADD CONSTRAINT password_id_user_user_id_user FOREIGN KEY (id_user) REFERENCES user_identity(id_user);
ALTER TABLE post ADD CONSTRAINT post_id_user_user_id_user FOREIGN KEY (id_user) REFERENCES user_identity(id_user);
ALTER TABLE post ADD CONSTRAINT post_id_cat_category_id_cat FOREIGN KEY (id_cat) REFERENCES category(id_cat);
ALTER TABLE comment ADD CONSTRAINT comment_id_user_user_id_user FOREIGN KEY (id_user) REFERENCES user_identtity(id_user);
ALTER TABLE comment ADD CONSTRAINT comment_id_post_post_id_post FOREIGN KEY (id_post) REFERENCES post(id_post);
ALTER TABLE notificacao ADD CONSTRAINT notificacao_id_user_user_id_user FOREIGN KEY (id_user) REFERENCES user_identity(id_user);

