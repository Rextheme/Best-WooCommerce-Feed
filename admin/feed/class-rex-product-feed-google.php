<?php

/**
 * The file that generates xml feed for Google.
 *
 * A class definition that includes functions used for generating xml feed.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Rex_Product_Feed_Google
 * @subpackage Rex_Product_Feed_Google/includes
 * @author     RexTheme <info@rextheme.com>
 */

use LukeSnowden\GoogleShoppingFeed\Containers\GoogleShopping;

class Rex_Product_Feed_Google extends Rex_Product_Feed_Abstract_Generator {

	/**
	 * Create Feed for Google
	 *
	 * @return boolean
	 * @author
	 **/
	public function make_feed() {

		GoogleShopping::title($this->title);
		GoogleShopping::link($this->link);
		GoogleShopping::description($this->desc);

		foreach( $this->products as $product ) {

			$data = $this->get_product_data( $product->ID );

			$item = GoogleShopping::createItem();
			$item->id($data['id']);
			$item->title($data['title']);
			$item->description($data['desc']);
			$item->price($data['price']);
			$item->availability($data['availability']);
			$item->condition('new');
            $item->mpn($data['sku']);
            $item->identifier_exists('no');
			$item->link($data['link']);
			$item->image_link($data['image']);

		}

		$this->feed = GoogleShopping::asRss();
		return $this->save_feed();

	}

}
