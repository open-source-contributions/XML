<?php
declare(strict_types = 1);

namespace Innmind\Xml\Element;

use Innmind\Xml\NodeInterface;
use Innmind\Immutable\{
    Map,
    MapInterface
};

class SelfClosingElement extends Element
{
    private $string;

    public function __construct(
        string $name,
        MapInterface $attributes = null
    ) {
        parent::__construct(
            $name,
            $attributes,
            new Map('int', NodeInterface::class)
        );
    }

    public function hasChildren(): bool
    {
        return false;
    }

    public function content(): string
    {
        return '';
    }

    public function __toString(): string
    {
        if ($this->string === null) {
            $this->string = sprintf(
                '<%s%s />',
                $this->name(),
                $this->hasAttributes() ? ' '.$this->attributes()->join(' ') : ''
            );
        }

        return $this->string;
    }
}
