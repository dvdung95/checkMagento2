<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 27/02/2019
 * Time: 11:39
 */

namespace Vietdung\Blogg\Model\ResourceModel;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blogg extends AbstractDb
{
    protected function _construct()
    {
        $this->_init("blogg","id");
    }
}