<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @method \SprykerDemo\Zed\Uploads\Business\UploadsBusinessFactory getFactory()
 */
class UploadsFacade extends AbstractFacade implements UploadsFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string $fileSystem
     * @param string|null $fileNamePrefix
     *
     * @return array
     */
    public function upload(UploadedFile $file, string $fileSystem, ?string $fileNamePrefix = null): array
    {
        return $this->getFactory()->createUploader()->upload($file, $fileSystem, $fileNamePrefix);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $fileName
     * @param string $fileSystemName
     *
     * @return void
     */
    public function remove(string $fileName, string $fileSystemName): void
    {
        $this->getFactory()->createUploader()->remove($fileName, $fileSystemName);
    }
}
