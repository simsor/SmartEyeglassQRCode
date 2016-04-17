<?php include('header.php'); ?>

<section id="one" class="wrapper style1">
    <div class="inner">
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major narrow ">
                <h1>All tags</h1>
                <p>
                    <?php

                    foreach ($data['tags'] as $tag) {
                        echo '<a href="search/tag/' . $tag->getName() . '"">'. $tag->getName() .'</a> ';
                    }

                    ?>
                    </p>
                    </header>
            </div>
        </section>
    </div>
</section>

<?php include("footer.html"); ?>

