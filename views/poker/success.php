<?php
/**
 * Created by PhpStorm.
 * User: Tiefanovic
 * Date: 9/18/2019
 * Time: 2:53 AM
 */
?>
<main role="main" class="inner cover">
    <h1 class="cover-heading">You Got it!</h1>
    <p class="lead">Percentage: <?php echo $percentage; ?>%</p>
    <p class="lead">
        <form method="post" action="/poker/new-game">
        <input type="hidden" name="_token" value="<?php echo $this->getFormKey();?>">
            <button type="submit" class="btn btn-lg btn-secondary">Start New Game</button>
        </form>
    </p>
</main>
