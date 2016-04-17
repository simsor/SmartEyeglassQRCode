<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">

        <div class="inner">
            <form action="search" method="POST">
                <div class="12u$">
                    <p>Search :</p>
                    <input class="" name='searchtags' placeholder="" type="text"/>
                    <p>Search type:</p>
                    <select name='searchtype'>
                        <option value="keyword">By Keyword</option>
                        <option value="author">By Author</option>
                        <option value="tag">By Tag</option>
                    </select>
                    <p>Order by:</p>
                     <select name='orderby'>
                        <option value="dateasc">Latest first</option>
                        <option value="datedes">Older first</option>
                        <option value="voteasc">Highest vote first</option>
                        <option value="votedec">Lowest vote first</option>
                    </select>
                    <br>
                    <input type="submit" value="searchpost" name="search" id="Search"/>
                </div>
            </form>
            <br>
            <h1> Search page</h1>
            <?php
            if (isset($data['data'])) {
                $count = 0;
                foreach ($data['data'] as $value) {
                    echo '<article class="feature">
                        <div class="content container">
                        <h2>' . $value->getPostTitle() . '</h2>
                        <p>Posted:' . $value->getDateTimePosted() . '</p>
                        <p>' . $value->getPostContent() . '</p>';

                    foreach ($value->getImages() as $img) {
                        echo '<span class="image"><a target="_blank" href="' . $img->getFilePath() . '"><img src="' .
                            $img->getFilePath() . '"></img></a></span>';
                        if (null !== $img->getCoordinates()) {
                            echo '<a target="_blank"  href="https://www.google.com/maps/place/' .
                                $img->getCoordinates() . '">See on the map</a>';
                        }
                    }

                    echo '<ul class="actions"><li><a name="button_more" type="submit" href="showadventure/' .
                        $value->getPostId() . '" class="button alt">More</a></li></ul></div></article>';
                    $count++;
                }
            }
            ?>
        </div>
    </section>

<?php include("footer.html"); ?>