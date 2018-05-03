<?php
    if(isset($_GET['delete']) && $_GET['bid']){
        deleteEntry($_GET['bid']);
        header('location: index.php?function=mein_blog&bid=1');
    }


    $blogs = getEntries($_SESSION['userId']);
        
    if (isset($_GET['eid'])) $eid = $_GET['eid'];
    else if(isset($blogs[0]['eid'])) $eid = $blogs[0]['eid'];
    else $eid = 0;
    
    if(isset($_GET['kommentardelete'])){
        deleteComment($_GET['kommentardelete']);
    }
    
?>
    <h1 id="welcome">Ihre Blogbeiträge</h1>

    <div id="beitraege">




        <div id="blogs_ubersicht">
            <a href="index.php?function=new">
                <div class="button" id="neuer_blog">
                    <p class="buttons_text">Neuer Blog</p>
                </div>
            </a>
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
                    echo "<a href='index.php?function=mein_blog&eid={$blog['eid']}'>
                    <div class='blogs_beschreibung'>
                    <h3>". $blog['title'] . "</h3>
                    <h4>". $date ."</h4>
                    <p>". $content ."...</p>
                    </div>
                    </a>";
                }else{
                    echo "<a href='index.php?function=mein_blog&eid={$blog['eid']}'>
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
            if($eid != 0){
                $blog = getEntry($eid);
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />';
                $content = str_replace($order, $replace, $blog['content']);
                //$date = date("Y-m-d H:i:s", $blog['datetime']);
                $date = date("d.m.Y / H:i", $blog['datetime']);
                echo "<div class='blog'> 
                        <div id='blog_header'>
                            <h2>". $blog['title'] . "</h2>
                            <h3>" . $date . "</h3>
                        </div>
                        <div class='edit_delete'>
                            <a href='index.php?function=edit&bid={$blog['eid']}'>
                            <div class='button'>
                                <p class='buttons_text'>Bearbeiten</p>
                            </div>
                            <a href='index.php?function=mein_blog&bid={$blog['eid']}&delete=true'>
                                <div class='button'>
                                    <p class='buttons_text'>Löschen</p>
                                </div>
                            </a>
                        </div>
                        <p id='blog_content'>" . $content . "</p>
                    </div>";

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


                        echo "<a href='index.php?function=mein_blog&&eid=$eid&kommentardelete={$kommentar['cid']}'>
                                    <div class='default_button kommentar_edit'>
                                        <p class='kommentar_edit_text'>Löschen</p>
                                    </div>
                                </a>";

                    echo "</div>";

                }
        
            }
    
    //if(isset($_GET['delete'])
    ?>
        </div>
    </div>
