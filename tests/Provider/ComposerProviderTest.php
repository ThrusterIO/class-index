<?php

declare(strict_types=1);

namespace Thruster\ClassIndex\Tests\Provider;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Thruster\ClassIndex\Provider\ComposerProvider;

/**
 * Class ComposerProviderTest
 *
 * @package Thruster\ClassIndex\Tests\Provider
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ComposerProviderTest extends TestCase
{
    public function testVendorAutoloadDoesNotExist(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ComposerProvider('/-2321c;ldskfl;sdfdldfkl;dsf');
    }

    public function testVendorAutoloadDoesExist(): void
    {
        new ComposerProvider(__DIR__ . '/../fixtures/notDumped/vendor/autoload.php');

        $this->assertTrue(true);
    }

    public function testVendorDir(): void
    {
        $provider = new ComposerProvider(__DIR__ . '/../fixtures/notDumped/vendor/autoload.php');

        $this->assertEquals(
            realpath(__DIR__ . '/../fixtures/notDumped/vendor'),
            $provider->getVendorDirPath()
        );
    }

    public function testAutoloadPaths(): void
    {
        $provider = new ComposerProvider(__DIR__ . '/../fixtures/notDumped/vendor/autoload.php');

        $this->assertEquals(
            realpath(__DIR__ . '/../fixtures/notDumped') . '/vendor/composer/autoload_classmap.php',
            $provider->getAutoloadClassMapPath()
        );

        $this->assertEquals(
            realpath(__DIR__ . '/../fixtures/notDumped') . '/vendor/composer/autoload_namespace.php',
            $provider->getAutoloadNamespacesPath()
        );

        $this->assertEquals(
            realpath(__DIR__ . '/../fixtures/notDumped') . '/vendor/composer/autoload_files.php',
            $provider->getAutoloadFilesPath()
        );

        $this->assertEquals(
            realpath(__DIR__ . '/../fixtures/notDumped') . '/vendor/composer/autoload_psr4.php',
            $provider->getAutoloadPsr4Path()
        );
    }
}
