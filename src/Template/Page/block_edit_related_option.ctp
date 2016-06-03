<?php $this->append('script'); ?>
<script>
    $(document).ready(function () {

        /**
         * 
         */
        $('#form-related-option').submit(function (event) {

            /**
             * stop form from submitting normally 
             */
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?= $this->Url->build('/content/page/saveOption/', true); ?>', // the url where we want to POST
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (data) {
                console.log(data);
            });

            /**
             * Refresh block
             */
            var URL = '<?= $this->Url->build('/content/page/editRelatedOption/' . $data['id'], true); ?>';
            $("#related-image-edit").load(URL);

            /**
             * update input value in related list 
             */
            var selector = '#related_content_title_' + $('#form-related-content input[name=id]').val();
            var value = $('#form-related-content input[name=content_title]').val();
            $(selector).val(value);
        });
    });
</script>
<?php $this->end(); ?>

<form id="form-related-option">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="alert alert-warning" role="alert">
        <h4><?= __('Edit Related Option'); ?></h4>
        <hr/>
        <small><?= __('Option Key'); ?>:</small>
        <input type="text" name="option_key" class="form-control input-sm" value="<?= $data['option_key'] ?>">
        <small><?= __('Option Value'); ?>:</small>
        <input type="text" name="option_value" class="form-control input-sm" value="<?= $data['option_value'] ?>">
        <hr/>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
