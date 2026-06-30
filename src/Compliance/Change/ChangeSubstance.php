<?php

namespace Rushing\KnowledgeSpineData\Compliance\Change;

/**
 * What changed about a rule — the global, subject-independent axis. Pairs with
 * a {@see TemporalDirection} (when it bites) to derive a per-subject
 * {@see Disposition}. See schema §5.1.
 */
enum ChangeSubstance: string
{
    case NewObligation = 'new_obligation';
    case Tightened = 'tightened';
    case Relaxed = 'relaxed';

    /** Body unchanged, predicate now matches more subjects — the dangerous-quiet one. */
    case ScopeExpanded = 'scope_expanded';
    case ScopeContracted = 'scope_contracted';

    case Clarification = 'clarification';

    /** A defined term/threshold changed; ripples into every rule referencing it. */
    case Redefinition = 'redefinition';

    case Withdrawn = 'withdrawn';

    /** The corpus had it wrong; a knowledge-axis fix, not a real-world change. */
    case Correction = 'correction';
}
