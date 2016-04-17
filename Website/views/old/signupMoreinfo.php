<?php include('header.php'); ?>
    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow ">
                        <h2>Sign up</h2>
                        <form enctype="multipart/form-data" action="" method="POST">
                            <div class="12u$(xsmall)">
                                <p>Enter your display name</p>
                                <input name="displayname" placeholder="User Name"
                                       type="text" <?php if (isset($data['displayname'])) {
                                    echo 'value="' . $data['displayname'] . '"';
                                } ?> />
                                <br>
                                <p>Upload a profile Picture</p>
                                <?php
                                if (isset($data['uploadfile'])) {
                                    echo $data['uploadfile'];
                                }
                                ?>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                                <input name="profilepic" type="file"/>
                            </div>
                            <ul class="actions">
                                <li><input type="hidden" value="step2" name="signup" id="action"/></li>
                                <li><input type="hidden" <?php echo 'value="' . $data['password'] . '"'; ?>
                                           name="password_hash" id="action"/></li>
                                <li><input type="hidden" <?php echo 'value="' . $data['username'] . '"'; ?>
                                           name="username" id="action"/></li>
                                <li><input class="button alt" type="submit" value="CREATE" name="Sign up" id="Sign up"/>
                                </li>
                                <li><a href="home" class="button alt">Cancel</a></li>
                            </ul>
                        </form>

                    </header>
                </div>
            </section>

        </div>
    </section>

<?php include("footer.html"); ?>