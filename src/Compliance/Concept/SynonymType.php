<?php

namespace Rushing\KnowledgeSpineData\Compliance\Concept;

/**
 * The kind of surface string that maps to a canonical concept. MARKETING and
 * MISSPELLING matter more here than in a clinical ontology — a compliance
 * catalog must model the names people actually use, not just the official ones.
 * See the ingredient ontology spec §3.
 */
enum SynonymType: string
{
    case Generic = 'generic';
    case Brand = 'brand';
    case Abbreviation = 'abbreviation';
    case Marketing = 'marketing';
    case Misspelling = 'misspelling';
    case Street = 'street';
}
