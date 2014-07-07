<?php get_header(); ?>

<article id = "search" class = "wrapper mainWrapper">

	<section id = "blogPosts">

        
		<?php if ( have_posts() ) : ?>
 
                <header class="page-header">
                    <h1><?php echo 'Search Results for: <span>' . get_search_query() . '</span>'; ?></h1>
                </header><!-- .page-header -->
 
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
 				<div class = "postMeta">
                    <h4 class = "date"><?php echo get_the_date(); ?></h4>
                    <div class = "metaContent">
                    	<h4>Categories</h4>
                		<?php echo get_the_category_list(""); ?>
                    </div>
                    <hr />
                </div>
                
                <div class = "blogPost clearfix">
        			<header class = "clearfix">
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