<?php

namespace Rushing\KnowledgeSpineData\Compliance\Concept;

use Spatie\LaravelData\Data;

/** A candidate concept for a raw string, with the confidence of the match. */
class ConceptMatch extends Data
{
    public function __construct(
        public string $conceptId,
        public float $confidence,
    ) {}
}
