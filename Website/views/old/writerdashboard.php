<?php include('header.php'); ?>

    <section id="one" class="wrapper style1">
        <div class="inner">
            <section id="three" class="wrapper style3 special">
                <div class="inner">
                    <header class="major narrow ">
                        <h1>Author DashBoard</h1>
                        <h2><a href='addpost'>New post</a></h2>
                    </header>
                    <h2>My stories</h2>
                    <?php
                    if (isset($data['stories'])) {
                        $count = 0;
                        foreach ($data['stories'] as $value) {
                            echo '<div class="content container">
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
                                                <a name="button_more" type="submit" href="editpost/' . $value->getPostId() . '" class="button alt">Edit</a>
                                              </li>
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