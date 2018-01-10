<h1 id="autoren">Wählen sie einen Blogger aus</h1>
<div id="benutuer">
    <?php
  // Alle Blogs bzw. Benutzernamen holen und falls Blog bereits ausgewählt, entsprechenden Namen markieren
  // Hier Code....

  // Schlaufe über alle Blogs bzw. Benutzer
  // Hier Code....

  // Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blogs und der Ausgabe mit PHP ersetzt werden
    $users = getUserNames();
    foreach($users as $user){
        //var_dump($user);
        //echo "<br>";
        if($user['uid']== $blogId){
            echo "<div id='selected' class='autoren'><a href='index.php?function=beitraege&bid=" . $user['uid'] . "' title='Blog auswählen'><h4>" . $user['name'] . "</h4></a></div>";
        }else{
            echo "<div class='autoren'><a href='index.php?function=beitraege&bid=" . $user['uid'] . "' title='Blog auswählen'><h4>" . $user['name'] . "</h4></a></div>";
        }
    }
?>
</div>

