DROP DATABASE IF EXISTS WeShare;
CREATE DATABASE IF NOT EXISTS WeShare ;
USE WeShare;

/* table Users */
CREATE TABLE IF NOT EXISTS Users
(IdUser				INT 			NOT NULL	AUTO_INCREMENT,
RegisterDate		DATE			NOT NULL,
Pseudo			 	VARCHAR(255) 	NOT NULL,
Password			VARCHAR(255) 	NOT NULL,
Mail			 	VARCHAR(255) 	NOT NULL,
LastName			VARCHAR(255),
FirstName			VARCHAR(255),
BornDate			DATE,
Address			 	VARCHAR(255),
City			 	VARCHAR(255),
Country			 	VARCHAR(255),
Phone				DECIMAL(12,0),
Avatar				BLOB,
PRIMARY KEY(IdUser));

/* table Events */
CREATE TABLE IF NOT EXISTS Events
(IdEvent			INT				NOT NULL	AUTO_INCREMENT,
IdOrganizer			INT 			NOT NULL,
DateOfEvent			DATE 			NOT NULL,
Adress				varchar(255)	NOT NULL,
City				varchar(255)	NOT NULL,
CreationDate		DATE 			NOT NULL,
PollEnding			DATE,
PRIMARY KEY(IdEvent),
FOREIGN KEY (IdOrganizer)
	REFERENCES Users(IdUser));

/* table EventsSelections */
CREATE TABLE IF NOT EXISTS EventsSelections
(IdEvent			INT				NOT NULL,
IdMovie				INT 			NOT NULL,
NumberOfVote		INT				DEFAULT 0,
FOREIGN KEY (IdEvent)
	REFERENCES Events(IdEvent));

/* table EventsInvitations */
CREATE TABLE IF NOT EXISTS EventsInvitations
(IdEvent			INT				NOT NULL,
IdUser				INT 			NOT NULL,
Status				INT				DEFAULT 0,
FOREIGN KEY (IdEvent)
	REFERENCES Events(IdEvent));

/* table Friends */
CREATE TABLE IF NOT EXISTS Friends
(IdUser				INT 			NOT NULL,
IdFriend			INT 			NOT NULL,
Status				INT				DEFAULT 0,
FOREIGN KEY (IdUser)
	REFERENCES Users(IdUser));

/* table Groups */
CREATE TABLE IF NOT EXISTS Groups
(IdGroup			INT 			NOT NULL	AUTO_INCREMENT,
Name				VARCHAR(255)	NOT NULL,
IdCreator			INT 			NOT NULL,
PRIMARY KEY(IdGroup));
	

/* table UserGroups */
CREATE TABLE IF NOT EXISTS UserGroups
(IdUser				INT 			NOT NULL,
IdGroup				INT 			NOT NULL,
FOREIGN KEY (IdUser)
	REFERENCES Users(IdUser),
FOREIGN KEY (IdGroup)
	REFERENCES Groups(IdGroup));
	
	
/* table PMs */
CREATE TABLE IF NOT EXISTS PMs
(IdPM				INT 			NOT NULL	AUTO_INCREMENT,
IdSender			INT 			NOT NULL,
Message				TEXT			NOT NULL,
MessageDate			DATE			NOT NULL,
PRIMARY KEY(IdPM));


/* table UserPMs */
CREATE TABLE IF NOT EXISTS UserPMs
(IdUser				INT 			NOT NULL,
IdPM				INT 			NOT NULL,
ReadStatus			INT				DEFAULT 0,
FOREIGN KEY (IdUser)
	REFERENCES Users(IdUser),
FOREIGN KEY (IdPM)
	REFERENCES PMs(IdPM));
	
/* table Movies */
CREATE TABLE IF NOT EXISTS Movies
(IdMovie			INT 			NOT NULL	AUTO_INCREMENT,
Name				VARCHAR(255)	NOT NULL,
Synopsis			TEXT			NOT NULL,
DateOfRecord		DATE			NOT NULL,
Poster				BLOB,
PRIMARY KEY(IdMovie));

/* table UserMovies */
CREATE TABLE IF NOT EXISTS UserMovies
(IdUser				INT 			NOT NULL,
IdMovie				INT 			NOT NULL,
Support				enum("cd","divx","blue-ray","dvd","fichier","VHS")	NOT NULL,
Available			INT				DEFAULT 1,
FOREIGN KEY (IdUser)
	REFERENCES Users(IdUser),
FOREIGN KEY (IdMovie)
	REFERENCES Movies(IdMovie));
	
/* table MoviesMarks */
CREATE TABLE IF NOT EXISTS MoviesMarks
(IdMovie			INT 			NOT NULL,
IdUser				INT 			NOT NULL,
Mark				DOUBLE			DEFAULT 0,
UserComment			TEXT,
FOREIGN KEY (IdUser)
	REFERENCES Users(IdUser),
FOREIGN KEY (IdMovie)
	REFERENCES Movies(IdMovie));

/* table Staffs */
CREATE TABLE IF NOT EXISTS Staffs
(IdStaff			INT 			NOT NULL	AUTO_INCREMENT,
LastName			VARCHAR(255)	NOT NULL,
FirstName			VARCHAR(255)	NOT NULL,
BornDate			DATE,
Bio					TEXT,
Picture				BLOB,
PRIMARY KEY(IdStaff));	

/* table MoviesStaffs */
CREATE TABLE IF NOT EXISTS MoviesStaffs
(IdMovie			INT 			NOT NULL,
IdStaff				INT 			NOT NULL,
StaffWork			enum("acteur","actrice","realisateur","realisatrice"),
FOREIGN KEY (IdStaff)
	REFERENCES Staffs(IdStaff),
FOREIGN KEY (IdMovie)
	REFERENCES Movies(IdMovie));

