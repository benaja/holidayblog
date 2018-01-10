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
  else $blogId = 1;

    if(isset($_GET['logout']) && $_GET['logout'] == true){
        session_destroy();
        header("Location: {$_SERVER['PHP_SELF']}?functin=login");
    }
?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <script src="include/functions.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <title>Blog-Projekt</title>
        <script src="js/sweetalert.js"></script>
        <link rel="icon" href="images/icon.svg">
    </head>

    <body>
        <!-- 
  nav, div und ul class="..." ist Bootstrap, falls nicht gewünscht entfernen oder anpassen.
  Die Einteilung der Website in verschiedene Bereiche (Menü-, Content-Bereich, usw.) kann auch selber mit div realisiert werden.
-->
        <div id="header">
            <img src="images/icon.svg" id="logo">
            <h2 id="holiday">HolidayBlog</h2>
            <?php
                $userName = "";
                if(isset($_SESSION['userId']) && $_SESSION['userId'] > 0){
                    $userName = getUserName($_SESSION['userId']);
                    echo "<a href='{$_SERVER['PHP_SELF']}?logout=true'>
                            <div id='user'>
                                <img src='images/profile.png' id='profile'>
                                <p id='user_name'>$userName</p>
                            </div>
                        </a>";
                }else{
                    
                }
            ?>
            <div id="nav">
                <ul id="nav_list">
                    <?php
                        if(isset($_SESSION['userId']) && $_SESSION['userId'] > 0){
                            echo "<li><a href='index.php?function=mein_blog&bid=$blogId'>Mein Blog</a></li>";
                            echo "<li><a href='index.php?function=blogs&bid=$blogId'>Andere Blogs</a></li>";
                        }else{
                            echo "<li><a href='index.php?function=login&bid=$blogId'>Login</a></li>";
                            echo "<li><a href='index.php?function=blogs&bid=$blogId'>Blog wählen</a></li>";
                        }
                    ?>
                    <li><a href="<?php echo "index.php?function=beitraege&bid=$blogId"?>">Beiträge anzeigen</a></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <?php
                // Für jede Funktion, die mit ?function=xy in der URL übergeben wird, muss eine Datei (in diesem Fall xy.php) existieren.
                // Diese Datei wird aufgerufen, um den Content der Seite aufzubereiten und anzuzeigen.
                if($function == "mein_blog"){
                    if(!isset($_SESSION['userId'])){
                        $function = "login";
                    }else if($_SESSION['userId'] == 0){
                        $function = "login";
                    }
                }
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
