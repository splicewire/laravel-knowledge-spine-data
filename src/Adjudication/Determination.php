<?php

namespace Splicewire\KnowledgeSpineData\Adjudication;

use Splicewire\KnowledgeSpineData\Knowledge\OrderingPoint;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

/**
 * An immutable, content-addressed audit point — the domain-agnostic
 * generalization of the host `Disclosure`.
 *
 * A Determination holds its verdicts (`findings[]`), awareness findings
 * (`awareness[]`), and unanswerable assertions (`gaps[]`) **inline and
 * un-flattened**, so a deferred UX can point a grid at `(claim × reference)`
 * cells with no rework. It is stamped with an {@see OrderingStamp} so the same
 * shape serves wall-clock (`Instant`) and chapter (`Ordinal`).
 *
 * It is content-addressed by two hashes derived purely from its own inline
 * inputs: `referenceHash` (the governing reference corpus) and `assertionHash`
 * (the subject's claims) — the kernel generalization of `corpus_hash` /
 * `declaration_hash`. Because both the hashes and the verdicts are carried
 * inline, a recorded determination **reproduces from itself** and never
 * re-reads the corpus: it is a self-contained audit point, never a cache.
 */
class Determination extends Data
{
    public function __construct(
        public string $referenceHash,
        public string $assertionHash,
        public OrderingStamp $orderingStamp,

        /** @var Verdict[] per-assertion verdicts, kept un-flattened */
        #[DataCollectionOf(Verdict::class)]
        public array $findings,

        /** @var string[] assertions that could not be assessed */
        public array $gaps,

        /**
         * The reference inputs the verdicts rest on, kept inline so the record
         * reproduces without re-reading the corpus.
         *
         * @var array<string, mixed>
         */
        public array $referenceInputs,

        /** @var array<string, mixed> the asserted inputs, kept inline */
        public array $assertionInputs,

        /** @var AwarenessFinding[] awareness findings folded in by the AwarenessAdjudicator */
        #[DataCollectionOf(AwarenessFinding::class)]
        public array $awareness = [],
    ) {}

    /**
     * Compose a determination from inputs already in hand. Nothing here reads a
     * corpus or a resolver — the determination is a pure projection of what the
     * caller passes, which is exactly why it can reproduce itself later.
     *
     * @param  array<string, mixed>  $referenceInputs
     * @param  array<string, mixed>  $assertionInputs
     * @param  Verdict[]  $findings
     * @param  string[]  $gaps
     * @param  AwarenessFinding[]  $awareness
     */
    public static function compose(
        array $referenceInputs,
        array $assertionInputs,
        array $findings,
        array $gaps,
        OrderingPoint $orderingPoint,
        array $awareness = [],
    ): self {
        return new self(
            referenceHash: ContentHash::of($referenceInputs),
            assertionHash: ContentHash::of($assertionInputs),
            orderingStamp: OrderingStamp::of($orderingPoint),
            findings: $findings,
            gaps: $gaps,
            referenceInputs: $referenceInputs,
            assertionInputs: $assertionInputs,
            awareness: $awareness,
        );
    }
}
