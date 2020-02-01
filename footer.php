	</div><!-- #content -->

	<?php  
	global $post;
    $post_slug = ( isset($post->post_name) ) ? $post->post_name : '';
	$button_name = get_field('footer_button_name','option');
	$button_link = get_field('footer_button_link','option'); ?>
	
	<?php if ($post_slug!=='events') { ?>
	<div class="home-buttondiv clear">
		<div class="innerwrap">
			<div class="wrapper">
				<?php if ($button_name && $button_link) { ?>
					<a class="btn-orange" href="<?php echo $button_link ?>">
						<span class="txt"><?php echo $button_name ?></span>
						<span class="top-border-left-right"></span>
						<span class="mid"></span>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="inner-pad clear">
				<?php
				$logos = get_field('company_logos','option');  
				if($logos) { ?>
					<div class="footer-logos clear">
						<div class="flexrow2 clear">
							<?php foreach ($logos as $logo) { 
							$image_id = $logo['ID'];
							$image_link = get_field('image_link',$image_id); 
							$open_link = ($image_link) ? '<a href="'.$image_link.'" target="_blank">':'';
							$close_link = ($image_link) ? '</a>':'';
							?>
							<div class="flexcol">
								<?php echo $open_link; ?><img class="logoImg" src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['title'] ?>" /><?php echo $close_link; ?>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>

				<?php
					$email = get_field('email','option');    
					$phone = get_field('phone','option');    
					$address = get_field('address','option');    
				?>
				<div class="footer-info">
					<?php if ($email) { ?>
						<span class="email"><a href="mailto:<?php echo antispambot($email,1); ?>"><?php echo antispambot($email); ?></a></span>
					<?php } ?>
					<?php if ($phone) { ?>
						<span class="phone"><a href="tel:<?php echo format_phone_number($phone);?>"><?php echo $phone;?></a></span>
					<?php } ?>
					<?php if ($address) { ?>
						<span class="address"><?php echo $address;?></span>
					<?php } ?>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
