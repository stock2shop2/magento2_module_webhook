<?php
namespace Stock2Shop\OrderExport;
use Magento\Sales\Api\Data\OrderAddressInterface as IOA;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
use Magento\Sales\Model\Order\Item as OI;
// 2018-08-11 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
final class Payload {
	/**
	 * 2018-08-11
	 * @used-by json()
	 * @param IOA|OA|null $a
	 * @return array(string => mixed)
	 */
	private function address(IOA $a) {return !$a ? [] : dfa_remove_objects($a);}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @return array(string => mixed)
	 */
	private function items() {return df_oqi_leafs($this->_o, function(OI $i) {return [
		'name' => $i->getName()
		,'image' => df_oqi_image($i)
		,'price' => df_oqi_price($i)
		,'price_with_discount' => df_oqi_price($i, false, true)
		,'price_with_discount_and_tax' => df_oqi_price($i, true, true)
		,'price_with_tax' => df_oqi_price($i, true)
		,'qty' => df_oqi_qty($i)
		,'tax_rate' => df_oqi_tax_rate($i)
		,'url' => df_oqi_url($i)
	];});}

	/**
	 * 2018-08-11
	 * @used-by json()
	 * @return array(string => mixed)
	 */
	private function payment() {return array_filter(
		dfa_remove_objects($this->_o->getPayment())
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
		,'customer' => !($cid = $o->getCustomerId()) ? [] : dfa_remove_objects(df_customer($cid))
		,'line_items' => $i->items()
		,'payment' => $i->payment()
		,'shipping_address' => $i->address($o->getShippingAddress())
		,'visitor' => $i->visitor()
	] + dfa_remove_objects($o));}
}