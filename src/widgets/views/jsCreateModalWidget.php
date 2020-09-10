<?php if (Yii::$app->request->isAjax): ?>
<?php
    $route = \yii\helpers\Url::toRoute(['/faq/handle-ajax/save-ajax']);
    ?>
<script>
    formModal = $('#<?=$formClassName?>');

    formModal.off('beforeSubmit');
    formModal.on('beforeSubmit', function(e){
        const urlParams = new URLSearchParams(formModal.attr('action'));
        let idQueryParam = urlParams.get('id') ? "&id=" + urlParams.get('id') : '';

        formModal.find('button[type="submit"]').attr('disabled', 'disabled');

        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '<?=$route?>?' + idQueryParam,
            dataType: 'json',
            data: formModal.serialize() + '&model=<?=$modelName?>'
        }).done(res => {
            $('.ModalContainer').modal('hide');
            $.toast({
                heading: 'Thông báo',
                text: 'Thành công',
                position: 'top-right',
                class: 'jq-toast-success',
                hideAfter: 3500,
                stack: 6,
                showHideTransition: 'fade'
            });

            // Trigger Event
            const event = new Event('post-object-created');
            document.getElementsByTagName('body')[0].dispatchEvent(event);

        }).fail(f => {
            $('.ModalContainer').modal('hide');
            $.toast({
                heading: 'Thông báo',
                text: 'Thất bại',
                position: 'top-right',
                class: 'jq-toast-danger',
                hideAfter: 3500,
                stack: 6,
                showHideTransition: 'fade'
            });
        });

        return false;
    });
</script>
<?php endif ?>