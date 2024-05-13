CREATE DATABASE haziorvos_rendelo
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci

USE haziorvos_rendelo

CREATE TABLE beteg(
    TAJszam CHAR(9) PRIMARY KEY,
    nev VARCHAR(30),
    irszam INT,
    utcahsz VARCHAR(40)
);

Vizsgálat időpontja(Vizsgálat kódja(PK), Dátum(PK), ÓraPerc, BetegId)
	Vizsgálat: BetegId -> Beteg(TAJ szám)

CREATE TABLE vizsgalatidopontja(
    Vizsgalatkodja INT PRIMARY KEY,
    Datum Date PRIMARY KEY,
    OraPerc TIME,
    BetegId INT
);

FOREIGN KEY (BetegId) REFERENCES beteg(TAJszmam);

CREATE TABLE betegseg(
    nev VARCHAR(50) PRIMARY KEY
);

CREATE TABLE gyogyszer(
    id INT PRIMARY KEY,
    nev VARCHAR(50)
);

CREATE TABLE hatoanyag(
    nev VARCHAR(50) PRIMARY KEY
);

CREATE Table gyogyszerhatoanyaga(
    GyogyszerID INT PRIMARY KEY,
    HatoanyagID INT PRIMARY KEY,
    FOREIGN KEY (GyogyszerID) REFERENCES gyogyszer(id),
    FOREIGN KEY (HatoanyagID) REFERENCES hatoanyag(nev)
);

