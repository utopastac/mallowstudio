<?php
/*
Template Name: Magazine
*/
?>
<?php get_header(); ?>

<div class = "wrapper mainWrapper">
    <section id = "homeBlogContents" class = "homeRow">

        <a class = "changeView" href="<?php echo get_page_link(5); ?>">
            View stacked layout
        </a>

        <ul class = "clearfix">
            <?php
            
            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query();
            $wp_query->query('posts_per_page=8'.'&paged='.$paged);
            while($wp_query->have_posts()) :
                 $wp_query->the_post();
            ?>
            
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
            <?php endwhile; ?>
        </ul>
        <div class = "nextPrev">
                <?php previous_posts_link('« Newer Entries', 0) ?>
                <?php next_posts_link('Older Entries »', 0); ?>
            </div>
    </section>
</div>

<?php get_footer(); ?>