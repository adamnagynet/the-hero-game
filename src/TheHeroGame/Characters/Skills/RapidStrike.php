<?php

namespace TheHeroGame\Characters\Skills;

/**
 * Class RapidStrike
 *
 * Gives the hero player the ability to double the caused damage during one attack
 *
 * @package TheHeroGame\Characters\Skills
 */
class RapidStrike extends AbstractSkills implements SkillsInterface
{
    /**
     * RapidStrike constructor
     * @param string $type
     * @param int $chance
     */
    public function __construct(string $type, int $chance)
    {
        parent::__construct($type, $chance);
    }

    /**
     * Doubles the damage inflicted by the player
     *
     * @param int $damage
     * @return int
     */
    public function getSpecialDamage(int $damage): int
    {
        return $damage * 2;
    }

}