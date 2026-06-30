<?php

namespace Rushing\KnowledgeSpineData\Adjudication;

use Rushing\KnowledgeSpineData\Predicate\Ternary;
use Spatie\LaravelData\Data;

/**
 * The first-class output the resolver used to throw away: a three-valued verdict
 * on one asserted facet against one governing reference.
 *
 * `state` is the direct {@see Ternary} projection, read per consumer
 * (permissible/impermissible/gap, substantiated/unsubstantiated/gap,
 * coherent/conflict/gap). The verdict carries everything an auditor needs to
 * trace the decision — the cited `reference`, the `asserted` and `governing`
 * values, the contributing `sources`, and the `provenanceFloor` (the weakest
 * trust rank the verdict rests on; higher is stronger, null when unqualified).
 *
 * Per-assertion and un-flattened on purpose: a `Determination` holds a list of
 * these so a future UX can map `(claim × reference)` cells with no rework.
 */
class Verdict extends Data
{
    public function __construct(
        public string $dimension,
        public VerdictState $state,
        public ?string $reference,
        public mixed $asserted,
        public mixed $governing,
        /** @var string[] */
        public array $sources = [],
        public ?int $provenanceFloor = null,
        public ?string $knower = null,
    ) {}

    /**
     * Project a comparison Ternary into a verdict.
     *
     * Named `for` (not `from`) so it does not shadow spatie's `Data::from()`.
     *
     * @param  string[]  $sources
     */
    public static function for(
        string $dimension,
        Ternary $comparison,
        ?string $reference,
        mixed $asserted,
        mixed $governing,
        array $sources = [],
        ?int $provenanceFloor = null,
        ?string $knower = null,
    ): self {
        return new self(
            dimension: $dimension,
            state: VerdictState::fromTernary($comparison),
            reference: $reference,
            asserted: $asserted,
            governing: $governing,
            sources: $sources,
            provenanceFloor: $provenanceFloor,
            knower: $knower,
        );
    }
}
