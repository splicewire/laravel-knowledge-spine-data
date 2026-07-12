<?php

namespace Splicewire\KnowledgeSpineData\Knowledge;

use Carbon\CarbonImmutable;
use InvalidArgumentException;

/**
 * An ordering point on the wall-clock axis. The axis compliance uses — "what
 * could the subject reasonably have known *as of this date*."
 */
class Instant implements OrderingPoint
{
    public function __construct(public CarbonImmutable $at) {}

    public function compareTo(OrderingPoint $other): int
    {
        if (! $other instanceof self) {
            throw new InvalidArgumentException('Cannot compare an Instant against a '.$other::class.' — different ordering axes.');
        }

        return $this->at <=> $other->at;
    }
}
