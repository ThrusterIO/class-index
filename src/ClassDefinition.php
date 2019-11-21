<?php

declare(strict_types=1);

namespace Thruster\ClassIndex;

/**
 * Class ClassDefinition
 *
 * @package Thruster\ClassIndex
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ClassDefinition
{
    private string $rawClass;
    private string $filePath;
    private ?string $className = null;
    private ?array $namespaceParts = null;
    private ?string $namespace = null;

    public function __construct(string $rawClass, string $filePath)
    {
        $this->rawClass = $rawClass;
        $this->filePath = $filePath;
    }

    public function getClassName(): string
    {
        if (null !== $this->className) {
            return $this->className;
        }

        $lastPos = strrpos($this->rawClass, '\\');
        if (false === $lastPos) {
            $lastPos = -1;
        }

        $this->className = substr($this->rawClass, $lastPos + 1);

        return $this->className;
    }

    public function getNamespaceParts(): array
    {
        if (null !== $this->namespaceParts) {
            return $this->namespaceParts;
        }

        $this->namespaceParts = explode('\\', $this->rawClass);
        array_pop($this->namespaceParts);

        return $this->namespaceParts;
    }

    public function getNamespace(): ?string
    {
        if (null !== $this->namespace) {
            return $this->namespace;
        }

        $lastPos = strrpos($this->rawClass, '\\');
        if (false === $lastPos || 0 === $lastPos) {
            $this->namespace = '\\';
        } else {
            $this->namespace = substr($this->rawClass, 0, $lastPos);
        }

        return $this->namespace;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function newInstance(): object
    {
        return new $this->rawClass;
    }
}
