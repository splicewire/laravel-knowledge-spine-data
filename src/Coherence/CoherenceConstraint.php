<?php

namespace Splicewire\KnowledgeSpineData\Coherence;

use Spatie\LaravelData\Data;

/**
 * An authored canon-consistency rule, evaluated three-valuedly against an
 * assertion. The contradiction-detection vocabulary the compliance module's
 * per-dimension obligation resolution does not carry.
 *
 * A constraint binds a `dimension` to a {@see CoherenceMode} and a
 * `precedenceTier` — higher outranks lower, so a high-authority declared
 * constraint is weighted above one over lower-trust derived facts. The
 * resolver never reaches into a
 * host's vocabulary: `dimension` is a free string id and `precedenceTier` is an
 * ordering-only int, exactly as the kernel `Verdict` is.
 */
class CoherenceConstraint extends Data
{
    public function __construct(
        public string $id,
        public string $dimension,
        public CoherenceMode $mode,
        /** Higher outranks lower: a declared fact outranks a derived one. */
        public int $precedenceTier = 0,
        /**
         * For `requires-awareness`: the fact key the acting knower must have
         * learned. Defaults to the dimension when omitted.
         */
        public ?string $awarenessFact = null,
    ) {}

    public function requiresAwareness(): bool
    {
        return $this->mode === CoherenceMode::RequiresAwareness;
    }

    /** The fact the acting knower must have learned for this constraint to hold. */
    public function factKey(): string
    {
        return $this->awarenessFact ?? $this->dimension;
    }
}
