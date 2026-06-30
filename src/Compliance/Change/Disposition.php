<?php

namespace Rushing\KnowledgeSpineData\Compliance\Change;

/**
 * What a subject must do about a change — the derived, per-subject output of the
 * taxonomy. Computed from substance × direction × in-scope, never declared by
 * the bulletin. See schema §5.3 and {@see DispositionCalculator}.
 */
enum Disposition: string
{
    case ActUrgent = 'act_urgent';
    case ActRequired = 'act_required';
    case Awareness = 'awareness';
    case NoImpact = 'no_impact';
}
