-- creating the database
create database studentportal;
use studentportal;

-- table users
create table users (
     id int AUTO_INCREMENT PRIMARY KEY,
     username varchar(255) not null unique,
     email varchar(255) not null unique,
     password varchar(255) not null
     );

