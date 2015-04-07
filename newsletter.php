<?php


require_once 'abstract.php';

/**
 * Magento Compiler Shell Script: Newsletter Sending
 *
 * @category    Mage
 * @package     Mage_Shell
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Shell_Compiler extends Mage_Shell_Abstract
{

    protected function _send()
    {

        $countOfQueue  = 3;
				$countOfSubscritions = 250;

				$collection = Mage::getModel('newsletter/queue')->getCollection()
				    ->setPageSize($countOfQueue)
				    ->setCurPage(1)
				    ->addOnlyForSendingFilter()
				    ->load();

				 $collection->walk('sendPerSubscriber', array($countOfSubscritions));

				return true;
    }

    /**
     * Run script
     *
     */
    public function run()
    {
        $this->_send();
        echo 'Sending';
    }

}

$shell = new Mage_Shell_Compiler();
$shell->run();
