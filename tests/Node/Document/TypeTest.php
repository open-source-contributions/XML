<?php
declare(strict_types = 1);

namespace Tests\Innmind\Xml\Node\Document;

use Innmind\Xml\Node\Document\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    /**
     * @dataProvider cases
     */
    public function testInterface($name, $public, $system, $string)
    {
        $type = new Type($name, $public, $system);

        $this->assertSame($name, $type->name());
        $this->assertSame($public, $type->publicId());
        $this->assertSame($system, $type->systemId());
        $this->assertSame($string, (string) $type);
    }

    /**
     * @expectedException Innmind\Xml\Exception\DomainException
     */
    public function testThrowWhenEmptyName()
    {
        new Type('');
    }

    public function cases(): array
    {
        return [
            ['foo', '', '', '<!DOCTYPE foo>'],
            ['foo', 'bar', '', '<!DOCTYPE foo PUBLIC "bar">'],
            ['foo', 'bar', 'baz', '<!DOCTYPE foo PUBLIC "bar" "baz">'],
            ['foo', '', 'baz', '<!DOCTYPE foo "baz">'],
        ];
    }
}
