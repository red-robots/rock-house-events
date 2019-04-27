<?php  
$max_post = 6;
$args = array(
	'posts_per_page'   => $max_post,
	'post_type'        => 'events',
	'post_status'      => 'publish',
	'meta_key'			=> 'start_date',
	'orderby'			=> 'meta_value',
	'order'				=> 'DESC',
	'meta_query' => array(
        array(
            'key' => 'event_status',
            'value' => 'active'
        ),
    )
);
$events = new WP_Query($args);
if ( $events->have_posts() ) {  ?>
<div class="upcoming-events-list">
	<div class="flexrow clear">
	<?php while ( $events->have_posts() ) : $events->the_post();  
		$pid = get_the_ID();
		$pagelink = get_permalink($pid);
		$thumb_id = get_post_thumbnail_id($pid);
		$featImg = wp_get_attachment_image_src($thumb_id,'medium_large');
		$noImageURL = get_bloginfo('template_url').'/images/noimage.png';
		$imageSrc = ($featImg) ? $featImg[0] : $noImageURL;
		$event_name = get_the_title($pid);
		$start_date = get_field('start_date',$pid);
		?>
		<div class="flexcol eventInfo">
			<div class="imagediv" style="background-image:url('<?php echo $imageSrc;?>');">
				<img class="feat-img" src="<?php echo $imageSrc;?>" alt="<?php echo $event_name ?>" />
				<a class="details" href="<?php echo $pagelink; ?>">
					<span class="eventtitle">
						<span class="txtwrap">
							<span class="event_name"><?php echo $event_name ?></span>
							<?php if ($start_date) { ?>
							<span class="start_date"><?php echo $start_date ?></span>
							<?php } ?>
						</span>
					</span>
					<span class="eventcaption">
					</span>
				</a>
			</div>
		</div>
	<?php endwhile; wp_reset_postdata(); ?>
	</div>
</div>
<?php } ?>