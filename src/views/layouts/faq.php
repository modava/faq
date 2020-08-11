<?php
\modava\faq\assets\FaqAsset::register($this);
\modava\faq\assets\FaqCustomAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
<?php echo $content ?>
<?php $this->endContent(); ?>
