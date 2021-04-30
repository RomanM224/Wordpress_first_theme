<article class="post">

    <div class="entry-header cf">

        <h1><?php the_title(); ?></h1>

    </div>

    <div class="post-thumb">
        <?php the_post_thumbnail('post_thumb'); ?>
    </div>
    <span class="categories">
        <a href="#">Design</a> /
        <a href="#">User Inferface</a> /
        <a href="#">Web Design</a>
    </span>
    <div class="post-content">

        <p><?php
            the_post();
            the_content();
            do_action('my_action');
            ?></p>

    </div>

</article> <!-- post end -->