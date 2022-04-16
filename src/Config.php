<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataIndexSync;

use Magento\Framework\Config\DataInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Config\DataResolverInterface;
use MateuszMesek\DocumentDataIndexIndexerApi\Config\SaveHandlerInterface;
use MateuszMesek\DocumentDataIndexMviewApi\Config\SubscriptionProviderInterface;

class Config implements DataResolverInterface, SaveHandlerInterface, SubscriptionProviderInterface
{
    private DataInterface $data;

    public function __construct(
        DataInterface $data
    )
    {
        $this->data = $data;
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
}
