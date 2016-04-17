<?php

echo '<ul class="actions">
			<li><img src="' . $_SESSION['profilepic'] . '" height="100" width="auto" ></li>
			<li>Hello, ' . $_SESSION['displayname'] . '</li>
			<li>Account type: ' . $_SESSION['role'] . '</li>
		</ul>
        <form action="#" method="POST">
       		<a href="manageaccount">Manage my account</a>
         	<input class="button alt fit" type="hidden" value="logout" name="action" id="action"/>
            <input class="button alt fit" type="submit" value="logout" name="logout" id="logout" />
        </form>';
?>