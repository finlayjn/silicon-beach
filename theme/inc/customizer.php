<?php

/**
 * Customizer settings for DaisyUI theme variables
 *
 * This file adds customizer settings to allow users to modify DaisyUI theme variables
 * directly from the WordPress Customizer.
 *
 * @package Silicon_Beach
 */

function silicon_beach_customize_register($wp_customize)
{
    // Section for DaisyUI Theme Variables
    $wp_customize->add_section('daisyui_theme_variables', array(
        'title'    => __('DaisyUI Theme Variables', 'silicon-beach'),
        'priority' => 30,
    ));

    // List of DaisyUI variables
    $variables = array(
        '--color-base-100' => 'Base 100',
        '--color-base-200' => 'Base 200',
        '--color-base-300' => 'Base 300',
        '--color-base-content' => 'Base Content',
        '--color-primary' => 'Primary',
        '--color-primary-content' => 'Primary Content',
        '--color-secondary' => 'Secondary',
        '--color-secondary-content' => 'Secondary Content',
        '--color-accent' => 'Accent',
        '--color-accent-content' => 'Accent Content',
        '--color-neutral' => 'Neutral',
        '--color-neutral-content' => 'Neutral Content',
        '--color-info' => 'Info',
        '--color-info-content' => 'Info Content',
        '--color-success' => 'Success',
        '--color-success-content' => 'Success Content',
        '--color-warning' => 'Warning',
        '--color-warning-content' => 'Warning Content',
        '--color-error' => 'Error',
        '--color-error-content' => 'Error Content',
        '--radius-selector' => 'Radius Selector',
        '--radius-field' => 'Radius Field',
        '--radius-box' => 'Radius Box',
        '--size-selector' => 'Size Selector',
        '--size-field' => 'Size Field',
        '--border' => 'Border',
        '--depth' => 'Depth',
        '--noise' => 'Noise',
    );

    foreach ($variables as $variable => $label) {
        $setting_id = str_replace('--', '', $variable); // Remove '--' for setting ID

        // Determine control type
        if (
            strpos($setting_id, 'radius') !== false ||
            strpos($setting_id, 'size') !== false
        ) {
            $control_type = 'number';
        } elseif (
            $setting_id === 'depth' ||
            $setting_id === 'noise'
        ) {
            $control_type = 'checkbox';
        } elseif (
            strpos($setting_id, 'color') !== false ||
            strpos($setting_id, 'content') !== false ||
            strpos($setting_id, 'primary') !== false ||
            strpos($setting_id, 'secondary') !== false ||
            strpos($setting_id, 'accent') !== false ||
            strpos($setting_id, 'neutral') !== false ||
            strpos($setting_id, 'info') !== false ||
            strpos($setting_id, 'success') !== false ||
            strpos($setting_id, 'warning') !== false ||
            strpos($setting_id, 'error') !== false
        ) {
            $control_type = 'color';
        } else {
            $control_type = 'text';
        }

        // Choose a sanitize callback suitable for the type
        $sanitize_callback = 'sanitize_text_field';
        if ($control_type === 'color') {
            $sanitize_callback = 'sanitize_hex_color';
        } elseif ($control_type === 'checkbox') {
            $sanitize_callback = 'silicon_beach_sanitize_checkbox';
        } elseif ($control_type === 'number') {
            $sanitize_callback = 'silicon_beach_sanitize_number';
        }

        // Add setting
        $wp_customize->add_setting($setting_id, array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => $sanitize_callback,
            'capability'        => 'edit_theme_options',
        ));

        // Add control (use the proper Color Control to enqueue color picker scripts)
        if ($control_type === 'color') {
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $setting_id,
                array(
                    'label'    => $label,
                    'section'  => 'daisyui_theme_variables',
                    'settings' => $setting_id,
                )
            ));
        } else {
            $wp_customize->add_control($setting_id, array(
                'label'    => $label,
                'section'  => 'daisyui_theme_variables',
                'settings' => $setting_id,
                'type'     => $control_type,
            ));
        }
    }

    // Front Page section
    $wp_customize->add_section('front_page', array(
        'title'    => __('Front Page', 'silicon-beach'),
        'priority' => 31,
    ));

    // Hero Background (image)
    $wp_customize->add_setting('hero_background', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_background',
        array(
            'label'    => __('Hero Background', 'silicon-beach'),
            'section'  => 'front_page',
            'settings' => 'hero_background',
        )
    ));

    // Logo (image)
    $wp_customize->add_setting('logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'logo',
        array(
            'label'    => __('Logo', 'silicon-beach'),
            'section'  => 'front_page',
            'settings' => 'logo',
        )
    ));

    // Hero Title (text)
    $wp_customize->add_setting('hero_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'silicon-beach'),
        'section'  => 'front_page',
        'settings' => 'hero_title',
        'type'     => 'text',
    ));

    // Hero Tagline (text)
    $wp_customize->add_setting('hero_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control('hero_tagline', array(
        'label'    => __('Hero Tagline', 'silicon-beach'),
        'section'  => 'front_page',
        'settings' => 'hero_tagline',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'silicon_beach_customize_register');

// Sanitize helpers
function silicon_beach_sanitize_checkbox($value) {
    return $value ? 1 : 0;
}
function silicon_beach_sanitize_number($value) {
    return is_numeric($value) ? $value : '';
}

// Output customizer settings as CSS variables
function silicon_beach_customizer_css()
{
?>
    <style type="text/css">
        :root {
            <?php
            $variables = array(
                '--color-base-100',
                '--color-base-200',
                '--color-base-300',
                '--color-base-content',
                '--color-primary',
                '--color-primary-content',
                '--color-secondary',
                '--color-secondary-content',
                '--color-accent',
                '--color-accent-content',
                '--color-neutral',
                '--color-neutral-content',
                '--color-info',
                '--color-info-content',
                '--color-success',
                '--color-success-content',
                '--color-warning',
                '--color-warning-content',
                '--color-error',
                '--color-error-content',
                '--radius-selector',
                '--radius-field',
                '--radius-box',
                '--size-selector',
                '--size-field',
                '--border',
                '--depth',
                '--noise',
            );

            foreach ($variables as $variable) {
                $setting_id = str_replace('--', '', $variable); // Remove '--' for setting ID
                $value = get_theme_mod($setting_id, '');
                if ($value !== '' && $value !== null) {
                    echo esc_html("{$variable}: {$value};\n");
                }
            }
            ?>
        }
    </style>
<?php
}

function silicon_beach_customizer_styles() {
    // Always print in controls frame; no is_customize_preview() check here
    echo '<style>
        #customize-control-color-base-100,
        #customize-control-color-base-200,
        #customize-control-color-base-300,
        #customize-control-color-base-content,
        #customize-control-color-primary,
        #customize-control-color-primary-content,
        #customize-control-color-secondary,
        #customize-control-color-secondary-content,
        #customize-control-color-accent,
        #customize-control-color-accent-content,
        #customize-control-color-neutral,
        #customize-control-color-neutral-content,
        #customize-control-color-info,
        #customize-control-color-info-content,
        #customize-control-color-success,
        #customize-control-color-success-content,
        #customize-control-color-warning,
        #customize-control-color-warning-content,
        #customize-control-color-error,
        #customize-control-color-error-content {
            width: 48%;
            float: left;
            margin-right: 4%;
        }
        #customize-control-color-base-content,
        #customize-control-color-primary-content,
        #customize-control-color-secondary-content,
        #customize-control-color-accent-content,
        #customize-control-color-neutral-content,
        #customize-control-color-info-content,
        #customize-control-color-success-content,
        #customize-control-color-warning-content,
        #customize-control-color-error-content {
            margin-right: 0;
        }
    </style>';
}

// Ensure color picker assets are available in the controls frame
function silicon_beach_customizer_enqueue() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}

add_action('wp_head', 'silicon_beach_customizer_css');
add_action('customize_controls_print_styles', 'silicon_beach_customizer_styles');
add_action('customize_controls_enqueue_scripts', 'silicon_beach_customizer_enqueue');
