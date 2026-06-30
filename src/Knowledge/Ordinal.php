<?php

namespace Rushing\KnowledgeSpineData\Knowledge;

use InvalidArgumentException;

/**
 * An ordering point on an integer axis — a chapter number, a transaction
 * sequence, a revision counter. The axis with no wall-clock.
 */
final class Ordinal implements OrderingPoint
{
    public function __construct(public readonly int $value) {}

    public function compareTo(OrderingPoint $other): int
    {
        if (! $other instanceof self) {
            throw new InvalidArgumentException('Cannot compare an Ordinal against a '.$other::class.' — different ordering axes.');
        }

        return $this->value <=> $other->value;
    }
}
