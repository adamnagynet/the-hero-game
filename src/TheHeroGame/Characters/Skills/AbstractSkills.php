<?php

namespace TheHeroGame\Characters\Skills;

/**
 * Class AbstractSkills
 * @package TheHeroGame\Characters\Skills
 */
abstract class AbstractSkills
{
    const RAPID_STRIKE_CLASS = 'RapidStrike';
    const MAGIC_SHIELD_CLASS = 'MagicShield';

    /** @var int $chance */
    protected $chance;

    /** @var string $type */
    protected $type;

    /** @var int $useSkill */
    protected $useSkill;

    /**
     * AbstractSkills constructor
     *
     * @param string $type
     * @param int $chance
     */
    public function __construct(string $type, int $chance)
    {
        $this->type = $type;
        $this->chance = $chance;
    }

    /**
     * @return mixed
     */
    public function getChance(): int
    {
        return $this->chance;
    }

    /**
     * @return mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUseSkill(): bool
    {
        return $this->useSkill;
    }

    /**
     * @return AbstractSkills
     */
    public function useSkill(): AbstractSkills
    {
        $rand = mt_rand(0, 100);
        $useSkill = $rand <= $this->getChance();
        $this->useSkill = $useSkill;

        return $this;
    }
}