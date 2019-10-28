<!doctype html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <meta charset="utf-8">
    <title>Your Blog</title>
    <link rel="stylesheet" type="text/css" href="http://194.5.157.92/phpObjektinis/resources/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="http://194.5.157.92/phpObjektinis/resources/css/style.css">

</head>
<body>
<header class="sechead">
    <div class="hwrapper">
        <div class="logotipas">
            <img src="https://cdn.logojoy.com/wp-content/uploads/2018/05/30164225/572.png">
        </div>
        <nav>
            <a href="<?php echo url('post'); ?>">Home</a>
            <a href="<?php echo url('post'); ?>">Blog</a>
            <?php if ($this->user):?>
            <a href="<?php echo url('post/create'); ?>">Create Post</a>
            <a href="<?php echo url('account/logout'); ?>">Logout</a>
                <a href="<?php echo url('contact/contactForm'); ?>">Contact</a>
            <?php else: ?>
                <a href="<?php echo url('account/login'); ?>">Login</a>
            <a href="<?php echo url('account/registration'); ?>">Register</a>
            <a href="<?php echo url('contact/contactForm'); ?>">Contact</a>
            <?php endif; ?>
            <?php foreach ($this->categories as $category):?>
                <a href="<?php echo url('category/show', $category->id) ?>"><?php echo $category->name; ?></a>
            <?php endforeach; ?>
            <div class="left-side">
                <?php if ($this->user): ?>
                    Hello, <?php echo $this->user->name; ?>
            <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
