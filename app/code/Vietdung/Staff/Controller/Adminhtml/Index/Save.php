<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Vietdung\Staff\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Vietdung\Staff\Model\Staff;
use Vietdung\Staff\Model\StaffFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Vietdung_Staff::save';

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Vietdung\Staff\Model\PageFactory
     */
    private $staffFactory;

    /**
     * @var \Vietdung\Staff\Api\PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     * @param \Vietdung\Staff\Model\PageFactory $pageFactory
     * @param \Vietdung\Staff\Api\PageRepositoryInterface $pageRepository
     */
    public function __construct(
        Action\Context $context,
        StaffFactory $staffFactory,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor

    )
    {
        $this->staffFactory = $staffFactory;
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
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
        $model = $this->staffFactory->create();


        if ($data) {

            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Staff::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            if (empty($data['image'])) {
                $data['image'] = null;
            }
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                    return $this->_redirect('*/*/');
                }
            }

            $model->setData($this->_filterBannerPostData($data));
            $this->messageManager->addSuccess(__('You saved the staff.'));

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the staff.'));
                $this->dataPersistor->clear('staff');
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $this->_redirect('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the image.' . $e->getMessage()));
            }
            $this->dataPersistor->set('staff', $data);
            if ($this->getRequest()->getParam('id')) {
                return $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
            }
            return $this->_redirect('*/*/add');

        }
        // Redirect to List page
        return $this->_redirect('*/*/');


    }
}
