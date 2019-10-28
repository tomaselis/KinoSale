<?php if (count($this->filmai)): ?>

    <div class="post-wrapper">
        <h2>Visu Filmu Parodymai</h2>
        <div class="post-row">

                <?php foreach ($this->filmai as $filmas): ?>
            <div class="cellone">
                    <a href="<?php echo url('film/show/'); echo $filmas->id ?>">
                    <div class="cell">
                        <img src="<?php echo mediaUrl(getImage($filmas->img, 350, 200)) ?>">
                    </div>
                    <div class="text">
                        <h3><?php echo $filmas->name ?></h3>
                    </a>

            </div>
            </div>
                <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

