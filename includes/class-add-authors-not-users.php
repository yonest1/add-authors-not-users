<?php

/**
 *
 * @link       http://addusersnotauthors.com
 * @since      1.0.0
 *
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/includes
 */

/**
 *
 * @since      1.0.0
 * @package    Add_Authors_Not_Users
 * @subpackage Add_Authors_Not_Users/includes
 * @author     Yonatan Est <	heyyonatane@gmail.com>
 */
class Add_Authors_Not_Users {

	/**
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Add_Authors_Not_Users_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'add-authors-not-users';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-add-authors-not-users-loader.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-add-authors-not-users-i18n.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-add-authors-not-users-admin.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-add-authors-not-users-public.php';

		$this->loader = new Add_Authors_Not_Users_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Add_Authors_Not_Users_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Add_Authors_Not_Users_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'aanu_meta_box' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'aanu_meta_box_save');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Add_Authors_Not_Users_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		
		$this->loader->add_filter( 'the_author', $plugin_public, 'author_name' );
		$this->loader->add_filter( 'get_the_author_display_name', $plugin_public, 'author_name' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Add_Authors_Not_Users_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
