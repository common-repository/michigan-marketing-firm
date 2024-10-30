<?php
/**
 * Plugin Name: Michigan Marketing Firm
 * Plugin URI: http://www.MichiganMarketingFirm.com
 * Description: Plugin to add functionality to wordpress for Michigan Marketing Firm Clients.
 * Version: 1.1.1
 * Author: Alex Yoesting
 * Author URI: http://www.alexyoesting.com
 */

defined('ABSPATH') or die('No script kiddies please!');


// define plugin location
define('MIMF_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MIMF_PLUGIN_URL', plugin_dir_url(__FILE__));

// include settings page
$file = MIMF_PLUGIN_DIR . 'mi-options.php';
include_once("$file");

// include slogans
$file2 = MIMF_PLUGIN_DIR . 'extras/happy.php';
include_once("$file2");

 // adds dashboard widget for MI Marketing
 function mimf_custom_dashboard_widgets()
 {
     global $wp_meta_boxes;

     wp_add_dashboard_widget('mimf_help_widget', 'Michigan Marketing Firm', 'mimf_dashboard_help');
 }

 function mimf_dashboard_help()
 {
     echo '<center><img src="' . MIMF_PLUGIN_URL . 'images/mi-logo-opt.png" height="200" width="200"><br><p>Welcome to your website! Need help? Contact the developer <a href="mailto:alex@michiganmarketingfirm.com">here</a>. For More Information visit: <a href="https://www.michiganmarketingfirm.com" target="_blank">Michigan Marketing Firm</a></p></center>';
 }
 add_action('wp_dashboard_setup', 'mimf_custom_dashboard_widgets');

 // adds footer to admin panel
 function mimf_remove_footer_admin()
 {
     echo 'Powered by <a href="http://www.michiganmarketingfirm.com" target="_blank">Michigan Marketing Firm</a> | Design by: <sterong><a href="https://github.com/Alexyoe" target="_blank">Alex Yoesting</a></stong></p>';
 }

 add_filter('admin_footer_text', 'mimf_remove_footer_admin');

 // add custom error message
 function mimf_no_wordpress_errors()
 {
     return '<strong>Ya Blew It!</strong>';
 }
 add_filter('login_errors', 'mimf_no_wordpress_errors');

 //* Add custom message to WordPress login page

 function mimf_custom_login_message($message)
 {
     if ((empty($message)) && (get_option('mimf_settings'))) {
         return '<div class="message"><p><strong>Just easin the tension baby!</strong></p></div>';
     } else {
         return $message;
     }
 }

 add_filter('login_message', 'mimf_custom_login_message');

 // adds message to admin panel
 function mimf_inform_user()
 {
     if (get_option('mimf_msg_settings')) {
         echo '<div class="notice notice-success idivi-notice " data-notice-id="idivi-notice"><p>Just easin the tension baby!</p></div>';
     } else {
         echo "";
     }
 }
 add_action('admin_notices', 'mimf_inform_user');

 // remove welcome from admin
 remove_action('welcome_panel', 'wp_welcome_panel');


// adds css to mimf settings page
function mimf_wp_admin_style()
{
    wp_enqueue_style('mimf_wp_admin_css', plugins_url('/css/admin-style.min.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'mimf_wp_admin_style');

// add settings link to plugin
function mimf_add_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=michigan_marketing_firm">' . __('Settings') . '</a>';
    array_push($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'mimf_add_settings_link');

// hides a few things from sidebar admin
function mimf_remove_tabs()
{
    if (get_option('mimf_hide_page')) {
        remove_menu_page('users.php');
        remove_menu_page('tools.php');
        remove_menu_page('edit.php?post_type=project');
        remove_menu_page('edit-comments.php');
    } else {
    }
}
add_action('admin_menu', 'mimf_remove_tabs');

// Remove the admin bar from the front end
function mimf_admin_toolbar()
{
    if (get_option('mimf_hide_toolbar')) {
        show_admin_bar('flase');
    } else {
    }
}

add_action('admin_init', 'mimf_admin_toolbar');

// adds admin Toolbar
$settingsurl = 'admin_url() . admin.php?page=michigan_marketing_firm';

function mimf_add_toolbar_items($admin_bar)
{
    $main_label = '<img style="height: 20px; margin-bottom: -4px; padding-right: 3px;" src="' . MIMF_PLUGIN_URL . 'images/mi-icon-2.png" alt="Test"> <span class="ab-label">' . __('Michigan Marketing Firm', 'michigan-marketing-firm') . '</span>';

    $admin_bar->add_menu(array(
        'id'    => 'MichiganMarketingFirm',
        'title'  => $main_label,
        'href'  => '#',

    ));
    $admin_bar->add_menu(array(
        'id'    => 'sub-settings',
        'parent' => 'MichiganMarketingFirm',
        'title' => 'Settings',
        'href'  => admin_url('admin.php?page=michigan_marketing_firm'),
        'meta'  => array(
            'title' => __('Settings'),
            'target' => '',
            'class' => 'my_menu_item_class'
        ),
    ));
}
add_action('admin_bar_menu', 'mimf_add_toolbar_items', 100);

// Conditially load things based on user being logged in
function mimf_cond_load()
{
    if (is_user_logged_in()) {
    } else {
        echo implode(get_option('mimf_conditional_script'));
    }
}
add_action('wp_footer', 'mimf_cond_load');

// Register more menus if needed
register_nav_menus(array(
  'primary-menu-2'   => esc_html__('Primary Menu Two', 'Divi'),
));

// enque the particle js script

function mimf_particlejs_enqueue_script()
{
    wp_enqueue_script('mimf_particlejs', plugin_dir_url(__FILE__) . '/includes/particles.min.js', false);
}
add_action('wp_enqueue_scripts', 'mimf_particlejs_enqueue_script');

// echo the particle js from the setting spage in footer
function mimf_output_particlejs()
{
    ?>
        <script type="text/javascript">
           <?php echo implode(get_option('mimf_particlejs')); ?>
        </script>

        <style type="text/css">
            canvas.particles-js-canvas-el {
                position: absolute;
                top: 0;
                left: 0;
            }
        </style>
    <?php
}
add_action('wp_footer', 'mimf_output_particlejs');
