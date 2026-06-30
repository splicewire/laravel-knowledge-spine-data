<?php

namespace Rushing\KnowledgeSpineData\Coherence;

use Rushing\KnowledgeSpineData\Coherence\Concerns\HasOrderingWindow;
use Rushing\KnowledgeSpineData\Knowledge\OrderingPoint;
use Spatie\LaravelData\Data;

/**
 * An established fact about a concept on a dimension, holding over an ordering
 * window — the coherence analog of the compliance module's `ConceptStatus`.
 *
 * "Lucas (concept) is a Camargue (value) horse on the breed (dimension),
 * established at chapter 1 (effectiveStart), per the story bible (source,
 * Declared provenance)." A later assertion is judged against the canon facts
 * that hold as of the asked-for story point.
 *
 * The window rides a generic {@see OrderingPoint} so "as of this point" is
 * *story* time (`Ordinal`/chapter), not edit time — though an `Instant` axis
 * works identically. `provenance` carries the trust tier so a `Derived` fact
 * contradicting a `Declared` one surfaces as drift, never a silent overwrite.
 */
class CanonFact extends Data
{
    use HasOrderingWindow;

    public function __construct(
        public string $conceptId,
        public string $dimension,
        public mixed $value,
        public CanonProvenance $provenance = CanonProvenance::Declared,
        /** The story point this fact begins to hold (inclusive); null = always. */
        public ?OrderingPoint $effectiveStart = null,
        /** The story point this fact stops holding (exclusive); null = open. */
        public ?OrderingPoint $effectiveEnd = null,
        /** The draft revision this record was learned at; null = always known. */
        public ?OrderingPoint $ingestedAt = null,
        /** The draft revision this record was retracted at; null = still live. */
        public ?OrderingPoint $knownUntil = null,
        public ?string $source = null,
    ) {}

    /** The kernel trust rank (higher is stronger) for a `Verdict::provenanceFloor`. */
    public function provenanceRank(): int
    {
        return $this->provenance->rank();
    }

    /**
     * The reference key under which this fact is addressed in a determination —
     * `concept/dimension`, stable across the window.
     */
    public function reference(): string
    {
        return $this->conceptId.'/'.$this->dimension;
    }
}
