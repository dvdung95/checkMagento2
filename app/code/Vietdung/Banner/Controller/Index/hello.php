<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 09:55
 */

namespace Vietdung\Banner\Controller\Index;


use Magento\Framework\App\Action\Action;

class hello extends Action
{
    public function execute()
    {
        echo "hello viet dung";
        die();
    }
}