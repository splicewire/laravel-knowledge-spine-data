<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Concept;

use Spatie\LaravelData\Data;

/**
 * A surface string that resolves to a concept, with the trust its source earns.
 * The open-ended set of these is how the catalog absorbs the variety of real
 * catalog strings onto one canonical id.
 */
class Synonym extends Data
{
    public function __construct(
        public string $conceptId,
        public string $text,
        public SynonymType $type = SynonymType::Generic,
        public SynonymSource $source = SynonymSource::Authority,
        public float $confidence = 1.0,
    ) {}
}
