<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Logging\Controller\Adminhtml\Logging;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class ExportCsv extends \Magento\Logging\Controller\Adminhtml\Logging
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Logging::magento_logging_events';

    /**
     * Export log to CSV
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $fileName = 'log.csv';
        /** @var \Magento\Backend\Block\Widget\Grid\ExportInterface $exportBlock */
        $exportBlock = $this->_view->getLayout()->getChildBlock('logging.grid', 'grid.export');
        return $this->_fileFactory->create(
            $fileName,
            $exportBlock->getCsvFile($fileName),
            DirectoryList::VAR_DIR
        );
    }
}
