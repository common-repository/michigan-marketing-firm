<?php
defined('ABSPATH') or die('No script kiddies please!');

// define variables
$logo = 'images/mi-icon-2.png';
// end variables

add_action('admin_menu', 'mimf_add_admin_menu');
add_action('admin_init', 'mimf_settings_init');

// adds menu page to admin sidebar
function mimf_add_admin_menu()
{
    add_menu_page('Michigan Marketing Firm', 'MI Marketing', 'manage_options', 'michigan_marketing_firm', 'mimf_options_page', plugin_dir_url(__FILE__) . 'images/mi-icon-2.png');
}


function mimf_settings_init()
{

  // register plugin settings
    register_setting('pluginPage', 'mimf_msg_settings');
    register_setting('pluginPage', 'mimf_settings');
    register_setting('pluginPage', 'mimf_hide_page');
    register_setting('pluginPage', 'mimf_hide_toolbar');
    register_setting('pluginPage', 'mimf_slogan_show');
    register_setting('pluginPage', 'mimf_particlejs');
    register_setting('pluginPage', 'mimf_conditional_script');

    // add settings section
    add_settings_section(
        'mimf_pluginPage_section',
        __('MIMF Settings', 'wordpress'),
        'mimf_settings_section_callback',
        'pluginPage'
    );

    // add admin message settings field
    add_settings_field(
        'mimf_select_field_0',
        __('Admin Messages', 'wordpress'),
        'mimf_select_field_0_render',
        'pluginPage',
        'mimf_pluginPage_section'
    );

    // add login message settings field
    add_settings_field(
        'mimf_select_field_1',
        __('Login Messages', 'wordpress'),
        'mimf_select_field_1_render',
        'pluginPage',
        'mimf_pluginPage_section'
    );

    // add hide pages settings field
    add_settings_field(
        'mimf_select_field_2',
        __('Hide Extra Pages', 'wordpress'),
        'mimf_select_field_2_render',
        'pluginPage',
        'mimf_pluginPage_section'
    );

    // add hide toolbar settings field
    add_settings_field(
        'mimf_select_field_3',
        __('Hide Toolbar', 'wordpress'),
        'mimf_select_field_3_render',
        'pluginPage',
        'mimf_pluginPage_section'
    );

    // add hide toolbar settings field
    add_settings_field(
        'mimf_select_field_4',
        __('Lyrics', 'wordpress'),
        'mimf_select_field_4_render',
        'pluginPage',
        'mimf_pluginPage_section'
    );

    add_settings_field(
      'mimf_texareat_field_0',
      __('Particle JS', 'wordpress'),
      'mimf_textarea_field_5_render',
      'pluginPage',
      'mimf_pluginPage_section'
    );

    add_settings_field(
      'mimf_texareat_field_1',
      __('Conditional Scripts', 'wordpress'),
      'mimf_textarea_field_6_render',
      'pluginPage',
      'mimf_pluginPage_section'
    );
}

// render checkbox option 0
function mimf_select_field_0_render()
{
    echo '<input name="mimf_msg_settings" id="eg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option('mimf_msg_settings'), false) . ' /> ';
}

// render checkbox option 1
function mimf_select_field_1_render()
{
    echo '<input name="mimf_settings" id="eg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option('mimf_settings'), false) . ' /> ';
}

// render checkbox option 2
function mimf_select_field_2_render()
{
    echo '<input name="mimf_hide_page" id="eg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option('mimf_hide_page'), false) . ' /> ';
}

// render checkbox option 3
function mimf_select_field_3_render()
{
    echo '<input name="mimf_hide_toolbar" id="eg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option('mimf_hide_toolbar'), false) . ' /> ';
}

// render checkbox option 4
function mimf_select_field_4_render()
{
    echo '<input name="mimf_slogan_show" id="eg_setting_name" type="checkbox" value="1" class="code" ' . checked(1, get_option('mimf_slogan_show'), false) . ' /> ';
}

// render textbox option 5
function mimf_textarea_field_5_render()
{
    $options = get_option('mimf_particlejs'); ?>
	<textarea cols='40' rows='5' name='mimf_particlejs[mimf_textarea_field_5]'><?php echo $options['mimf_textarea_field_5']; ?></textarea>
	<?php
}

// render textbox 6
function mimf_textarea_field_6_render()
{
    $options = get_option('mimf_conditional_script'); ?>
	<textarea cols='40' rows='5' name='mimf_conditional_script[mimf_textarea_field_6]'><?php echo $options['mimf_textarea_field_6']; ?></textarea>
	<?php
}

// render the section callback
function mimf_settings_section_callback()
{
    echo __('', 'wordpress');
}

// Render the options form
function mimf_options_page()
{
    ?>
    <!-- add styles here -->
	<form action='options.php' method='post' class="mi-opt-form">
<div class="inner-opt-mi">
    <img class"mi-opt-img" src="<?php echo plugin_dir_url(__FILE__) . 'images/mi-logo-opt.png'; ?>" style="width: 206px">

		<h2 class="mi-title">Michigan Marketing Firm</h2>
    <div class="mimf-toggle">
		<?php
        settings_fields('pluginPage');
    do_settings_sections('pluginPage');
    submit_button(); ?>
  </div>
<h3 class="mi-footer">Learn more at <a href="https://michiganmarketingfirm.com">Michigan Marketing Firm</a></h3>

<p class="mimf-credits">Plugin designed and maintained by <strong><a href="https://github.com/Alexyoe" target="_blank">Alex Yoesting</a></strong></p>
<h4><?php echo current_time('h:i a e') ?> on <?php echo current_time('D, M jS, Y') ?></h4>
</div>
	</form>
	<?php
}

?>
