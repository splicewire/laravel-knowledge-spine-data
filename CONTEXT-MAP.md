# laravel-knowledge-spine-data — Context Map (spoke)

The satellite-facing DTO half of the knowledge engine (`Assertion`/`Verdict`/`Determination`/
`CanonFact`/`ComplianceClaim`). Layering + shared seam rules: `splicewire-app/CONTEXT-MAP.md`.

## The seam this file exists to record

Its consumer lives in a **different, in-app** repo and isn't visible from here:
`laravel-knowledge-engine` (`Rushing\KnowledgeEngine\`, private) depends on this package —
**never the reverse** (1:1 parity). Adjudication is domain-agnostic — this is the package
most tempted to name host vocabulary (`merchant`/`MCC`/`SKU`/`ingredient`); it must not.
Pattern: app ADR-0044.
