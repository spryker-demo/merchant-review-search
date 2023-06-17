<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads\Business;

use Spryker\Service\Flysystem\FlysystemServiceInterface;
use Spryker\Shared\Config\Config;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerDemo\Zed\Uploads\Business\Uploader\Uploader;
use SprykerDemo\Zed\Uploads\Business\Uploader\UploaderInterface;
use SprykerDemo\Zed\Uploads\UploadsDependencyProvider;

/**
 * @method \SprykerDemo\Zed\Uploads\UploadsConfig getConfig()
 */
class UploadsBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\Uploads\Business\Uploader\UploaderInterface
     */
    public function createUploader(): UploaderInterface
    {
        return new Uploader(
            $this->getFlySystemService(),
            $this->getConfig(),
            $this->createSharedConfig(),
        );
    }

    /**
     * @return \Spryker\Service\Flysystem\FlysystemServiceInterface
     */
    public function getFlySystemService(): FlysystemServiceInterface
    {
        return $this->getProvidedDependency(UploadsDependencyProvider::FLY_SYSTEM_SERVICE);
    }

    /**
     * @return \Spryker\Shared\Config\Config
     */
    public function createSharedConfig(): Config
    {
        return new Config();
    }
}
