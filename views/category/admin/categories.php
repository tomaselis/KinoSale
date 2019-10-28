<div class="wrapper" id="table">
    <table>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
        </tr>
        <?php foreach($this->categories as $category):;?>
            <tr>
                <td><input name="category[]" type="checkbox" value="<?php echo $category->id;?>"></td>
                <td><?php echo $category->id ?></td>
                <td><?php echo $category->name ?></td>
                <td><?php echo $category->description ?></td>
                <td><?php echo $category->slug ?></td>
                <td><a href="<?php echo url('admin/edit/'); echo $category->id ?>")>
                    EDIT</a></td>
                <td><a href="<?php echo url('admin/delete/'); echo $category->id ?>"
                       onClick="return confirm('Are you sure you want to delete blog post: <?php echo $category->name ?>');"
                       class="btn">DELETE!</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>