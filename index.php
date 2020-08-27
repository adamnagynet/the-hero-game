<?php

/**
 *  Composer's packages' autoload
 */
require __DIR__.'/vendor/autoload.php';

/**
 *  Initialize the session
 */
ini_set('session.name', 'TheHeroGame');
ini_set('session.use_trans_sid', 0);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cache_limiter', 'private');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_path', '/');
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.entropy_length', 512);
ini_set('session.gc_maxlifetime', 6000);
ini_set('session.hash_bits_per_character', 5);
ini_set('session.hash_function', 'sha512');
ini_set('session.url_rewriter.tags', 'a=href,area=href,frame=src,input=src,form=fakeentry');
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_trans_sid', 0);
ini_set('session.cookie_secure', 1); // activate HTTPS first

session_set_cookie_params([
    'lifetime' => 600, // in seconds
    'path' => '/',
    'domain' => ltrim($_SERVER['SERVER_NAME'],'www.'),
    'secure' => TRUE, // switch to FALSE if SSL certificate isn't applicable
    'httponly' => TRUE,
    'samesite' => 'Strict'
]);

session_start(); // Session won't be used after all

/**
 *  Initialize the game
 */

use TheHeroGame\Gameplay\HeroGame;
$heroGame = new HeroGame();
require_once 'public_html/index.php';

session_destroy();
