<?php get_header(); ?>

<article id = "category" class = "wrapper mainWrapper">

	<section id = "blogPosts">

        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>             
        
        <div class = "blogPost clearfix">
        	<header class = "clearfix">
					<p class = "date"><?php echo get_the_date(); ?></p>
					<a href="<?php the_permalink() ?>" class = "postTitle"><?php the_title(); ?></a>
            </header>
            <div class = "blogContent">
				<?php the_excerpt(); ?>
            </div>
           
        </div>	
        <?php endwhile; endif; ?>
    </section>
    <?php get_sidebar(); ?>
	
</article>

<?php get_footer(); ?>