<?php get_header(); ?>

<div class = "wrapper mainWrapper">

    <section id = "homeBlogContents" class = "homeRow">
		
        <h2>Tag: <span><?php single_tag_title(); ?></span></h2>

        <ul class = "clearfix">
        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <li>
                <a href = "<?php the_permalink(); ?>">
                    <?php $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                    <div class = "image" style = "background-image: url(<?php echo $thumbnail_url; ?>)"></div>
                </a>
                <div class = "marginContent">
                    <a href = "<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                        <h4 class = "date"><?php echo get_the_date(); ?></h4>
                    
                        <hr />
                        <?php the_excerpt(); ?>
                    </a>
                    
                </div>
            </li>   
        
        <?php endwhile; endif; ?>
        </ul>
    </section>
	
</div>

<?php get_footer(); ?>