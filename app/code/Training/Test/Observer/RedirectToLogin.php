<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/6/19
 * Time: 10:54 PM
 */

namespace Training\Test\Observer;


use Magento\Framework\Event\ObserverInterface;
class RedirectToLogin implements ObserverInterface
{
    protected $customerSession;
    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    private $redirect;
    /**
     * @var \Magento\Framework\App\ActionFlag
     */
    private $actionFlag;
    /**
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\App\ActionFlag $actionFlag
    ) {
        $this->customerSession = $customerSession;
        $this->redirect = $redirect;
        $this->actionFlag = $actionFlag;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->customerSession->isLoggedIn()) {

//            I disable this block, because I have direct event(controller_action_predispatch_catalog_product_view)

//            $request = $observer->getEvent()->getData('request');
//            if ($request->getFullActionName() == 'catalog_product_view') { // altenative way
//                $controller = $observer->getEvent()->getData('controller_action');
//                $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
//            }

            $controller = $observer->getEvent()->getData('controller_action');
            $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
        }
    }
}