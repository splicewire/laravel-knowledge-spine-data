<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Concept;

use Spatie\LaravelData\Data;

/**
 * The tagger's verdict on one raw string: which band it fell in, the accepted
 * concept (only when Accepted), and the candidates considered. A Review or
 * Unknown surfaces honestly rather than guessing — the difference between a
 * diligence tool and an evasion tool, at the catalog-item level.
 */
class ConceptResolution extends Data
{
    public function __construct(
        public string $raw,
        public ResolutionBand $band,
        public ?string $conceptId = null,
        public float $confidence = 0.0,
        /** @var ConceptMatch[] */
        public array $candidates = [],
    ) {}

    public function isAccepted(): bool
    {
        return $this->band === ResolutionBand::Accepted;
    }
}
