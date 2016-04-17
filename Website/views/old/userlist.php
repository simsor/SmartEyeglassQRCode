<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow ">
                        <h1>User moderation</h1>
                    </header>
                    <h2>All Users</h2>
                    <?php
                    if (isset($data['users'])) {
                        $count = 0;
                        foreach ($data['users'] as $value) {
                            echo '
            <div class="content">
              <h2>' . $value->getDisplayName() . '</h2>
              <p>' . $value->getUsername() . '</p>
              <p>' . $value->getRole() . '</p>
              <img src="' . $value->getProfilePic() . '" height="100" width="auto" >
              <form method="post" action="moderateuser">
              <input type="hidden" name="username"value="' . $value->getUsername() . '">
              <button type="submit" name="moderateuser" value="banuser">Ban user</button>
              <button type="submit" name="moderateuser" value="';
              if(!$value->isActive()) echo 'activateuser">Activate User';
              else echo 'desactivateuser">Freeze user';
              echo '</button>
                         

             </form>


           </ul>
         </div>';
                            $count++;
                        }
                    }
                    ?>

                </div>
            </section>

        </div>
    </section>

<?php include("footer.html"); ?>