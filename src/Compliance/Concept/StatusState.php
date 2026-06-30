<?php

namespace Rushing\KnowledgeSpineData\Compliance\Concept;

/**
 * Lifecycle of a regulatory status record. Like rule fragments, statuses
 * supersede rather than delete — a superseded status leaves the hot path but
 * stays retrievable for point-in-time and diff.
 */
enum StatusState: string
{
    case Active = 'active';
    case Superseded = 'superseded';
    case Withdrawn = 'withdrawn';
}
