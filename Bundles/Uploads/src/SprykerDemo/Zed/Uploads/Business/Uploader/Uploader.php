<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads\Business\Uploader;

use Spryker\Service\Flysystem\FlysystemServiceInterface;
use Spryker\Shared\Config\Config;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use SprykerDemo\Zed\Uploads\UploadsConfig;

class Uploader implements UploaderInterface
{
    protected FlysystemServiceInterface $flysystemService;

    protected UploadsConfig $uploadsConfig;

    protected Config $sharedConfig;

    /**
     * @param \Spryker\Service\Flysystem\FlysystemServiceInterface $flysystemService
     * @param \SprykerDemo\Zed\Uploads\UploadsConfig $uploadsConfig
     * @param \Spryker\Shared\Config\Config $sharedConfig
     */
    public function __construct(FlysystemServiceInterface $flysystemService, UploadsConfig $uploadsConfig, Config $sharedConfig)
    {
        $this->flysystemService = $flysystemService;
        $this->uploadsConfig = $uploadsConfig;
        $this->sharedConfig = $sharedConfig;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string $fileSystemName
     * @param string|null $fileNamePrefix
     *
     * @return array
     */
    public function upload(UploadedFile $file, string $fileSystemName, ?string $fileNamePrefix = null): array
    {
        $fileName = $fileNamePrefix . $this->generateUniqueFileName($file);

        $this->flysystemService->write(
            $fileSystemName,
            $fileName,
            $file->getContent(),
            $this->uploadsConfig->getFileSystemWriterConfig()
        );

        return [
            'fileName' => $fileName,
            'filePublicPath' => $this->getPublicUrl(
                $fileName,
                $fileSystemName
            ),
        ];
    }

    /**
     * @param string $fileName
     * @param string $fileSystemName
     *
     * @return void
     */
    public function remove(string $fileName, string $fileSystemName): void
    {
        if ($this->flysystemService->has($fileSystemName, $fileName)) {
            $this->flysystemService->delete($fileSystemName, $fileName);
        }
    }

    /**
     * @param string $fileName
     * @param string $fileSystemName
     *
     * @return string
     */
    public function getPublicUrl(string $fileName, string $fileSystemName): string
    {
        $s3BucketConfig = $this->uploadsConfig->getFileSystemConfigByName($fileSystemName);

        return sprintf(
            'https://%s.s3.%s.amazonaws.com/%s%s',
            $s3BucketConfig['bucket'],
            $s3BucketConfig['region'],
            $s3BucketConfig['path'],
            $fileName
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function generateUniqueFileName(UploadedFile $file)
    {
        return time() . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
    }
}
