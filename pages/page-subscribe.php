<?php
/**
 * Template Name: Email List
 */

get_header(); ?>

	<div id="primary" class="full-content-area wrapper default-template">
		<main id="main" class="site-main clear" role="main">
			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="entry-content"><?php the_content(); ?></div>
				<?php $subscription_form = get_field('subscription_form_html'); ?>
				<?php if ($subscription_form) { ?>
				<div class="subscription-wrapper"><?php echo $subscription_form ?></div>
				<?php } ?>
			
			<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
