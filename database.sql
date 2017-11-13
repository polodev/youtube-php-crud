create database company;
use company;

create table people (
  id  int(11) auto_increment primary key,
  name varchar(30) not null,
  email varchar(30) not null
);