<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>

<div class = "wrapper mainWrapper">
    <section id = "portfolio">
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
        <div class = "clearfix homeRow">
        	<header>
                <?php the_title('<h2>', '</h2>'); ?>
            </header>
            <div class = "portfolioContent">
    			<?php the_content(); ?>
            </div>
        </div>
        <?php //the_permalink()  get_the_ID() ?>
        <?php endwhile; ?>
    </section>
</div>

<?php get_footer(); ?>