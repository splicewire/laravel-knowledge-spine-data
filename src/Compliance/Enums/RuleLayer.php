<?php

namespace Splicewire\KnowledgeSpineData\Compliance\Enums;

/**
 * The corpus layer a rule is authored in. A subject inherits the union of every
 * layer that matches it; rules are authored once, in their proper layer, and
 * verticals compose rather than duplicate. See schema §1.1.
 */
enum RuleLayer: string
{
    case Universal = 'universal';
    case BusinessModel = 'business_model';
    case Vertical = 'vertical';
    case Jurisdiction = 'jurisdiction';
}
