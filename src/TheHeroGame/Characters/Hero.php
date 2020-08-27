<?php

namespace TheHeroGame\Characters;

use TheHeroGame\Characters\Skills\AbstractSkills;

/**
 * Class Hero
 */
class Hero extends AbstractCharacters
{
    /** @var array $skills */
    protected $skills = [];

    /** @var array $skillsTypes */
    protected $skillsTypes = [
        AbstractSkills::RAPID_STRIKE_CLASS,
        AbstractSkills::MAGIC_SHIELD_CLASS,
    ];

    /**
     * @return array
     */
    public function getSkillsTypes(): array
    {
        return $this->skillsTypes;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * Add skill to Hero
     *
     * @param AbstractSkills $skill
     * @return Hero
     */
    public function addSkill(AbstractSkills $skill): Hero
    {
        foreach ($this->skillsTypes as $skillType) {
            if (!$this->skillIsSet($skill, $skillType) && $skillType == $skill->getType()) {
                $this->skills[$skillType] = $skill;
            }
        }
        return $this;
    }

    /**
     * Checks if a skill is already added for Hero
     *
     * @param AbstractSkills $skill
     * @param string $skillType
     * @return bool
     */
    private function skillIsSet(AbstractSkills $skill, string $skillType)
    {
        if (isset($this->skills[$skillType]) &&
            $this->skills[$skillType] instanceof $skill) {
            return true;
        }
        return false;
    }
}