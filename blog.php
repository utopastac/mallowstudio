<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>

<div class = "wrapper mainWrapper">
    <section id = "blogPosts">

        <a class = "changeView" href="<?php echo get_page_link(351); ?>">
            View magazine layout
        </a>

        <?php
        
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query('posts_per_page=8'.'&paged='.$paged);
        while($wp_query->have_posts()) :
             $wp_query->the_post();
        ?>
        
        <div class = "blogPost stacked clearfix">
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
                <div class = "postEnd">
                    <a href="<?php comments_link(); ?>" class = "comments">
                        <?php comments_number( 'no comments', 'one comments', '% comments' ); ?>
                    </a>
                </div>
                
            </div>
            
        </div>

        <?php endwhile; ?>
        <div class = "nextPrev">
            <?php previous_posts_link('« Newer Entries', 0) ?>
            <?php next_posts_link('Older Entries »', 0); ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>