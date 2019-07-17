<?php get_header(); ?>

<!-- Index Template -->

<main>
    <div class="post-content">
        <?php get_template_part( 'loop' ); ?>
    </div>
</main>

<?php if( is_home() ) { ?>
    <section class="homepage-contact">
        <strong>Contact us:</strong> <a title="Send an email" href="mailto:mariangrudko@138inprogresspublishing.com">mariangrudko@138inprogresspublishing.com</a>
    </section>
<?php } ?>

<?php get_footer(); ?>