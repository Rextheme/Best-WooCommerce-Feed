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
	 * The Product/Feed ID.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rex_Product_Feed_Abstract_Generator    id    Feed id.
	 */
	protected $id;

	/**
	 * The Product Query args to retrieve specific products for making the Feed.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rex_Product_Feed_Abstract_Generator    $products_args    Contains products query args for feed.
	 */
	protected $products_args;

	/**
	 * The Product Query args to retrieve specific products for making the Feed.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rex_Product_Feed_Abstract_Generator    $products    Contains all products to make feed.
	 */
	protected $products;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $config ) {

		$this->id = $config['post_id'];
		$this->prepare_products_args( $config['products'] );
		$this->get_products();

	}

	/**
	 * Prepare the Products Query args for retrieving  products.
	 *
	 **/
	protected function prepare_products_args( $args ) {

		$this->products_args = array(
			'post_type'      => 'product',
			'posts_per_page' => -1,
		);

		if ( $args['products_scope'] !== 'all') {
			$terms = $args['products_scope'] === 'product_tag' ? 'tags' : 'cats';

			$this->products_args['tax_query'][] = array(
				'taxonomy' => $args['products_scope'],
				'field'    => 'slug',
				'terms'    => $args[$terms]
			);
		}
	}


	/**
	 * Get the products to generate feed.
	 *
	 **/
	protected function get_products() {

		$this->products = get_posts( $this->products_args );

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
	 * Save the feed as XML file.
	 *
	 * @return boolean
	 **/
	protected function save_feed( $feed ){
		$path  = wp_upload_dir();
		$path  = $path['basedir'] . '/rex-feed';

		// make directory if not exist
		if ( !file_exists($path) ) {
			wp_mkdir_p($path);
		}

		$file = trailingslashit($path) . "feed-{$this->id}.xml";

		return (bool) file_put_contents($file, $feed);
	}

	/**
	 * Responsible for creating the feed.
	 * @return string
	 **/
	abstract public function make_feed();

}
