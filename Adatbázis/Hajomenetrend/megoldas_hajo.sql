/*1*/
CREATE DATABASE hajo_SzSz
DEFAULT CHARACTER "utf8_hungarian_ci"

/*2*/
ALTER TABLE menetrend
ADD COLUMN azon INT AUTO_INCREMENT PRIMARY KEY FIRST;

/*3*/
SELECT honnan, indul, hova, erkezik FROM menetrend
WHERE jarat = 'J1'

/*4*/
SELECT DISTINCT `hova` FROM `menetrend` 
WHERE `honnan` = 'Balatonfüred'
AND `indul` >= '11:30' 
AND `indul` <= '12:30'

/*4.a*/
SELECT DISTINCT `hova` FROM `menetrend` 
WHERE `honnan` = 'Balatonfüred'
AND `indul` BETWEEN '11:30' AND '12:30'