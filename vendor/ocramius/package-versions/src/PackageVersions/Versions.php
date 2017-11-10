<?php

namespace PackageVersions;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    const VERSIONS = array (
  'keboola/csv' => '1.1.4@d7e257096c42eab09b54b7b46a905ca953a8eb6f',
  'keboola/php-temp' => '0.1.6@ffe345e78ba0d35d970fc26fe2c1a36f7d20ca8c',
  'symfony/config' => 'v3.3.10@4ab62407bff9cd97c410a7feaef04c375aaa5cfd',
  'symfony/filesystem' => 'v3.3.10@90bc45abf02ae6b7deb43895c1052cb0038506f1',
  'symfony/finder' => 'v3.3.10@773e19a491d97926f236942484cb541560ce862d',
  'symfony/process' => 'v3.3.10@fdf89e57a723a29baf536e288d6e232c059697b1',
  'symfony/serializer' => 'v3.3.10@40521cd4908451be804a4ca73717948f4b8c5954',
  'jean85/pretty-package-versions' => '1.0.2@cda6ed1bfbcf7a3736b8943466ad8b1b5c0cc7c9',
  'nette/bootstrap' => 'v2.4.5@804925787764d708a7782ea0d9382a310bb21968',
  'nette/di' => 'v2.4.10@a4b3be935b755f23aebea1ce33d7e3c832cdff98',
  'nette/finder' => 'v2.4.1@4d43a66d072c57d585bf08a3ef68d3587f7e9547',
  'nette/neon' => 'v2.4.2@9eacd50553b26b53a3977bfb2fea2166d4331622',
  'nette/php-generator' => 'v3.0.1@eb2dbc9c3409e9db40568109ca4994d51373b60c',
  'nette/robot-loader' => 'v3.0.2@b703b4f5955831b0bcaacbd2f6af76021b056826',
  'nette/utils' => 'v2.4.8@f1584033b5af945b470533b466b81a789d532034',
  'nikic/php-parser' => 'v3.1.2@08131e7ff29de6bb9f12275c7d35df71f25f4d89',
  'ocramius/package-versions' => '1.1.3@72b226d2957e9e6a9ed09aeaa29cabd840d1a3b7',
  'phpstan/phpstan' => '0.8.5@0dfb4f00959c53378cf15e32a79a254acada35d7',
  'psr/log' => '1.0.2@4ebe3a8bf773a19edfe0a84b6585ba3d401b724d',
  'squizlabs/php_codesniffer' => '3.1.1@d667e245d5dcd4d7bf80f26f2c947d476b66213e',
  'symfony/console' => 'v3.3.10@116bc56e45a8e5572e51eb43ab58c769a352366c',
  'symfony/debug' => 'v3.3.10@eb95d9ce8f18dcc1b3dfff00cb624c402be78ffd',
  'symfony/polyfill-mbstring' => 'v1.6.0@2ec8b39c38cb16674bbf3fea2b6ce5bf117e1296',
  'keboola/processor-add-row-number-column' => 'dev-manifest@ee501a6171a164c7f8e790e3d261c56ae52ea23f',
);

    private function __construct()
    {
    }

    /**
     * @throws \OutOfBoundsException if a version cannot be located
     */
    public static function getVersion(string $packageName) : string
    {
        if (! isset(self::VERSIONS[$packageName])) {
            throw new \OutOfBoundsException(
                'Required package "' . $packageName . '" is not installed: cannot detect its version'
            );
        }

        return self::VERSIONS[$packageName];
    }
}
