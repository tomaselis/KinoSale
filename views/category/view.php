<h1 class="headings"><?php echo $this->categoryName; ?></h1>

<div class="post-wrapper">
    <div class="post-row">

        <?php foreach ($this->posts as $post): ?>
            <div class="cellone">
                <a href="<?php echo url('post/show/');
                echo $post->getId() ?>">
                    <div class="cell">
                        <img src="<?php echo mediaUrl(getImage($post->getImage(), 350, 200)) ?>">
                    </div>
                    <div class="text">
                        <h3><?php echo $post->getTitle() ?></h3>
                </a>
                <?php if ($this->user):?>
                    <a href="<?php echo url('admin/category/edit/'); echo $post->getId() ?>">EDIT</a>
                    <a href="<?php echo url('post/delete/'); echo $post->getId() ?>"
                       onClick="return confirm('Are you sure you want to delete this post: <?php $post->getTitle() ?>');">DELETE</a>
                <?php endif; ?>
            </div>
    </div>
    <?php endforeach;; ?>

</div>

