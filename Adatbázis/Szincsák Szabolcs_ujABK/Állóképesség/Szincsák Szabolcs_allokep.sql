-- Active: 1706598324977@@127.0.0.1@3306@allokep

/*2*/
SELECT
  megye.letszam
FROM megye
WHERE megye.nev LIKE "%Vas%"

/*3*/
SELECT
  SUM(aerob.letszam)
FROM aerob
  INNER JOIN megye
    ON aerob.mkod = megye.kod
WHERE megye.nev LIKE "%Somogy%" 

/*4*/
SELECT
  aerob.letszam
FROM aerob
  INNER JOIN allapot
    ON aerob.allkod = allapot.kod
  INNER JOIN megye
    ON aerob.mkod = megye.kod
WHERE megye.nev LIKE "%Zala%"
AND aerob.nem = 1
AND allapot.nev LIKE "%egészséges%"

/*5*/
SELECT
    COUNT(*) AS megyek_szama
FROM
    megye
WHERE
    letszam < (
        SELECT
            letszam
        FROM
            megye
        WHERE
            nev = 'Heves'
    );

/*6*/
SELECT
    (COUNT(aerob.azon) * 100.0 / megye.letszam) AS reszveteli_arany
FROM
    megye
    LEFT JOIN aerob ON megye.kod = aerob.mkod
WHERE
    megye.nev = 'Pest';

/*7*/
SELECT
    megye.nev,
    COUNT(*) AS egeszseges_lanyok_szama
FROM
    megye
    JOIN aerob ON megye.kod = aerob.mkod
    JOIN allapot ON aerob.allkod = allapot.kod
WHERE
    allapot.nev LIKE "%egészséges%"
    AND aerob.nem = '0'
GROUP BY
    megye.nev
ORDER BY
    egeszseges_lanyok_szama DESC;


/*8*/


/*9*/