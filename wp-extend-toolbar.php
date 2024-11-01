<?php
/*
 Plugin Name: WP Extend Toolbar
 Plugin URI: https://piece-web.jp/plugins/wp-extend-toolbar/
 Description: Adds a page information to the admin bar.
 Author: Michinari Odajima
 Version: 2.1.0
 Author URI: https://piece-web.jp/
 Domain Path: /language
 Text Domain: wp-extend-toolbar
 */

class WP_Extend_Toolbar {

	function __construct() {
		
		add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
		add_action( 'admin_bar_init', array( $this, 'admin_bar_init' ) );
		
	}
	
	function admin_bar_init() {

		if ( ! is_admin() && is_admin_bar_showing() && is_user_logged_in() && current_user_can('edit_user') ) {
			
			add_action( 'admin_bar_menu',     array( $this, 'admin_bar_menu' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ),        100 );
		
		}
	}
	
	function admin_bar_menu() {
		
		global $wp_admin_bar, $template;
		
		$wp_admin_bar->add_group( array(
			'id'     => 'extend-toolbar',
			'meta'   => array(
				'class' => 'ab-extend-toolbar',
			),
		) );
		
		$wp_admin_bar->add_node( array(
			'parent' => 'extend-toolbar',
			'id'     => 'extend-toolbar-title',
			'title'  => '',
			'meta'   => array(),
		) );
		
		$wp_admin_bar->add_node( array(
			'parent' => 'extend-toolbar',
			'id'     => 'extend-toolbar-description',
			'title'  => '',
			'meta'   => array(),
		) );
		
		$wp_admin_bar->add_node( array(
			'parent' => 'extend-toolbar',
			'id'     => 'extend-toolbar-keyword',
			'title'  => '',
			'meta'   => array(),
		) );
		
		$title = sprintf(
			'<span class="title">' . __('Themes') . ' : </span><span class="value">%s</span>',
			get_template()
		);
		
		$wp_admin_bar->add_node(
			array(
				'id'    => 'admin_bar_theme_name',
				'meta'  => array(),
				'title' => $title,
			)
		);
		
		$title = sprintf(
			'<span class="title">' . __('Template') . ' : </span> <span class="value">%s</span>',
			basename( $template )
		);
		
		$wp_admin_bar->add_node(
			array(
				'id'    => 'admin_bar_template_name',
				'meta'  => array(),
				'title' => $title,
			)
		);
		
		$img_url  = $this->get_plugins_url('/img/btn-close.png');
		
echo <<<EOM
<img src="{$img_url}" id="open-close-button" class="open" alt="">
EOM;
	}

	function enqueue() {
		
		wp_enqueue_style( 'wp-extend-toolbar',  $this->get_plugins_url( "/css/wp-extend-toolbar.css" ), array() );
		wp_enqueue_script( 'wp-extend-toolbar', $this->get_plugins_url( "/js/wp-extend-toolbar.js" ),   array( 'jquery' ), null, true );
		
	}

	function get_plugins_url( $path = '' ) {
		
		return plugins_url( $path, __FILE__ );
		
	}
}


function wp_extend_toolbar_load_plugin_textdomain() {
    
    load_plugin_textdomain( 'wp-extend-toolbar', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    
}
add_action( 'plugins_loaded', 'wp_extend_toolbar_load_plugin_textdomain' );


$GLOBALS['wp_extend_toolbar'] = new WP_Extend_Toolbar();