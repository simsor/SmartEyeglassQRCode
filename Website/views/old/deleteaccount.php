<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow">
                        <h2>Delete account</h2>
                        <form action="" method="POST">
                            <p>Are you sure you want to delete your account?</p>
                            <p>Enter your password</p>
                            <?php
                                if (isset($data['error'])) {
                                    echo $data['error'];
                                }
                            ?>
                            <input name="pwd1" placeholder="Password" type="password"/>
                            <br>
                            <p>Repeat your password</p>
                            <input name="pwd2" placeholder="Password" type="password"/>

                            <ul class="actions">
                                <li><input type="hidden" value="confirmdelete" name="confirmdelete" id="action"/></li>
                                <li><input type="submit" value="Delete account" name="Sign up" id="Sign up"/></li>
                                <li><a href='manageaccount' class='button'/>Cancel</a></li>
                            </ul>
                        </form>
                    </header>
                </div>
            </section>
        </div>
    </section>

<?php include("footer.html"); ?>