<html lang="hu">

<head>
    <title>Űrlapok</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="urlap_1.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <form action="mailto:tesztelek@localhost.org" method="POST">
        <fieldset>
            <legend>Személyes adatok</legend>
            <div class="uralpmezo">
                <label for="vezeteknev">Vezetéknév:</label>
                <input type="text" id="vezeteknev" name="vezeteknev" value="" required />
            </div>
            <div class="uralpmezo">
                <label for="kerestnev">Keresztnévnév:</label>
                <input type="text" id="keresztnev" name="keresztnev" value="" readonly />
            </div>
            <div class="uralpmezo">
                <label for="szuladat">Szuletési idő</label>
                <input type="date" id="szuldat" name="szuldat" value="" />
            </div>

            <div class="uralpmezo">
                <label for="jelszo">Jelszó:</label>
                <input type="password" id="jelszo" name="jelszo" value="" />
            </div>

            <div class="uralpmezo">
                <label for="hajszin">Hajszíne: </label>
                <input type="color" id="hajszin" name="hajszin" value="" />
            </div>
        </fieldset>
        <fieldset>
            <legend>Egyéb adatok</legend>
            <div class="check">A gépjármű típusa:</div>

            <input type="checkbox" name="auto" id="auto" value="ON" checked="" />
            <label for="auto">Személygépkocsi</label>
            <input type="checkbox" name="motor" id="motor" value="ON" />
            <label for="motor">Motorkerékpár</label>
            <input type="checkbox" name="bicikli" id="bicikli" value="ON" />
            <label for="bicikli">Bicikli</label>
            <div class="uralpmezo">
                <label for="oneletrajz">Önéletrajz:</label>
                <textarea id="oneletrajz" name="oneletrajz" rows="5" cols="30">
                    </textarea>
            </div>
            <div class="radio">neme:</div>
            <div class="uralpmezo">
                <input type="radio" name="nem" id="ferfi" value="ffi" checked="" />
                <label for="ferfi">férfi</label>
            </div>
            <div class="uralpmezo">
                <input type="radio" name="nem" id="no" value="no" />
                <label for="no">nő</label>
            </div>
        </fieldset>
        <input type="submit" value="Adatok küldés" />
    </form>

</body>

</html>