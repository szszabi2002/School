CREATE DATABASE hamburger_13I_2cs
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

SELECT
  menutetel.*
FROM menutetel
WHERE menutetel.ar = 2500

UPDATE menutetel.ar
  SET ar=2300
WHERE menutetel.nev = 'Grill pizza 32cm'