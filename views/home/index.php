<?php
/**
 * Created by PhpStorm.
 * User: Tiefanovic
 * Date: 9/17/2019
 * Time: 10:48 PM
 */

?>
<main role="main" class="inner cover">
    <h1 class="cover-heading">Pocker Chance Calculator</h1>
    <p class="lead">This game will calculate the percentage of getting your selected card in the next draw</p>
    <?php if(!empty($errors)):?>
        <?php foreach($errors as $error):?>
            <div class="alert alert-danger" role="alert"><?php echo $error;?></div>
        <?php endforeach;?>
    <?php endif;?>
    <p class="lead">Please Select Card</p>
    <div class="card-deck">
        <form class="row" id="select-card-form" method="post" action="/poker/select-card">
            <input type="hidden" name="_token" value="<?php echo $this->getFormKey(); ?>">
            <input type="hidden" name="selected_card" value="0">
            <?php $i=0; foreach($deck->getCards() as $card): ?>
            <div class="col-md-3">
                <p class="card-name" data-card-id="<?php echo $card->getCardName();?>"><?php echo $card->getCardName();?></p>
            </div>
            <?php endforeach; ?>
        </form>
    </div>
</main>
<script>
    $(document).ready(function(){
        $('.card-name').on('click', function(){
            $('input[name=selected_card').val($(this).data('card-id'));
            $('#select-card-form').submit();
        })
    })
</script>

