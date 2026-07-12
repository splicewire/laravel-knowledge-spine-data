<?php

namespace Splicewire\KnowledgeSpineData\Predicate;

/**
 * Kleene three-valued logic.
 *
 * UNKNOWN is not "maybe" and not "false" — it is a missing profile facet that
 * the engine must surface as a question, never silently resolve to false. A
 * false negative (a rule suppressed by absent data) is the dangerous direction
 * in compliance, so UNKNOWN propagates rather than collapses. See schema §2.
 */
enum Ternary: string
{
    case True = 'true';
    case False = 'false';
    case Unknown = 'unknown';

    public static function of(bool $value): self
    {
        return $value ? self::True : self::False;
    }

    public function not(): self
    {
        return match ($this) {
            self::True => self::False,
            self::False => self::True,
            self::Unknown => self::Unknown,
        };
    }

    /**
     * Conjunction over the Kleene ordering False < Unknown < True:
     * False if any operand is False, else Unknown if any is Unknown, else True.
     */
    public function and(self $other): self
    {
        if ($this === self::False || $other === self::False) {
            return self::False;
        }

        if ($this === self::Unknown || $other === self::Unknown) {
            return self::Unknown;
        }

        return self::True;
    }

    /**
     * Disjunction: True if any operand is True, else Unknown if any is Unknown,
     * else False.
     */
    public function or(self $other): self
    {
        if ($this === self::True || $other === self::True) {
            return self::True;
        }

        if ($this === self::Unknown || $other === self::Unknown) {
            return self::Unknown;
        }

        return self::False;
    }

    public function isTrue(): bool
    {
        return $this === self::True;
    }

    public function isUnknown(): bool
    {
        return $this === self::Unknown;
    }
}
