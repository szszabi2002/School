-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Jan 23. 07:54
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `nyilvantartas_13i_gy2`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `barlang`
--

CREATE TABLE `barlang` (
  `nev` varchar(41) DEFAULT NULL,
  `hossz` decimal(6,1) DEFAULT NULL,
  `kiterjedes` decimal(4,1) DEFAULT NULL,
  `melyseg` decimal(4,1) DEFAULT NULL,
  `magassag` decimal(3,1) DEFAULT NULL,
  `telepules` varchar(17) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `barlang`
--

INSERT INTO `barlang` (`nev`, `hossz`, `kiterjedes`, `melyseg`, `magassag`, `telepules`) VALUES
('Soproni Zsivány-barlang', 110.0, 12.0, 12.0, 0.0, 'Fertőrákos'),
('Abaligeti-barlang', 1712.0, 48.7, 10.0, 38.7, 'Abaliget'),
('Duó-zsomboly', 62.8, 31.0, 31.0, 0.0, 'Pécs'),
('Remény-zsomboly', 60.0, 51.5, 51.5, 0.0, 'Orfű'),
('Spirál-víznyelő', 850.0, 86.4, 86.4, 0.0, 'Pécs'),
('Büdöskúti-zsomboly', 40.0, 20.5, 20.5, 0.0, 'Pécs'),
('Korall-zsomboly', 25.0, 17.8, 17.8, 0.0, 'Mánfa'),
('Tettyei-forrásbarlang', 40.0, 17.0, 16.0, 1.0, 'Pécs'),
('Mánfai-kőlyuk', 310.0, 12.0, 4.3, 7.7, 'Mánfa'),
('Orfűi Vízfő-barlang', 328.5, 27.0, 1.0, 26.0, 'Orfű'),
('Mészégető-források-barlangja', 279.0, 14.5, 1.4, 13.1, 'Orfű'),
('Vásáros-úti-zsomboly', 76.2, 31.5, 29.5, 2.0, 'Orfű'),
('Szuadó-völgyi-víznyelőbarlang', 345.4, 52.0, 52.0, 0.0, 'Orfű'),
('Trió-barlang', 250.0, 58.0, 58.0, 0.0, 'Orfű'),
('Madárka-zsomboly', 42.4, 18.3, 18.3, 0.0, 'Orfű'),
('Beremendi-kristálybarlang', 850.0, 53.0, 38.0, 15.0, 'Beremend'),
('Nagyharsányi-kristálybarlang', 600.0, 60.0, 59.0, 1.0, 'Nagyharsány'),
('Hajszabarnai Pénz-lik', 120.0, 18.5, 13.0, 5.5, 'Bakonyjákó'),
('Kőris-hegyi-ördöglik', 64.0, 36.0, 36.0, 0.0, 'Bakonyszücs'),
('Pipa-zsomboly', 125.0, 48.2, 48.2, 0.0, 'Zirc'),
('Bükkös-árki-barlang', 73.2, 31.1, 31.1, 0.0, 'Isztimér'),
('Alba Regia-barlang', 3600.0, 200.2, 200.2, 0.0, 'Isztimér'),
('Háromkürtő-zsomboly', 360.0, 105.0, 105.0, 0.0, 'Tés'),
('Bongó-zsomboly', 136.7, 35.4, 35.4, 0.0, 'Bakonynána'),
('Őskarszt-akna', 53.0, 40.0, 40.0, 0.0, 'Tés'),
('Csengő-zsomboly', 210.3, 133.9, 133.9, 0.0, 'Olaszfalu'),
('Jubileumi-zsomboly', 222.2, 121.0, 121.0, 0.0, 'Tés'),
('Csipkés-zsomboly', 180.0, 72.5, 72.5, 0.0, 'Tés'),
('Tábla-völgyi-barlang', 350.0, 78.0, 78.0, 0.0, 'Tés'),
('Szelelő-lyuk', 261.3, 25.0, 25.0, 0.0, 'Tés'),
('Károlyházi-nyelő barlangja', 100.0, 65.0, 65.0, 0.0, 'Csesznek'),
('Szentgáli-kőlik', 420.0, 43.7, 39.0, 4.7, 'Szentgál'),
('Tűzköves-hegyi-barlang', 156.3, 15.8, 5.4, 10.4, 'Szentgál'),
('Cserszegtomaji-kútbarlang', 3320.0, 12.0, 10.0, 2.0, 'Cserszegtomaj'),
('Acheron-kútbarlang', 215.0, 3.5, 0.0, 3.5, 'Cserszegtomaj'),
('Csodabogyós-barlang', 5200.0, 121.0, 121.0, 0.0, 'Balatonederics'),
('Döme-barlang', 354.0, 109.4, 108.0, 1.4, 'Balatonederics'),
('Jakucs László-barlang', 154.0, 24.5, 24.5, 0.0, 'Balatonederics'),
('Szél-lik', 212.7, 40.0, 40.0, 0.0, 'Balatonederics'),
('Tapolcai-tavasbarlang', 3280.0, 22.0, 22.0, 0.0, 'Tapolca'),
('Tapolcai Kórház-barlang', 2280.0, 36.8, 34.8, 2.0, 'Tapolca'),
('Berger Károly-barlang', 1070.0, 14.7, 14.7, 0.0, 'Tapolca'),
('Gánti-barlang', 149.0, 14.6, 14.0, 0.6, 'Gánt'),
('Vértessomlói-barlang', 110.0, 36.0, 36.0, 0.0, 'Vértessomló'),
('Keselő-hegyi-barlang', 400.0, 115.0, 115.0, 0.0, 'Tatabánya'),
('Keselő-hegyi 11. sz. barlang', 183.5, 66.8, 66.8, 0.0, 'Tatabánya'),
('Keselő-hegyi 2. sz. barlang', 150.0, 57.0, 33.0, 24.0, 'Tatabánya'),
('Kálvária-hegyi 1. sz. barlang', 100.0, 10.0, 10.0, 0.0, 'Tatabánya'),
('Kálvária-hegyi 2. sz. barlang', 34.0, 4.2, 1.7, 2.5, 'Tatabánya'),
('Keselő-hegyi 4. sz. barlang', 68.8, 62.5, 35.5, 27.0, 'Tatabánya'),
('Keselő-hegyi 21. sz. barlang', 20.5, 8.0, 6.2, 1.8, 'Tatabánya'),
('Tűzköves-barlang', 47.3, 21.5, 21.5, 0.0, 'Süttő'),
('Jura-zsomboly', 137.8, 52.1, 52.1, 0.0, 'Süttő'),
('Legyes-barlang', 0.0, 33.2, 33.2, 0.0, 'Süttő'),
('Lengyel-barlang', 585.0, 70.0, 70.0, 0.0, 'Tatabánya'),
('Vértes László-barlang', 163.7, 58.5, 58.5, 0.0, 'Vértesszőlős'),
('Veres-hegyi-barlang', 182.5, 45.0, 45.0, 0.0, 'Tatabánya'),
('Tükör-forrási-barlang', 30.0, 24.0, 24.0, 0.0, 'Tata'),
('Angyal-forrási-barlang', 48.0, 10.0, 10.0, 0.0, 'Tata'),
('Kullancsos-barlang', 165.0, 41.5, 41.5, 0.0, 'Baj'),
('Megalodus-barlang', 261.0, 24.1, 20.5, 3.6, 'Tata'),
('Bartha-kútbarlang', 59.3, 20.3, 20.3, 0.0, 'Tata'),
('Gorba-tetői-barlang', 55.0, 26.5, 26.5, 0.0, 'Tardos'),
('Pisznice-barlang', 560.0, 20.0, 5.0, 15.0, 'Lábatlan'),
('Pisznicei Határ-barlang', 69.5, 12.6, 7.8, 4.8, 'Lábatlan'),
('Pisznicei-zsomboly', 37.5, 26.0, 26.0, 0.0, 'Lábatlan'),
('Lábatlani Sárkány-lyuk', 65.0, 20.0, 6.0, 14.0, 'Lábatlan'),
('Bajóti Büdös-lyuk', 50.3, 11.3, 11.3, 0.0, 'Bajót'),
('Öreg-kői 1. sz. zsomboly', 115.0, 34.0, 34.0, 0.0, 'Bajót'),
('Dorogi 9. sz. kaverna', 80.0, 0.0, 0.0, 0.0, 'Dorog'),
('Dorogi 10. sz. kaverna', 70.0, 0.0, 0.0, 0.0, 'Dorog'),
('Tokodi vízakna hasadékbarlangja', 0.0, 0.0, 0.0, 0.0, 'Tokod'),
('Babál-barlang', 128.7, 20.0, 10.0, 10.0, 'Sárisáp'),
('Bátori-barlang', 360.0, 56.0, 50.0, 6.0, 'Budapest'),
('Gellért-hegyi-aragonitbarlang', 25.0, 11.0, 0.0, 11.0, 'Budapest'),
('Ördögárok utcai-barlang', 45.1, 21.0, 21.0, 0.0, 'Budapest'),
('Rácskai-barlang', 100.0, 34.0, 31.0, 3.0, 'Budapest'),
('Budai Vár-barlang', 3300.0, 15.0, 15.0, 0.0, 'Budapest'),
('Pálvölgyi-Mátyáshegyi-barlangrendszer', 19000.0, 122.6, 94.9, 27.7, 'Budapest'),
('Szemlő-hegyi-barlang', 2201.0, 50.4, 11.1, 39.3, 'Budapest'),
('Látó-hegyi-barlang', 58.0, 21.0, 17.0, 4.0, 'Budapest'),
('Ferenc-hegyi-barlang', 6500.0, 85.0, 85.0, 0.0, 'Budapest'),
('Harcsaszájú-Hideglyuk-barlangrendszer', 7000.0, 93.0, 80.0, 13.0, 'Budapest'),
('Molnár János-barlang', 6000.0, 128.6, 98.6, 30.0, 'Budapest'),
('Bekey-barlang', 173.0, 39.6, 39.6, 0.0, 'Budapest'),
('József-hegyi-barlang', 5677.0, 105.8, 105.8, 0.0, 'Budapest'),
('József-hegyi 2-3. sz. barlang', 80.0, 40.0, 40.0, 0.0, 'Budapest'),
('Barit-barlang', 215.0, 20.8, 9.9, 10.9, 'Budapest'),
('Tábor-hegyi-barlang', 162.0, 21.9, 16.6, 5.3, 'Budapest'),
('Solymári-ördöglyuk', 5550.0, 78.0, 78.0, 0.0, 'Solymár'),
('Róka-hegyi-barlang', 87.0, 38.7, 38.7, 0.0, 'Üröm'),
('Amfiteátrum-barlang', 294.0, 76.0, 76.0, 0.0, 'Üröm'),
('Ürömi-víznyelőbarlang', 214.0, 28.4, 26.3, 2.1, 'Üröm'),
('Porhintő-barlang', 30.0, 20.0, 20.0, 0.0, 'Üröm'),
('Papp Ferenc-barlang', 400.0, 66.0, 66.0, 0.0, 'Pilisborosjenő'),
('Szabó József-barlang', 152.2, 18.3, 15.8, 2.5, 'Budakalász'),
('Pomázi kőfejtő Felső-barlangja', 300.0, 45.0, 45.0, 0.0, 'Pomáz'),
('Amazonok-barlangja', 141.0, 12.6, 12.6, 0.0, 'Pomáz'),
('Arany-lyuk', 92.0, 42.0, 42.0, 0.0, 'Budakalász'),
('Leány-Legény-Ariadne-barlangrendszer', 5050.0, 119.0, 58.0, 61.0, 'Pilisszentlélek'),
('Nagy-Somlyóhegyi-barlang', 90.0, 52.5, 50.5, 2.0, 'Pilisjászfalu'),
('Szent Özséb-barlang', 800.0, 82.0, 82.0, 0.0, 'Pilisszentkereszt'),
('Szopláki-ördöglyuk', 220.0, 37.6, 37.6, 0.0, 'Pilisszentkereszt'),
('Pilis-barlang', 470.0, 45.0, 6.0, 39.0, 'Pilisszentkereszt'),
('Ajándék-barlang', 500.0, 58.4, 57.2, 1.2, 'Pilisszentkereszt'),
('Sátorkőpusztai-barlang', 354.0, 61.4, 49.3, 12.1, 'Esztergom'),
('Strázsa-hegyi-barlang', 60.0, 25.0, 16.0, 9.0, 'Esztergom'),
('Kis-Strázsa-hegyi-hasadékbarlang', 80.0, 20.0, 20.0, 0.0, 'Esztergom'),
('Széchy Dénes-barlang', 50.0, 10.0, 2.0, 8.0, 'Esztergom'),
('Naszályi-víznyelőbarlang', 1900.0, 173.0, 173.0, 0.0, 'Vác'),
('Nincskegyelem-aknabarlang', 224.0, 71.0, 71.0, 0.0, 'Vác'),
('Násznép-barlang', 222.5, 19.7, 7.5, 12.2, 'Kosd'),
('Nézsai-víznyelőbarlang', 393.5, 55.7, 55.7, 0.0, 'Nézsa'),
('Csörgő-lyuk', 428.0, 29.6, 29.6, 0.0, 'Mátraszentimre'),
('Diabáz-barlang', 1000.0, 161.0, 161.0, 0.0, 'Miskolc'),
('Szalajka-forrásbarlang', 100.0, 20.0, 20.0, 0.0, 'Szilvásvárad'),
('Kis-kőháti-zsomboly', 479.0, 117.0, 117.0, 0.0, 'Nagyvisnyó'),
('Esztáz-kői-barlang', 160.0, 33.5, 18.0, 15.5, 'Felsőtárkány'),
('Gyurkó-lápai-barlang', 181.2, 45.0, 39.3, 5.7, 'Varbó'),
('Szamentu-barlang', 944.7, 42.0, 36.9, 5.1, 'Varbó'),
('Három-kúti-barlang', 89.0, 19.3, 4.7, 14.6, 'Miskolc'),
('Lilla-barlang', 225.0, 20.3, 19.1, 1.2, 'Parasznya'),
('Bronzika-barlang', 337.5, 27.2, 24.8, 2.4, 'Miskolc'),
('Kő-lyuk', 623.0, 30.6, 19.0, 11.6, 'Parasznya'),
('Hillebrand Jenő-barlang', 240.0, 24.1, 16.2, 7.9, 'Parasznya'),
('Szeleta-zsomboly', 645.0, 101.5, 101.5, 0.0, 'Miskolc'),
('Vénusz-barlang', 637.0, 37.6, 18.4, 19.2, 'Parasznya'),
('Szent István-barlang', 1445.0, 93.8, 16.8, 77.0, 'Miskolc'),
('Jáspis-barlang', 830.0, 193.0, 193.0, 0.0, 'Miskolc'),
('Garadna-forrásbarlang', 7.0, 4.5, 4.5, 0.0, 'Hámor'),
('Szirén-barlang', 700.0, 45.0, 42.0, 3.0, 'Miskolc'),
('Létrási-vizesbarlang', 3000.0, 67.8, 57.8, 10.0, 'Miskolc'),
('Szepesi-Láner-barlangrendszer', 2500.0, 159.3, 159.3, 0.0, 'Miskolc'),
('Bányász-barlang', 120.0, 89.0, 89.0, 0.0, 'Miskolc'),
('Bolhási-Jávorkúti-barlangrendszer', 5314.0, 132.0, 125.5, 6.5, 'Miskolc'),
('Speizi-barlang', 715.0, 101.0, 101.0, 0.0, 'Miskolc'),
('Borókás-tebri 4. sz. víznyelőbarlang', 550.0, 96.0, 96.0, 0.0, 'Miskolc'),
('István-lápai-barlang', 7300.0, 254.0, 254.0, 0.0, 'Miskolc'),
('Borókás-tebri 2. sz. víznyelőbarlang', 503.0, 95.0, 95.0, 0.0, 'Miskolc'),
('Fekete-barlang', 2200.0, 174.0, 174.0, 0.0, 'Miskolc'),
('Vesszős-gerinci-barlang', 221.4, 6.8, 6.8, 0.0, 'Miskolc'),
('Balekina-barlang', 600.0, 90.0, 90.0, 0.0, 'Miskolc'),
('Pénz-pataki-víznyelőbarlang', 1989.0, 155.5, 150.0, 5.5, 'Bükkszentkereszt'),
('Hajnóczy-barlang', 4257.0, 125.0, 81.3, 43.7, 'Cserépfalu'),
('Anna-barlang', 568.0, 14.0, 4.5, 9.5, 'Hámor'),
('Diósgyőrtapolcai-barlang', 87.8, 9.0, 3.8, 5.2, 'Miskolc'),
('Vár-tetői-barlang', 550.0, 101.8, 101.8, 0.0, 'Miskolc'),
('Tatár-árki-barlang', 156.0, 39.0, 35.0, 4.0, 'Miskolc'),
('Fecske-lyuk', 210.0, 26.9, 9.3, 17.6, 'Miskolc'),
('Nagykőmázsa-oldali-zsomboly', 90.0, 32.0, 32.0, 0.0, 'Miskolc'),
('Viktória-barlang', 723.4, 41.5, 41.5, 0.0, 'Miskolc'),
('Mexikó-völgyi-víznyelőbarlang', 414.0, 79.0, 79.0, 0.0, 'Miskolc'),
('Esztramosi Földvári Aladár-barlang', 190.0, 7.1, 7.1, 0.0, 'Bódvarákó'),
('Rákóczi 3. sz. barlang', 150.0, 34.0, 27.0, 7.0, 'Tornaszentandrás'),
('Rákóczi-oldaltáró-barlangja', 170.0, 29.2, 10.4, 18.8, 'Tornaszentandrás'),
('Rákóczi 1. sz. barlang', 650.0, 79.0, 61.0, 18.0, 'Tornaszentandrás'),
('Rákóczi 2. sz. barlang', 533.3, 53.0, 53.0, 0.0, 'Tornaszentandrás'),
('Esztramosi Felső-táró 2. sz. ürege', 46.0, 23.0, 0.0, 23.0, 'Tornaszentandrás'),
('Baradla-barlang', 20500.0, 112.0, 86.0, 26.0, 'Jósvafő'),
('Imolai-ördöglyuk', 53.3, 33.9, 30.0, 3.9, 'Imola'),
('Béke-barlang', 7183.0, 97.0, 71.0, 26.0, 'Aggtelek'),
('Teresztenyei-forrásbarlang', 80.0, 8.0, 0.0, 8.0, 'Teresztenye'),
('Szabadság-barlang', 3030.0, 48.5, 30.4, 18.1, 'Égerszög'),
('Danca-barlang', 1390.0, 30.0, 0.0, 30.0, 'Égerszög'),
('Baradla-tetői-zsomboly', 387.0, 87.0, 87.0, 0.0, 'Aggtelek'),
('Baradla Hosszú-Alsó-barlang', 127.0, 17.1, 10.8, 6.3, 'Jósvafő'),
('Kossuth-barlang', 1610.0, 60.0, 32.0, 28.0, 'Jósvafő'),
('Vass Imre-barlang', 2185.0, 56.6, 12.8, 43.8, 'Jósvafő'),
('Csapás-tetői-barlang', 33.0, 18.0, 18.0, 0.0, 'Szinpetri'),
('Rejtek-zsomboly', 450.0, 66.5, 66.5, 0.0, 'Szögliget'),
('Hosszú-tetői-barlang', 40.0, 8.0, 3.0, 5.0, 'Szögliget'),
('Magas-tetői-barlang', 168.5, 39.5, 34.1, 5.4, 'Szögliget'),
('Bába-völgyi 2. sz. víznyelő barlangja', 70.0, 22.0, 22.0, 0.0, 'Szögliget'),
('Frank-barlang', 182.2, 46.7, 46.7, 0.0, 'Bódvaszilas'),
('Csörgő-forrásbarlang', 120.0, 0.0, 0.0, 0.0, 'Szögliget'),
('Meteor-barlang', 1672.0, 127.0, 127.0, 0.0, 'Bódvaszilas'),
('Kopasz-vigasz-barlang', 220.0, 37.0, 37.0, 0.0, 'Bódvaszilas'),
('Almási-zsomboly', 358.0, 100.0, 100.0, 0.0, 'Bódvaszilas'),
('Szabó-pallagi-zsomboly', 1035.0, 151.0, 151.0, 0.0, 'Bódvaszilas'),
('Vecsembükki-zsomboly', 900.0, 236.0, 236.0, 0.0, 'Bódvaszilas'),
('Kopaszgally-oldali 2. sz. víznyelőbarlang', 450.0, 118.0, 118.0, 0.0, 'Bódvaszilas'),
('Széki-zsomboly', 120.0, 51.5, 51.5, 0.0, 'Bódvaszilas');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
