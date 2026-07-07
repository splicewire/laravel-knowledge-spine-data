<?php

namespace Rushing\KnowledgeSpineData\Knowledge;

use InvalidArgumentException;

/**
 * An ordering point on an integer axis — a chapter number, a transaction
 * sequence, a revision counter. The axis with no wall-clock.
 */
class Ordinal implements OrderingPoint
{
    public function __construct(public int $value) {}

    public function compareTo(OrderingPoint $other): int
    {
        if (! $other instanceof self) {
            throw new InvalidArgumentException('Cannot compare an Ordinal against a '.$other::class.' — different ordering axes.');
        }

        return $this->value <=> $other->value;
    }
}
