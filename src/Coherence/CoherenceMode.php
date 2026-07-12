<?php

namespace Splicewire\KnowledgeSpineData\Coherence;

/**
 * How a {@see CoherenceConstraint} judges an assertion against canon — the
 * contradiction-detection vocabulary the compliance module's obligation
 * resolution lacks.
 */
enum CoherenceMode: string
{
    /** Once established, the value must not be contradicted by a later assertion. */
    case Stable = 'stable';

    /** Not two distinct values for the dimension at one ordering point. */
    case UniqueAtTime = 'unique-at-time';

    /** The acting knower must have learned the fact by the point they acted. */
    case RequiresAwareness = 'requires-awareness';

    /** The predicate leaf operator this mode compares asserted-vs-canon under. */
    public function operator(): string
    {
        return match ($this) {
            self::Stable, self::UniqueAtTime => 'eq',
            self::RequiresAwareness => 'eq',
        };
    }
}
