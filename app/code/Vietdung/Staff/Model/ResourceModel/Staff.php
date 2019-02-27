<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 10:35
 */

namespace Vietdung\Staff\Model\ResourceModel;



use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Staff extends AbstractDb
{
    protected function _construct()
    {
       $this->_init("staff","id");
    }
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $image = $object->getData('image');

        if ($image != null) {
            $imageUploader = ObjectManager::getInstance()->create("Vietdung\Staff\StaffImageUpload");
            $imageUploader->moveFileFromTmp($image);
        }
        return $this;
    }
}