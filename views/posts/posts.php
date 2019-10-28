<?php if (count($this->posts)): ?>

    <div class="post-wrapper">
        <h2>ALL POSTS</h2>
        <div class="post-row">

                <?php foreach ($this->posts as $post): ?>
            <div class="cellone">
                    <a href="<?php echo url('post/show/'); echo $post->id ?>">
                    <div class="cell">
                        <img src="<?php echo $post->img ?>">
                    </div>
                    <div class="text">
                        <h3><?php echo $post->title ?></h3>
                    </a>
                <?php if ($this->user):?>
                        <a href="<?php echo url('post/edit/'); echo $post->id ?>">EDIT</a>
                        <a href="<?php echo url('post/delete/'); echo $post->id ?>"
                        onClick="return confirm('Are you sure you want to delete this post: <?php $post->title ?>');">DELETE</a>
                <?php endif; ?>
            </div>
            </div>
                <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>

