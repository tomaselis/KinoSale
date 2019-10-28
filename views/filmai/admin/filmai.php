<div class="wrapper">
<table>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Content</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php foreach ($this->posts as $post):?>
        <tr>
            <td><input name="post[]" type="checkbox" value="<?php echo $post->id ?>"></td>
            <td><?php echo $post->title ?></td>
            <td><?php echo $post->content ?></td>
            <td><img class="adminImg" src="<?php echo mediaUrl(getImage($post->img, 300, 200)) ?>"></td>
            <td>
                <a href="<?php echo url('post/edit', $post->id) ?>">EDIT</a>
                <a href="<?php echo url('post/delete', $post->id)?>">DELETE</a>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

</div>
