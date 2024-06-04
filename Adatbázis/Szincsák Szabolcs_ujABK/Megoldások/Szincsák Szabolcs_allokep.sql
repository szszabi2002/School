-- Active: 1706598324977@@127.0.0.1@3306@allokep

/*2*/
SELECT megye.letszam FROM megye WHERE megye.nev LIKE "%Vas%"

/*3*/
SELECT SUM(aerob.letszam)
FROM aerob
    INNER JOIN megye ON aerob.mkod = megye.kod
WHERE
    megye.nev LIKE "%Somogy%"

/*4*/
SELECT aerob.letszam
FROM aerob
    INNER JOIN allapot ON aerob.allkod = allapot.kod
    INNER JOIN megye ON aerob.mkod = megye.kod
WHERE
    megye.nev LIKE "%Zala%"
    AND aerob.nem = 1
    AND allapot.nev LIKE "%egészséges%"

/*5*/
SELECT COUNT(*) AS megyek_szama
FROM megye
WHERE
    letszam < (
        SELECT letszam
        FROM megye
        WHERE
            nev = 'Heves'
    );

/*6*/
SELECT COUNT(aerob.azon) * 100.0 / megye.letszam AS reszveteli_arany
FROM megye
    LEFT OUTER JOIN aerob ON megye.kod = aerob.mkod
WHERE
    megye.nev LIKE "Pest"

/*7*/
SELECT megye.nev, SUM(aerob.letszam)
FROM megye
    INNER JOIN aerob ON megye.kod = aerob.mkod
    INNER JOIN allapot ON aerob.allkod = allapot.kod
WHERE
    allapot.nev = 'egészséges'
    AND aerob.nem = '0'
GROUP BY
    megye.nev
ORDER BY 2 DESC

/*8*/
SELECT COUNT(aerob.azon) * 100.0 / megye.letszam AS reszveteli_arany
FROM megye
    LEFT OUTER JOIN aerob ON megye.kod = aerob.mkod
GROUP BY
    megye.nev
ORDER BY 1 DESC
LIMIT 1

/*9*/
SELECT megye.nev AS Megyenév, SUM(aerob.letszam) / megye.letszam AS Arány
FROM aerob
    INNER JOIN megye ON aerob.mkod = megye.kod
    INNER JOIN allapot ON aerob.allkod = allapot.kod
WHERE
    allapot.nev NOT LIKE 'egészséges'
GROUP BY
    megye.nev
HAVING
    Arány > 0.25