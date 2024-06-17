CREATE DATABASE IF NOT EXISTS trading_game;

USE trading_game;

CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nick_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    `group` INT DEFAULT 1,
    avatar VARCHAR(255) DEFAULT 'default.png',
    ip VARCHAR(255) NOT NULL,
    gold INT DEFAULT 100,
    ship_capacity INT DEFAULT 20,
    current_port INT DEFAULT 1,
    departed TINYINT(1) DEFAULT 0,
    departure_time INT DEFAULT 0,
    created_at INT DEFAULT 0,
    updated_at INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS ports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    travel_time INT NOT NULL
);
