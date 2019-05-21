<?php  
$home_page_id = get_home_page_id();
$featured_event = get_field('featured_event',$home_page_id);
$max_post = 6;
$feat_id = ($featured_event) ? $featured_event->ID:0;
$events = get_upcoming_events_list($max_post,$feat_id);
$total_events = ($events) ? count($events) : 0; 
$blank_items = 0;
if($total_events>0) {
	if($total_events<6) {
		$blank_items =  $max_post - $total_events;
	}
} else {
	$blank_items = $max_post;
}

$noImageURL = get_bloginfo('template_url').'/images/noimage.png';
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
?>
<div class="upcoming-events-list">
	<?php if ( $events ) {  ?>
		<?php $j=1; foreach($events as $row) { 
			$pid = $row->ID;
			$pagelink = get_permalink($pid);
			$thumb_id = get_post_thumbnail_id($pid);
			$featImg = wp_get_attachment_image_src($thumb_id,'medium_large');
			$imageSrc = ($featImg) ? $featImg[0] : $noImageURL;
			$event_name = get_the_title($pid);
			$start_date = get_field('start_date',$pid);
			$end_date = get_field('end_date',$pid);
			$start_dayofweek = '';
			$end_dayofweek = '';
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
			$short_description = get_field('event_short_description',$pid);
			$event_dates_arr = array($start_date,$end_date);
			$event_dates_arr = ($event_dates_arr && array_filter($event_dates_arr)) ? array_unique($event_dates_arr) : '';
			$event_dates = ($event_dates_arr) ? implode(" - ",array_filter($event_dates_arr)) : '';
			$dateCount = 0;
			if( $event_dates_arr && array_filter($event_dates_arr) ){
				$dateCount = count( array_filter($event_dates_arr) );
			}?>
			<div id="eventinfo_<?php echo $j;?>" class="flexcol eventInfo">
				<div class="imagediv" style="background-image:url('<?php echo $imageSrc;?>');">
					<img class="feat-img" src="<?php echo $imageSrc;?>" alt="<?php echo $event_name ?>" />
					<a class="details <?php echo ($short_description) ? 'has-caption':'no-caption';?>" href="<?php echo $pagelink; ?>">
						<span class="eventtitle">
							<span class="txtwrap">
								<span class="event_name"><?php echo $event_name ?></span>
								<?php if ($event_dates) { ?>
									<?php if ($dateCount>1) { ?>
										<span class="start_date"><?php echo $event_dates ?></span>
									<?php } else { ?>
										<span class="start_date">
											<span class="dayofweek"><?php echo $start_dayofweek ?></span>
											<?php echo $event_dates ?>
										</span>
									<?php } ?>
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
