<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 10:29
 */

namespace Vietdung\Staff\Model;


use Magento\Framework\Model\AbstractModel;

class Staff extends AbstractModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    protected function _construct()
    {
        $this->_init("Vietdung\Staff\Model\ResourceModel\Staff");
    }
}