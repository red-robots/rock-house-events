<?php
/**
 * Template Name: Events
 */

$home_page_id = get_home_page_id();
get_header(); ?>

<div id="primary" class="full-content-area clear">
	<main id="main" class="site-main wrapper" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( get_the_content() ) { ?>
				<div class="entry-content"><?php the_content(); ?></div>
			<?php } ?>
		<?php endwhile; ?>

		<div class="flexrow sectioncols clear">

			<?php
			$max_items = 6;
			$featured_event = get_field('featured_event',$home_page_id);  
			$feat_id = ($featured_event) ? $featured_event->ID:0;
			$events = get_upcoming_events_list($max_items,$feat_id);
			?>

			<?php if ($featured_event) { 
			$pid = $featured_event->ID;
			$pagelink = get_permalink($pid);
			$thumb_id = get_post_thumbnail_id($pid);
			$featImg = wp_get_attachment_image_src($thumb_id,'large'); ?>
			<div class="event-page-section featured-event-section flexcol">
				<div class="innerpad clear">
					<div class="titlediv"><h2>Featured Event</h2></div>
					<a class="imagewrap" href="<?php echo $pagelink ?>"><img src="<?php echo $featImg[0] ?>" alt="<?php echo $featured_event->post_title; ?>"></a>
				</div>
			</div>
			<?php } ?>

			<?php 
			$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
			//$eventList = get_all_events(6,$feat_id,$paged);
			$events_all = get_upcoming_events_list(-1, $feat_id);
			if($paged>1){
				$events = get_all_events($max_items,$feat_id,$paged);
			}

			$j=1;  if ( $events ) {  ?>
			<div id="upcoming_events_list" class="event-page-section upcoming-events-list flexcol">
				<div id="innerpad_content" class="innerpad clear">
					<div class="titlediv"><h2>Upcoming Events</h2></div>
					<div class="flexrow event-rows clear">
						<?php foreach($events as $row) { 
							$pid = $row->ID;
							$pagelink = get_permalink($pid);
							$thumb_id = get_post_thumbnail_id($pid);
							$featImg = wp_get_attachment_image_src($thumb_id,'medium_large');
							$imageSrc = ($featImg) ? $featImg[0] : $noImageURL;
							$event_name = get_the_title($pid);
							$start_date = get_field('start_date',$pid);
							$end_date = get_field('end_date',$pid);
							$short_description = get_field('event_short_description',$pid);
							$event_dates_arr = array($start_date,$end_date);
							$event_dates_arr = ($event_dates_arr && array_filter($event_dates_arr)) ? array_unique($event_dates_arr) : '';
							$event_dates = ($event_dates_arr) ? implode(" - ",array_filter($event_dates_arr)) : '';
							?>
							<div id="eventinfo_<?php echo $j;?>" class="flexcol eventInfo">
								<div class="imagediv" style="background-image:url('<?php echo $imageSrc;?>');">
									<img class="feat-img" src="<?php echo $imageSrc;?>" alt="<?php echo $event_name ?>" />
									<a class="details <?php echo ($short_description) ? 'has-caption':'no-caption';?>" href="<?php echo $pagelink; ?>">
										<span class="eventtitle">
											<span class="txtwrap">
												<span class="event_name"><?php echo $event_name ?></span>
												<?php if ($event_dates) { ?>
												<span class="start_date"><?php echo $event_dates ?></span>
												<?php } ?>
											</span>
										</span>
										<?php if ($short_description) { ?>
											<span class="eventcaption">
												<span class="txtpad">
													<strong class="titletxt"><?php echo $event_name ?></strong> - <?php echo $short_description ?>
												<span class="moretxt">more</span></span>
											</span>
										<?php } ?>
									</a>
								</div>
							</div>
						<?php $j++; } ?>
					</div>
					<div id="events_pagination" class="pagination">
						<?php
						if($events_all) {
							$limit = $max_items;
							$total = count($events_all);
			  				$page_num_items = ceil($total/$limit);
						    $pagination = array(
						        'base' => @add_query_arg('pg','%#%'),
						        'format' => '?paged=%#%',
						        'mid-size' => 1,
						        'current' => $paged,
						        'total' => $page_num_items,
						        'prev_next' => True,
						        'prev_text' => __( '<span class="fa fa-arrow-left"></span>' ),
						        'next_text' => __( '<span class="fa fa-arrow-right"></span>' )
						    );
						    echo paginate_links($pagination);
						}
						?>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>

		
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
