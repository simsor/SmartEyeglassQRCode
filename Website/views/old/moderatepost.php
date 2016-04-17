<?php include('header.php'); ?>

<section id="one" class="wrapper style1">
    <div class="inner">
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major narrow ">
                    <h1>Edit post</h1>
                    <form enctype="multipart/form-data" method="post" action="moderatepost">
                        <?php
                        if (isset($data['error'])) {
                            echo $data['error'] . '<br>';
                        }
                        echo '
           <p>Post Title:</p><p>' . $post->getPostTitle() . '</p>
           <p>Post Content:</p><p>' . $post->getPostContent() . ' </p>
           <p>Tags</p>
           <p>';
                        foreach ($post->getTag() as $tag) {
                            echo $tag->getName() . ' ';
                        }
                        echo '</p>
           <input type="hidden" value="' . $post->getPostId() . '" name="post_id" >
           <input type="submit" value="deletepost" name="moderatepost" >         

         </form>
         <div class="image-grid">';
                        foreach ($post->getImages() as $img) {
                            echo '
             <form   enctype="multipart/form-data" method="post" action="moderatepost">
              <div>
                <a target="_blank" class="image" href="' . $img->getFilePath() . '"><img src="' . $img->getFilePath() . '"/></a>

                 <input type="hidden" value="' . $post->getPostId() . '" name="post_id" >
                <input type="hidden" value="' . $img->getImgId() . '" name="img_id" >
                <input type="submit" value="deleteimg" name="moderatepost" >

              </div>
            </form>';
                        }
                        if ($post->getComments() != NULL) {
                        foreach ($post->getComments() as $comment) {
                            echo '
                              <div>
                                <p>Comment posted by:' . $comment->getUser()->getDisplayname() . '</p><textarea name="comment_content" readonly >' .

                                $comment->getMessage() . '</textarea><p>' . $comment->getDateTimePosted() . '</p>'; //

                                echo '
                                  <form action="moderatepost" method="POST">
                                      <input type="hidden" value="deletecomment"  name="moderatepost"/>
                                      
                 <input type="hidden" value="' . $post->getPostId() . '" name="post_id" >
                                      <input type="hidden" name="id_comment" value="' . $comment->getCommentId() . '" />
                                      <input type="submit" value="Delete this comment" name="delete" />
                                  </form>';
                            
                        }
                    }
                        ?>

            </div>
        </section>

    </div>
</section>

<?php include("footer.html"); ?>

