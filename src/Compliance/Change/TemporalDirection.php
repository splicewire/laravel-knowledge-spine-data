<?php

namespace Rushing\KnowledgeSpineData\Compliance\Change;

/**
 * When a change bites — the temporal axis orthogonal to {@see ChangeSubstance}.
 * IMMEDIATE and RETROACTIVE escalate a disposition to urgent. See schema §5.2.
 */
enum TemporalDirection: string
{
    /** Effective in the future; runway exists. */
    case Prospective = 'prospective';

    /** Effective on announcement. */
    case Immediate = 'immediate';

    /** Effective date precedes ingestion; can move a transaction that already happened. */
    case Retroactive = 'retroactive';

    public function isUrgent(): bool
    {
        return $this === self::Immediate || $this === self::Retroactive;
    }
}
