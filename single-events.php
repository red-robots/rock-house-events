<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); ?>
<div id="primary" class="full-content-area clear default-template event-detail-page">
	<main id="main" class="site-main wrapper clear" role="main">
	<?php while ( have_posts() ) : the_post(); 
		$post_id = get_the_ID();
		$post_thumbnail_id = get_post_thumbnail_id( $post_id );
		$featImg = wp_get_attachment_image_src($post_thumbnail_id,'full');
		?>
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="event-feat-image"><?php the_post_thumbnail('full'); ?></div>
		<?php } ?>
		<div class="entry-content event-information <?php echo ($featImg) ? 'half':'full';?>">
			<?php the_content(); ?>
		</div>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
