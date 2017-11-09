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
        echo "<div><a href='index.php?function=blogs&bid=" . $user['uid'] . "' title='Blog auswählen'><h4>" . $user['name'] . "</h4></a></div>";
    }
?>
</div>
<div id="blogs">
    <?php
        $blogs = getEntries($blogId);
        //var_dump($blogs);
        
        foreach($blogs as $blog){
            $order   = array("\r\n", "\n", "\r");
            $replace = '<br />';
            $content = str_replace($order, $replace, $blog['content']);
            echo "<div class='blog'> 
                    <h2>". $blog['title'] . "</h2>
                    <p>" . $content . "</p>";
        }
    ?>
</div>
