<?php
namespace Keboola\Processor\SelectColumns;

/**
 * @param array $manifest
 * @param array $parameters
 * @return array
 * @throws Exception
 */
function processManifest(array $manifest, array $parameters)
{
    if (!isset($manifest["columns"])) {
        throw new Exception(
            "Manifest file does not specify columns."
        );
    }

    $output = $manifest;
    $output["columns"] = $parameters["columns"];
    return $output;
}
