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
class Rex_Product_CPT {

  /**
   * Register all metaboxes.
   *
   * @since    1.0.0
   */
  public function register() {
    $this->post_types();
  }

  /**
   * Metabox for Google Merchant.
   *
   * @since    1.0.0
   */
  private function post_types(){
    register_extended_post_type( 'product-feed', array(
      'supports' => array( 'title' ),
      'enter_title_here' => 'Enter feed title here'
    ));
  }

}
