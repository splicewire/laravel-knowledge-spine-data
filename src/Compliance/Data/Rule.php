<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Data;

use Carbon\CarbonImmutable;
use Splicewire\KnowledgeSpineData\Compliance\Concerns\HasBitemporalValidity;
use Splicewire\KnowledgeSpineData\Compliance\Enums\RuleLayer;
use Splicewire\KnowledgeSpineData\Compliance\Enums\RuleStatus;
use Rushing\LaravelDataSchemas\Attributes\Description;
use Rushing\LaravelDataSchemas\Attributes\Example;
use Spatie\LaravelData\Data;

/**
 * An atomic rule fragment — the authored unit of the layered corpus.
 *
 * This Data class is the source of truth (schemas all the way down): its
 * JSON-Schema projection is what every consumer reads, whether the fragment is
 * authored locally as PHP here or codegen'd remotely from a host's tenant
 * store. See ADR-0001 and schema reference §1.2.
 */
class Rule extends Data
{
    use HasBitemporalValidity;

    public function __construct(
        #[Description('Domain-prefixed stable identifier, e.g. RULE-0042.')]
        #[Example('RULE-0042')]
        public string $fragmentId,

        #[Description('Corpus layer this rule is authored in.')]
        public RuleLayer $layer,

        #[Description('Citable source, e.g. "Visa Core Rules §5.4.2", "21 CFR 1308.13".')]
        #[Example('Visa Core Rules §5.4.2')]
        public string $source,

        #[Description('The atomic rule statement.')]
        public string $body,

        #[Description('Boolean predicate tree evaluated against the subject under three-valued logic.')]
        public array $appliesTo,

        #[Description('The dimension this rule speaks to. The host vertical defines its dimension keys.')]
        public string $requirementKey,

        #[Description('The value asserted on the requirement_key.')]
        public mixed $requirement,

        #[Description('Integer precedence used by the Precedence policy — higher wins. The host names its ladder (e.g. law > regulator > contract); the engine compares only the ordering.')]
        public int $precedenceTier,

        #[Description('When the rule came into force in the world (effective-time lower bound).')]
        public ?CarbonImmutable $effectiveStart = null,

        #[Description('When the rule ceased to be in force; null means currently in force.')]
        public ?CarbonImmutable $effectiveEnd = null,

        #[Description('Knowledge-time: when the corpus learned this fragment.')]
        public ?CarbonImmutable $ingestedAt = null,

        #[Description('Set only if we retroactively learned this knowledge-time fact was wrong.')]
        public ?CarbonImmutable $knownUntil = null,

        #[Description('fragment_id this rule supersedes, dropped from the candidate set before resolution.')]
        public ?string $supersedes = null,

        #[Description('Why it changed — the human-facing change explanation.')]
        public ?string $changeNote = null,

        public RuleStatus $status = RuleStatus::Active,
    ) {}
}
