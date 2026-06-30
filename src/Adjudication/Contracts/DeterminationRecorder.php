<?php

namespace Rushing\KnowledgeSpineData\Adjudication\Contracts;

use Rushing\KnowledgeSpineData\Adjudication\Determination;

/**
 * The append-only record contract for determinations. The engine defines the
 * shape of "write an immutable audit point"; the *host* supplies persistence —
 * symmetric with the compliance Service/Recorder split, where the pure service
 * composes a result and the recorder is the only writer of the durable row.
 *
 * Implementations MUST be append-only: a determination is never mutated in
 * place. The content-addressing on {@see Determination} (referenceHash /
 * assertionHash) is what lets a recorder decide whether a freshly composed
 * determination differs from the last recorded one before appending a new row.
 */
interface DeterminationRecorder
{
    /** Append an immutable determination and return what was stored. */
    public function record(Determination $determination): Determination;

    /**
     * Append only when the determination differs from the latest stored one for
     * the same subject identity; return the new record, or null when unchanged.
     */
    public function redetermine(string $subjectKey, Determination $determination): ?Determination;
}
