<?php

declare(strict_types=1);

namespace Keboola\Processor\SelectColumns;

use Keboola\Csv\CsvFile;
use SplFileInfo;

/**
 * @throws Exception
 */
function processFile(SplFileInfo $sourceFile, string $destinationFolder, array $manifest, array $parameters): void
{
    $sourceCsv = new CsvFile($sourceFile->getPathname(), $manifest['delimiter'], $manifest['enclosure']);
    $destinationCsv = new CsvFile(
        sprintf('%s%s', $destinationFolder, $sourceFile->getFilename()),
        $manifest['delimiter'],
        $manifest['enclosure'],
    );

    $columnIndexes = [];
    foreach ($parameters['columns'] as $column) {
        $index = array_search($column, $manifest['columns']);
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
