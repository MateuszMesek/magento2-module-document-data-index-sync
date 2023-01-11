<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataIndexSync\Model;

use Magento\Framework\Config\DataInterface;
use MateuszMesek\DocumentDataApi\Model\Config\DocumentNamesInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Model\Config\DataResolverInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Model\Config\IndexIdsResolverInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Model\Config\IndexNameResolverInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Model\Config\IndexStructureBuilderInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Model\Config\ReadHandlerInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Model\Config\SaveHandlerInterface;
use MateuszMesek\DocumentDataIndexMviewApi\Model\Config\SubscriptionProviderInterface;

class Config implements
    DocumentNamesInterface,
    DataResolverInterface,
    ReadHandlerInterface,
    SaveHandlerInterface,
    SubscriptionProviderInterface,
    IndexNameResolverInterface,
    IndexStructureBuilderInterface,
    IndexIdsResolverInterface
{
    public function __construct(
        private readonly DataInterface $data
    )
    {
    }

    public function getDocumentNames(): array
    {
        $documents = $this->data->get();

        return array_keys($documents);
    }

    public function getDataResolver(string $documentName): ?string
    {
        return $this->data->get("$documentName/dataResolver");
    }

    public function getReadHandler(string $documentName): ?string
    {
        return $this->data->get("$documentName/readHandler");
    }

    public function getSaveHandler(string $documentName): ?string
    {
        return $this->data->get("$documentName/saveHandler");
    }

    public function getIndexerAction(string $documentName): ?string
    {
        return $this->data->get("$documentName/indexerAction");
    }

    public function getMviewAction(string $documentName): ?string
    {
        return $this->data->get("$documentName/mviewAction");
    }

    public function getSubscriptionProvider(string $documentName): ?string
    {
        return $this->data->get("$documentName/subscriptionProvider");
    }

    public function getIndexNameResolver(string $documentName): ?string
    {
        return $this->data->get("$documentName/indexNameResolver");
    }

    public function getIndexStructureBuilder(string $documentName): ?string
    {
        return $this->data->get("$documentName/indexStructureBuilder");
    }

    public function getIndexIdsResolver(string $documentName): ?string
    {
        return $this->data->get("$documentName/indexIdsResolver");
    }
}
