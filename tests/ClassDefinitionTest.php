<?php

declare(strict_types=1);

namespace Thruster\ClassIndex\Tests;

use PHPUnit\Framework\TestCase;
use stdClass;
use Thruster\ClassIndex\ClassDefinition;

/**
 * Class ClassDefinitionTest
 *
 * @package Thruster\ClassIndex\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ClassDefinitionTest extends TestCase
{
    public function dataClassName(): array
    {
        $out = [];

        $out[] = ['Foo\\Bar\\FooBar', 'FooBar'];
        $out[] = ['Foo\\Bar', 'Bar'];
        $out[] = ['Foo', 'Foo'];

        return $out;
    }

    /**
     * @dataProvider dataClassName
     */
    public function testClassName(string $given, string $expected): void
    {
        $classDef = new ClassDefinition($given, '');

        $this->assertEquals($expected, $classDef->getClassName());
        $this->assertEquals($expected, $classDef->getClassName());
    }

    public function dataNamespaceParts(): array
    {
        $out = [];

        $out[] = ['Foo\\Bar\\FooBar', ['Foo', 'Bar']];
        $out[] = ['Foo\\Bar', ['Foo']];
        $out[] = ['Foo', []];

        return $out;
    }

    /**
     * @dataProvider dataNamespaceParts
     */
    public function testNamespaceParts(string $given, array $expected): void
    {
        $classDef = new ClassDefinition($given, '');

        $this->assertEquals($expected, $classDef->getNamespaceParts());
        $this->assertEquals($expected, $classDef->getNamespaceParts());
    }

    public function dataNamespace(): array
    {
        $out = [];

        $out[] = ['Foo\\Bar\\FooBar', 'Foo\\Bar'];
        $out[] = ['Foo\\Bar', 'Foo'];
        $out[] = ['Foo', '\\'];

        return $out;
    }

    /**
     * @dataProvider dataNamespace
     */
    public function testNamespace(string $given, string $expected): void
    {
        $classDef = new ClassDefinition($given, '');

        $this->assertEquals($expected, $classDef->getNamespace());
        $this->assertEquals($expected, $classDef->getNamespace());
    }

    public function testFilePath()
    {
        $classDef = new ClassDefinition('', '/tmp/foo');

        $this->assertEquals('/tmp/foo', $classDef->getFilePath());
    }

    public function testNewInstance()
    {
        $classDef = new ClassDefinition(stdClass::class, '');

        $instance = $classDef->newInstance();

        $this->assertIsObject($instance);
        $this->assertInstanceOf(stdClass::class, $instance);
    }
}
