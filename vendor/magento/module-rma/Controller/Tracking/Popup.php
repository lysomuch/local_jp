<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Rma\Controller\Tracking;

use Magento\Framework\Exception\NotFoundException;

class Popup extends \Magento\Rma\Controller\Tracking
{
    /**
     * Popup action
     * Shows tracking info if it's present, otherwise redirects to 404
     *
     * @return void
     * @throws NotFoundException
     */
    public function execute()
    {
        /** @var $shippingInfoModel \Magento\Rma\Model\Shipping\Info */
        $shippingInfoModel = $this->_objectManager->create(\Magento\Rma\Model\Shipping\Info::class);
        $shippingInfoModel->loadByHash($this->getRequest()->getParam('hash'));

        $this->_coreRegistry->register('rma_current_shipping', $shippingInfoModel);
        if (count($shippingInfoModel->getTrackingInfo()) == 0) {
            throw new NotFoundException(__('Page not found.'));
        }
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Tracking Information'));
        $this->_view->renderLayout();
    }
}
