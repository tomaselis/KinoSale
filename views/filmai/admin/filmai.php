<div class="wrapper">
<table>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Content</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php foreach ($this->filmai as $filmas):?>
        <tr>
            <td><input name="post[]" type="checkbox" value="<?php echo $filmai->id ?>"></td>
            <td><?php echo $filmas->name ?></td>
            <td><?php echo $filmas->amziausgrupe ?></td>
            <td><img class="adminImg" src="<?php echo mediaUrl(getImage($filmai->img, 300, 200)) ?>"></td>
            <td>
                <a href="<?php echo url('filmas/edit', $filmai->id) ?>">EDIT</a>
                <a href="<?php echo url('filmas/delete', $filmai->id)?>">DELETE</a>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

</div>
