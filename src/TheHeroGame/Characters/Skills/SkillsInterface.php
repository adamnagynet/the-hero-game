<?php

/**
 * Interface SkillInterface
 * @package TheHeroGame\Characters\Skills
 */
namespace TheHeroGame\Characters\Skills;

interface SkillsInterface
{
    public function getSpecialDamage(int $damage): int;
}