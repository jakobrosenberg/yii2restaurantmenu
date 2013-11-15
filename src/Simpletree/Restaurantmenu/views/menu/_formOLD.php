<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Simpletree\Restaurantmenu\models\MenuItemInfo;
use yii\widgets\MaskedInput;

/**
 * @var yii\base\View $this
 * @var Simpletree\Restaurantmenu\models\Menu $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-form">

	<?php $form = ActiveForm::begin(['class'=>'horizontal-form']); ?>

        <?php echo Yii::$app->language ?>

		<?= $form->field($model, 'active')->checkbox() ?>

    <?php echo $model->menuInfo->language ?>

    <?php foreach ($model->menuInfos AS $i => $MenuInfo): ?>
        <h3><?= $MenuInfo['language'] ?></h3>
        <?= $form->field($model, 'menuInfos['.$i.'][name')->textInput() ?>
        <?= $form->field($MenuInfo, 'name')->textInput() ?>
        <?= $form->field($model, 'menuInfos['.$i.'][description]')->textArea() ?>
    <?php endforeach ?>

<!--ITEMS-->
        <h3>Items</h3>
        <div class="menu_items"></div>
<!--EXISTING ITEMS-->
        <?php $form->fieldConfig['template'] ="{input}\n{error}\n{hint}" ?>
        <?php foreach ($model->menuItems AS $i => $MenuItem): ?>
        <div class="menu_items_item panel">
            <div class="row">
                <div class="large-8 columns">
                    <?= $form->field($model, 'menuItems['.$i.'][MenuItemInfo][name]')->textInput(['class'=>'form-control name']) ?>
                </div>
            </div>
            <div class="row">

                <div class="large-2 push-8 small-6 columns">
                    <?= $form->field($model, 'menuItems['.$i.'][MenuItemInfo][price]')->widget(MaskedInput::className(), ['class'=>'form-control price', 'value'=>123, 'mask'=>'9999,99']) ?>
                </div>
                <div class="large-2 push-8 small-6 columns">
                    <?= $form->field($model, 'menuItems['.$i.'][MenuItemInfo][currency]')->textInput(['class'=>'form-control currency']) ?>
                </div>
                <div class="large-8 pull-4 columns">
                    <?= $form->field($model, 'menuItems['.$i.'][MenuItemInfo][description]')->textArea(['class'=>'form-control description']) ?>
                    <?= $form->field($model->menuItems[$i]->menuItemInfo, 'description')->textArea() ?>
                </div>
            </div>
        </div>
        <?php endforeach ?>
<!--/EXISTING ITEMS-->
        <a id="add_menu_item" href="#">Tilføj ret</a>

        <div class="hidden" id="menu_item_template">
            <div class="menu_items_item">
                <?= $form->field(new MenuItemInfo(), 'name')->textInput(['name'=>'MenuItemInfo[name][]']) ?>
                <?= $form->field(new MenuItemInfo(), 'price')->textInput(['name'=>'MenuItemInfo[price][]']) ?>
                <?= $form->field(new MenuItemInfo(), 'description') ?>
            </div>
        </div>
<!--/ITEMS-->

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>







	<?php ActiveForm::end(); ?>

</div>

<script>

</script>


<?php $this->registerJs('
$("#add_menu_item").click(function(){
        $(".menu_items").append($("#menu_item_template").html());
    });
') ?>
<?php $this->registerJs('
//<script>


$("input, textarea").each(function(e){
    $("<span>"+$(this).val()+"</span>")
    .addClass("input-placeholder")
    .addClass($(this).attr("class"))
    .click({el:this},function(event){
        $(event.data.el).show();
        $(this).hide();
    }).insertAfter($(this));
    $(this).hide();
});
//
') ?>

<style>
    .input-placeholder {
        border-bottom: dashed 1px black;
        cursor: pointer;
        display: inline-block;
    }

    .input-placeholder.name {
        font-size: 1.5em;
        margin: 0.1em 0 0.5em 0;
    }

    .input-placeholder.price {
        display:block;
        text-align: right;
    }

    .input-placeholder.price, .input-placeholder.currency {
        font-size: 1.2em;
    }
</style>