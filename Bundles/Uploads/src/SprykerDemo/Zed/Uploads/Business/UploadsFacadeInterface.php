<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads\Business;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadsFacadeInterface
{
    /**
     * Specification:
     * - Upload file to s3.
     *
     * @api
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string $fileSystem
     * @param string|null $fileNamePrefix
     *
     * @return array
     */
    public function upload(UploadedFile $file, string $fileSystem, ?string $fileNamePrefix = null): array;

    /**
     * Specification:
     * - Remove file from s3.
     *
     * @api
     *
     * @param string $fileName
     * @param string $fileSystemName
     *
     * @return void
     */
    public function remove(string $fileName, string $fileSystemName): void;
}
