<?php
declare(strict_types = 1);

namespace Innmind\Xml\Translator\NodeTranslator;

use Innmind\Xml\{
    Translator\NodeTranslator,
    Translator\Translator,
    Node,
    Exception\InvalidArgumentException,
    Node\EntityReference,
};

final class EntityReferenceTranslator implements NodeTranslator
{
    public function translate(
        \DOMNode $node,
        Translator $translator
    ): Node {
        if (!$node instanceof \DOMEntityReference) {
            throw new InvalidArgumentException;
        }

        return new EntityReference($node->nodeName);
    }
}
