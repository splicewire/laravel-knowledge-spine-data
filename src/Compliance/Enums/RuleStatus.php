<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Enums;

/**
 * Lifecycle of a rule fragment. Revisions supersede, they don't delete:
 * SUPERSEDED leaves the hot path but stays retrievable for point-in-time and
 * diff. WITHDRAWN is reserved for rules that were never valid (ingested in
 * error), never for ones that merely aged out. See schema §1.2.
 */
enum RuleStatus: string
{
    case Active = 'active';
    case Superseded = 'superseded';
    case Withdrawn = 'withdrawn';
}
