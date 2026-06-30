<?php

namespace Rushing\KnowledgeSpineData\Compliance\Resolution;

use Spatie\LaravelData\Data;

/**
 * Names a fragment that contributed to a resolved requirement. Provenance is
 * what makes the engine explainable rather than an oracle — it powers the
 * "here's the rule, confirm with counsel" framing. See schema §3.
 */
class Provenance extends Data
{
    public function __construct(
        public string $fragmentId,
        public string $source,
        public int $precedenceTier,
    ) {}
}
