<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataIndexSync\Plugin\InjectIndexers;

use Magento\Framework\Indexer\Config\Reader;
use MateuszMesek\DocumentDataIndexSync\Config;

class OnIndexerConfigReader
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
        array $output,
        $scope = null
    )
    {
        $documentNames = $this->config->getDocumentNames();

        foreach ($documentNames as $documentName) {
            $indexId = "document_data_sync_$documentName";

            $output[$indexId] = [
                'indexer_id' => $indexId,
                'view_id' => $indexId,
                'action_class' => $this->config->getIndexerAction($documentName) ?: 'MateuszMesek\DocumentDataIndexSync\Action',
                'shared_index' => null,
                'title' => 'Document Data Sync: '.$this->convertNameToTile($documentName),
                'description' => '',
                'dependencies' => [],
                'document_name' => $documentName
            ];
        }

        return $output;
    }

    private function convertNameToTile(string $name): string
    {
        return ucwords(implode(' ', explode('_', $name)));
    }
}
