<?php

namespace TheHeroGame\Gameplay;

use TheHeroGame\Config\GameConfig;
use TheHeroGame\Characters\AbstractCharacters;
use TheHeroGame\Characters\Hero;
use TheHeroGame\Characters\Beast;
use TheHeroGame\Characters\Skills\MagicShield;
use TheHeroGame\Characters\Skills\RapidStrike;
use TheHeroGame\Characters\Skills\AbstractSkills;
use Exception;


/**
 * Class HeroGame
 * Contains the gameplay
 *
 * @package TheHeroGame\Gameplay
 */
class HeroGame
{

    /** @var Hero*/
    protected $hero;

    /** @var Beast */
    protected $beast;

    /** @var AbstractCharacters */
    protected $winner;

    /** @var string $attacker */
    protected $attacker;

    /** @var array $statsTemp */
    protected $statsTemp = [];

    /** @var int $roundsPlayed */
    static $roundsPlayed = 0;

    public function __construct()
    {
    }

    /**
     * Enter the Emagia Forest and start the battles
     * @throws Exception
     */
    public function startBattle()
    {
        try {

            $this->initGame();

            while ($this->getPlayersAreAlive() && self::$roundsPlayed < GameConfig::MAX_ROUNDS) {

                $this->printMsgCard('Stats after attack nr.' . (self::$roundsPlayed+1));

                switch ($this->attacker) {
                    case GameConfig::HERO:
                        $this->heroAttack();
                        $this->attacker = GameConfig::BEAST;
                        break;
                    case GameConfig::BEAST:
                        $this->beastAttacks();
                        $this->attacker = GameConfig::HERO;
                        break;
                }

                $this->addHeroSpecialSkills();
                self::$roundsPlayed++;
            }

            $this->setWinner();
            $this->printMsgCard('The winner is: ' . $this->winner->getPlayerName());

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Init Gameplay
     *
     * @throws Exception
     */
    public function initGame()
    {
        try {

            $this->createHero();
            $this->createBeast();

            $this->getFirstAttacker();

            $firstMsg = '<strong>' . $this->beast->getPlayerName() . '</strong>! ⚡⚔️' . $this->beast->getAvatar();
            if ($this->attacker == GameConfig::HERO) {
                $this->printMsgCard('As you are walking through the woods, you spot a beast in sight, ' . $firstMsg);
            } else {
                $this->printMsgCard('Just as you enter the woods, you\'re surprised by the attack of ' . $firstMsg);
            }

            $this->printMsgCard('Here are your full stats before the battle:');
            $this->printStatsCards([$this->hero, $this->beast], 'full');

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Create Hero player
     *
     * @return HeroGame
     * @throws Exception
     */
    private function createHero(): HeroGame
    {
        try {

            $this->hero = new Hero();
            $this->hero->setPlayerName(GameConfig::HERO_NAME);
            $this->hero->setAvatar(GameConfig::HERO_EMOJI);
            $this->generateStats(GameConfig::HERO_STATS);

            foreach ($this->statsTemp as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                $this->hero->{$methodName}($value);
            }

            $this->addHeroSpecialSkills();

            return $this;

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Create Beast player
     *
     * @return HeroGame
     * @throws Exception
     */
    private function createBeast(): HeroGame
    {
        try {

            $randKey = array_rand(GameConfig::BEASTS_NAMES, 1);

            $this->beast = new Beast();
            $this->beast->setPlayerName(GameConfig::BEASTS_NAMES[$randKey]);
            $this->beast->setAvatar(GameConfig::BEAST_EMOJI[$randKey]);
            $this->generateStats(GameConfig::BEAST_STATS);

            foreach ($this->statsTemp as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                $this->beast->{$methodName}($value);
            }

            return $this;

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * @return HeroGame
     * @throws Exception
     */
    private function addHeroSpecialSkills(): HeroGame
    {
        try {
            $rapidStrike = new RapidStrike(AbstractSkills::RAPID_STRIKE_CLASS, GameConfig::HERO_SKILLS['RAPID_STRIKE']);
            $magicShield = new MagicShield(AbstractSkills::MAGIC_SHIELD_CLASS, GameConfig::HERO_SKILLS['MAGIC_SHIELD']);

            $this->hero->addSkill($rapidStrike->useSkill())
                ->addSkill($magicShield->useSkill());

            return $this;

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Decide which player will attack first in a battle
     *
     * @throws Exception
     */
    private function getFirstAttacker()
    {
        try {
            if ($this->hero->getSpeed() > $this->beast->getSpeed()) {
                $this->attacker = GameConfig::HERO;
            } elseif ($this->hero->getSpeed() < $this->beast->getSpeed()) {
                $this->attacker = GameConfig::BEAST;
            } elseif ($this->hero->getLuck() > $this->beast->getLuck()) {
                $this->attacker = GameConfig::HERO;
            } elseif ($this->hero->getLuck() < $this->beast->getLuck()) {
                $this->attacker = GameConfig::BEAST;
            } else {
                $this->initGame();
            }
        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Generate player's stats based on the intervals from the config file.
     *
     * @param array $statsArr
     * @throws Exception
     */
    private function generateStats(array $statsArr)
    {
        try {
            $uniqueStats = $this->getStatsNames($statsArr);

            foreach ($uniqueStats as $stat) {
                $this->statsTemp[strtolower($stat)] = $this->getRandom($stat, $statsArr['MIN_'. $stat], $statsArr['MAX_'. $stat]);
            }
        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Returns an unique list of stats from the config file.
     *
     * @param array $stats
     * @return array
     * @throws Exception
     */
    private function getStatsNames(array $stats): array
    {
        try {

            $result = [];
            foreach ($stats as $key => $value) {
                if (($pos = strpos($key, "_")) !== FALSE) {
                    $result[] = substr($key, $pos + 1);
                }
            }

            return array_unique($result);

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Check if all characters are alive
     *
     * @return bool
     * @throws Exception
     */
    private function getPlayersAreAlive()
    {
        try {
            if($this->hero->getHealth() > 0 && $this->beast->getHealth() > 0) {
                return true;
            }

            return false;

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Returns a random number from the given interval
     *
     * @param int $min
     * @param int $max
     * @param string $stat
     *
     * @return int
     *
     * @throws Exception
     */
    private function getRandom(string $stat, int $min = 10, int $max = 100): int
    {
        try {

            if ($min >= $max) {
                return mt_rand($max, $min);
            }

            return mt_rand($min, $max);

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Executes Hero attack
     *
     * @throws Exception
     */
    private function heroAttack()
    {
        try {

            $rapidStrike = $this->getHeroSkill(AbstractSkills::RAPID_STRIKE_CLASS);
            $damage = $this->sufferDamage($this->hero, $this->beast);

            if ($rapidStrike->getUseSkill()) {
                $damage = $rapidStrike->getSpecialDamage($damage);
            }

            $beastHealth = $this->beast->getHealth() - $damage;
            $this->beast->setHealth($beastHealth);

            $this->logUsedSkill($rapidStrike);
            $this->printStatsCards([$this->hero, $this->beast]);

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Executes Beast attack
     *
     * @throws Exception
     */
    private function beastAttacks()
    {
        try {

            $magicShield = $this->getHeroSkill(AbstractSkills::MAGIC_SHIELD_CLASS);
            $damage = $this->sufferDamage($this->beast, $this->hero);

            if ($magicShield->getUseSkill()) {
                $damage = $magicShield->getSpecialDamage($damage);
            }

            $heroHealth = $this->hero->getHealth() - $damage;
            $this->hero->setHealth($heroHealth);

            $this->logUsedSkill($magicShield);
            $this->printStatsCards([$this->hero, $this->beast]);

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Calculates damage
     *
     * @param AbstractCharacters $attacker
     * @param AbstractCharacters $defender
     * @return int
     * @throws Exception
     */
    private function sufferDamage(AbstractCharacters $attacker, AbstractCharacters $defender): int
    {
        try {
            return $attacker->getStrength() - $defender->getDefence();
        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Check if defender is lucky
     *
     * @param AbstractCharacters $attacker
     * @param AbstractCharacters $defender
     * @throws Exception
     * @return bool
     */
    private function isDefenderLucky(AbstractCharacters $attacker, AbstractCharacters $defender): bool
    {
        try {
            return $attacker->getLuck() < $defender->getLuck();
        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Return hero skill class
     *
     * @param string $skill
     * @return AbstractSkills
     * @throws Exception
     */
    private function getHeroSkill(string $skill): AbstractSkills
    {
        try {

            $skillTypes = $this->hero->getSkillsTypes();

            if (empty($skill)) {
                throw new Exception('Please provide a skill type');
            }

            if (!in_array($skill, $skillTypes)) {
                throw new Exception('Wrong skill type provided!');
            }

            $skills = $this->hero->getSkills();

            return $skills[$skill];

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Return the winner of the battle
     *
     * @return HeroGame
     * @throws Exception
     */
    private function setWinner(): HeroGame
    {
        try {

            if ($this->hero->getHealth() > $this->beast->getHealth()) {
                $this->winner = $this->hero;
                if (isset($_SESSION['quickStats'])) {
                    $_SESSION['quickStats']['hero']++;
                }
            } else {
                $this->winner = $this->beast;
            }

            if (isset($_SESSION['quickStats'])) {
                $_SESSION['quickStats']['total']++;
            };

            return $this;

        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * Echoes a bootstrap card to the page, styled based on the cardType parameter.
     * Possible values: story, hero or beast
     *
     * @param string $cardMsg
     * @param string $cardType
     * @return bool
     * @throws Exception
     */
    public function printMsgCard(string $cardMsg, string $cardType = 'story'):bool
    {
        try {

            if (empty($cardMsg) || empty($cardType) || !in_array(strtolower($cardType), ['story', 'hero', 'beast'])) {
                return false;
            }

            $card = '<div class="card '.$cardType.'-card shadow mb-4 animate__animated animate__fadeIn">';
                $card .= '<div class="card-body">';
                    $card .= html_entity_decode($cardMsg);
                $card .= '</div>';
            $card .= '</div>';

            print_r($card);

            return true;

        } catch (Exception $e) {
            throw($e);
        }

    }

    /**
     * Echoes a bootstrap cards to the page, containing the two characters' stats
     * in two different formats, short or full info
     *
     * @param array $characters
     * @param string $cardType
     * @return bool
     * @throws Exception
     */
    public function printStatsCards(array $characters, string $cardType = 'short'):bool
    {
        try {

            if (!isset($characters)) {
                return false;
            }

            $card = '<div class="card-deck mb-4 text-center">';

            foreach ($characters as $character) {

                $card .= '<div class="fighter card shadow animate__animated animate__fadeIn">';

                    $card .= '<div class="card-header">';
                        $card .= '<h3 class="my-0 fighter-name">'. $character->getAvatar() .' '. $character->getPlayerName() .'</h3>';
                    $card .= '</div>';

                    $thisHealthValue = $character->getHealth();

                    $card .= '<div class="card-body">';
                    $card .= '<h1 class="card-title health-progress">';
                        $card .= '<div class="progress ">';
                            $card .= '<div class="progress-bar w-'.max($thisHealthValue,0).'" role="progressbar" style="width:'. max($thisHealthValue,0) .'%">'. max($thisHealthValue,0) .'%</div>';
                        $card .= '</div>';
                    $card .= '</h1>';

                    if ($cardType == 'full') {
                        $card .= '<ul class="list-group">';
                            $card .= '<li class="list-group-item d-flex justify-content-between align-items-center health">Health <span class="badge">'. $thisHealthValue .'</span></li>';
                            $card .= '<li class="list-group-item d-flex justify-content-between align-items-center strength">Strength <span class="badge">'. $character->getStrength() .'</span></li>';
                            $card .= '<li class="list-group-item d-flex justify-content-between align-items-center defence">Defence <span class="badge">'. $character->getDefence() .'</span></li>';
                            $card .= '<li class="list-group-item d-flex justify-content-between align-items-center speed">Speed <span class="badge">'. $character->getSpeed() .'</span></li>';
                            $card .= '<li class="list-group-item d-flex justify-content-between align-items-center luck">Luck <span class="badge">'. $character->getLuck() .'</span></li>';
                        $card .= '</ul>';
                    }

                    $card .= '</div>';
                $card .= '</div>';

            }

            $card .= '</div>';

            print_r($card);
            return true;

        } catch (Exception $e) {
            throw($e);
        }

    }

    /**
     * @param $skill
     * @throws Exception
     */
    private function logUsedSkill(AbstractSkills $skill)
    {
        try {

            if ($skill->getUseSkill()) {
                $this->printMsgCard('You\'ve used ' . $skill->getType() . '!', 'hero');
            } else {
                $this->printMsgCard('You were unable to use one of your specials skills!', 'hero');
            }

        } catch (Exception $e) {
            throw($e);
        }
    }

}