<?php

namespace Rushing\KnowledgeSpineData\Adjudication;

/**
 * A stable content hash over an arbitrary value, canonicalized so the same
 * content always hashes identically regardless of associative key order.
 *
 * This is the kernel generalization of the host's declaration/corpus hashing:
 * a `Determination` is content-addressed by hashing its own inline inputs, so a
 * recorded determination is self-contained and reproducible — its identity is a
 * pure function of what it carries, never of when or where it was computed.
 * List order is significant; map order is not.
 */
final class ContentHash
{
    public static function of(mixed $content): string
    {
        return hash('sha256', self::canonical($content));
    }

    private static function canonical(mixed $value): string
    {
        if (is_array($value)) {
            $isList = array_is_list($value);

            if (! $isList) {
                ksort($value);
            }

            $parts = [];
            foreach ($value as $key => $item) {
                $parts[] = ($isList ? '' : $key.':').self::canonical($item);
            }

            return '['.implode(',', $parts).']';
        }

        if ($value instanceof \BackedEnum) {
            return self::canonical($value->value);
        }

        return (string) json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
