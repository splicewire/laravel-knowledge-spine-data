<?php

namespace Splicewire\KnowledgeSpineData\Knowledge;

/**
 * A point on *some* ordering axis along which knowledge accrues.
 *
 * Knowledge time is not necessarily wall-clock. Compliance orders by date
 * ({@see Instant}); a narrative orders by chapter, an audit by transaction
 * sequence ({@see Ordinal}). The kernel stays neutral: it only needs to compare
 * two points on the *same* axis. Comparing across axes is a programming error
 * and throws.
 */
interface OrderingPoint
{
    /**
     * Spaceship comparison against another point on the same axis:
     * negative if this is earlier, 0 if equal, positive if later. Implementations
     * throw on a cross-axis comparison (e.g. an Ordinal against an Instant).
     */
    public function compareTo(OrderingPoint $other): int;
}
