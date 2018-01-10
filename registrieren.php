<div id="login">
        <h2 id="login_titel">Registrieren</h2>
        <?php
                    
            if(isset($_POST['name'])){
                //$userExist = userExi
                if(!userExists($_POST['email'])){
                    if($_POST['passwort'] == $_POST['passwort2']){
                        $user = addUser($_POST['name'], $_POST['email'], md5($_POST['passwort']), 1);
                        echo "<p id='erfolgreich_registriert'>Sie haben sich erfolgreich Registriert!</p>";
                        echo "<p>Logen sie sich nun ein um Blogbeiträge zu erstellen.</p>";
                        echo "<a href='index.php?function=login'>
                                <button class='default_button' id='go_to_login_button'>Zum Login</button>
                            </a>";
                        //$_SESSION['userId']=$userid;
                        //header("Location: {$_SERVER['PHP_SELF']}?function=mein_blog");
                    }else{
                        echo "<p id='login_falsch'>Passwörter stimmen nicht überein!</p>";
                    }
                }else{
                    echo "<p id='login_falsch'>Email ist bereits vorhanden!</p>";
                }
                
            }
        ?>
            <form id="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']."?function=registrieren "; ?>">
                <label for="name">Name</label>
                <div class="login_div">
                    <input class="login_imput" type="text" id="name" name="name" placeholder="Vorname Nachname"  required value="" />
                </div>
                <label for="email">E-Mail Adresse</label>
                <div class="login_div">
                    <input class="login_imput" type="email" id="email" name="email" placeholder="E-Mail" required value="" />
                </div>
                <label for="passwort">Passwort</label>
                <div class="login_div">
                    <input class="login_imput" type="password" id="passwort" name="passwort" required placeholder="Passwort" value="" minlength="8"/>
                </div>
                <label for="passwort2">Passwort wiederholen</label>
                <div class="login_div">
                    <input class="login_imput" type="password" id="passwort2" name="passwort2" required placeholder="Passwort" value="" minlength="8"/>
                </div>
                <div>
                    <button id="login_button" type="submit">Registrieren</button>
                </div>
            </form>

    </div>