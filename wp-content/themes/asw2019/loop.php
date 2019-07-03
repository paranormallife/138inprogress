<main class="posts <?php if( is_home() ) { echo 'home'; } ?>">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php $thumbnail = get_the_post_thumbnail_url(); ?>

<?php if( is_home() ) { ?>

    <article class="post home">
        <div class="thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" />
            </a>
        </div>
        <div class="title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
        </div>
        <div class="excerpt">
            <?php echo get_the_excerpt(); ?>
            <a class="readmore" title="Read More About <?php the_title(); ?>" href="<?php the_permalink(); ?>">Read More &rarr;</a>
        </div>
    </article>

<?php } else { ?>

    <article class="post single <?php if( $thumbnail != '' ) { echo 'has-thumbnail'; } ?>" id="<?php echo $post->ID; ?>">
        <?php if( $thumbnail != '' ) { ?>
            <div class="thumbnail">
                <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" />
            </div>
        <?php } ?>
        <div class="content">
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </div>
    </article>

<?php } ?>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</main>