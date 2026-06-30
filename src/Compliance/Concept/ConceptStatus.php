<?php

namespace Rushing\KnowledgeSpineData\Compliance\Concept;

use Carbon\CarbonImmutable;
use Rushing\KnowledgeSpineData\Compliance\Concerns\HasBitemporalValidity;
use Spatie\LaravelData\Data;

/**
 * An authority-sourced, bitemporal regulatory status for a concept in a
 * jurisdiction — "this substance has this classification per this authority, in
 * force over this window, learned by us at this time." The same two-axis design
 * as a rule fragment, now on the concept side: it answers "was this substance
 * scheduled on the date the merchant processed that transaction?" See the
 * ingredient ontology §4.
 *
 * Jurisdiction is not optional — federal and state schedules diverge, so status
 * resolution threads the subject's geography the way rule resolution does. The
 * status states the regulatory *fact with a source*; it never decides legality.
 */
class ConceptStatus extends Data
{
    use HasBitemporalValidity;

    public function __construct(
        public string $conceptId,
        public string $jurisdiction,
        public string $authority,
        public string $classification,
        public ?CarbonImmutable $effectiveStart = null,
        public ?CarbonImmutable $effectiveEnd = null,
        public ?CarbonImmutable $ingestedAt = null,
        public ?CarbonImmutable $knownUntil = null,
        public ?string $supersedes = null,
        public ?string $source = null,
        public ?string $sourceUrl = null,
        public ?string $changeNote = null,
        public StatusState $status = StatusState::Active,
        public ?string $statusId = null,
    ) {}
}
