<?php

namespace Splicewire\KnowledgeSpineData\Adjudication;

use Spatie\LaravelData\Data;

/**
 * One awareness verdict folded into a {@see Determination}'s `awareness[]` list:
 * a knower acted on a fact at a point, and either had or had not learned it by
 * then.
 *
 * `learnedBy` is the ordering value at which the knower first learned the fact
 * (null if never), `actedAt` is the ordering value at which they acted, and
 * `state` is the three-valued reading — `Satisfied` (aware in time), `Violated`
 * (`unaware`: acted before learning), `Gap` (outside the ledger's completeness
 * window — we cannot tell). Produced by the {@see AwarenessAdjudicator}; the
 * shape is identical on either ordering axis (Instant or Ordinal).
 */
class AwarenessFinding extends Data
{
    public function __construct(
        public string $knower,
        public string $fact,
        public VerdictState $state,
        public ?int $learnedBy,
        public int $actedAt,
    ) {}
}
