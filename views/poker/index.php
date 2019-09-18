<?php
/**
 * Created by PhpStorm.
 * User: Tiefanovic
 * Date: 9/18/2019
 * Time: 1:41 AM
 */
?>
<main role="main" class="inner cover">
    <?php if(!empty($errors)):?>
        <?php foreach($errors as $error):?>
            <div class="alert alert-danger" role="alert"><?php echo $error;?></div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="col-md-12">
        <div class="card text-white bg-dark">
            <div class="card-header">Last Games</div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Card</th>
                        <th scope="col">Percent %</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($history)): ?>
                    <?php foreach($history as $game):?>
                        <tr scope="row">
                            <td><?php echo $game->getId(); ?></td>
                            <td><?php echo $game->getCardName(); ?></td>
                            <td><?php echo $game->getPercentage(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Card</th>
                        <th scope="col">Percent %</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <form action="/poker/draw" method="post">
            <div class="card text-white bg-dark">
                <div class="card-header">Game Play</div>
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="drawn-card">
                        <span class="card-name"><?php echo $selectedCard; ?></span>
                        <span class="card-name"><?php echo (!empty($drawnCard) ? $drawnCard->getCardName() : ""); ?></span>
                    </div>
                </div>
                <div class="col-md-6">

                        <input type="hidden" name="_token" value="<?php echo $this->getFormKey();?>" />
                        <div class="deck ">
                            <div class="deck-wrapper"><span>Remaining Cards:</span><?php echo $deck->count(); ?></div>
                            <div class="percentage-wrapper"><span>Percentage:</span><?php echo $currentPercent;?>%</div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-primary">Draw Card</button>
            </div>
        </form>
    </div>
    <div class="col-md-12"></div>
</main>
