<?php

namespace Rushing\KnowledgeSpineData\Compliance\Concept;

use Rushing\LaravelDataSchemas\Attributes\Description;
use Rushing\LaravelDataSchemas\Attributes\Example;
use Spatie\LaravelData\Data;

/**
 * A canonical entity a corpus refers to — kind-agnostic. The densest case is a
 * substance (UNII/CAS-anchored), but the same shape serves defined terms, MCCs,
 * cited statutes, jurisdictions. "Ingredient" is just `kind = 'substance'`; the
 * engine never says "ingredient". See approach-revision (Concept Anchor).
 */
class Concept extends Data
{
    public function __construct(
        #[Description('Stable internal id, never reused.')]
        public string $conceptId,

        #[Description('What sort of concept this is.')]
        #[Example('substance')]
        public string $kind,

        #[Description('The preferred display name.')]
        #[Example('Tirzepatide')]
        public string $preferredName,

        /** @var array<string, string> external authoritative ids: {cas, unii, drugbank, inchikey} */
        #[Description('External authoritative identifiers — the anchor of truth. An entry with none is lower-confidence.')]
        public array $identityRefs = [],

        /** @var string[] */
        #[Description('Taxonomy tags, e.g. "peptide/glp-1-agonist".')]
        public array $taxonomyTags = [],
    ) {}
}
