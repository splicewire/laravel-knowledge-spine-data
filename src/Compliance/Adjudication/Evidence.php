<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Adjudication;

use Spatie\LaravelData\Data;

/**
 * A provenance-bearing value or attestation bound to a specific claim — the thing
 * the "can you prove it" axis evaluates against.
 *
 * Engine vocabulary only: an `Evidence` item is a measured `value` (a numeric COA
 * result, a boolean attestation) cited by a `reference`, carrying a `provenance`
 * trust rank (higher is stronger). The *host* names what it is — a lab COA, a
 * supplier attestation, a country-of-origin doc — and supplies the rank from its
 * own `ProvenanceTier`; the engine never names those.
 *
 * `boundTo` is the `facetPath` of the {@see ComplianceClaim} this evidence
 * substantiates, so a claim can be bound to several evidence items and the
 * strongest available one drives the verdict's provenance floor.
 */
class Evidence extends Data
{
    public function __construct(
        /** The claim facetPath this evidence is bound to. */
        public string $boundTo,

        /** The measured / attested value the evidence carries. */
        public mixed $value,

        /** Citation handle for the evidence item (e.g. a COA id). */
        public string $reference,

        /** Trust rank of the evidence (higher is stronger); maps a host ProvenanceTier. */
        public ?int $provenance = null,
    ) {}
}
