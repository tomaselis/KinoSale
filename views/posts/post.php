


<div class="post-columSingle">
    <h2><?php echo $this->post->getTitle() ?></h2>

    <div class="single-post">
        <div>
            <img class="img-wrap" src="<?php echo $this->post->getImage() ?>">
        </div>
        <div>
            <?php echo $this->post->getContent() ?>
        </div>
    </div>
</div>