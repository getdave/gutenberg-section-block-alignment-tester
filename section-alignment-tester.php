<?php
/**
 * @package Section Alignment Tester
 * @version 1.0.0
 */
/*
Plugin Name: Section Alignment Tester
Plugin URI: http://wordpress.org
Description: For testing the Section Block alignment variations.
Author: Dave Smith (@getdave)
Version: 1.0.0
Author URI: https://aheadcreative.com
*/


function gutenberg_add_section_alignment_test( $settings, $post ) {
	$is_new_post = 'auto-draft' === $post->post_status;
	$target_post_type = 'page';

	$alignments = array(
		'', //standard
		'wide',
		'full'
	);

	function block_image($alignment='') {
		return array( 'core/image', array(
			'align' => $alignment,
			'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
		) );
	}

	function block_cover($alignment='') {
		return array( 'core/cover', array(
			'align' => $alignment,
			'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
		) );
	}

	function block_media_text($alignment='') {
		return array( 'core/media-text', array(
			'align' => $alignment,
			'customBackgroundColor' => '#ff0000',
			'mediaUrl' => 'https://cldup.com/Fz-ASbo2s3.jpg',
			'mediaType' => 'image',
		), array(
			array( 'core/paragraph', array(
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
			))
		) );
	}

	function block_columns($alignment='') {
		return array( 'core/columns', array(
				'align' => $alignment,
				'columns' => 2,
			), array(

				array( 'core/column', array(), array(
					array( 'core/paragraph', array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					))
				) ),

				array( 'core/column', array(), array(
					array( 'core/paragraph', array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					))
				) ),
				
			) 
		);
	}

	function block_gallery($alignment='') {
		return array( 'core/gallery', array(
			'align' => $alignment,
			'images' => array(
				array(
					'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
				),
				array(
					'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
				),
				array(
					'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
				),
				array(
					'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
				),
				array(
					'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
				),
				array(
					'url' => 'https://cldup.com/Fz-ASbo2s3.jpg'
				)
			)
		) );
	}

	function block_table($alignment='') {
		return array( 'core/table', array(
			'align' => $alignment,
			'body' => array(
				'cells' => array(
					array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					),
					array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					),
					array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					),
					array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					),
					array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					),
					array(
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis ante, consectetur a bibendum et, rhoncus in nibh.'
					)
				)
			)
		) );
	}

	$blocks = array(
		//'table',
		'gallery',
		'columns',
		'image',
		'cover',
		'media-text',
	);

	$template = array_reduce($blocks, function($template, $block) use ($blocks, $image, $alignments, $block_image, $block_cover, $block_columns, $block_gallery, $block_table) {

		$block_func = str_replace('-', '_', $block);

		$template[] = array( 'core/section', array(
			'align' => '',
			'customBackgroundColor' => 'rgb(34, 159, 216)',
		), array(
			array('core/heading', array(
				'content' => ucfirst($block) . ' test: Standard Width',
			)),
			call_user_func('block_' . $block_func),
			call_user_func('block_' . $block_func, 'wide'),
			call_user_func('block_' . $block_func, 'full'),
		) );
		$template[] = array( 'core/section', array(
			'align' => 'wide',
			'customBackgroundColor' => 'rgb(34, 159, 216)',
		), array(
			array('core/heading', array(
				'content' => ucfirst($block) . ' test: Wide Width',
			)),
			call_user_func('block_' . $block_func),
			call_user_func('block_' . $block_func, 'wide'),
			call_user_func('block_' . $block_func, 'full'),
		) );
		$template[] = array( 'core/section', array(
			'align' => 'full',
			'customBackgroundColor' => 'rgb(34, 159, 216)',
		), array(
			array('core/heading', array(
				'content' => ucfirst($block) . ' test: Full Width',
			)),
			call_user_func('block_' . $block_func),
			call_user_func('block_' . $block_func, 'wide'),
			call_user_func('block_' . $block_func, 'full'),
		) );
		return $template;
	}, array());
	
	if ( $is_new_post && ! isset( $settings['template'] ) && $target_post_type === $post->post_type ) {
		$settings['template'] = $template;
	}

	return $settings;
}
add_filter( 'block_editor_settings', 'gutenberg_add_section_alignment_test', 10, 2);