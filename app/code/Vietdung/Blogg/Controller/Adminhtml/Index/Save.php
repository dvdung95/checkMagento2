<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 27/02/2019
 * Time: 16:47
 */

namespace Vietdung\Blogg\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Vietdung\Blogg\Model\BloggFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    protected $_pageFactory;
    protected $_bloggFactory;
    public function __construct(Action\Context $context,
                                PageFactory $pageFactory,
                                BloggFactory $bloggFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_bloggFactory = $bloggFactory;
        parent::__construct($context);
    }
    protected function _filterBannerPostData(array $rawData): array
    {
        $data = $rawData;
        if (isset($data['image']) && is_array($data['image'])) {
            if (!empty($data['image']['delete'])) {
                $data['image'] = null;
            } else {
                if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
                    $data['image'] = $data['image'][0]['name'];
                } else {
                    unset($data['image']);
                }
            }
        }
        return $data;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $rsPage = $this->_pageFactory->create();
        return $rsPage;
    }
}