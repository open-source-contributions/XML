<?php
declare(strict_types = 1);

namespace Tests\Innmind\Xml\Translator\NodeTranslator\Visitor;

use Innmind\Xml\{
    Translator\NodeTranslator\Visitor\Attributes,
    AttributeInterface
};
use Innmind\Immutable\MapInterface;

class AttributesTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleNode()
    {
        $attributes = (new Attributes)(new \DOMNode);

        $this->assertInstanceOf(MapInterface::class, $attributes);
        $this->assertSame('string', (string) $attributes->keyType());
        $this->assertSame(
            AttributeInterface::class,
            (string) $attributes->valueType()
        );
        $this->assertCount(0, $attributes);
    }

    public function testNoAttributes()
    {
        $document = new \DOMDocument;
        $document->loadXML('<foo/>');

        $attributes = (new Attributes)($document->childNodes->item(0));

        $this->assertInstanceOf(MapInterface::class, $attributes);
        $this->assertSame('string', (string) $attributes->keyType());
        $this->assertSame(
            AttributeInterface::class,
            (string) $attributes->valueType()
        );
        $this->assertCount(0, $attributes);
    }

    public function testAttributes()
    {
        $document = new \DOMDocument;
        $document->loadXML('<foo bar="baz"/>');

        $attributes = (new Attributes)($document->childNodes->item(0));

        $this->assertInstanceOf(MapInterface::class, $attributes);
        $this->assertSame('string', (string) $attributes->keyType());
        $this->assertSame(
            AttributeInterface::class,
            (string) $attributes->valueType()
        );
        $this->assertCount(1, $attributes);
        $this->assertSame(
            'baz',
            $attributes->get('bar')->value()
        );
    }
}