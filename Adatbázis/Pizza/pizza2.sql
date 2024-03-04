-- A Pizza adatb�zis adatai alapj�n �jabb SQL lek�rdez�sek seg�ts�g�vel v�laszold meg az al�bbi k�rd�seket!

-- K�rd�sek:

-- 	 1.	Mennyit k�lt�ttek pizz�ra az egyes vev�k?
SELECT vnev, SUM(par * db)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    vevo.vazon
    -- 	 2.	Mennyit vettek az egyes vev�k a k�l�nb�z� pizz�kb�l?
SELECT vnev, pnev, SUM(db) AS 'Darab'
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1,
    2;

-- 	 3.	Ki h�ny pizz�t sz�ll�tott h�zhoz az egyes napokon?
SELECT fnev, datum, SUM(db) AS 'Darab'
FROM
    rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
    inner join futar on futar.fazon = rendeles.fazon
GROUP BY
    2,
    1
    -- 	 4.	Ki h�ny pizz�t rendelt az egyes napokon?
SELECT vnev, datum, SUM(db) AS 'Darab'
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    2,
    1
    -- 	 5.	Mennyi volt a bev�tel az egyes napokon?
SELECT datum, SUM(par * db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
    -- 	 6.	H�ny pizza fogyott naponta?
SELECT datum, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
    -- 	 7.	Mennyi pizza fogyott �tlagosan naponta?
SELECT datum, SUM(db) / AVG(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
-- 	 8.	H�ny pizz�t rendeltek �tlagosan egyszerre?
select datum, avg(db)
FROM vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
where
    ido = ido
group by
    1
    -- 	 9.	H�ny alkalommal sz�ll�tottak h�zhoz az egyes fut�rok?
select fnev, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    inner join futar on futar.fazon = rendeles.fazon
group by
    1
    -- 	10.	A fogyaszt�s alapj�n mi a pizz�k n�pszer�s�gi sorrendje?
select pnev, SUM(db)
FROM tetel
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
group by
    1
ORDER BY 2 DESC
-- 	11.	A rendel�s �rt�ke alapj�n mi a vev�k sorrendje?
SELECT vnev, SUM(par * db)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
ORDER BY 2 DESC
    -- 	12.	Melyik a legdr�g�bb pizza?
select pnev, par
FROM pizza
GROUP BY
    pnev
ORDER BY par DESC
LIMIT 1;

-- 	13.	Ki sz�ll�totta h�zhoz a legt�bb pizz�t?
select fnev, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    inner join futar on futar.fazon = rendeles.fazon
group by
    1
order by 2 desc
limit 1;
-- 	14.	Ki ette a legt�bb pizz�t?
select vnev, SUM(db)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
ORDER BY 2 DESC
LIMIT 1;

-- 	15.	Melyik nap fogyott a legt�bb pizza?
SELECT datum, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
ORDER BY 2 DESC
LIMIT 1;

-- 	16.	Melyik nap fogyott a legt�bb Hawaii pizza?
SELECT
  pizza.pnev, datum
  IFNULL(SUM(tetel.db),0) AS 'Hawaii pizza db'
FROM tetel
    INNER JOIN rendeles ON tetel.razon = rendeles.razon
  RIGHT OUTER JOIN pizza
    ON tetel.pazon = pizza.pazon
WHERE pizza.pnev = 'Hawaii'
GROUP BY pizza.pnev

-- 	17.	H�ny pizza fogyott a legforgalmasabb napon?

-- 	18.	Mennyi volt a bev�tel a legjobb napon?

-- 	19.	Mi Szundi kedvenc pizz�ja?

-- 	20.	Kik rendeltek pizz�t a nyit�s napj�n?

-- 	21.	Mely pizz�k olcs�bbak a Capricciosa pizz�n�l?

-- 	22.	Mely pizz�k dr�g�bbak az �tlagosn�l?

-- 	23.	Mely pizza �ra van legk�zelebb az �tlag�rhoz?

-- 	24.	Mely fut�rok mentek t�bbet h�zhoz az �tlagosn�l?