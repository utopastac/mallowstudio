<?php get_header(); ?>

<article id = "single" class = "wrapper mainWrapper">

	<section id = "blogPosts">

        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <div class = "blogPost clearfix">
        	<header class = "clearfix">
            
                <?php 
					the_title('<h1>', '</h1>');
				?>
            </header>
            <div class = "blogContent">

                <div class = "postMeta">
                    <h4 class = "date"><?php echo get_the_date(); ?></h4>
                    <div class = "metaContent">
                        <h4>Categories</h4>
                        <?php echo get_the_category_list(""); ?>
                        <h4>Tags</h4>
                        <?php echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>'); ?>
                    </div>
                    <hr />
                </div>

				<div class = "blogMain">
                    <?php the_content(); ?>
                </div>
                
            </div>
            
            <?php comments_template(); ?>
            
        </div>	
        <div class = "nextPosts">

            <div class = 'post-link'>
                <?php
                $previous_post = get_previous_post();
                if (!empty( $previous_post )): ?>
                    <h4>Previous Post</h4>
                    <a href="<?php echo get_permalink( $previous_post->ID ); ?>">
                        <h3><?php echo $previous_post->post_title; ?></h3>
                        <p><?php echo $previous_post->post_excerpt; ?><p>
                    </a>
                <?php endif; ?>
            </div>

            <div class = 'post-link'>
                <?php
                $next_post = get_next_post();
                if (!empty( $next_post )): ?>
                    <h4>Next Post</h4>
                    <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                        <h3><?php echo $next_post->post_title; ?></h3>
                        <p><?php echo $next_post->post_excerpt; ?><p>
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <?php endwhile; endif; ?>
        
    </section>
	
</article>

<?php get_footer(); ?>