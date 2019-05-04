<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
$home_page_id = get_home_page_id();
get_header(); ?>
<div id="primary" class="full-content-area clear">
	<?php $post = get_post($home_page_id);
	if ( $post ) {  setup_postdata($post); ?>
		
		<div class="black-navigation clear">
			<div class="wrapper clear">
				<div class="flexrow clear">
					<div class="text-left flexcol"><span aria-label="true" class="eventSectionTitle">Featured Event</span></div>
					<div class="text-right flexcol"><span aria-label="true" class="eventSectionTitle">Upcoming Events</span></div>
				</div>
			</div>
		</div>

	<?php } ?>

	<?php  
		$featured_event = get_field('featured_event',$home_page_id);
	?>
	<div class="content-wrap-events clear">
		<div class="flexrow clear">
			<div class="flexcol featured-event js-blocks">
				<div class="blackdiv"><span aria-label="true" class="eventSectionTitle">Featured Event</span></div>
				<?php if ($featured_event) { 
					$pid = $featured_event->ID;
					$pagelink = get_permalink($pid);
					$thumb_id = get_post_thumbnail_id($pid);
					$featImg = wp_get_attachment_image_src($thumb_id,'large');
					if($featImg) { ?>
					<a class="imagewrap" href="<?php echo $pagelink ?>"><img src="<?php echo $featImg[0] ?>" alt="<?php echo $featured_event->post_title; ?>"></a>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="flexcol upcoming-events js-blocks">
				<div class="blackdiv"><span aria-label="true" class="eventSectionTitle">Upcoming Events</span></div>
				<?php get_template_part('template-parts/upcoming-events'); ?>
			</div>
		</div>
	</div>

</div><!-- #primary -->
<?php
get_footer();
