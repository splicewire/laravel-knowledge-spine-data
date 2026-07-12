<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Concept;

/**
 * Where a synonym came from — which sets its trust. Authority synonyms are high
 * trust; reviewer-confirmed ones are the growth engine (each correction makes the
 * next merchant's identical string auto-resolve). See ingredient ontology §3/§6.
 */
enum SynonymSource: string
{
    case Authority = 'authority';
    case TaggerLearned = 'tagger_learned';
    case ReviewerConfirmed = 'reviewer_confirmed';
}
