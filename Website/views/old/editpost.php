<?php include('header.php'); ?>

<section id="one" class="wrapper style1">
    <div class="inner">
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major narrow ">
                    <h1>Edit post</h1>
                    <form enctype="multipart/form-data" method="post" action="editpost">
                        <?php
                        if (isset($data['error'])) {
                            echo $data['error'] . '<br>';
                        }
                        echo '<p>Edit post Title:</p><input value="' . $post->getPostTitle() . '" name="post_title" type="text">
                            <p>Edit post Content:</p><textarea rows="20" name="post_content" >' . $post->getPostContent() . ' </textarea>
                            <p>Tags</p>
                            <textarea name="tags">';
                                foreach ($post->getTag() as $tag) {
                                    echo $tag->getName() . ' ';
                                }
                                echo '</textarea>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                            <div>';
                            if (isset($data['uploadfile'])) {
                                echo $data['uploadfile'] . '<br>';
                            }
                            echo 'Upload new Picture
                            <input name="imagepost" type="file" /></div>
                            <input type="hidden" value="' . $post->getPostId() . '" name="post_id" >
                            <input type="submit" value="edit" name="edit" >
                            <input type="submit" value="deletepost" name="edit" >
                        </form>
                        <div class="image-grid">';
                            foreach ($post->getImages() as $img) {
                                echo '<form   enctype="multipart/form-data" method="post" action="editpost">
                                    <div>
                                    <a target="_blank" class="image" href="' . $img->getFilePath() . '"><img src="' . $img->getFilePath() . '"></img></a>

                                    <input type="hidden" value="' . $post->getPostId() . '" name="post_id" >
                                    <input type="hidden" value="' . $img->getImgId() . '" name="img_id" >
                                    <input type="submit" value="deleteimg" name="edit">
                                  </div>
                                </form>';
                             }
?>
            </div>
        </section>

    </div>
</section>

<?php include("footer.html"); ?>

