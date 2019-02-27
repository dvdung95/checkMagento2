<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 16:48
 */

namespace Vietdung\Staff\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $pageFactory;
    public function __construct(Action\Context $context,PageFactory $pageFactory)
    {

        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $rsPage = $this->pageFactory->create();
        $rsPage->setActiveMenu('Vietdung_Staff::staff_manager');
        $rsPage->getConfig()->getTitle()->prepend(__("Staff Manager"));
        return $rsPage;
    }
}