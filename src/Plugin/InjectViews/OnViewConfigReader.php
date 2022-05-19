<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataIndexSync\Plugin\InjectViews;

use Magento\Framework\Mview\Config\Reader;
use MateuszMesek\DocumentDataIndexSync\Config;

class OnViewConfigReader
{
    private Config $config;

    public function __construct(
        Config $config
    )
    {
        $this->config = $config;
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
                'subscriptions' => [
                    $subscriptionTable => [
                        'name' => $subscriptionTable,
                        'column' => 'id',
                        'subscription_model' => null
                    ]
                ],
                'sync_document_name' => $documentName
            ];
        }

        return $output;
    }
}
