<?php
/**
 * Plugin Name:     Frontify
 * Plugin URI:      https://www.frontify.com
 * Author:          Frontify
 * Description:     Frontify Media Library Integration
 * Version:         0.0.1
 * License:         GPL2
 */

defined( 'ABSPATH' ) || exit;

function frontify_register_block() {
    if (!function_exists('register_block_type')) {
        return;
    }

    $asset_file = include(plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

    wp_register_script(
        'frontify-script',
        plugins_url('build/index.js', __FILE__),
        $asset_file['dependencies'],
        $asset_file['version']
    );
    wp_register_style(
        'frontify-styles',
        plugins_url('styles.css', __FILE__),
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path( __FILE__ ) . 'styles.css' )
    );

    register_block_type('frontify/dam', [
        'editor_script' => 'frontify-script',
        'editor_style' => 'frontify-styles',
        'attributes' => [
            'base_url' => [
                'type' => 'string',
                'default' => esc_attr(get_option('frontify_url', '')) . '/external-asset-chooser'
            ],
            'api_token' => [
                'type' => 'string',
                'default' => esc_attr(get_option('frontify_api_token', ''))
            ],
            'title' => [
                'type' => 'string',
                'default' => '',
            ],
            'caption' => [
                'type' => 'array',
                'source' => 'children',
                'selector' => 'figcaption'
            ],
            'asset_url' => [
                'type' => 'string'
            ],
            'hide_chooser' => [
                'type' => 'boolean',
                'default' => true
            ]
        ]
    ]

    );

}

add_action('init', 'frontify_register_block');

function frontify_settings_page() {
    add_submenu_page(
        'options-general.php',
        'Frontify Settings',
        'Frontify',
        'manage_options',
        'frontify-settings',
        'frontify_settings_page_html'
    );
    add_action('admin_init', 'frontify_settings_init');
}

add_action('admin_menu', 'frontify_settings_page');

function frontify_settings_init() {
    add_settings_section(
        'frontify-settings-section',
        'Frontify Settings',
        '',
        'frontify-settings'
    );

    register_setting(
        'frontify-settings',
        'frontify_api_token'
    );
    register_setting(
        'frontify-settings',
        'frontify_url'
    );

    add_settings_field(
        'frontify-api-token',
        'API Token',
        'frontify_token_settings_cb',
        'frontify-settings',
        'frontify-settings-section'
    );
    add_settings_field(
        'frontify-url',
        'URL',
        'frontify_url_settings_cb',
        'frontify-settings',
        'frontify-settings-section'
    );
}

function frontify_token_settings_cb() {
    $token = esc_attr(get_option('frontify_api_token', ''));
    ?>
    <div>
        <input id="title" type="text" name="frontify_api_token" class="regular-text" value="<?php echo $token; ?>">
        <p class="description">Your Frontify access token</p>
    </div>
    <?php
}

function frontify_url_settings_cb() {
    $url = esc_attr(get_option('frontify_url', ''));
    ?>
    <div>
        <input id="title" type="text" name="frontify_url" class="regular-text" value="<?php echo $url; ?>">
        <p class="description">Your Frontify domain, e.g. https://weare.frontify.com</p>
    </div>
    <?php
}

function frontify_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>

    <div class="wrap">
        <form method="POST" action="options.php">
            <?php settings_fields('frontify-settings');?>
            <?php do_settings_sections('frontify-settings')?>
            <?php submit_button();?>
        </form>
    </div>
    <?php
}
