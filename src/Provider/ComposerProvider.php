<?php

declare(strict_types=1);

namespace Thruster\ClassIndex\Provider;

use InvalidArgumentException;

/**
 * Class ComposerProvider
 *
 * @package Thruster\ClassIndex\Provider
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ComposerProvider
{
    private string $vendorAutoloadPath;

    private ?string $vendorDirPath = null;

    private ?array $classMap = null;

    public function __construct(string $vendorAutoloadPath)
    {
        if (false === file_exists($vendorAutoloadPath)) {
            throw new InvalidArgumentException('Vendor autoload file does not exist at: "' . $vendorAutoloadPath . '"');
        }

        $this->vendorAutoloadPath = realpath($vendorAutoloadPath);
    }

    public function getVendorDirPath(): string
    {
        if (null !== $this->vendorDirPath) {
            return $this->vendorDirPath;
        }

        $this->vendorDirPath = dirname($this->vendorAutoloadPath);

        return $this->vendorDirPath;
    }

    public function getClassMap(): array
    {
        $classMapPath = $this->getAutoloadClassMapPath();

        if (file_exists($classMapPath)) {
            $this->classMap = includeFile($classMapPath);
        } else {
            $this->classMap = [];
        }

        return $this->classMap;
    }

    public function getAutoloadClassMapPath(): string
    {
        return $this->getVendorDirPath() . '/composer/autoload_classmap.php';
    }

    public function getAutoloadFilesPath(): string
    {
        return $this->getVendorDirPath() . '/composer/autoload_files.php';
    }

    public function getAutoloadNamespacesPath(): string
    {
        return $this->getVendorDirPath() . '/composer/autoload_namespace.php';
    }

    public function getAutoloadPsr4Path(): string
    {
        return $this->getVendorDirPath() . '/composer/autoload_psr4.php';
    }
}

function includeFile(string $file) {
    include $file;
}
