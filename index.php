<?php get_header(); ?>


<div class = "wrapper mainWrapper">

    <section id = "homePortfolioContents" class = "homeRow">
        <h2>Latest Patterns</h2>
        <ul class = "clearfix">
            <?php
                $args = array(
                    'post_type' => 'patterns',
                    'posts_per_page' => 4
                );
                $posts = new WP_Query($args );
                
                //$posts->query($args);
                while($posts->have_posts()) :
                     $posts->the_post();
            ?>
            <li>
                <a href = "<?php the_permalink(); ?>">
                    <?php $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                    <div class = "image" style = "background-image: url(<?php echo $thumbnail_url; ?>)"></div>
                    <!--<div class = "image"><?php the_post_thumbnail(); ?></div>-->
                    <h3><?php the_title(); ?></h3>
                </a>
            </li> 
              
            <?php endwhile; ?>
        </ul>
    </section>

	<section id = "homeBlogContents" class = "homeRow">
    	<h2>Latest Blog Posts</h2>
        <ul class = "clearfix">
            <?php
            	$args = array(
					'posts_per_page' => 4
				);
                $posts = new WP_Query($args );
				
                //$posts->query($args);
                while($posts->have_posts()) :
                     $posts->the_post();
            ?>
            
            <li>
                <a href = "<?php the_permalink(); ?>">
                    <?php $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                    <div class = "image" style = "background-image: url(<?php echo $thumbnail_url; ?>)"></div>
                </a>
                <div class = "marginContent">
                	<a href = "<?php the_permalink(); ?>">
                    	<h3><?php the_title(); ?></h3>
                    </a>
                    <hr />
                	<?php the_excerpt(); ?>
                    <a href = "<?php the_permalink(); ?>" class = "read-more">Read More</a>
                </div>
            </li>	
            <?php endwhile; ?>
        </ul>
    </section>
    
</div>


<?php get_footer(); ?>