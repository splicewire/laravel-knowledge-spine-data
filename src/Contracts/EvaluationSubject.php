<?php

namespace Rushing\KnowledgeSpineData\Contracts;

/**
 * The thing a corpus is resolved against — abstract on purpose.
 *
 * The engine never names the subject. Whether it is a payments merchant, a food
 * establishment, an appraisal assignment, or a narrative character is the
 * host's concern. A host type becomes resolvable by projecting itself into the
 * flat, nested array the predicate evaluator reads.
 *
 * Keys are the field paths predicates address. An absent facet must be *omitted*
 * (not set to null) so a predicate over it resolves to UNKNOWN rather than
 * false — the false-negative guard that runs through the whole engine.
 */
interface EvaluationSubject
{
    /** @return array<string, mixed> */
    public function toEvaluationContext(): array;
}
