<?php
/**
 * Doc Settings
 */
Redux::set_section('docly_opt', array(
    'title' => esc_html__( 'Doc Settings', 'docly' ),
    'id' => 'docly_doc_sec',
    'customizer_width' => '400px',
    'icon' => 'dashicons dashicons-media-document',
	'fields' => array(
		array(
			'id'            => 'doc_slug',
			'type'          => 'text',
			'title'         => esc_html__( 'Slug', 'docly' ),
			'subtitle'      => esc_html__( 'You can change the doc post type slug from here. The default slug is docs. After changing the slug, go to Settings > Permalinks and click on the Save Changes button.', 'docly' ),
		),
        array(
            'title'     => esc_html__( 'Doc Meta', 'docly' ),
            'subtitle'  => esc_html__( 'Doc Meta contains Author name and Doc page views count.', 'docly' ),
            'id'        => 'is_doc_meta',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'docly' ),
            'off'       => esc_html__( 'Hide', 'docly' ),
            'default'   => '1',
        ),
        array(
            'title'     => esc_html__( 'Articles Title', 'docly' ),
            'id'        => 'articles_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Articles', 'docly'),
        ),
	)
));

/**
 * Search Banner
 */
Redux::set_section('docly_opt', array(
	'title' => esc_html__( 'Search Banner', 'docly' ),
	'id' => 'doc_search_opt',
	'subsection' => true,
	'icon' => '',
	'fields' => array(
		array(
			'title'     => esc_html__( 'Documentation List', 'docly' ),
			'subtitle'  => esc_html__( 'Show/Hide the documentation dropdown list.', 'docly' ),
			'id'        => 'is_search_doc_dropdown',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'docly' ),
			'off'       => esc_html__( 'Hide', 'docly' ),
			'default'   => '1',
		),
		array(
			'title'     => esc_html__( 'Search Keywords', 'docly' ),
			'id'        => 'is_keywords',
			'type'      => 'switch',
			'on'        => esc_html__( 'Yes', 'docly' ),
			'off'       => esc_html__( 'No', 'docly' ),
		),
		array(
			'title'     => esc_html__( 'Keywords Label', 'docly' ),
			'id'        => 'keywords_label',
			'type'      => 'text',
			'default'   => esc_html__( 'Popular Searches', 'docly'),
			'required'  => array('is_keywords', '=', '1'),
		),
		array(
			'title'     => esc_html__( 'Keywords', 'docly' ),
			'id'        => 'doc_keywords',
			'type'      => 'multi_text',
			'add_text'  =>  esc_html__( 'Add Keyword', 'docly'),
			'required'  => array('is_keywords', '=', '1'),
		),
		array(
			'title'     => esc_html__( 'Ajax Search Result Limit', 'docly' ),
			'subtitle'  => esc_html__( 'This will limit the doc sections and articles in Ajax live search results. Input -1 for show all results.', 'docly' ),
			'id'        => 'doc_result_limit',
			'type'      => 'text',
			'default'   => '-1',
		),
	)
));


/**
 * Left Sidebar
 */
Redux::set_section('docly_opt', array(
    'title' => esc_html__( 'Left Sidebar', 'docly' ),
    'id' => 'doc_left_sidebar_opt',
    'subsection' => true,
    'icon' => '',
    'fields' => array(
	    array(
		    'id'        => 'action_btn_typo',
		    'type'      => 'typography',
		    'title'     => esc_html__( 'Documentation Title Typography', 'docly' ),
		    'output'    => '.doc_left_sidebarlist .doc-title',
	    ),
	    array(
		    'title'     => esc_html__( 'Doc Section Icon', 'docly' ),
		    'subtitle'  => esc_html__( "This is the Doc's default icon. If you don't use icon for the article section individually, this icon will be shown.", 'docly' ),
		    'id'        => 'doc_sec_icon',
		    'type'      => 'media',
		    'compiler'  => true,
		    'default'   => array(
			    'url'   => DOCLY_DIR_IMG.'/folder-closed.png'
		    )
	    ),
	    array(
		    'title'     => esc_html__( 'Doc Section Icon Open', 'docly' ),
		    'subtitle'  => esc_html__( "This is the Doc's default icon. If you don't use icon for the article section individually, this icon will be shown on open states of the Doc sections.", 'docly' ),
		    'id'        => 'doc_sec_icon_open',
		    'type'      => 'media',
		    'compiler'  => true,
		    'default'   => array(
			    'url'   => DOCLY_DIR_IMG.'/folder-open.png'
		    )
	    ),
    )
));


/**
 * Right Sidebar
 */
Redux::set_section('docly_opt', array(
    'title' => esc_html__( 'Right Sidebar', 'docly' ),
    'id' => 'doc_right_sidebar_opt',
    'subsection' => true,
    'icon' => '',
    'fields' => array(
        array(
            'title'     => esc_html__( 'Select Dropdown', 'docly' ),
            'subtitle'  => __( 'You can display conditional contents using the [conditional_data] shortcode in documentation based on the dropdown value. See the shortcode usage tutorial <a href="https://is.gd/W7BCSg" target="_blank">here</a>.', 'docly' ),
            'id'        => 'is_os_dropdown',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'docly' ),
            'off'       => esc_html__( 'Hide', 'docly' ),
            'default'   => '1',
        ),

        array(
            'title'         => esc_html__( 'Dropdown Options', 'docly' ),
            'subtitle'      => esc_html__( 'You can use Fontawesome 5 and Elegant icon classes in the icon field.', 'docly' ),
            'id'            => 'os_options',
            'type'          => 'slides',
            'content_title' => esc_html__( 'Option', 'docly' ),
            'show' => array(
                'title' => true,
                'description' => false,
                'url' => true,
            ),
            'placeholder' => array(
                'title'     => esc_html__( 'Title', 'docly' ),
                'url'      => esc_html__( 'Icon', 'docly' ),
            ),
            'required' => array( 'is_os_dropdown', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Font Size Switcher', 'docly' ),
            'id'        => 'is_font_switcher',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'docly' ),
            'off'       => esc_html__( 'Hide', 'docly' ),
            'default'   => '1',
        ),

        array(
            'title'     => esc_html__( 'Print Icon', 'docly' ),
            'id'        => 'is_print_icon',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'docly' ),
            'off'       => esc_html__( 'Hide', 'docly' ),
            'default'   => '1',
        ),

        array(
            'title'     => esc_html__( 'Dark Mode', 'docly' ),
            'subtitle'  => esc_html__( 'This will permanently disable and delete the Dark mode and will keep only the light mode.', 'docly' ),
            'id'        => 'is_dark_switcher',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enable', 'docly' ),
            'off'       => esc_html__( 'Disable', 'docly' ),
            'default'   => '1',
        ),
    )
));


/**
 * Doc Footer
 */
Redux::set_section('docly_opt', array(
    'title' => esc_html__( 'Layout', 'docly' ),
    'id' => 'doc_layout_opt',
    'subsection' => true,
    'icon' => '',
    'fields' => array(
        array(
            'title'     => esc_html__( 'Doc Layout', 'docly' ),
            'id'        => 'doc_layout',
            'type'      => 'image_select',
            'options'   => array(
                'both_sidebar' => array(
                    'alt' => esc_html__( 'Both Sidebar', 'docly' ),
                    'img' => DOCLY_DIR_IMG.'/layouts/both_sidebar.jpg'
                ),
                'left_sidebar' => array(
                    'alt' => esc_html__( 'Left Sidebar', 'docly' ),
                    'img' => DOCLY_DIR_IMG.'/layouts/sidebar_left.jpg'
                ),
            ),
            'default' => 'both_sidebar'
        ),

	    array(
		    'title'     => esc_html__( 'Doc Page Width', 'docly' ),
		    'subtitle'  => esc_html__( 'Set the default Doc page width from here.', 'docly' ),
		    'id'        => 'doc_width',
		    'type'      => 'select',
		    'options'   => array(
			    'boxed' => esc_html__('Boxed', 'docly'),
			    'full-width' => esc_html__('Full Width', 'docly'),
		    ),
		    'default' => 'boxed'
	    ),

        array(
            'title'     => esc_html__( 'Doc Footer', 'docly' ),
            'id'        => 'doc_footer',
            'type'      => 'image_select',
            'options'   => array(
                'simple' => array(
                    'alt' => esc_html__( 'Simple Footer', 'docly' ),
                    'img' => DOCLY_DIR_IMG.'/footer/footer-simple.png'
                ),
                'normal' => array(
                    'alt' => esc_html__( 'Widgets Footer', 'docly' ),
                    'img' => DOCLY_DIR_IMG.'/footer/footer-normal.png'
                ),
            ),
            'default' => 'simple'
        )
    )
));


/**
 * Feedback area
 */
Redux::set_section('docly_opt', array(
    'title' => esc_html__( 'Feedback Area', 'docly' ),
    'id' => 'doc_feedback_opt',
    'subsection' => true,
    'icon' => '',
    'fields' => array(
	    array(
		    'title'     => esc_html__( 'Feedback Area', 'docly' ),
		    'id'        => 'is_feedback_area',
		    'type'      => 'switch',
		    'on'        => esc_html__( 'Show', 'docly' ),
		    'off'       => esc_html__( 'Hide', 'docly' ),
		    'default'   => '1',
	    ),

        array(
            'title'     => esc_html__( 'Still Stuck', 'docly' ),
            'id'        => 'still_stuck_text',
            'type'      => 'text',
            'default'   => esc_html__( 'Still stuck?', 'docly' ),
	        'required'  => array('is_feedback_area', '=', '1')
        ),

        array(
            'title'     => esc_html__( 'Help form link text', 'docly' ),
            'id'        => 'help_form_link_text',
            'type'      => 'text',
            'default'   => esc_html__( 'How can we help?', 'docly' ),
            'required'  => array('is_feedback_area', '=', '1')
        ),

	    array(
		    'title'     => esc_html__( 'Feedback Label', 'docly' ),
		    'id'        => 'doc_feedback_label',
		    'type'      => 'text',
		    'default'   => esc_html__( 'Was this page helpful?', 'docly' ),
		    'required'  => array('is_feedback_area', '=', '1')
	    ),

	    array(
		    'title'     => esc_html__( 'Feedback Modal', 'docly' ),
		    'subtitle'  => esc_html__( 'Customize the feedback modal form here.', 'docly' ),
		    'id'        => 'feedback_modal_form',
		    'type'      => 'section',
		    'indent'    => true,
		    'required'  => array('is_feedback_area', '=', '1')
	    ),

        array(
            'title'     => esc_html__( 'Form Title', 'docly' ),
            'id'        => 'feedback_form_title',
            'type'      => 'text',
            'default'   => esc_html__( 'How can we help?', 'docly' ),
            'required'  => array('is_feedback_area', '=', '1')
        ),

        array(
            'title'     => esc_html__( 'Form Subtitle', 'docly' ),
            'id'        => 'feedback_form_subtitle',
            'type'      => 'textarea',
            'required'  => array('is_feedback_area', '=', '1')
        ),

	    array(
		    'id'     => 'feedback_modal_form-end',
		    'type'   => 'section',
		    'indent' => false,
	    ),
    )
));