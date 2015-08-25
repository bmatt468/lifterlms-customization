<?php
/**
* Plugin Name: LifterLMS-Customization
* Plugin URI: http://lifterextensions.com/
* Description: This plugin allows you to easily change the look and feel of LifterLMS without having to do any backend CSS work.
* Version: 0.1.0
* Author: Benjamin R. Matthews
* Author URI: http://benjaminrmatthews.com
*
* @package 		LifterLMS-Customization
* @category 	Core
* @author 		Bejamin R. Matthews
*/

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) : exit;
endif;
// make sure class loads
if ( ! class_exists( 'LLMS_Customization') ) :
	class LLMS_Customization
	{		
		/**
		 * This function is called when the plugin is 
		 * instantiated. It creates the needed actions and 
		 * hooks for the plugin.
		 */
		public function __construct() 
		{			
			// Define class constants
			$this->define_constants();
			// add hooks here
			add_action( 'plugins_loaded', array($this, 'includes') );
			add_action( 'plugins_loaded', array($this, 'Init') );
			add_action('admin_enqueue_scripts',array($this,'AddStyles'));			
		}
		
		public function Init() 
		{
			// only load plugin if LifterLMS class exists.
			if ( class_exists( 'LifterLMS') ) 
			{
				
			}
			else 
			{
				add_action( 'admin_init', array($this,'DeactivatePlugin'));
          		add_action( 'admin_notices', array($this,'DeactivatePluginNotice'));
			}			
		}
		
		public function DeactivatePlugin() 
		{
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
		
		public function DeactivatePluginNotice() 
		{
			echo '<div class="error"><p><strong>LifterLMS</strong> is not active; <strong>LifterLMS Customization</strong> has been <strong>deactivated</strong>.</p></div>';
			if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );
		}
		
		private function define_constants() 
		{			
			if ( ! defined( 'LLMSCustomization_PLUGIN_FILE' ) ) 
			{
				define( 'LLMSCustomization_PLUGIN_FILE', __FILE__ );
			}
			
			if ( ! defined( 'LLMSCustomization_PLUGIN_DIR' ) ) 
			{
				define( 'LLMSCustomization_PLUGIN_DIR', WP_PLUGIN_DIR . "/" . plugin_basename( dirname(__FILE__) ) . '/');
			}
		}
		
		public function includes() {			
			if ( class_exists( 'LifterLMS') ) 
			{
				
			} 
		}
		
		public function AddStyles()
		{
			
		}		
	}
endif;
return new LLMS_Customization;

?>