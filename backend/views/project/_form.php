<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;

/** @var yii\web\View $this */
/** @var common\models\Project $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile(
    '@web/js/projectForm.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tech_stack')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'description')->widget(Summernote::class, [
        // 'useKrajeePresets' => true,
        // other widget settings
    ]); ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'en',
        // 'dateFormat' => 'yyyy-MM-dd',
        // 'dateFormat' => 'php:Y-m-d',
        'options' => [
            'placeholder' => "Data"
        ],
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'en',
            // 'dateFormat' => 'php:Y-m-d',
            // 'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'placeholder' => "Data"
            ],
    ]) ?>

    <br>
    <?php foreach ($model->projectImages as $image): ?>
        <div id="image-div-<?=$image->id?>" class="project-image-container">
            <?=
                Html::img($image->file->absoluteUrl(), [
                    'alt' => 'Example',
                    'height' => 200,
                    'width' => 200,
                    'class' => 'project-view__image'
                ]);
            ?>
            <?= Html::button(Yii::t('app', 'Delete'), [
                    'class' => 'btn btn-danger btn-delete-project',
                    'data-image-id' => $image->id
                ]); 
            ?>
            <div id="image-delete-error-<?=$image->id?>" class="text-danger"></div>
        </div>
    <?php endforeach ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
