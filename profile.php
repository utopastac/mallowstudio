<?php
/*
Template Name: Profile
*/
?>
<?php get_header(); ?>

<article id = "profile" class = "wrapper mainWrapper">

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
                    <?php dynamic_sidebar( 'about_sidebar_left' ); ?>
                    <hr />
                </div>

                <div class = "blogMain">
                    <?php the_content(); ?>
                </div>
                
            </div>
            
        </div>	
        <?php endwhile; endif; ?>
    </section>
	
</article>

<?php get_footer(); ?>