<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\helpers\Url;

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

    <?= $form->field($model, 'imageFiles[]')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'pluginOptions' => [
            'initialPreview'=> $model->imagemAbsolutUrl(),
            'initialPreviewAsData' => true,
            'showUpload' => false,
            'deleteUrl' => Url::to(['project/delete-image']),
            'initialPreviewConfig' => $model->imageConfig()
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
