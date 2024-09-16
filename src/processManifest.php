<?php

declare(strict_types=1);

namespace Keboola\Processor\SelectColumns;

/**
 * @throws Exception
 */
function processManifest(array $manifest, array $parameters): array
{
    if (!isset($manifest['columns'])) {
        throw new Exception(
            'Manifest file does not specify columns.',
        );
    }

    $output = $manifest;
    $output['columns'] = $parameters['columns'];

    if (isset($manifest['column_metadata'])) {
        foreach ($manifest['column_metadata'] as $column => $metadata) {
            if (!in_array($column, $parameters['columns'])) {
                unset($output['column_metadata'][$column]);
            }
        }
    }

    return $output;
}
