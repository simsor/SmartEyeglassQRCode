<?php include('header.php'); ?>

<section id="one" class="wrapper style1">
    <div class="inner">
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major narrow ">
                    <?php
                    echo '<p>Posted:' . $post->getDateTimePosted() . '</p>';
                    if($post->getDateTimePosted()!=$post->getDateLastEdit()){
                        echo '<p>Edited:' . $post->getDateLastEdit() . '</p>';                        
                    }
                    echo '<p>By:<a href=search/author/' . $post->getUsername() . '>' . $post->getUsername() . '</a></p>';
                    echo '<h1>' . $post->getPostTitle() . '</h1>';
                    echo '<p>' . $post->getPostContent() . '</p>';
                    echo '<p>Tags<p>
                     <p>';
                    foreach ($post->getTag() as $tag) {
                        echo '<a href="search/tag/' . $tag->getName() . '"">'. $tag->getName() .'</a> ';
                    }
                    echo '</p><div class="image-grid">';
                    foreach ($post->getImages() as $img) {
                        echo '<a target="_blank" class="image" href="' . $img->getFilePath() . '"><img src="' . $img->getFilePath() . '"></img></a>';
                    }
                    echo '</div>';
                    if ($post->getVotes() != NULL) {
                        echo '<P>';
                        foreach ($post->getVotes() as $vote) {
                            echo $vote->getUser()->getDisplayname() . ' ';
                        }
                        echo 'voted for this adventure!</p>';
                        echo 'Total: '.count($post->getVotes()).' votes.</p>';
                    }

                    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'unregisteredUser';
                    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknownuser';
                    $active = isset($_SESSION['active']) ? $_SESSION['active'] : (bool)false;

                    if ($active && ( $role == "reader" || ($role == "author" && $post->getUsername() != $username))) {
                        echo '
                        <form action="" method="POST">
                            <input type="hidden" value="votepost" name="action" id="action"/>
                            <input type="hidden" name="id_adv" value="' . $post->getPostId() . '" id="action"/>
                            <input type="hidden" name="username" value="' . $_SESSION['username'] . '" id="action"/>
                            <input type="submit" value="Vote for this story" name="vote" id="vote" />
                        </form>';///vote
                    }
                    if ($post->getComments() != NULL) {
                               echo '<table class="alt">';
                        foreach ($post->getComments() as $comment) {
                            echo '
                              <tr>
                              <td><span class="image"><img src="'. $comment->getUser()->getProfilePic() .'" height="100" width="auto" ></span></td>
                              <td>
                              <form action="" method="POST">
                                <p>Comment posted by:' . $comment->getUser()->getDisplayname() . '</p><textarea name="comment_content" ';
                            if (!($active && $comment->getUser()->getUsername() == $username)) echo 'readonly';
                            echo '>' .

                                $comment->getMessage() . '</textarea><p>' . $comment->getDateTimePosted() . '</p>'; //

                            if ($comment->getVotes() != NULL) {
                                echo '<P>';
                                foreach ($comment->getVotes() as $vote) {
                                    echo $comment->getUser()->getDisplayname() . ' ';
                                }
                                echo 'like this comment!</p>';
                                echo 'Total: '.count($comment->getVotes()).' votes.</p>';
                            }

                            if ($active && $role == 'reader' && $comment->getUser()->getUsername() == $username) {
                                echo '<input type="hidden" value="editcomment"  name="action"/>
                                    <input type="hidden" name="id_comment" value="' . $comment->getCommentId() . '" />
                                    <input type="submit" value="Edit this comment" name="edit" />
                                  </form>
                                  <form action="" method="POST">
                                      <input type="hidden" value="deletecomment"  name="action"/>
                                      <input type="hidden" name="id_comment" value="' . $comment->getCommentId() . '" />
                                      <input type="submit" value="Delete this comment" name="delete" />
                                  </form>';
                            }
                            if ($active && ( $role == "reader" || ($role == "author" && $comment->getUser()->getUsername() != $username))) {
                                echo '
                                <form action="votecomment" method="POST">
                                    <input type="hidden" name="id_comment" value="' . $comment->getCommentId() . '" />
                            <input type="hidden" name="post_id" value="' . $post->getPostId() . '" id="action"/>
                                    <input type="hidden" name="username" value="' . $_SESSION['username'] . '" />
                                    <input type="submit" value="Vote for this comment" name="vote" id="vote" />
                                </form>';///vote
                            }
                            echo '
                                  </td>
                                  </tr>';
                        }
                        echo "</table>";
                    }
                    if ($active && $role == "reader") {
                        echo '<form action="" method="POST">
                          <p>Type a comment</p>';
                        if (isset($data["comment"])) echo $data["comment"];
                        echo '
                            <textarea name="comment_content" > </textarea>
                            <input type="hidden" value="commentpost" name="action" id="action"/>
                            <input type="hidden" value="commentpost" name="commentpost" id="action"/>
                            <input type="hidden" name="id_adv" value="' . $post->getPostId() . '" id="action"/>
                            <input type="hidden" name="username" value="' . $_SESSION['username'] . '" id="action"/>
                            <input type="submit" value="Comment this story" name="Comment" id="vote" />
                        </form>';
                    }
                    ?>
                    </header>
            </div>
        </section>
    </div>
</section>

<?php include("footer.html"); ?>

