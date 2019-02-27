<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 10:55
 */

namespace Vietdung\Staff\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Vietdung\Staff\Model\StaffFactory;
use Vietdung\Staff\Model\ResourceModel\Staff\CollectionFactory;

class Index extends Action
{
    protected $staffFactory;
    protected $collectionFactory;
    public function __construct(Context $context,StaffFactory $staffFactory,CollectionFactory $collectionFactory)
    {
        $this->staffFactory = $staffFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $staff1 = $this->staffFactory->create();
        $collection = $this->collectionFactory->create();

        $data = $collection->addFieldToFilter('id',['eq'=> 1])->getData();
        var_dump($data);



    }
}