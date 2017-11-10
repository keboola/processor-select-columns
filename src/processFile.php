<?php
namespace Keboola\Processor\SelectColumns;

use Keboola\Csv\CsvFile;

/**
 * @param \SplFileInfo $sourceFile
 * @param string $destinationFolder
 * @param array $manifest
 * @param array $parameters
 * @throws Exception
 */
function processFile(\SplFileInfo $sourceFile, $destinationFolder, array $manifest, array $parameters)
{
    $sourceCsv = new CsvFile($sourceFile->getPathname(), $manifest["delimiter"], $manifest["enclosure"]);
    $destinationCsv = new CsvFile($destinationFolder . $sourceFile->getFilename(), $manifest["delimiter"], $manifest["enclosure"]);

    $columnIndexes = [];
    foreach ($parameters["columns"] as $column) {
        $index = array_search($column, $manifest["columns"]);
        if ($index === false) {
            throw new Exception("Column {$column} not found.");
        }
        $columnIndexes[] = $index;
    }

    foreach ($sourceCsv as $index => $row) {
        $writeRow = [];
        foreach ($columnIndexes as $index) {
            $writeRow[] = $row[$index];
        }
        $destinationCsv->writeRow($writeRow);
    }
}
