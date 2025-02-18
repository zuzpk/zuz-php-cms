<div class="header-tall contact rel flex aic " style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">
    <div class="sec a flex col">

        <h1 class="s50 b900">Contact US</h1>
        <h1 class="s24">Questions? Suggestions? Please write us a line and we will get back to you as soon as possible!</h1>
    
    </div>

    <div class="sec b flex col rel">

        <?php echo Cover('rgba(220, 229, 231, .87)'); ?>

        <input type="text" class="input s16" name="name" placeholder="Name">
        <input type="text" class="input s16" name="email" placeholder="Enter email address">
        <input type="text" class="input s16" name="company" placeholder="Enter your company or website">
        <textarea name="desc" class="input s16"></textarea>
        <button class="button s16 send-cu">Send</button>
    
    </div>

</div>