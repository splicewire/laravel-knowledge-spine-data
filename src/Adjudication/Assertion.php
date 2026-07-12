<?php

namespace Splicewire\KnowledgeSpineData\Adjudication;

use Splicewire\KnowledgeSpineData\Contracts\EvaluationSubject;
use Spatie\LaravelData\Data;

/**
 * An addressable claim: a single facet a subject asserts, lifted out of the
 * anonymous evaluation context so it can be adjudicated on its own.
 *
 * The resolver reads a subject's context as undifferentiated facets. Adjudication
 * needs each claim to be a *thing* — iterable, citable, carrying its own
 * provenance — so that "is this claim consistent with the governing reference?"
 * is a question about an object, not a key. `provenance` is an optional trust
 * rank (higher is stronger); the kernel never names the tiers, leaving the host
 * to map them.
 */
class Assertion extends Data
{
    public function __construct(
        public string $facetPath,
        public mixed $value,
        public ?int $provenance = null,
    ) {}

    /**
     * Enumerate a subject's asserted facets. An *omitted* facet does not become
     * an assertion — it stays unknown, exactly as a predicate over it would
     * resolve to UNKNOWN rather than a false claim.
     *
     * @return array<string, Assertion> keyed by facetPath
     */
    public static function fromSubject(EvaluationSubject $subject): array
    {
        return self::fromContext($subject->toEvaluationContext());
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, Assertion>
     */
    public static function fromContext(array $context): array
    {
        $assertions = [];

        foreach ($context as $facetPath => $value) {
            $assertions[$facetPath] = new self($facetPath, $value);
        }

        return $assertions;
    }
}
