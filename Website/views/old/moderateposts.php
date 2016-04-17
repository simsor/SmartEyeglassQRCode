<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow ">
                        <h1>Moderate Posts</h1>
                    </header>
                    <h2>My stories</h2>
                    <?php
                    if (isset($data['stories'])) {
                        $count = 0;
                        foreach ($data['stories'] as $value) {
                            echo '
            <article class="feature">
            <div class="content container">
              <h2>' . $value->getPostTitle() . '</h2>
              <p>' . $value->getPostContent() . '</p>';
                            foreach ($value->getImages() as $img) {
                                echo '<span class="image"><a target="_blank" href="' . $img->getFilePath() . '"><img src="' . $img->getFilePath() . '"></img></a></span>';
                                if (null !== $img->getCoordinates()) {
                                    echo '<a target="_blank"  href="https://www.google.com/maps/place/' . $img->getCoordinates() . '">See on the map</a>';
                                }
                            }
                            echo '<ul class="actions">
              <li>
              <a name="button_more" type="submit" href="moderatepost/' . $value->getPostId() . '" class="button alt">Moderate</a>
              </li>
            </ul>
          </div>
        </article>';
                            $count++;
                        }
                    }
                    ?>

                </div>
            </section>

        </div>
    </section>

<?php include("footer.html"); ?>