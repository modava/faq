<?php

use modava\faq\FaqModule;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>

<h3 class="p-2"><?=$model->title?></h3>
<div class="p-2">
    <?=$model->short_content?>
</div>
<div class="p-2">
    <?=$model->content?>
</div>