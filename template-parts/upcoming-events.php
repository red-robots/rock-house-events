<?php  
$home_page_id = get_home_page_id();
$featured_event = get_field('featured_event',$home_page_id);
$max_post = 6;
$args = array(
	'posts_per_page'   => $max_post,
	'post_type'        => 'events',
	'post_status'      => 'publish',
	'meta_key'		=> 'start_date',
	'orderby'	=> 'meta_value_num',
	'order' => 'ASC',
	'meta_query' => array(
        array(
            'key' => 'event_status',
            'value' => 'active'
        ),
    )
);

if($featured_event) {
	$featured_event_id = $featured_event->ID;
	$args['post__not_in'] = array($featured_event_id);
}
$eventsPost = get_posts($args);
$events = new WP_Query($args); 
$total_events = ($eventsPost) ? count($eventsPost) : 0; 
$blank_items = 0;
if($total_events>0) {
	if($total_events<6) {
		$blank_items =  $max_post - $total_events;
	}
} else {
	$blank_items = $max_post;
}

$noImageURL = get_bloginfo('template_url').'/images/noimage.png';
?>
<div class="upcoming-events-list">
	<div class="flexrow clear">
	<?php if ( $events->have_posts() ) {  ?>
		<?php $j=1; while ( $events->have_posts() ) : $events->the_post();  
			$pid = get_the_ID();
			$pagelink = get_permalink($pid);
			$thumb_id = get_post_thumbnail_id($pid);
			$featImg = wp_get_attachment_image_src($thumb_id,'medium_large');
			$imageSrc = ($featImg) ? $featImg[0] : $noImageURL;
			$event_name = get_the_title($pid);
			$start_date = get_field('start_date',$pid);
			$short_description = get_field('event_short_description',$pid);
			?>
			<div id="eventinfo_<?php echo $j;?>" class="flexcol eventInfo">
				<div class="imagediv" style="background-image:url('<?php echo $imageSrc;?>');">
					<img class="feat-img" src="<?php echo $imageSrc;?>" alt="<?php echo $event_name ?>" />
					<a class="details <?php echo ($short_description) ? 'has-caption':'no-caption';?>" href="<?php echo $pagelink; ?>">
						<span class="eventtitle">
							<span class="txtwrap">
								<span class="event_name"><?php echo $event_name ?></span>
								<?php if ($start_date) { ?>
								<span class="start_date"><?php echo $start_date ?></span>
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
		<?php $j++; endwhile; wp_reset_postdata(); ?>
	<?php } ?>

	<?php if ($blank_items>0) { 
		$ctr = ($j>1) ? $j-1 : 0; ?>
		<?php for($i=1; $i<=$blank_items; $i++) { 
			$num = $ctr + $i; ?>
			<div id="eventinfo_<?php echo $num;?>" class="flexcol eventInfo comingsoon">
				<div class="imagediv" style="background-image:url('<?php echo $noImageURL;?>');">
					<img class="feat-img" src="<?php echo $noImageURL;?>" alt="" />
					<div class="details">
						<span class="eventtitle">
							<span class="txtwrap">
								<span class="event_name">Event coming soon</span>
							</span>
						</span>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	</div>
</div>
