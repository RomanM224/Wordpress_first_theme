<article class="post">

<div class="entry-header cf">

    <h1><?php the_title(); ?></h1>

</div>

<div class="post-content">

    <p><?php
        the_post();
        the_content();
        do_action('my_action');
        ?></p>

</div>

</article> <!-- post end -->
