<?php
if(function_exists("register_field_group")) {

	/* Woo Categories / Tags Settings */

	register_field_group(array (
		'id' => 'acf_products-categories',
		'title' => 'Products categories',
		'fields' => array (


			array (
				'key' => 'field_prodcat_img_header',
				'label' => esc_html__('Image Header', 'eva'),
				'name' => 'tdl_prodcat_image_header',
				'type' => 'image',
				'instructions' => esc_html__('Specify the image you want to display at the top of current category page.', 'eva'),
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),

			array (
				'key' => 'field_prodcat_header_height',
				'label' => esc_html__('Page Header height (px)', 'eva'),
				'name' => 'tdl_prodcat_header_height',
				'type' => 'number',
				'instructions' => esc_html__("How tall do you want your header? Don't include 'px' in the string. e.g. 450", 'eva'),
				// 'default_value' => '400',
			),
	

			array (
				'key' => 'field_prodcat_header_bgchange',
				'label' => esc_html__('Header Transparency', 'eva'),
				'name' => 'tdl_prodcat_bg_change',
				'type' => 'select',
				'instructions' => esc_html__('Select the content color for Header.', 'eva'),
				'choices' => array (
					'' => esc_html__('Inherit', 'eva'),
					'background--light' => esc_html__('Light', 'eva'),
					'background--dark' => esc_html__('Dark', 'eva'),
					// 'background--auto' => esc_html__('Automatic check background', 'eva'),
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),								


		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'product_cat',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	/* Product */
	register_field_group(array (
		'id' => 'acf_sidebar',
		'title' => esc_html__('Product Settings', 'eva'),
		'fields' => array (

			array (
				'key' => 'field_qickview_color',
				'label' => esc_html__('Quick View button color', 'eva'),
				'name' => 'tdl_qickview_color',
				'type' => 'select',
				'instructions' => esc_html__('Select color for Quick View button', 'eva'),
				'choices' => array (
					'background--light' => esc_html__('Light', 'eva'),
					'background--dark' => esc_html__('Dark', 'eva'),
					// 'background--auto' => esc_html__('Automatic check background', 'eva'),
				),
				'default_value' => 'background--light',
				'allow_null' => 0,
				'multiple' => 0,
			),

		),
		'location' => array (

			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 6,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	/* Page Settings */
	register_field_group(array (
		'id' => 'acf_page-settings',
		'title' => 'Page Settings',
		'fields' => array (

			array (
				'key' => 'field_page_header_title',
				'label' => esc_html__('Show Title Area', 'eva'),
				'name' => 'tdl_hide_title',
				'type' => 'true_false',
				'instructions' => esc_html__('Check this if you want to show/hide page title area.', 'eva'),
				'message' => esc_html__('Show Title Area', 'eva'),
				'default_value' => 1,
			),		

			array (
				'key' => 'field_page_title',
				'label' => esc_html__('Page SubTitle', 'eva'),
				'name' => 'tdl_subtitle',
				'type' => 'text',
				'instructions' => esc_html__('Enter page subtitle.', 'eva'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_page_header_title',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_page_header_height',
				'label' => esc_html__('Page Header height (px)', 'eva'),
				'name' => 'tdl_header_height',
				'type' => 'number',
				'instructions' => esc_html__("How tall do you want your header? Don't include 'px' in the string. e.g. 450", 'eva'),
				// 'default_value' => '400',
			),

			// array (
			// 	'key' => 'field_page_header_bgchange',
			// 	'label' => esc_html__('Automatic Header Content color switcher', 'eva'),
			// 	'name' => 'tdl_bg_change',
			// 	'type' => 'true_false',
			// 	'instructions' => esc_html__('Check this if you want to automatically switch to a darker or a lighter header content depending on the brightness of background header images behind it. (Required page featured image)', 'eva'),
			// 	'message' => esc_html__('Automatic Header Content color switcher', 'eva'),
			// 	'default_value' => 0,
			// ),

			array (
				'key' => 'field_page_header_bgchange',
				'label' => esc_html__('Header Transparency', 'eva'),
				'name' => 'tdl_bg_change',
				'type' => 'select',
				'instructions' => esc_html__('Select the content color for Header.', 'eva'),
				'choices' => array (
					'' => esc_html__('Inherit', 'eva'),
					'background--light' => esc_html__('Light', 'eva'),
					'background--dark' => esc_html__('Dark', 'eva'),
					// 'background--auto' => esc_html__('Automatic check background', 'eva'),
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),

			array (
				'key' => 'field_bottom_padding',
				'label' => esc_html__('Disable Bottom Padding', 'eva'),
				'name' => 'tdl_bottom_padding',
				'type' => 'true_false',
				'message' => esc_html__('Check to Disable Bottom Padding', 'eva'),
				'default_value' => 0,
			),										
	

		),

		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-right-sidebar.php',
					'order_no' => 0,
					'group_no' => 2,
				),
			),	
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-left-sidebar.php',
					'order_no' => 0,
					'group_no' => 3,
				),
			),	
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-full-width.php',
					'order_no' => 0,
					'group_no' => 4,
				),
			),	
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-narrow.php',
					'order_no' => 0,
					'group_no' => 5,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	/* Post Type: Link */
	register_field_group(array (
		'id' => 'acf_post-type-link',
		'title' => esc_html__('Post Type: Link', 'eva'),
		'fields' => array (
			array (
				'key' => 'field_52613356beee6',
				'label' => esc_html__('Link URL', 'eva'),
				'name' => 'tdl_link_url',
				'type' => 'text',
				'instructions' => esc_html__('Specify the URL to replace post title permalink.', 'eva'),
				'default_value' => '',
				'placeholder' => esc_html__('URL', 'eva'),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'link',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	/* Post Type: Quote */
	register_field_group(array (
		'id' => 'acf_post-type-quote',
		'title' => esc_html__('Post Type: Quote', 'eva'),
		'fields' => array (
			array (
				'key' => 'field_526135682f07d',
				'label' => esc_html__('Quote Text', 'eva'),
				'name' => 'tdl_quote_text',
				'type' => 'textarea',
				'instructions' => esc_html__('Specify the quote text.', 'eva'),
				'default_value' => '',
				'placeholder' => esc_html__('Quote text', 'eva'),
				'maxlength' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_526135822f07e',
				'label' => esc_html__('Quote Author', 'eva'),
				'name' => 'tdl_quote_author',
				'type' => 'text',
				'instructions' => esc_html__('Specify the quote author.', 'eva'),
				'default_value' => '',
				'placeholder' => esc_html__('Quote author', 'eva'),
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'quote',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


}
