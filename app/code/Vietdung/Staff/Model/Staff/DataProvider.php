<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/17/2019
 * Time: 10:19 AM
 */

namespace Vietdung\Staff\Model\Staff;


use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Vietdung\Staff\Model\ResourceModel\Staff\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\TestFramework\Filesystem;
class DataProvider extends AbstractDataProvider
{

    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $staffCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {

        $this->collection = $staffCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
        $this->storeManager = $storeManager;
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */

    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();




        /** @var $staff \Vietdung\staff\Model\staff */
        foreach ($items as $staff) {
            $data = $staff->getData();

            $image = $data['image'];
            unset($data['image']);
            $data['image'][0]['url'] = $this->storeManager->getStore()->getBaseUrl(
                    UrlInterface::URL_TYPE_MEDIA
                ).'staff/images/' .$image;

            $data['image'][0]['name'] = $image;
            $this->loadedData[$staff->getId()] = $data;


        }

        $data = $this->dataPersistor->get('staff');

        if (!empty($data)) {
            $staff = $this->collection->getNewEmptyItem();
            $staff->setData($data);
            $this->loadedData[$staff->getId()] = $staff->getData();
            $this->dataPersistor->clear('staff');
        }
        return $this->loadedData;
    }
}