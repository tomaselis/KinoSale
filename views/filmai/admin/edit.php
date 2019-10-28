
<!--<form method="post" action="http://194.5.157.92/phpObjektinis/index.php/post/update">-->
<!--    <div class="container">-->
<!--        <h1>Your Blog</h1>-->
<!--        <p>Please write your blog bellow</p>-->
<!--        <input type="text" placeholder="Enter Title" name="title" value="--><?php // echo $this->post->getTitle()?><!--">-->
<!--        <textarea rows="10" cols="50" name="content" placeholder="Please write your main text in this window.">-->
<!--            --><?php // echo $this->post->getContent()?><!--">-->
<!--        </textarea>-->
<!--        <input type="text" placeholder="please enter your image link" name="img" value="--><?php // echo $this->post->getImage()?><!--">-->
<!---->
<!--        <input type="hidden" name="id" value="--><?php // echo $this->post->getId()?><!--">-->
<!---->
<!--        <div>-->
<!--            <button type="submit" class="signupbtn">Submit Blog</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->


<h2 class="headings">EDIT THIS POST</h2>
<div class="msg-block"></div>
<?php
echo $this->form; ?>

