<?php

namespace Rushing\KnowledgeSpineData\Adjudication;

use Carbon\CarbonImmutable;
use InvalidArgumentException;
use Rushing\KnowledgeSpineData\Knowledge\Instant;
use Rushing\KnowledgeSpineData\Knowledge\OrderingPoint;
use Rushing\KnowledgeSpineData\Knowledge\Ordinal;
use Spatie\LaravelData\Data;

/**
 * A serializable projection of an {@see OrderingPoint} — `(kind, value)` — so a
 * {@see Determination} can stamp its axis and survive as JSON / a generated
 * schema without leaking a Carbon or an interface into the record.
 *
 * The same decomposition the Eloquent knowledge ledger already uses: `kind`
 * names the axis (`instant` | `ordinal`), `value` is the single comparable
 * integer (a Unix timestamp for an Instant, the ordinal for an Ordinal). It
 * round-trips back to a concrete OrderingPoint so a recorded determination
 * reconstructs its axis without re-reading anything.
 */
class OrderingStamp extends Data
{
    public function __construct(
        public string $kind,
        public int $value,
    ) {}

    public static function of(OrderingPoint $point): self
    {
        return match (true) {
            $point instanceof Instant => new self('instant', $point->at->getTimestamp()),
            $point instanceof Ordinal => new self('ordinal', $point->value),
            default => throw new InvalidArgumentException('Cannot stamp an ordering point of type '.$point::class.'.'),
        };
    }

    public function toOrderingPoint(): OrderingPoint
    {
        return match ($this->kind) {
            'instant' => new Instant(CarbonImmutable::createFromTimestamp($this->value, 'UTC')),
            'ordinal' => new Ordinal($this->value),
            default => throw new InvalidArgumentException("Unknown ordering kind `{$this->kind}`."),
        };
    }
}
