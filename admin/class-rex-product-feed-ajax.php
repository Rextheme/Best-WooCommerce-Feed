<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Rex_Product_Metabox
 * @subpackage Rex_Product_Feed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines all the Metaboxes for Products
 *
 * @package    Rex_Product_Metabox
 * @subpackage Rex_Product_Feed/admin
 * @author     RexTheme <info@rextheme.com>
 */
class Rex_Product_Feed_Ajax {

  /**
   * Hook in ajax handlers.
   *
   * @since    1.0.0
   */
  public static function init() {

    $validations = array(
      'logged_in' => true,
      'user_can'  => 'manage_options',
    );

    wp_ajax_helper()->handle( 'my-handle' )
      ->with_callback( array( 'Rex_Product_Feed_Ajax', 'generate_feed' ) )
      ->with_validation( $validations );
  }

  public function generate_feed( $payload ){

    try {
      $merchant = Rex_Product_Feed_Factory::build('google');
    } catch (Exception $e) {
      return $e->getMessage();
    }

  }

}
