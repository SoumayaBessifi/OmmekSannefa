<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

final class EnumProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return "enum" === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?BlogPost
    {
        // Retrieve the blog post item from somewhere then return it or null if not found
        return new BlogPost($id);
    }
}