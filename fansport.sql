drop table if exists fantasysport;
create table fantasysport
(
  userId INT(11) auto_increment,
  userName varchar(32) NOT NULL,
  userPW varchar(64) NOT NULL,
  firstName varchar(32) NOT NULL,
  lastName varchar(32) NOT NULL,
  emailAd varchar(50) NOT NULL,
  activeSession varchar(128),
  lastLogin datetime,
  primary key (userId, userName, emailAd)
);
