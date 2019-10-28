<!doctype html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <meta charset="utf-8">
    <title>Your Blog</title>
    <link rel="stylesheet" type="text/css" href="http://194.5.157.92/phpObjektinis/resources/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="http://194.5.157.92/phpObjektinis/resources/css/style.css">
    <script src="http://194.5.157.92/phpObjektinis/resources/js/jquery.js"></script>
    <script src="http://194.5.157.92/phpObjektinis/resources/js/functions.js"></script>
</head>
<body>
<header class="sechead">
    <div class="hwrapper">
        <div class="logotipas">
            <img src="https://cdn.logojoy.com/wp-content/uploads/2018/05/30164225/572.png">
        </div>
        <nav>
            <a href="<?php echo url('post'); ?>">HOME</a>
            <a href="<?php echo url('admin/posts'); ?>">POSTS</a>
            <a href="<?php echo url('admin/categories'); ?>">CATEGORIES</a>
            <a href="<?php echo url('post/create');?>">CREATE POST</a>
        </nav>
    </div>
</header>

