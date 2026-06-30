<?php

namespace Rushing\KnowledgeSpineData\Compliance\Adjudication;

use Spatie\LaravelData\Data;

/**
 * The governing standard a claim's bound evidence is checked against — the
 * "prove it" reference. It pairs a `limit` (the spec value evidence must satisfy)
 * with the predicate leaf `operator` the measured evidence value is compared to
 * the limit under (`gte` for a purity floor, `lte` for an impurity ceiling, `eq`
 * for an attested match).
 *
 * Authored host-side per claim; the engine only compares. `claimFacet` is the
 * {@see ComplianceClaim} facetPath the standard governs, so the
 * {@see SubstantiationCheck} can find the standard for a claim.
 */
class SubstantiationStandard extends Data
{
    public function __construct(
        /** The claim facetPath this standard governs. */
        public string $claimFacet,

        /** The spec value the evidence must satisfy. */
        public mixed $limit,

        /** The predicate leaf op the measured value is compared to the limit under. */
        public string $operator = 'gte',

        /** Citation handle for the standard (e.g. the controlling spec/rule id). */
        public ?string $reference = null,
    ) {}
}
