<?php

namespace Splicewire\KnowledgeSpineData\Coherence;

/**
 * The trust rank of an established fact, coherence-local on purpose.
 *
 * A declared fact (`Declared`, e.g. an authored bible) outranks a human-
 * confirmed one (`Verified`), which outranks one extracted from generated
 * output (`Derived`). The order is the thing — a `Derived` fact must never
 * silently overwrite a `Declared` one; that is exactly **coherence drift**.
 *
 * This is the coherence sibling of the compliance module's provenance tiering,
 * NOT a reference to it: the kernel `Verdict::provenanceFloor` is a bare `int`
 * rank, so coherence maps its own tiers to ranks here and never imports a
 * `Compliance\` symbol (ADR-0004). Higher rank is stronger.
 */
enum CanonProvenance: string
{
    case Derived = 'derived';
    case Verified = 'verified';
    case Declared = 'declared';

    /** The kernel trust rank (higher is stronger) this tier projects to. */
    public function rank(): int
    {
        return match ($this) {
            self::Derived => 1,
            self::Verified => 2,
            self::Declared => 3,
        };
    }

    /** Does this tier outrank another — i.e. may it overwrite it without drift? */
    public function outranks(self $other): bool
    {
        return $this->rank() > $other->rank();
    }
}
