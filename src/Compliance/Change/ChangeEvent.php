<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Change;

use Splicewire\KnowledgeSpineData\Compliance\Data\Rule;
use Spatie\LaravelData\Data;

/**
 * A transition between two states of the corpus: an old rule superseded by a
 * new one. `oldRule` is null for a NEW_OBLIGATION; `newRule` is null for a
 * WITHDRAWN. `substance` and `direction` are declared (they come from the
 * bulletin or reconciliation); the per-subject {@see Disposition} is derived
 * from them, never trusted from a self-label. See schema §5.
 */
class ChangeEvent extends Data
{
    public function __construct(
        public ChangeSubstance $substance,
        public TemporalDirection $direction,
        public ?Rule $oldRule = null,
        public ?Rule $newRule = null,
    ) {}

    /** The requirement_key this change touches, whichever side of the transition exists. */
    public function requirementKey(): ?string
    {
        return $this->newRule?->requirementKey ?? $this->oldRule?->requirementKey;
    }
}
