<?php get_header(); ?>

<article id = "single" class = "wrapper mainWrapper">

	<section id = "portfolio">

        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php $tempID = get_the_ID(); ?>         
        
        <div class = "clearfix homeRow">
        	<header>
                <?php the_title('<h2>', '</h2>'); ?>
            </header>
            <div class = "portfolioContent">
    			<?php the_content(); ?>
            </div>
        </div>
            
        </div>	
        <?php endwhile; endif; ?>
    </section>

    <ul id = "innerNav" class = "clearfix">
        <?php
        	$args = array(
				'post_type' => 'patterns',
				'posts_per_page' => 8
			);
            $posts = new WP_Query($args );
			
            //$posts->query($args);
            while($posts->have_posts()) :
                 $posts->the_post();
        ?>
        
        <li>
            <a <?php if($tempID == get_the_ID()) echo ' class = "current"'; ?> href = "<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </li>	
        <?php endwhile; ?>
    </ul>
	
</article>

<?php get_footer(); ?>