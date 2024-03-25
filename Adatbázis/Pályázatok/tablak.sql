CREATE TABLE koltsegtipus (
  id varchar(3),
  megnevezes varchar(32) NOT NULL,
  CONSTRAINT pk_koltsegtipus PRIMARY KEY (id)
);

CREATE TABLE palyazat (
  id int,
  tervezetA int NOT NULL,
  tervezetC int NOT NULL,
  CONSTRAINT pk_palyazat PRIMARY KEY (id)
);

CREATE TABLE szamla (
  id int,
  szamlaszam varchar(9) NOT NULL,
  datum date NOT NULL,
  ertek int NOT NULL,
  palyazatId int NOT NULL,
  koltsegtipusId varchar(3) NOT NULL,
  CONSTRAINT pk_szamla PRIMARY KEY (id)
);