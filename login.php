<?php
  $meldung = "";
  $email = "";
  $passwort = "";
  // $_SERVER['PHP_SELF'] = login.php in diesem Fall (also die PHP-Datei, die gerade ausgeführt wird).
  // Mit andern Worten: Nach Senden des Formulars wird wieder login.php aufgerufen.
  // Die Funktionen zur Überprüfung, ob die Login-Daten gültig sind, muss also hier oben im PHP-Teil stehen!
  // Wenn Login-Daten korrekt sind:
  // Session-Variable mit Benutzer-ID setzen und Wechsel in Memberbereich
  // $_SESSION['uid'] = $uid;	
  // header('Location: index.php?function=entries_member');
  // Wenn Formular gesendet worden ist, die Login-Daten aber nicht korrekt sind:
  // Unten auf der Seite Anzeige der Fehlermeldung.
?>
    <div id="login">
        <h2 id="login_titel">Login</h2>
        <form id="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']." ?function=login "; ?>">
            <label for="email">Benutzername</label>
            <div class="login_div">
                <input class="login_imput" type="email" id="email" name="email" placeholder="E-Mail" value="" />
            </div>
            <label for="passwort">Passwort</label>
            <div class="login_div">
                <input  class="login_imput" type="password" id="passwort" name="passwort" placeholder="Passwort" value="" />
            </div>
            <div>
                <button id="login_button" type="submit">Login</button>
            </div>
        </form>
    </div>
