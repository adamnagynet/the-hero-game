<?php

namespace TheHeroGame\Config;

/**
 * Class GameConfig
 *
 * @package TheHeroGame
 */
class GameConfig
{
    const MAX_ROUNDS = 20;

    const HERO = 'hero';
    const HERO_NAME = 'Orderus';
    const HERO_STATS = [
        'MIN_HEALTH'    => 70,
        'MAX_HEALTH'    => 100,
        'MIN_STRENGTH'  => 70,
        'MAX_STRENGTH'  => 80,
        'MIN_DEFENCE'   => 45,
        'MAX_DEFENCE'   => 55,
        'MIN_SPEED'     => 40,
        'MAX_SPEED'     => 50,
        'MIN_LUCK'      => 10,
        'MAX_LUCK'      => 30,
    ];
    const HERO_SKILLS = [
        'RAPID_STRIKE'  => 10,
        'MAGIC_SHIELD'  => 20,
    ];
    const HERO_EMOJI = '🧝';

    const BEAST = 'beast';
    const BEASTS_NAMES = [
        'CartAbandonatus',
        'ShippingCostMaximus',
        'NoMoreCreditOnCardia',
        'WindowShopItAll',
        'PriceComparingo',
        'RatingsCheckerus'
    ];
    const BEAST_STATS = [
        'MIN_HEALTH'    => 60,
        'MAX_HEALTH'    => 90,
        'MIN_STRENGTH'  => 60,
        'MAX_STRENGTH'  => 90,
        'MIN_DEFENCE'   => 40,
        'MAX_DEFENCE'   => 60,
        'MIN_SPEED'     => 40,
        'MAX_SPEED'     => 60,
        'MIN_LUCK'      => 25,
        'MAX_LUCK'      => 40,
    ];
    const BEAST_EMOJI = [
        '🦖', '🦕', '🐉', '🦂', '🐲', '🕷️'
    ];

}