<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Relay\Builder;

use Overblog\GraphQLBundle\Definition\Builder\MappingInterface;

class RelayConnectionFieldsBuilder implements MappingInterface
{
    public function toMappingDefinition(array $config): array
    {
        if (!isset($config['edgeType']) || !\is_string($config['edgeType'])) {
            throw new \InvalidArgumentException('Using the Relay Connection fields builder, the key "edgeType" defining the GraphQL type of edges is required and must be a string.');
        }

        $edgeType = $config['edgeType'];
        $edgeDescription = $config['edgeDescription'] ?? 'Edges of the connection';

        $pageInfoType = $config['pageInfoType'] ?? 'PageInfo';
        $pageInfoDescription = $config['pageInfoDescription'] ?? 'Page info of the connection';

        return [
            'edges' => [
                'description' => $edgeDescription,
                'type' => \sprintf('[%s]', $edgeType),
            ],
            'pageInfo' => [
                'description' => $pageInfoDescription,
                'type' => $pageInfoType,
            ],
        ];
    }
}