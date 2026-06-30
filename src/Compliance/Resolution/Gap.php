<?php

namespace Rushing\KnowledgeSpineData\Compliance\Resolution;

use Spatie\LaravelData\Data;

/**
 * A rule whose applicability could not be determined because the profile is
 * missing a facet it tests. Gaps are first-class output — the "what we need to
 * assess you" checklist — never a silent pass. See schema §2 and §6.3.
 */
class Gap extends Data
{
    public function __construct(
        public string $fragmentId,
        public string $requirementKey,
        public string $source,
    ) {}
}
