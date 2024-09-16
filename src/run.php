<?php

declare(strict_types=1);

use Keboola\Processor\SelectColumns\ConfigDefinition;
use Keboola\Processor\SelectColumns\Exception;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use function Keboola\Processor\SelectColumns\processFile;
use function Keboola\Processor\SelectColumns\processManifest;

require('vendor/autoload.php');

$dataDir = getenv('KBC_DATADIR') === false ? '/data/' : getenv('KBC_DATADIR');

$destination = $dataDir . '/out/tables/';
$configFile = $dataDir . '/config.json';

if (!file_exists($configFile)) {
    echo 'Config file not found';
    exit(2);
}

try {
    $fs = new Filesystem();
    $jsonDecode = new JsonDecode(true);
    $jsonEncode = new JsonEncode();

    $config = $jsonDecode->decode(
        file_get_contents($configFile),
        JsonEncoder::FORMAT,
    );

    $parameters = (new Processor())->processConfiguration(new ConfigDefinition(), [$config['parameters'] ?? []]);

    $finder = new Finder();
    $finder->notName('*.manifest')->in($dataDir . '/in/tables')->depth(0);
    foreach ($finder as $file) {
        $columnsInManifest = false;

        $manifestFile = $file->getPathname() . '.manifest';
        if (!$fs->exists($manifestFile)) {
            throw new Exception(
                'Table ' . $file->getBasename() . ' does not have a manifest file.',
            );
        }

        $manifest = $jsonDecode->decode(
            file_get_contents($manifestFile),
            JsonEncoder::FORMAT,
        );

        if (!isset($manifest['delimiter'])) {
            throw new Exception(
                'Manifest file for table ' . $file->getBasename() . ' does not specify delimiter.',
            );
        }
        if (!isset($manifest['enclosure'])) {
            throw new Exception(
                'Manifest file for table ' . $file->getBasename() . ' does not specify enclosure.',
            );
        }


        $targetManifest = $destination . $file->getFilename() . '.manifest';
        file_put_contents(
            $targetManifest,
            $jsonEncode->encode(processManifest($manifest, $parameters), JsonEncoder::FORMAT),
        );

        if (is_dir($file->getPathname())) {
            // sliced file
            $slicedFiles = new FilesystemIterator($file->getPathname(), FilesystemIterator::SKIP_DOTS);
            $slicedDestination = $destination . $file->getFilename() . '/';
            if (!$fs->exists($slicedDestination)) {
                $fs->mkdir($slicedDestination);
            }
            foreach ($slicedFiles as $slicedFile) {
                processFile(
                    $slicedFile,
                    $slicedDestination,
                    $manifest,
                    $parameters,
                );
            }
        } else {
            processFile($file, $destination, $manifest, $parameters);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
} catch (InvalidConfigurationException $e) {
    echo 'Invalid configuration: ' . $e->getMessage();
    exit(1);
} catch (Throwable $e) {
    echo $e->getMessage();
    exit(2);
}
