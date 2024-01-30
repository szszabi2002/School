-- Active: 1706598324977@@127.0.0.1@3306@szotar_szsz
/*1*/
CREATE DATABASE szotar_Szsz
CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*2*/
SELECT
  szolista.angol,
  szolista.magyar
FROM szolista
WHERE szolista.helyes >= 150
OR szolista.helytelen <= 5
/*3*/
SELECT
  szolista.angol,
  szolista.magyar
FROM szolista
WHERE szolista.angol SOUNDS LIKE szolista.magyar
/*4*/
