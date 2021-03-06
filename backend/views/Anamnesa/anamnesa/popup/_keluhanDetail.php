<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\tabs\TabsX;
use backend\models\Lookup;
use yii\helpers\Url;



?>
<div class="modal-content" style="width: 750px;margin-left: 400px;margin-top: 100px">
<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
<!--	<h4><?php // echo $model->getAttributeLabel($_GET['title']); ?></h4>-->
</div>
<input type="hidden" value="" id="namakeluhan" name="namakeluhan">
<div class="modal-body">

    <?php
    if($_GET['param']== "Batuk" || $_GET['param']== "Gangguan_Buang_Air_Besar" || $_GET['param']== "Gangguan_Buang_Air_Kecil" || $_GET['param']== "Gangguan_Tenggorokan" || $_GET['param']== "Masalah_pada_Hidung/Pernapasan"
                || $_GET['param']== "Masalah_pada_Perut" || $_GET['param']== "Masalah_Kewanitaan" || $_GET['param']== "Masalah_Reproduksi_Pria" || $_GET['param']== "Lainnya"){
        $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> Rincian',
            'content'=>yii\base\View::render('_keluhanRincian',['model'=>$model]),
            'active'=>true
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-flag"></i> Anamnesa Terpimpin',
         //   'content'=>yii\base\View::render('_keluhanLokasi',['model'=>$model]),
            'id'=>'tabs-keluhanterpimpin',
            'content'=>'<div id="tabanamnesa_terpimpin"></div>',
            'linkOptions'=>['data-enable-cache'=>false,'data-url'=>\yii\helpers\Url::to(['/Anamnesa/anamnesa/anamnesa-terpimpin','id'=>$_GET['id']])],
        ],
        ];
    }
    else {      
    $items = [
    [
        'label'=>'<i class="glyphicon glyphicon-tasks"></i> Rincian',
        'content'=>yii\base\View::render('_keluhanRincian',['model'=>$model]),
        'active'=>true
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-pushpin"></i> Lokasi',
     //   'content'=>yii\base\View::render('_keluhanLokasi',['model'=>$model]),
        'id'=>'tabs-keluhanlokasi',
        'content'=>'<div id="tablokasi"></div>',
        'linkOptions'=>['data-enable-cache'=>false,'data-url'=>\yii\helpers\Url::to(['/Anamnesa/anamnesa/popup-lokasi',['id'=>$_GET['id'],'datakeluhan'=>str_replace("_"," ",$_GET['param'])]])],
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-flag"></i> Anamnesa Terpimpin',
     //   'content'=>yii\base\View::render('_keluhanLokasi',['model'=>$model]),
        'id'=>'tabs-keluhanterpimpin',
        'content'=>'<div id="tabanamnesa_terpimpin"></div>',
        'linkOptions'=>['data-enable-cache'=>false,'data-url'=>\yii\helpers\Url::to(['/Anamnesa/anamnesa/anamnesa-terpimpin','id'=>$_GET['id']])],
    ],        
   /* [
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
        'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>'test4',
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>'content4',
             ],
        ],
    ],*/
];
    }
    
    echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'encodeLabels'=>false,
    'id'=>'tabs-keluhan',
    'pluginOptions' =>  ['enableCache'=>false],
  //  'enableCache'=>false,
   //  'pluginEvents' => ["tabsX.beforeSend" => "$('#tabs-keluhanlokasi').on('tabsX.beforeSend', function (event) {
  //  alert('test);
//});"], 
]);
    ?>
    
  
    
</div>

<div class="modal-footer">


</div>


    
     
    </div>   


