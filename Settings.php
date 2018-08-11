<?php
namespace Stock2Shop\OrderExport;
// 2018-08-11 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
/** @method static Settings s() */
final class Settings extends \Df\Config\Settings {
	/**
	 * 2018-08-11
	 * @used-by \Stock2Shop\OrderExport\Client::urlBase()
	 * @return string
	 */
	function url() {return $this->v();}

	/**
	 * 2018-08-11
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'stock2shop/order_export';}
}