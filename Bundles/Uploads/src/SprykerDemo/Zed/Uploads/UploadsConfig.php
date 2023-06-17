<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads;

use Spryker\Shared\Config\Config;
use Spryker\Shared\FileSystem\FileSystemConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class UploadsConfig extends AbstractBundleConfig
{
    /**
     * @param string $fileSystemName
     *
     * @return mixed
     */
    public function getFileSystemConfigByName(string $fileSystemName)
    {
        return Config::get(FileSystemConstants::FILESYSTEM_SERVICE)[$fileSystemName];
    }

    /**
     * @return string[]
     */
    public function getFileSystemWriterConfig(): array
    {
        return [
            'ACL' => 'public-read',
        ];
    }
}
