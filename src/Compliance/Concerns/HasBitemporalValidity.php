<?php

namespace Rushing\KnowledgeSpineData\Compliance\Concerns;

use Carbon\CarbonImmutable;

/**
 * The two-axis temporal check shared by anything dated both in the world and in
 * the corpus's knowledge — a rule fragment, a concept's regulatory status.
 *
 * Effective time answers "was it in force in the world then"; knowledge time
 * answers "did we know it then, and have we since learned it was wrong". The
 * using class must expose `?CarbonImmutable` properties `effectiveStart`,
 * `effectiveEnd`, `ingestedAt`, `knownUntil`. See schema §4.
 */
trait HasBitemporalValidity
{
    /** Is this record's knowledge live as of the given knowledge time? */
    public function knownAsOf(CarbonImmutable $asOfKnowledge): bool
    {
        if ($this->ingestedAt !== null && $this->ingestedAt->greaterThan($asOfKnowledge)) {
            return false; // not yet learned at that point
        }

        if ($this->knownUntil !== null && $this->knownUntil->lessThanOrEqualTo($asOfKnowledge)) {
            return false; // record was retracted/corrected by then
        }

        return true;
    }

    /** Was this in force in the world at the given effective time? */
    public function effectiveAsOf(CarbonImmutable $asOfEffective): bool
    {
        if ($this->effectiveStart !== null && $this->effectiveStart->greaterThan($asOfEffective)) {
            return false;
        }

        if ($this->effectiveEnd !== null && $this->effectiveEnd->lessThanOrEqualTo($asOfEffective)) {
            return false;
        }

        return true;
    }
}
