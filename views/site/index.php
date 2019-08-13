<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Functions;
use app\models\Tarif;
use kartik\date\DatePicker;

$functions = new Functions();
$this->title = 'Форма оформления заказа';
?>
<div class="form">
    <h1>Тестовое задание № 1</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Форма оформления заказа</h2>
            <p class="message"><?= $message ?></p>
            <?php
        //-- имена тарифов из БД
                $items = array();
                foreach($tarifs as $tarif)
                {
                    $items[$tarif->id] = $tarif->name;
                }
            ?>
            <?php $form_2 = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
            <?= $form_2->field($form, 'phone', ["template" => "<label> Введите номер телефона </label>\n{input}\n{hint}\n{error}"])->textInput(['placeholder' => 'Введите номер телефона', 'class' => 'form-control phone']) ?>
            <?php
                $param = [
                    'class' => 'form-control drop',
                ];
            ?>

            <?= $form_2->field($form, 'tarif', ["template" => "<label> Выберите нужный тариф </label>\n{input}\n{hint}\n{error}"])->dropDownList($items, $param); ?>
            <?= $form_2->field($form, 'date', ["template" => "<label> Выберите дату доставки</label>\n{input}\n{hint}\n{error}"])->widget(DatePicker::className(), [
                    'name' => 'date',
                     'value' => date('d.m.Y', strtotime('+2 days')),
                     'options' => ['placeholder' => 'Выбор даты ...'],
                     'pluginOptions' => [
                         'format' => 'dd.mm.yyyy',
                         'todayHighlight' => true
                     ]
                ]); 
            ?>


            <?= $form_2->field($form, 'adress', ["template" => "<label> Введите адрес доставки </label>\n{input}\n{hint}\n{error}"])->textInput(['placeholder' => "Адрес доставки"]) ?>
            <?= Html::submitButton('Оформить', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>        
        </div>
    </div>
    <div class="row">
        <h1>Тестовое задание № 2</h1>
        <h3>Количество заказов с ценой меньше 1000 </h3>
        <table class="table">
            <tr>
                <td>client_id</td>
                <td>count1</td>
            </tr>
            <?php foreach($task_2_1 as $k => $v) { ?>
                <?php if($v) { ?>
                <tr>
                    <td><?= $k ?></td>
                    <td><?= $v ?></td>
                </tr>
                <?php } ?>
            <?php } ?>
        </table>
        
        <h3>Третий заказ для каждого клиента</h3>
        <table class="table">
            <tr>
                <td>id</td>
                <td>client_id</td>
                <td>price</td>
            </tr>
            <?php foreach($task_2_2 as $task) { ?>
                <?php if($task) { ?>
                <tr>
                    <td><?= $task->id ?></td>
                    <td><?= $task->client ?></td>
                    <td><?= $functions->getPrice($task->id) ?></td>
                </tr>
                <?php } ?>
            <?php } ?>
        </table>

        <h3>Третий заказ, сделанный после заказа стоимостью больше 1000</h3>
        <table class="table">
            <tr>
                <td>id</td>
                <td>client_id</td>
                <td>price</td>
            </tr>
            <?php foreach($task_2_3 as $task) { ?>
                <?php if($task) { ?>
                <tr>
                    <td><?= $task->id ?></td>
                    <td><?= $task->client ?></td>
                    <td><?= $functions->getPrice($task->id) ?></td>
                </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
    
</div>