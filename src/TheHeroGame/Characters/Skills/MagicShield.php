<?php

namespace TheHeroGame\Characters\Skills;

/**
 * Class MagicShield
 *
 * Limits the damage made by the enemy to half
 *
 * @package TheHeroGame\Characters\Skills
 */
class MagicShield extends AbstractSkills implements SkillsInterface
{
    /**
     * MagicShield constructor
     * @param string $type
     * @param int $chance
     */
    public function __construct(string $type, int $chance)
    {
        parent::__construct($type, $chance);
    }

    /**
     * Limits the damage inflicted to the player to half
     *
     * @param int $damage
     * @return int
     */
    public function getSpecialDamage(int $damage): int
    {
        return $damage / 2;
    }
}