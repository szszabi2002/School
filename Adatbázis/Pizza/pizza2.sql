-- A Pizza adatbázis adatai alapján újabb SQL lekérdezések segítségével válaszold meg az alábbi kérdéseket!

-- Kérdések:

-- 	 1.	Mennyit költöttek pizzára az egyes vevõk?
SELECT vnev, SUM(par * db)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    vevo.vazon
    -- 	 2.	Mennyit vettek az egyes vevõk a különbözõ pizzákból?
SELECT vnev, pnev, SUM(db) AS 'Darab'
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1,
    2;

-- 	 3.	Ki hány pizzát szállított házhoz az egyes napokon?
SELECT fnev, datum, SUM(db) AS 'Darab'
FROM
    rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
    inner join futar on futar.fazon = rendeles.fazon
GROUP BY
    2,
    1
    -- 	 4.	Ki hány pizzát rendelt az egyes napokon?
SELECT vnev, datum, SUM(db) AS 'Darab'
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    2,
    1
    -- 	 5.	Mennyi volt a bevétel az egyes napokon?
SELECT datum, SUM(par * db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
    -- 	 6.	Hány pizza fogyott naponta?
SELECT datum, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
    -- 	 7.	Mennyi pizza fogyott átlagosan naponta?
SELECT datum, SUM(db) / AVG(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
-- 	 8.	Hány pizzát rendeltek átlagosan egyszerre?
select datum, avg(db)
FROM vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
where
    ido = ido
group by
    1
    -- 	 9.	Hány alkalommal szállítottak házhoz az egyes futárok?
select fnev, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    inner join futar on futar.fazon = rendeles.fazon
group by
    1
    -- 	10.	A fogyasztás alapján mi a pizzák népszerûségi sorrendje?
select pnev, SUM(db)
FROM tetel
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
group by
    1
ORDER BY 2 DESC
-- 	11.	A rendelés értéke alapján mi a vevõk sorrendje?
SELECT vnev, SUM(par * db)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
ORDER BY 2 DESC
    -- 	12.	Melyik a legdrágább pizza?
select pnev, par
FROM pizza
GROUP BY
    pnev
ORDER BY par DESC
LIMIT 1;

-- 	13.	Ki szállította házhoz a legtöbb pizzát?
select fnev, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    inner join futar on futar.fazon = rendeles.fazon
group by
    1
order by 2 desc
limit 1;
-- 	14.	Ki ette a legtöbb pizzát?
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

-- 	15.	Melyik nap fogyott a legtöbb pizza?
SELECT datum, SUM(db)
FROM rendeles
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
GROUP BY
    1
ORDER BY 2 DESC
LIMIT 1;

-- 	16.	Melyik nap fogyott a legtöbb Hawaii pizza?
SELECT
  pizza.pnev, datum
  IFNULL(SUM(tetel.db),0) AS 'Hawaii pizza db'
FROM tetel
    INNER JOIN rendeles ON tetel.razon = rendeles.razon
  RIGHT OUTER JOIN pizza
    ON tetel.pazon = pizza.pazon
WHERE pizza.pnev = 'Hawaii'
GROUP BY pizza.pnev

-- 	17.	Hány pizza fogyott a legforgalmasabb napon?

-- 	18.	Mennyi volt a bevétel a legjobb napon?

-- 	19.	Mi Szundi kedvenc pizzája?

-- 	20.	Kik rendeltek pizzát a nyitás napján?

-- 	21.	Mely pizzák olcsóbbak a Capricciosa pizzánál?

-- 	22.	Mely pizzák drágábbak az átlagosnál?

-- 	23.	Mely pizza ára van legközelebb az átlagárhoz?

-- 	24.	Mely futárok mentek többet házhoz az átlagosnál?