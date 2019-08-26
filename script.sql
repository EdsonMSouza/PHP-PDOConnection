CREATE DATABASE IF NOT EXISTS pdo_connection;

USE pdo_connection;


CREATE TABLE IF NOT EXISTS pdo_example(
    id 		int(11) not null primary key AUTO_INCREMENT,
    name	varchar(30) not null,
    age		int(11) not null
);