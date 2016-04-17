<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow">

                        <h1>Manage account</h1>

                        <form method="post" action="changedisplayname">
                            <p>Display Name</p> <?php if (isset($data["displayname"])) echo $data["displayname"]; ?>
                            <input type="text" name="displayname"/></p>
                            <p><input type="submit" value="changedisplayname" action="changedisplayname"></p>
                        </form>

                        <form method="post" action="changepassword">
                            <?php if (isset($data["password"])) echo $data["password"]; ?>
                            <p>Password <input type="password" name="pwd1"/></p>
                            <p>Password <input type="password" name="pwd2"/></p>
                            <p><input type="submit" value="Change Password" action="changepassword" name="changepassword">
                            </p>
                        </form>
                        <form method="post" action="deleteaccount">
                            <p><input type="submit" name="deleteaccount" value="deleteaccount"></p>
                        </form>
                        <form enctype="multipart/form-data" method="post" action="changeprofilepic">
                            <?php
                            echo '<img src="' . $_SESSION['profilepic'] . '" height="100" width="auto" >';
                            if (isset($data['uploadfile'])) {
                                echo $data['uploadfile'];
                            }
                            ?>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                            <p><input name="picturefile" type="file"/></p>
                            <p><input type="submit" name="changeprofilepic" value="Change Profile Picture"></p>
                        </form>
                    </header>
                </div>
            </section>
        </div>
    </section>

<?php include("footer.html"); ?>