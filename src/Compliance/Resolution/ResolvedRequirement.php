<?php

namespace Rushing\KnowledgeSpineData\Compliance\Resolution;

use Rushing\KnowledgeSpineData\Compliance\Provenance\ProvenanceTier;
use Spatie\LaravelData\Data;

/**
 * The settled value for one requirement_key, plus the provenance that produced
 * it. The engine's output is a map of these, not a rule list. See schema §3.
 *
 * `provenanceFloor` qualifies the result by input quality: the weakest trust
 * tier among the subject facets the contributing rules depended on, or null when
 * the subject does not expose provenance. See schema §6.4.
 */
class ResolvedRequirement extends Data
{
    public function __construct(
        public string $requirementKey,
        public mixed $resolvedRequirement,
        public ResolutionPolicy $policy,
        /** @var Provenance[] */
        public array $provenance,
        public ?ProvenanceTier $provenanceFloor = null,
    ) {}
}
