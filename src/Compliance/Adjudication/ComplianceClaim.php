<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Adjudication;

use Spatie\LaravelData\Data;

/**
 * An asserted compliance claim, addressable on its own: a subject asserts a
 * `value` on a `dimension` (the resolver's `requirement_key`), to be judged
 * against the requirement that resolves on that dimension under a named
 * comparison `operator`.
 *
 * This is the compliance specialization of the kernel {@see
 * \Splicewire\KnowledgeSpineData\Adjudication\Assertion}: the kernel `Assertion`
 * enumerates anonymous facets; a `ComplianceClaim` additionally names *which
 * resolved requirement it is checked against* and *how*. The vocabulary stays
 * engine-level — `dimension` is a free requirement-key string, `operator` is a
 * predicate leaf op — so the host (label/ad copy → claims) names the merchant
 * words, never the engine.
 *
 * Carrying the operator on the claim (rather than inferring it) keeps the
 * adjudicator a pure comparator: "is the asserted value consistent with what the
 * rule requires, under this relation?" A permissibility check is typically
 * `eq`/`in`; a numeric tolerance is `lte`/`gte` (used by the substantiation axis).
 */
class ComplianceClaim extends Data
{
    public function __construct(
        /** The asserted facet id, used as the verdict dimension and citation handle. */
        public string $facetPath,

        /** The asserted value the merchant claims. */
        public mixed $value,

        /** The resolver requirement_key this claim is judged against. */
        public string $requirementKey,

        /** The predicate leaf op the asserted value is compared to the requirement under. */
        public string $operator = 'eq',

        /** Optional trust rank of the assertion itself (higher is stronger); null when unqualified. */
        public ?int $provenance = null,
    ) {}
}
