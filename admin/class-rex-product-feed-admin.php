<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/admin
 * @author     RexTheme <info@rextheme.com>
 */
class Rex_Product_Feed_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


  /**
   * Metabox instance of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      object    $metabox    The current metabox of this plugin.
   */
  private $cpt;

  /**
   * Metabox instance of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      object    $metabox    The current metabox of this plugin.
   */
  private $metabox;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version     = $version;
    $this->cpt         = new Rex_Product_CPT;
    $this->metabox     = new Rex_Product_Metabox;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rex_Product_Feed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rex_Product_Feed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

    $screen = get_current_screen();

    if( $hook != 'post.php' && $hook != 'post-new.php' ){
      return;
    }

    if ( $screen->post_type === 'product-feed' ) {
      wp_enqueue_style( 'materialize-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), $this->version, 'all' );
      wp_enqueue_style( 'materialize-css', plugin_dir_url( __FILE__ ) . 'css/materialize.min.css', array(), $this->version, 'all' );
  		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rex-product-feed-admin.css', array(), $this->version, 'all' );
    }


	}

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts($hook) {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Rex_Product_Feed_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Rex_Product_Feed_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    if( $hook != 'post.php' && $hook != 'post-new.php' ){
      return;
    }

    wp_enqueue_script( 'materialize-js', plugin_dir_url( __FILE__ ) . 'js/materialize.min.js', array( 'jquery' ), $this->version, false );
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rex-product-feed-admin.js', array( 'jquery' ), $this->version, false );

  }

  /**
   * Register CPT for the Plugin
   *
   * @since    1.0.0
   */
  public function register_cpt() {
    $this->cpt->register();
  }

	/**
	 * Register All the Metaboxes for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_metaboxes() {
    $this->metabox->register();
	}

}
