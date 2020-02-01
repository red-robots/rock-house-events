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
		$start_date = get_field('start_date',$post_id);
		$end_date = get_field('end_date',$post_id);
		$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
		if($start_date){
			$date = DateTime::createFromFormat('m/d/Y', $start_date);
			$start_date = $date->format('m/d/y');
			$nthDay = date('w', strtotime($start_date));
			$start_dayofweek = $days[$nthDay];
		}
		if($end_date){
			$ee_date = DateTime::createFromFormat('m/d/Y', $end_date);
			$end_date = $ee_date->format('m/d/y');
			$enthDay = date('w', strtotime($end_date));
			$end_dayofweek = $days[$enthDay];
		}

		$startTime = get_field("event_start_time");
		$endTime = get_field("event_end_time");
		//echo $result    = date('Y-m-d', strtotime(($start_date - $dayofweek).' day', strtotime($start_date)));
		$time_info = array($startTime,$endTime);
		$eventTime = ( $time_info && array_filter($time_info) ) ?  implode(" &ndash; ", array_filter($time_info)) : '';

		?>
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="event-feat-image"><?php the_post_thumbnail('full'); ?></div>
		<?php } ?>
		<div class="entry-content event-information <?php echo ($featImg) ? 'half':'full';?>">
			<?php if ($start_date || $event_start_time) { ?>
			<div class="event-date-info">
				<?php if ($start_date) { ?>
					<span class="start"><?php echo $start_dayofweek . ', ' . $start_date ?></span>
					<?php if ($end_date) { ?><span class="sep"> &ndash; </span><span class="start"><?php echo $end_dayofweek . ', ' . $end_date ?></span><?php } ?>
				<?php } ?>
				
				<?php if ($eventTime) { ?>
					<div class="eventTime"><?php echo $eventTime ?></div>
				<?php } ?>

			</div>
			<?php } ?>
			<?php the_content(); ?>
		</div>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
