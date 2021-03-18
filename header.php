<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>


	<meta charset="<?php esc_html(bloginfo( 'charset' )); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_html(bloginfo( 'pingback_url' )); ?>">

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143581396-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-143581396-1');
</script>

	<?php
		if (is_singular() && get_option('thread_comments'))
			wp_enqueue_script('comment-reply');

		wp_head();
	?>

</head>

<?php 
	$tdl_options = eva_global_var();
	$form_style = (!empty($tdl_options['tdl_form_style'])) ? $tdl_options['tdl_form_style'] : 'default'; 
	$color_scheme = (!empty($tdl_options['tdl_main_color_scheme'])) ? $tdl_options['tdl_main_color_scheme'] : 'mc_light';
	$header_layout = (!empty($tdl_options['tdl_header_layout'])) ? $tdl_options['tdl_header_layout'] : '1';
	if ( (isset($tdl_options['tdl_topbar_switch'])) && ($tdl_options['tdl_topbar_switch'] == "1") ) {
	  $topbar = 'has_topbar';
	} else {
	  $topbar = 'no_topbar';
	}	
 ?>

<body <?php body_class(); ?> data-form-style="<?php echo esc_attr($form_style); ?>" data-color-scheme="<?php echo esc_attr($color_scheme); ?>" data-topbar="<?php echo esc_attr( $topbar ); ?>" data-header-layout="<?php echo esc_attr( $header_layout ); ?>">

	<?php if ( (isset($tdl_options['tdl_page_loader'])) && (trim($tdl_options['tdl_page_loader']) == "1" ) ) : ?>
		<div id="eva-loader-wrapper">
			<div class="eva-loader-section">
				<div class="eva-loader-<?php echo esc_attr($tdl_options['tdl_page_loader_spinner']); ?>"></div>
			</div>
		</div>
	<?php endif; ?>

	    <?php if ( (isset($tdl_options['tdl_topbar_switch'])) && ($tdl_options['tdl_topbar_switch'] == "1" ) ) : ?>        
	    	<?php get_template_part( 'header', 'topbar' ); ?>                					
	    <?php endif; ?>


        <?php if ( isset($tdl_options['tdl_header_layout']) ) : ?>
								
			<?php if ( $tdl_options['tdl_header_layout'] == "1" ) : ?>
				<?php get_template_part( 'header', 'default' ); ?>
	        <?php elseif ( $tdl_options['tdl_header_layout'] == "2" ) : ?>
	        	<?php get_template_part( 'header', 'centered' ); ?>
			<?php else : ?>
				<?php get_template_part( 'header', 'left' ); ?>
			<?php endif; ?>		                                
	    <?php else : ?>                          
	            <?php get_template_part( 'header', 'default' ); ?>
        <?php endif; ?>	



	<div class="offcanvas_container">
		<div class="offcanvas_main_content">
			<div class="page-wrapper">
