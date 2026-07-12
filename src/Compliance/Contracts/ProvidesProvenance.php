<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Contracts;

use Splicewire\KnowledgeSpineData\Compliance\Provenance\ProvenanceTier;

/**
 * An optional capability a subject may implement alongside `EvaluationSubject`:
 * the trust tier behind each facet, keyed by the field path predicates address.
 *
 * The resolver consults it only if present, so the seam stays backward-compatible
 * — a plain subject simply yields unqualified output (a null floor). Return null
 * for a path whose provenance is unknown.
 */
interface ProvidesProvenance
{
    public function provenanceOf(string $fieldPath): ?ProvenanceTier;
}
