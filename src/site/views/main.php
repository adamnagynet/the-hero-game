<?php

    /**
     * Set the gameflow, with the state of buttons and stats.
     */

    $showEnterBtn = !isset($_POST['command']) || (isset($_POST['command']) && !$_POST['command'] == 'enter-the-forest') ?? false;

    $showRestartBtn = (isset($_POST['command'])) ?? false;

    if (!isset($_SESSION['quickStats'])) {
        $_SESSION['quickStats'] = ['hero' => 0, 'total' => 0];
    }

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The Hero Game">
    <meta name="author" content="Adam D. Nagy">
    <meta name="csrf-token" content="W0IlH63c9ckcpsab1yOlnO2gnRIHjBR633kXHgVR">
    <title>The Hero Game</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css" integrity="sha512-kb1CHTNhoLzinkElTgWn246D6pX22xj8jFNKsDmVwIQo+px7n1yjJUZraVuR/ou6Kmgea4vZXZeUDbqKtXkEMg==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public_html/assets/css/hero.css">
</head>
<body>
    <header class="text-center py-5">
        <h1 class="animate__animated animate__fadeIn">
            <span class="title-emoji">🍃🌳🌲</span> The Hero Game <span class="title-emoji">🌲🌳🍃</span>
        </h1>
    </header>

    <main class="container">
        <article class="row mb-4">
            <div class="col-md-2"></div>
            <div class="col-md-10 col-lg-8">

                <div class="card shadow animate__animated animate__fadeIn">
                    <div class="card-body">
                        <h2 class="story-intro">
                            <em><strong>O</strong></em>nce upon a time there was a great hero, called <strong>Orderus</strong>, with some strengths and weaknesses, as all heroes have. After battling all kinds of monsters for more than a hundred years, and learning some impressive new skills, Orderus walks into the ever-green forests of <strong>Emagia</strong>, and encounters some wild beasts...<br/><br/>
                            <strong>Do you have what it takes to guide Orderus through the forest?
                            <?php if (isset($_SESSION['quickStats']) && $_SESSION['quickStats']['total']>0) {
                                print_r("So far you\'ve played" . $_SESSION['quickStats']['total'] ." rounds and won " . $_SESSION['quickStats']['hero'] . "!");
                            } else {
                                print_r("Start your first game now!");
                            } ?>
                            </strong>
                        </h2>
                    </div>
                </div>

                <?php if (isset($showEnterBtn) && $showEnterBtn) { ?>
                <form method="post" action="/" class="animate__animated animate__fadeIn">
                    <input type="hidden" name="command" value="enter-the-forest">
                    <input type="hidden" name="_token" value="yIcHUzipr2Y2McGE3EUk5JwLOPjxrC3yEBetRtlV">
                    <input type="submit" class="fight-btn btn btn-block shadow mt-4" name="enter-the-forest" value="🪓 Enter the forest!">
                </form>
                <?php } ?>

            </div>
            <div class="col-md-2"></div>
        </article>

        <?php if (isset($showEnterBtn) && !$showEnterBtn) { ?>
        <section class="row arena">
            <div class="col-md-2"></div>
            <div class="col-md-10 col-lg-8">
                <?php $heroGame->startBattle(); ?>

                <?php if (isset($showRestartBtn) && $showRestartBtn) { ?>
                <form method="post" action="/" class="animate__animated animate__fadeIn mt-5">
                    <input type="hidden" name="command" value="restart-the-game">
                    <input type="hidden" name="_token" value="yIcHUzipr2Y2McGE3EUk5JwLOPjxrC3yEBetRtlV">
                    <input type="submit" class="fight-btn btn btn-block shadow mt-5" name="enter-the-forest" value="🚪 Restart the game">
                </form>
                <?php } ?>

            <div class="col-md-2"></div>
        </section>
        <?php } ?>

        <section class="row arena">
            <div class="col-md-2"></div>
            <div class="col-md-10 col-lg-8">
                <span class="versus-badge badge badge-pill hidden">VS.</span>
            </div>
            <div class="col-md-2"></div>
        </section>

    </main>

    <footer class="text-center mt-5 mb-4">&copy; 2020 Emagia Forest</footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>