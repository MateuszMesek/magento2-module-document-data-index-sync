<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataIndexSync\SubscriptionProvider;

use ArrayIterator;
use MateuszMesek\DocumentDataIndexMviewApi\SubscriptionProviderInterface;
use Traversable;

class DefaultProvider implements SubscriptionProviderInterface
{
    public function get(array $context): Traversable
    {
        return new ArrayIterator([]);
    }
}
