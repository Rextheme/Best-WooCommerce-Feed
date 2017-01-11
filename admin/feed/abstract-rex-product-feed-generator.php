<?php

/**
 * Abstract Rex Product Feed Generator
 *
 * A abstract class definition that includes functions used for generating xml feed.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 * The XML Feed Generator.
 *
 * This is used to generate xml feed based on given settings.
 *
 * @since      1.0.0
 * @package    Rex_Product_Feed_Abstract_Generator
 * @author     RexTheme <info@rextheme.com>
 */
abstract class Rex_Product_Feed_Abstract_Generator {

  /**
   * Get the products to generate feed.
   *
   **/
  protected function get_products( $args = array() ) {

    $args = array(
      'post_type'      => 'product',
      'posts_per_page' => -1
    );

    $products = get_posts( $args );

    return $products;

  }


  /**
   * Get Product data.
   *
   * @return array
   **/
  protected function get_product_data( $id = false ){
    $product = new WC_Product($id);

    return array(
      'id'       => $product->get_id(),
      'title'    => $product->get_title(),
      'desc'     => $product->get_post_data()->post_excerpt,
      'link'     => $product->get_permalink(),
      'image'    => wp_get_attachment_url( $product->get_image_id() ),
      'stock'    => 'in stock',// $product->get_availability()['class'],
      'price'    => $product->get_price(),
      'currency' => get_woocommerce_currency(),
    );
  }

  /**
   * Responsible for creating the feed.
   * @return string
   **/
  abstract protected function make_feed();

}
