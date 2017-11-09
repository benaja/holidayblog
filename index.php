<?php
  session_start();
  require_once("include/functions.php");
  require_once("include/functions_db.php");
  require_once("include/functions_db_plus.php");
  define("DBNAME", "db/blog.db");
  // Datenbankverbindung herstellen, diesen Teil nicht ändern!
  if (!file_exists(DBNAME)) exit("Die Datenbank 'blog.db' konnte nicht gefunden werden!");
  $db = new SQLite3(DBNAME);
  setValue("cfg_db", $db);
  // Einfacher Dispatcher: Aufruf der Funktionen via index.php?function=xy
  if (isset($_GET['function'])) $function = $_GET['function'];
  else $function = "login";
  // Prüfung, ob bereits ein Blog ausgewählt worden ist
  if (isset($_GET['bid'])) $blogId = $_GET['bid'];
  else $blogId = 0;
?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <script src="js/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <script src="include/functions.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <title>Blog-Projekt</title>
    </head>

    <body>
        <!-- 
  nav, div und ul class="..." ist Bootstrap, falls nicht gewünscht entfernen oder anpassen.
  Die Einteilung der Website in verschiedene Bereiche (Menü-, Content-Bereich, usw.) kann auch selber mit div realisiert werden.
-->
        <div id="header">
            <img src="images/icon.svg" id="logo">
            <h2 id="holiday">HolidayBlog</h2>
            <div id="nav">
                <ul id="nav_list">
                    <li><a href="<?php echo "index.php?function=login&bid=$blogId"?>">Login</a></li>
                    <li><a href="<?php echo "index.php?function=blogs&bid=$blogId"?>">Blog wählen</a></li>
                    <li><a href="<?php echo "index.php?function=entries_login&bid=$blogId"?>">Beiträge anzeigen</a></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <?php
                // Für jede Funktion, die mit ?function=xy in der URL übergeben wird, muss eine Datei (in diesem Fall xy.php) existieren.
                // Diese Datei wird aufgerufen, um den Content der Seite aufzubereiten und anzuzeigen.
                if (!file_exists("$function.php")) exit("Die Datei '$function.php' konnte nicht gefunden werden!");
                require_once("$function.php");
            ?>
        </div>
    </body>

    </html>
    <?php
  // Datenbankverbindung schliessen, diesen Teil nicht ändern!
  $db = getValue('cfg_db');
  $db->close();
?>
