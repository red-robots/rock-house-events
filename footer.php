	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="inner-pad clear">
				<?php
				$logos = get_field('company_logos','option');  
				if($logos) { ?>
					<div class="footer-logos clear">
						<div class="flexrow2 clear">
							<?php foreach ($logos as $logo) { ?>
							<div class="flexcol">
								<img class="logoImg" src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['title'] ?>" />
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
