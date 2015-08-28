<?php
/**
* Plugin Name: LifterLMS-Customization
* Plugin URI: http://lifterextensions.com/
* Description: This plugin allows you to easily change the look and feel of LifterLMS without having to do any backend CSS work.
* Version: 0.6.0
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
				add_menu_page('LifterLMS Customization', 
					'LifterLMS Customization', 
					'manage_options',
					'lifterlms_customization',
					array( $this, 'GenerateAdminPage' ),
					plugin_dir_url(LLMSCustomization_PLUGIN_FILE) . 'assets/img/menu-icon.png',
					'50.15974');
				add_action( 'admin_init', array($this,'RegisterSettings'));
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
		
		public function includes() 
		{			
			if ( class_exists( 'LifterLMS') ) 
			{
				
			} 
		}
		
		public function AddStyles()
		{
			wp_enqueue_style('llms_customizer', plugins_url('/assets/css/style.css',__FILE__));
			wp_enqueue_style( 'wp-color-picker' );
    		wp_enqueue_script( 'llms_customizer_script', plugins_url('/assets/js/backend.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		}

		public function RegisterSettings() 
		{
			//register our settings
			register_setting( 'LLMS_CustomizationSettings', 'LLMS_CustomizationSettings' );

			///////////////////
			// Themes Secion //
			///////////////////
			add_settings_section( 'LLMS_CustomizationThemeSection', 
				'LifterLMS Color Themes', 
				array($this,'ThemeSectionOutput'), 
				'lifterlms_custom_open'
			);

			///////////////////
			// First Section //
			///////////////////
			add_settings_section( 'LLMS_CustomizationColorSection', 
				'LifterLMS Primary Button Color Customization', 
				array($this,'ColorSectionOutput'), 
				'lifterlms_custom'
			);

			add_settings_field( 'primary_button_color',
				'Primary Button Color',
				array($this,'PrimaryButtonColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationColorSection'
			);

			add_settings_field( 'primary_button_hover_color',
				'Primary Button Hover Color',
				array($this,'PrimaryButtonHoverColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationColorSection'
			);

			add_settings_field( 'primary_button_text_color',
				'Primary Button Text Color',
				array($this,'PrimaryButtonTextColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationColorSection'
			);

			////////////////////
			// Second Section //
			////////////////////
			add_settings_section( 'LLMS_CustomizationSecondaryButtonColorSection', 
				'LifterLMS Secondary Button Color Customization', 
				array($this,'SecondaryButtonColorSectionOutput'), 
				'lifterlms_custom'
			);

			add_settings_field( 'secondary_button_color',
				'Secondary Button Color',
				array($this,'SecondaryButtonColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationSecondaryButtonColorSection'
			);

			add_settings_field( 'secondary_button_hover_color',
				'Secondary Button Hover Color',
				array($this,'SecondaryButtonHoverColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationSecondaryButtonColorSection'
			);

			add_settings_field( 'secondary_button_text_color',
				'Secondary Button Text Color',
				array($this,'SecondaryButtonTextColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationSecondaryButtonColorSection'
			);

			///////////////////
			// Third Section //
			///////////////////
			add_settings_section( 'LLMS_CustomizationLessonColorSection', 
				'LifterLMS Lesson Color Customization', 
				array($this,'LessonColorSectionOutput'), 
				'lifterlms_custom'
			);

			add_settings_field( 'incomplete_lesson_icon_color',
				'Incomplete Lesson Icon Color',
				array($this,'IncompleteLessonColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationLessonColorSection'
			);

			add_settings_field( 'complete_lesson_icon_color',
				'Complete Lesson Icon Color',
				array($this,'CompleteLessonColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationLessonColorSection'
			);

			add_settings_field( 'progress_bar_base_color',
				'Progress Bar Base Color',
				array($this,'ProgressBarBaseColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationLessonColorSection'
			);

			add_settings_field( 'progress_bar_completed_color',
				'Progress Bar Completed Color',
				array($this,'ProgressBarCompletedColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationLessonColorSection'
			);

			add_settings_field( 'course_home_completed_lesson_icon_color',
				'Progress Bar Completed Color',
				array($this,'CourseSyllabusCompletedLessonColorOutput'),
				'lifterlms_custom',
				 'LLMS_CustomizationLessonColorSection'
			);

			////////////////////
			// Fourth Section //
			////////////////////
			/*add_settings_section( 'LLMS_CustomizationTextSection', 
				'LifterLMS Text Customization', 
				array($this,'TextSectionOutput'), 
				'lifterlms_custom'
			);*/

			////////////////////
			// PayPal Section //
			////////////////////
			add_settings_section( 'LLMS_CustomizationCloseSection', 
				'Thank you!', 
				array($this,'CloseSectionOutput'), 
				'lifterlms_custom_close'
			);
		}

		//////////////////////////////////
		// Theme Section Output Methods //
		//////////////////////////////////
		public function ThemeSectionOutput()
		{
			?>
			<p>This section gives you the ability to select a predefined theme for use within LifterLMS;
			however, if you wish to customize the plugin to your specific color set, you can do that below. </p>
			<?php
			submit_button('Advanced View', 'secondary', 'enable_advanced_view');
		}

		//////////////////////////////////////////
		// Primary Color Section Output Methods //
		//////////////////////////////////////////
		public function ColorSectionOutput($arg)
		{
			?>
			<p>This section contains the fields that allow you to customize the color scheme of LifterLMS' standard button set.</p>
			<?php
		}

		public function PrimaryButtonColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[button-color]" value="<?php echo isset($o['button-color']) ? $o['button-color'] : '#e5554e'; ?>" class="my-color-field" data-default-color="#e5554e" />
			<div class="settings_label">This option controls the main color for LifterLMS' standard buttons (e.g., 'View Course')</div>
			<?php
		}

		public function PrimaryButtonHoverColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[button-hover-color]" value="<?php echo isset($o['button-hover-color']) ? $o['button-hover-color'] : '#e24038'; ?>" class="my-color-field" data-default-color="#e24038" />
			<div class="settings_label">This option controls the hover color for LifterLMS' standard buttons</div>
			<?php
		}

		public function PrimaryButtonTextColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[button-text-color]" value="<?php echo isset($o['button-text-color']) ? $o['button-text-color'] : '#fefefe'; ?>" class="my-color-field" data-default-color="#fefefe" />
			<div class="settings_label">This option controls the text color for LifterLMS' standard buttons</div>
			<?php
		}

		/////////////////////////////////////////////
		// Secondary Colors Section Output Methods //
		/////////////////////////////////////////////
		public function SecondaryButtonColorSectionOutput($value='')
		{
			?>
			<p>This section contains the fields that allow you to customize the color scheme of LifterLMS' secondary button set.</p>
			<?php
		}

		public function SecondaryButtonColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[secondary-button-color]" value="<?php echo isset($o['secondary-button-color']) ? $o['secondary-button-color'] : '#333333'; ?>" class="my-color-field" data-default-color="#333333" />
			<div class="settings_label">This option controls the main color for LifterLMS' secondary buttons (e.g., 'Take this Course', 'Sign Up')</div>
			<?php
		}

		public function SecondaryButtonHoverColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[secondary-button-hover-color]" value="<?php echo isset($o['secondary-button-hover-color']) ? $o['secondary-button-hover-color'] : '#e5554e'; ?>" class="my-color-field" data-default-color="#e5554e" />
			<div class="settings_label">This option controls the hover color for LifterLMS' secondary buttons</div>
			<?php
		}

		public function SecondaryButtonTextColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[secondary-button-text-color]" value="<?php echo isset($o['secondary-button-text-color']) ? $o['secondary-button-text-color'] : '#fefefe'; ?>" class="my-color-field" data-default-color="#fefefe" />
			<div class="settings_label">This option controls the text color for LifterLMS' secondary buttons</div>
			<?php
		}

		/////////////////////////////////////////
		// Lesson Color Section Output Methods //
		/////////////////////////////////////////
		public function LessonColorSectionOutput()
		{
			?>
			<p>This section contains the fields that allow you to customize the color scheme of LifterLMS' lessons (i.e., progress bar, lesson complete icon, etc.).</p>
			<?php
		}

		public function IncompleteLessonColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[incomplete-lesson-text-color]" value="<?php echo isset($o['incomplete-lesson-text-color']) ? $o['incomplete-lesson-text-color'] : '#cccccc'; ?>" class="my-color-field" data-default-color="#cccccc" />
			<div class="settings_label">This option controls the icon color for the incomplete lessons on the course syllabus</div>
			<?php
		}

		public function CompleteLessonColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[complete-lesson-text-color]" value="<?php echo isset($o['complete-lesson-text-color']) ? $o['complete-lesson-text-color'] : '#e5554e'; ?>" class="my-color-field" data-default-color="#e5554e" />
			<div class="settings_label">This option controls the icon color for the complete lessons on the course syllabus</div>
			<?php
		}

		public function ProgressBarBaseColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[progress-bar-base-color]" value="<?php echo isset($o['progress-bar-base-color']) ? $o['progress-bar-base-color'] : '#f1f2f1'; ?>" class="my-color-field" data-default-color="#f1f2f1" />
			<div class="settings_label">This option controls the base color for the progress bar</div>
			<?php
		}

		public function ProgressBarCompletedColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[progress-bar-completed-color]" value="<?php echo isset($o['progress-bar-completed-color']) ? $o['progress-bar-completed-color'] : '#e5554e'; ?>" class="my-color-field" data-default-color="#e5554e" />
			<div class="settings_label">This option controls the color for the completed portion of the progress bar</div>
			<?php
		}

		public function CourseSyllabusCompletedLessonColorOutput()
		{
			$o = get_option('LLMS_CustomizationSettings');
			?>
			<input type="text" name="LLMS_CustomizationSettings[course-home-completed-lesson-icon-color]" value="<?php echo isset($o['course-home-completed-lesson-icon-color']) ? $o['course-home-completed-lesson-icon-color'] : '#e5554e'; ?>" class="my-color-field" data-default-color="#e5554e" />
			<div class="settings_label">This option controls the icon color this is displayed by completed lessons on the course home page</div>
			<?php
		}

		/////////////////////////////////
		// Text Section Output Methods //
		/////////////////////////////////
		public function TextSectionOutput($arg)
		{
			?>
			<p>This section contains the fields that allow you to customize the text output of LifterLMS.</p>
			<?php	
		}

		//////////////////////////////////
		// Close Section Output Methods //
		//////////////////////////////////
		public function CloseSectionOutput()
		{
			?>
			<p>Enjoying the plugin? Maybe consider donating! There is, of course, no pressure at all! I appreciate your support and feedback as I work to make
			this plugin as useful and usable as possible. Thanks you so much for your kind support!</p>
			<?php
		}

		public function GenerateAdminPage()
		{
			?>
			<div class="wrap">
				<h2>LifterLMS Customization</h2>
				<form method="post" action="options.php">
				    <?php settings_fields( 'LLMS_CustomizationSettings' ); ?>
				    <?php do_settings_sections( 'lifterlms_custom_open' ); ?>
				    <div id="advanced_color_content" style="display:none;">
				    <?php do_settings_sections( 'lifterlms_custom' ); ?>
				    </div>
				    <?php do_settings_sections( 'lifterlms_custom_close' ); ?>				    
				    <?php submit_button(); ?>
				</form>
				</div>

			</div>
			<?php
		}		
	}
endif;
return new LLMS_Customization;

?>