<?php

    if(isset($_POST['title']) && isset($_GET['bid'])){
        updateEntry($_GET['bid'], $_POST['title'], $_POST['content']);
        header("location: index.php?function=mein_blog&bid={$_GET['bid']}");
    }


    $blog = getEntry($_GET['bid']);

?>

    <div id='edit'>
        <form action="" method="POSt">
            <h2 class='edit_titel'>Titel</h2>
            <input name="title" value='<?php echo $blog['title']; ?>' type="text" class='edit_input' required>
            <h2 class='edit_titel'>Text</h2>
            <textarea name='content' type="text" class='edit_input' required><?php echo $blog['content']; ?></textarea>
            <div class='edit_buttons'>
                <button type="submit" class="button">Speichern</button>
                <a href="index.php?function=mein_blog">
                    <div class="button"><p class="buttons_text">Abbrechen</p></div>
                </a>
            </div>
        </form>
    </div>
