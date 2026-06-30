<?php

namespace Rushing\KnowledgeSpineData\Coherence\Concerns;

use Rushing\KnowledgeSpineData\Knowledge\OrderingPoint;

/**
 * The two-axis temporal check a canon fact needs — but on a generic
 * {@see OrderingPoint} so it works on chapter (`Ordinal`) story time, not just
 * wall-clock.
 *
 * This is the coherence sibling of the compliance module's bitemporal-validity
 * concern; it is deliberately re-stated here over `OrderingPoint` rather than
 * imported, so `Coherence\` names zero `Compliance\` symbols (ADR-0004). The
 * using class exposes `?OrderingPoint` properties `effectiveStart` /
 * `effectiveEnd` (the in-story window the fact holds over) and
 * `?OrderingPoint` `ingestedAt` / `knownUntil` (the draft-revision window the
 * record itself is live over).
 */
trait HasOrderingWindow
{
    /** Did the fact hold in the world (the story) at the given story point? */
    public function effectiveAsOf(OrderingPoint $asOf): bool
    {
        if ($this->effectiveStart !== null && $this->effectiveStart->compareTo($asOf) > 0) {
            return false; // not yet established at that story point
        }

        if ($this->effectiveEnd !== null && $this->effectiveEnd->compareTo($asOf) <= 0) {
            return false; // superseded by then
        }

        return true;
    }

    /** Is this record's knowledge live as of the given draft-revision point? */
    public function knownAsOf(OrderingPoint $asOfKnowledge): bool
    {
        if ($this->ingestedAt !== null && $this->ingestedAt->compareTo($asOfKnowledge) > 0) {
            return false; // not yet recorded at that revision
        }

        if ($this->knownUntil !== null && $this->knownUntil->compareTo($asOfKnowledge) <= 0) {
            return false; // retracted/corrected by then
        }

        return true;
    }
}
