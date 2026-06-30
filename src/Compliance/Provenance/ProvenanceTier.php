<?php

namespace Rushing\KnowledgeSpineData\Compliance\Provenance;

/**
 * The trust tier of a subject facet — how the value was obtained. The engine
 * qualifies its output by the *weakest* input that drove a conclusion: a result
 * resting on a merely declared fact is only as defensible as that declaration.
 * See schema §6.1 / §6.4.
 *
 * Ranked so the "floor" of a set is its lowest tier.
 */
enum ProvenanceTier: int
{
    case Declared = 1;
    case Derived = 2;
    case Verified = 3;
}
