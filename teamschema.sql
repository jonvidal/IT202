drop table if exists nflteam;
create table nflteam
(
  teamId INT(11) auto_increment,
  teamName varchar(40) NOT NULL,
  primary key (teamId, teamName)
);

drop table if exists nbateam;
create table nbateam
(
  teamId INT(11) auto_increment,
  teamName varchar(40) NOT NULL,
  primary key (teamId, teamName)
);

drop table if exists mlbteam;
create table mblteam
(
  teamId INT(11) auto_increment,
  teamName varchar(40) NOT NULL,
  primary key (teamId, teamName)
);