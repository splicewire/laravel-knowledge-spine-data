<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Resolution;

/**
 * How a conflict on a single requirement_key is settled when more than one
 * applicable rule asserts a value for it. Chosen per dimension, because the
 * right answer differs: licensing is precedence-driven (law wins), reserves
 * are conservative (take the strictest), registrations simply union. See §3.
 */
enum ResolutionPolicy: string
{
    /** Highest precedence_tier wins (e.g. statute over contract over guidance). */
    case Precedence = 'precedence';

    /** Most conservative numeric value wins — safety, not authority. */
    case Max = 'max';

    /** Least numeric value wins. */
    case Min = 'min';

    /** Non-conflicting; the resolved value is the set union of all asserted values. */
    case Union = 'union';
}
