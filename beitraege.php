<?php
    $user = getUserName($blogId);
    $blogs = getEntries($blogId);
    if (isset($_GET['eid'])) $eid = $_GET['eid'];
    else $eid = $blogs[0]['eid'];
    //$userName = getUserName($_SESSION['userId']);

    if(isset($_POST['kommentar'])){
        addComment($eid, $userName, $_POST['kommentar']);
    }
    if(isset($_GET['kommentardelete'])){
        deleteComment($_GET['kommentardelete']);
    }
?>

    <h1 id="autor_blogs">Blogs von
        <?php echo $user; ?>
    </h1>
    <div id="blogs_ubersicht">
        <?php
            foreach($blogs as $blog){
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />';
                $content = str_replace($order, $replace, $blog['content']);
                $content = substr($content, 0, 100);
                //$date = date("Y-m-d H:i:s", $blog['datetime']);
                $date = date("d.m.Y / H:i", $blog['datetime']);
                //$eid = $blog['eid'];
                if($eid != $blog['eid']){
                    echo "<a href='index.php?function=beitraege&bid=$blogId&eid={$blog['eid']}'>
                    <div class='blogs_beschreibung'>
                    <h3>". $blog['title'] . "</h3>
                    <h4>". $date ."</h4>
                    <p>". $content ."...</p>
                    </div>
                    </a>";
                }else{
                    echo "<a href='index.php?function=beitraege&bid=$blogId&eid={$blog['eid']}'>
                    <div id='ausgewaelter_blog' class='blogs_beschreibung'>
                    <h3>". $blog['title'] . "</h3>
                    <h4>". $date ."</h4>
                    <p>". $content ."...</p>
                    </div>
                    </a>";
                }
                
            }
        ?>
    </div>
    <div id="blogs">
        <?php
        //$blogs = getEntries($blogId);
        //var_dump($blogs);
            $uid = 0;
            $blog = getEntry($eid);  
                $uid = $blog['uid'];
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />';
                $content = str_replace($order, $replace, $blog['content']);
                //$date = date("Y-m-d H:i:s", $blog['datetime']);
                $date = date("d.m.Y / H:i", $blog['datetime']);
                echo "<div class='blog'> 
                        <h2>". $blog['title'] . "</h2>
                        <h3>" . $date . "</h3>
                        <p>" . $content . "</p>
                    </div>";
            
        ?>
        <div id="kommentare">
            <?php 
            
                if($userName != ""){
                    echo "<form action='' method='post'>
                            <button id='senden' class='default_button' type='submit'>
                                <p id='senden_text'>Senden</p>
                            </button>
                            <textarea id='kommentar' rows='1' name='kommentar' placeholder='Kommentar hinzufügen'></textarea>
                        </form>";
                }
            
                $kommentare = getComments($eid);
                foreach($kommentare as $kommentar){
                    $order   = array("\r\n", "\n", "\r");
                    $replace = '<br />';
                    $content = str_replace($order, $replace, $kommentar['content']);
                    //$date = date("Y-m-d H:i:s", $blog['datetime']);
                    $date = date("d.m.Y / H:i", $kommentar['datetime']);
                    
                    echo "<div class='kommentar'>
                            <div class='kommentar_content'>
                                <h2 class='kommentar_name'>{$kommentar['name']}</h2>
                                <p class='kommentar_time'>$date</p>
                                <p class='kommentar_text'>$content</p>
                            </div>";
                    
                    if($kommentar['name'] == $userName  || (isset($_SESSION['userId']) && $_SESSION['userId'] == $uid)){
                        echo "<a href='index.php?function=beitraege&bid={$_GET['bid']}&eid=$eid&kommentardelete={$kommentar['cid']}'>
                                    <div class='default_button kommentar_edit'>
                                        <p class='kommentar_edit_text'>Löschen</p>
                                    </div>
                                </a>";
                    }
                    echo "</div>";
                    
                }
                
            ?>
        </div>
    </div>
