<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bellaworks
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site clear">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>

	<header id="masthead" class="site-header clear" role="banner">
		<div class="wrapper clear">

			<div class="flexrow clear">
				<div class="leftcol">
				<?php if( get_custom_logo() ) { ?>
					<?php if ( is_home() ) { ?>
						<h1 class="logo">
			            	<?php the_custom_logo(); ?>
			            </h1>
					<?php } else { ?>
						<div class="logo">
			            	<?php the_custom_logo(); ?>
			            </div>
					<?php } ?>
		            
		        <?php } else { ?>
		            <h1 class="logo">
			            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
		            </h1>
		        <?php } ?>
		        </div>

		        <?php  
		        $faceboook = get_field('facebook_link','option');
		        $twitter = get_field('twitter_link','option');
		        $instagram = get_field('instagram_link','option');
		        ?>
		        <div class="rightcol">
		        	<div class="social-media">
		        		<?php if ($faceboook) { ?>
		        		<a class="facebook" target="_blank" href="<?php echo $faceboook ?>"><i aria-hidden="true" class="fab fa-facebook"></i></a>
		        		<?php } ?>
		        		<?php if ($twitter) { ?>
		        		<a class="twitter" target="_blank" href="<?php echo $twitter ?>"><i aria-hidden="true" class="fab fa-twitter-square"></i></a>
		        		<?php } ?>
		        		<?php if ($instagram) { ?>
		        		<a class="instagram" target="_blank" href="<?php echo $instagram ?>">
		        			<span class="normal"><i aria-hidden="true" class="fab fa-instagram"></i></span>
		        			<span class="hover"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448 512" style="enable-background:new 0 0 448 512;" xml:space="preserve"><style type="text/css">.st0{fill:url(#SVGID_1_);}</style><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="224.05" y1="477.2495" x2="224.05" y2="18.5249"><stop offset="0" style="stop-color:#FFD97E"/><stop offset="2.857143e-02" style="stop-color:#FCBB5F"/><stop offset="6.051237e-02" style="stop-color:#F89638"/><stop offset="0.2749" style="stop-color:#E45466"/><stop offset="0.4079" style="stop-color:#D92F7F"/><stop offset="0.4966" style="stop-color:#D53082"/><stop offset="0.5887" style="stop-color:#C83589"/><stop offset="0.6825" style="stop-color:#B43C96"/><stop offset="0.7774" style="stop-color:#9646A8"/><stop offset="0.8722" style="stop-color:#7153BF"/><stop offset="0.9042" style="stop-color:#6358C8"/></linearGradient><path class="st0" d="M224.1,141c-63.6,0-114.9,51.3-114.9,114.9s51.3,114.9,114.9,114.9S339,319.5,339,255.9S287.7,141,224.1,141z M224.1,330.6c-41.1,0-74.7-33.5-74.7-74.7s33.5-74.7,74.7-74.7s74.7,33.5,74.7,74.7S265.2,330.6,224.1,330.6L224.1,330.6z M370.5,136.3c0,14.9-12,26.8-26.8,26.8c-14.9,0-26.8-12-26.8-26.8s12-26.8,26.8-26.8S370.5,121.5,370.5,136.3z M446.6,163.5c-1.7-35.9-9.9-67.7-36.2-93.9c-26.2-26.2-58-34.4-93.9-36.2c-37-2.1-147.9-2.1-184.9,0C95.8,35.1,64,43.3,37.7,69.5s-34.4,58-36.2,93.9c-2.1,37-2.1,147.9,0,184.9c1.7,35.9,9.9,67.7,36.2,93.9s58,34.4,93.9,36.2c37,2.1,147.9,2.1,184.9,0c35.9-1.7,67.7-9.9,93.9-36.2c26.2-26.2,34.4-58,36.2-93.9C448.7,311.3,448.7,200.5,446.6,163.5L446.6,163.5z M398.8,388c-7.8,19.6-22.9,34.7-42.6,42.6c-29.5,11.7-99.5,9-132.1,9s-102.7,2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6c-11.7-29.5-9-99.5-9-132.1s-2.6-102.7,9-132.1c7.8-19.6,22.9-34.7,42.6-42.6c29.5-11.7,99.5-9,132.1-9s102.7-2.6,132.1,9c19.6,7.8,34.7,22.9,42.6,42.6c11.7,29.5,9,99.5,9,132.1S410.5,358.6,398.8,388z"/></svg></span>
		        		</a>
		        		<?php } ?>
		        	</div>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<span id="toggleMenu" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span><i aria-label="Menu"></i></span></span>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container_class'=>'main-menu-wrapper','link_before'=>'<span>','link_after'=>'</span>' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div><!-- wrapper -->
	</header><!-- #masthead -->

	<div class="black-border wrapper clear"><div class="clear"></div></div>

	<div id="content" class="site-content clear">
