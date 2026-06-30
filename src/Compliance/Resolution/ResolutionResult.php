<?php

namespace Rushing\KnowledgeSpineData\Compliance\Resolution;

use Spatie\LaravelData\Data;

/**
 * The engine's answer: the resolved requirement per dimension, plus the gaps
 * that could not be answered with the profile as given. See schema §3, §6.3.
 */
class ResolutionResult extends Data
{
    public function __construct(
        /** @var array<string, ResolvedRequirement> keyed by requirement_key */
        public array $requirements = [],

        /** @var Gap[] */
        public array $gaps = [],
    ) {}

    public function requirement(string $requirementKey): ?ResolvedRequirement
    {
        return $this->requirements[$requirementKey] ?? null;
    }

    public function hasGaps(): bool
    {
        return $this->gaps !== [];
    }
}
