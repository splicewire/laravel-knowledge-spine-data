<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Concept;

/**
 * Confidence is control flow, not a stored number. A tagged string lands in one
 * of three bands: auto-accepted, routed to a human reviewer, or surfaced as
 * unknown — never silently guessed into a convenient category. The middle band
 * is the product's core interaction, not overhead. See ingredient ontology §5.
 */
enum ResolutionBand: string
{
    case Accepted = 'accepted';
    case Review = 'review';
    case Unknown = 'unknown';
}
