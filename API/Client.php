<?php
namespace Stock2Shop\OrderExport\API;
use Stock2Shop\OrderExport\Settings as S;
// 2018-08-11 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
final class Client extends \Df\API\Client {
	/**
	 * 2018-08-11
	 * @override
	 * @see \Df\API\Client::_construct()
	 * @used-by \Df\API\Client::__construct()
	 */
	protected function _construct() {parent::_construct(); $this->reqJson();}

	/**
	 * 2018-08-11
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by url()
	 * @return string
	 */
	protected function urlBase() {return S::s()->url();}
}