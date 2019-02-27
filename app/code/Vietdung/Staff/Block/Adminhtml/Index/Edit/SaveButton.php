<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 25/02/2019
 * Time: 14:45
 */

namespace Vietdung\Staff\Block\Adminhtml\Index\Edit;


use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save '),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];

    }
}