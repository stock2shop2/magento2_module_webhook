<?php
namespace Stock2Shop\OrderExport\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order as O;
use Stock2Shop\OrderExport\API\Facade;
use Stock2Shop\OrderExport\Payload;
use Stock2Shop\OrderExport\Settings as S;
// 2018-08-11 Dmitry Fedyuk https://www.upwork.com/fl/mage2pro
final class OrderSaveAfter implements ObserverInterface {
	/**
	 * 2018-08-11
	 * @override
	 * @see ObserverInterface::execute()
	 * @param Observer $ob
	 */
	function execute(Observer $ob) {
		static $in; /** @var bool $in */
		if (!$in) {
			$in = true;
			try {
				$o = $ob['order']; /** @var O $o */
				if (S::s()->enable($o->getStore())) {
					/** @var string $state */ /** @var string $status */
					list($state, $status) = [$o->getState(), $o->getStatus()];
					df_order_comment($o, df_cc_n(
						"The Stock2Shop's webhook is notified."
						,"The order's status: «{$status}»"
						,"The order's state: «{$state}»"
						,sprintf("The webhook's response: «%s»", df_chop(
							df_try(
								function() use($o) {return Facade::s()->post(Payload::get($o))[0];}
								,function(\Exception $e) {return df_etsd($e);}
							)
						, 25000))
					));
				}
			}
			finally {$in = false;}
		}
	}
}