<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow">
                        <h2>Sign up</h2>
                        <form action="" method="POST">
                            <br>
                            <h4>Enter a user name</h4>
                            <?php
                            if (isset($data['username'])) {
                                if ($data['username'] == 'taken') echo '<p>This user name has already been taken.</p>';
                                if ($data['username'] == 'regexp') echo '<p>Please enter a valid email.</p>';
                            }
                            ?>
                            <input name="username" placeholder="User Name" type="email"/>
                            <br>
                            <h4>Enter a password</h4>
                            <?php
                            if (isset($data['password'])) {
                                if ($data['password'] == 'notidentical') echo '<p>The passwords you entered are not identical.</p>';
                                if ($data['password'] == 'regexp') echo '<p>Please enter a password that is between 6 and 20 characters.<br>
                                    There should be at least 1 of each of the following: uppercase letter, <br>lowercase letter, symbol(@#$%), number.</p>';
                            }
                            ?>
                            <input name="password" placeholder="Password" type="password"/>
                            <br>
                            <h4>Repeat your password</h4>
                            <input name="password2" placeholder="Confirmation" type="password"/>

                            <ul class="actions">
                                <li><input type="hidden" value="step1" name="signup" id="action"/></li>
                                <li><input class="button alt fit" type="submit" value="Next step" name="Sign up"
                                           id="Sign up"/></li>
                            </ul>
                        </form>
                    </header>
                </div>
            </section>
        </div>
    </section>

<?php include("footer.html"); ?>