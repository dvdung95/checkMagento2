<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 10:41
 */

namespace Vietdung\Staff\Model\ResourceModel\Staff;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
       $this->_init("Vietdung\Staff\Model\Staff","Vietdung\Staff\Model\ResourceModel\Staff");
    }
}