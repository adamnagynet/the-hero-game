<?php

namespace TheHeroGame\Characters;

/**
 * Class AbstractCharacters
 * @package TheHeroGame\Characters
 */
abstract class AbstractCharacters
{
    /** @var $name */
    protected $name;

    /** @var $health int */
    protected $health;

    /** @var $strength int */
    protected $strength;

    /** @var $defence int */
    protected $defence;

    /** @var $speed int */
    protected $speed;

    /** @var $luck int */
    protected $luck;

    /** @var $avatar string */
    protected $avatar;

    /**
     * AbstractCharacters constructor.
     */
    public function __construct()
    {
    }

    /**
     * Returns the characters' name
     *
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->name;
    }

    /**
     * Sets characters' name
     *
     * @param string $name
     * @return AbstractCharacters
     */
    public function setPlayerName(string $name): AbstractCharacters
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Return character's health
     *
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Sets character's health
     *
     * @param int $health
     * @return AbstractCharacters
     */
    public function setHealth(int $health): AbstractCharacters
    {
        $this->health = $health;
        return $this;
    }

    /**
     * Return character's strength
     *
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * Sets character's strength
     *
     * @param int $strength
     * @return AbstractCharacters
     */
    public function setStrength(int $strength): AbstractCharacters
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * Return character's defence
     *
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * Sets character's defence
     *
     * @param int $defence
     * @return AbstractCharacters
     */
    public function setDefence(int $defence): AbstractCharacters
    {
        $this->defence = $defence;
        return $this;
    }

    /**
     * Return character's speed
     *
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * Sets character's speed
     *
     * @param int $speed
     * @return AbstractCharacters
     */
    public function setSpeed(int $speed): AbstractCharacters
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * Return character's luck
     *
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * Sets character's luck
     *
     * @param int $luck
     * @return AbstractCharacters
     */
    public function setLuck(int $luck): AbstractCharacters
    {
        $this->luck = $luck;
        return $this;
    }

    /**
     * Return character's avatar
     *
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Sets character's avatar
     *
     * @param string avatar
     * @return AbstractCharacters
     */
    public function setAvatar(string $avatar): AbstractCharacters
    {
        $this->avatar = $avatar;
        return $this;
    }
}