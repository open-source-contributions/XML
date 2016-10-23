<?php
declare(strict_types = 1);

namespace Tests\Innmind\XML\Node;

use Innmind\XML\{
    Node\Text,
    NodeInterface
};
use Innmind\Immutable\MapInterface;

class TextTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $this->assertInstanceOf(
            NodeInterface::class,
            new Text('foo')
        );
    }

    public function testChildren()
    {
        $text = new Text('foo');

        $this->assertInstanceOf(MapInterface::class, $text->children());
        $this->assertSame('int', (string) $text->children()->keyType());
        $this->assertSame(
            NodeInterface::class,
            (string) $text->children()->ValueType()
        );
        $this->assertCount(0, $text->children());
        $this->assertFalse($text->hasChildren());
    }

    public function testContent()
    {
        $this->assertSame(
            ' foo ',
            (new Text(' foo '))->content()
        );
    }

    public function testCast()
    {
        $this->assertSame(
            'foo',
            (string) new Text('foo')
        );
    }
}
