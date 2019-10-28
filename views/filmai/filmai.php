<?php if (count($this->posts)): ?>

    <div class="post-wrapper">
        <h2>Visu Filmu Parodymai</h2>
        <div class="post-row">

                <?php foreach ($this->films as $filmai): ?>
            <div class="cellone">
                    <a href="<?php echo url('post/show/'); echo $filmai->id ?>">
                    <div class="cell">
                        <img src="<?php echo mediaUrl(getImage($filmai->img, 350, 200)) ?>">
                    </div>
                    <div class="text">
                        <h3><?php echo $filmai->name ?></h3>
                    </a>

            </div>
            </div>
                <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>

