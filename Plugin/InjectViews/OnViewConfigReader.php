<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataIndexSync\Plugin\InjectViews;

use Magento\Framework\Mview\Config\Reader;
use MateuszMesek\DocumentDataIndexSync\Model\Config;

class OnViewConfigReader
{
    public function __construct(
        private readonly Config $config
    )
    {
    }

    public function afterRead(
        Reader $reader,
        array  $output,
               $scope = null
    ): array
    {
        $documentNames = $this->config->getDocumentNames();

        foreach ($documentNames as $documentName) {
            $viewId = "document_data_sync_$documentName";
            $subscriptionTable = "document_data_sync_{$documentName}_mview";

            $output[$viewId] = [
                'view_id' => $viewId,
                'action_class' => $this->config->getMviewAction($documentName),
                'group' => 'indexer',
                'walker' => 'Magento\Framework\Mview\View\ChangeLogBatchWalker',
                'subscriptions' => [
                    $subscriptionTable => [
                        'name' => $subscriptionTable,
                        'column' => 'id',
                        'subscription_model' => null,
                        'processor' => 'Magento\Framework\Mview\View\AdditionalColumnsProcessor\DefaultProcessor'
                    ]
                ],
                'sync_document_name' => $documentName
            ];
        }

        return $output;
    }
}
