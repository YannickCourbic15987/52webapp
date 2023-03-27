-- SCRIPT de création de la base de donnée écrit à la maim 


CREATE DATABASE IF NOT EXISTS circlegamebdd_dev

CREATE TABLE IF NOT EXISTS laniste(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    prename VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    coin INT NOT NULL
);

CREATE TABLE IF NOT EXISTS ludi(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    speciality VARCHAR(150) NOT NULL,
    lanistes_id INT FOREIGN KEY (lanistes_id) REFERENCES laniste(id)
);

CREATE TABLE IF NOT EXISTS gladiator(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    avatar TEXT NOT NULL,
    address FLOAT NOT NULL,
    strength FLOAT NOT NULL,
    balance FLOAT NOT NULL,
    speed FLOAT NOT NULL,
    strategy FLOAT NOT NULL,
    ludis_id INT FOREIGN KEY (ludis_id) REFERENCES lud(id),
    edit DATETIME DEFAULT NULL,
    performance FLOAT DEFAULT NULL
);