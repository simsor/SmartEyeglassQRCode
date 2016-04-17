<?php include('header.php'); ?>

<section id="one" class="wrapper style1">
    <div class="inner">
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major narrow ">
                    <h2>ERROR</h2>
                    <?php
                    foreach ($data as $msgerror) {
                        echo '<p>' . $msgerror . '</p>';
                    }
                    ?>

                </header>
                <ul class="actions">
                    <li><a href="" class="button big alt">Get me back Home!</a></li>
                </ul>
            </div>
        </section>

    </div>
</section>

<?php include("footer.html"); ?>

