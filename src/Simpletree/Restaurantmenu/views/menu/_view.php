<?php
/**
 * Created by Jakob
 * Date: 08-11-13
 * Time: 23:32
 */

use Simpletree\Foundation\Html;

?>
<div class="row">
    <div class="col-lg-6">
        <h2><?= $model->name ?></h2>
        <h4><?= $model->description ?></h4>
        <div><?= $model->language ?></div>
    </div>
    <div class="col-lg-6">
        <br>
        <br>

        <?php if($model->language == 'en'): ?>
            <?= Html::a("Ret", ['menuiteminfo/update', 'id'=>$model->id]) ?>
        <?php else: ?>
            <?= Html::a("Tilføj oversættelse", ['menuiteminfo/create', 'id_menu_item'=>$model->id_menu_item]) ?>
        <?php endif ?>
        |
        <?= Html::a("Slet", '#') ?>
    </div>
</div>