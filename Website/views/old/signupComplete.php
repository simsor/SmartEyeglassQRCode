<?php include('header.php'); ?>
    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow ">
                        <h2>Sign up complete!</h2>
                        <p>Now, please Log In</p>
                        <form action="" method="POST">
                            <input name="username" placeholder="Name"
                                   type="text" <?php echo 'value="' . $data['username'] . '"' ?> />
                            <input name="password" placeholder="Password" type="password"/>
                            <ul class="actions">
                                <li><input type="hidden" value="login" name="action" id="action"/></li>
                                <li><a href='home'><input type="submit" value="Log in" name="Log in" id="Log in"/></a>
                                </li>
                            </ul>
                        </form>
                    </header>
                </div>
            </section>
        </div>
    </section>

<?php include("footer.html"); ?>