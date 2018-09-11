<?php

namespace App\Http\Request;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class UploadedFileResolver implements ArgumentValueResolverInterface
{
    /** @var Filesystem */
    private $fs;

    /** @var string */
    private $dirForTemporaryFiles;

    public function __construct(Filesystem $fs, string $projectDir)
    {
        $this->fs = $fs;

        $this->dirForTemporaryFiles = "{$projectDir}/var/upload/";
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getType() === UploadedFile::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $fileContent = $request->getContent();

        if (!is_string($fileContent)) {
            throw new \UnexpectedValueException();
        }

        $fileName = md5($fileContent);
        $filePath = $this->dirForTemporaryFiles . $fileName;

        if (!$this->fs->exists($this->dirForTemporaryFiles)) {
            $this->fs->mkdir($this->dirForTemporaryFiles);
        }
        $this->fs->dumpFile($filePath, $fileContent);

        yield new UploadedFile($filePath, $fileName);
    }
}
