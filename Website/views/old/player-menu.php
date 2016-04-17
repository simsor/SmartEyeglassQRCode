<?php echo '<img src="' . $_SESSION['profilepic'] . '" height="100" width="auto" >
					<br>Hello ' . $_SESSION['displayname'] .
    '<br>Account type: ' . $_SESSION['role'] . '
                    <form action="#" method="POST">
                        <ul class="actions">
                            <li><a href="manageaccount">Manage my account</a></li>
                            <li><a href="dashboard">Author dashboard</a></li>
                            <li><input type="hidden" value="logout" name="action" id="action"/></li>
                            <li><input type="submit" value="logout" name="logout" id="logout" /></li>
                        </ul>
                    </form>';
?>