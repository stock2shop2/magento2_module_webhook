<?php
namespace Stock2Shop\OrderExport;
use Magento\Sales\Api\Data\OrderAddressInterface as IOA;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
// 2018-08-11 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
final class Payload {
	/**
	 * 2018-08-11
	 * @used-by json()
	 * @param IOA|OA|null $a
	 * @return array(string => mixed)
	 */
	private function address(IOA $a) {return !$a ? [] : dfa_remove_objects($a->getData());}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @return array(string => mixed)
	 */
	private function customer() {return [];}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @return array(string => mixed)
	 */
	private function items() {return [];}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @return array(string => mixed)
	 */
	private function payment() {return array_filter(
		dfa_remove_objects($this->_o->getPayment()->getData())
		,function($k) {return !df_starts_with($k, 'cc_');}
		,ARRAY_FILTER_USE_KEY
	);}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @return array(string => mixed)
	 */
	private function visitor() {return [
		'http_user_agent' => df_request_ua()
		,'http_x_forwarded_for' => dfa($_ENV, 'HTTP_X_FORWARDED_FOR')
		,'http_via' => dfa($_ENV, 'HTTP_VIA')
		,'remote_addr' => df_visitor_ip()
	];}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @var O
	 */
	private $_o;

	/**
	 * 2018-08-11
	 * @used-by \Stock2Shop\OrderExport\Observer\OrderSaveAfter::execute()
	 * @param O $o
	 * @return string
	 */
	static function json(O $o) {$i = new self; $i->_o = $o; return df_json_encode([
		'billing_address' => $i->address($o->getBillingAddress())
		,'customer' => $i->customer()
		,'line_items' => $i->items()
		,'payment' => $i->payment()
		,'shipping_address' => $i->address($o->getShippingAddress())
		,'visitor' => $i->visitor()
	] + dfa_remove_objects($o->getData()));}
}