<?php

namespace Splicewire\KnowledgeSpineData\Adjudication;

use Splicewire\KnowledgeSpineData\Predicate\Ternary;

/**
 * The first-class projection of {@see Ternary} as a verdict outcome.
 *
 * One enum, read per consumer: `Satisfied` is permissible / substantiated /
 * coherent; `Violated` is impermissible / unsubstantiated / conflict; `Gap` is
 * "we can't assess" — the UNKNOWN that must never collapse to a false pass or a
 * false fail. The mapping is total and lossless, so a verdict round-trips back
 * to the Ternary the resolver computed.
 */
enum VerdictState: string
{
    case Satisfied = 'satisfied';
    case Violated = 'violated';
    case Gap = 'gap';

    public static function fromTernary(Ternary $ternary): self
    {
        return match ($ternary) {
            Ternary::True => self::Satisfied,
            Ternary::False => self::Violated,
            Ternary::Unknown => self::Gap,
        };
    }

    public function toTernary(): Ternary
    {
        return match ($this) {
            self::Satisfied => Ternary::True,
            self::Violated => Ternary::False,
            self::Gap => Ternary::Unknown,
        };
    }
}
