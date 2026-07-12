<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Contracts;

use Splicewire\KnowledgeSpineData\Compliance\Data\Rule;

/**
 * Loads the corpus as engine DTOs. The default implementation is Eloquent, but
 * a host could back this with a remote store or a fixture without the engine
 * caring — the Resolver only ever sees `Data\Rule`.
 *
 * Bitemporal/applicability filtering lives in the Resolver, not here, so the
 * repository stays a thin loader.
 */
interface RuleRepository
{
    /** @return iterable<Rule> */
    public function all(): iterable;

    /** @return iterable<Rule> rules whose requirement_key is in the given set */
    public function forRequirementKeys(array $requirementKeys): iterable;
}
