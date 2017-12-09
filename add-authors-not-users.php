<?php

/**
 *
 * @link              http://addusersnotauthors.com
 * @since             1.0.0
 * @package           Add_Authors_Not_Users
 *
 * @wordpress-plugin
 * Plugin Name:       Add authors not users
 * Plugin URI:        http://addusersnotauthors.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Yonatan Est
 * Author URI:        http://addusersnotauthors.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       add-authors-not-users
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-add-authors-not-users-activator.php
 */
function activate_add_authors_not_users() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-add-authors-not-users-activator.php';
	Add_Authors_Not_Users_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-add-authors-not-users-deactivator.php
 */
function deactivate_add_authors_not_users() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-add-authors-not-users-deactivator.php';
	Add_Authors_Not_Users_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_add_authors_not_users' );
register_deactivation_hook( __FILE__, 'deactivate_add_authors_not_users' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-add-authors-not-users.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_add_authors_not_users() {

	$plugin = new Add_Authors_Not_Users();
	$plugin->run();

}
run_add_authors_not_users();
