<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads\Business\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string $fileSystemName
     * @param string|null $fileNamePrefix
     *
     * @return array
     */
    public function upload(UploadedFile $file, string $fileSystemName, ?string $fileNamePrefix = null): array;

    /**
     * @param string $fileName
     * @param string $fileSystemName
     *
     * @return void
     */
    public function remove(string $fileName, string $fileSystemName): void;

    /**
     * @param string $fileName
     * @param string $fileSystemName
     *
     * @return string
     */
    public function getPublicUrl(string $fileName, string $fileSystemName): string;
}
