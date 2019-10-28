


<div class="wrapperPost">
    <h2><?php echo $this->post->getTitle() ?></h2>

    <div class="single-post">
        <div>
            <img class="img-wrap" src="<?php echo mediaUrl(getImage($this->post->getImage(), 700, 400)) ?>">
        </div>
        <div>
            <?php echo $this->post->getContent() ?>
        </div>
    </div>
</div>