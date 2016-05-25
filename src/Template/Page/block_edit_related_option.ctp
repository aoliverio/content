<!-- Load datepicker -->
<script type="text/javascript" src="<?php echo $this->Url->build('/'); ?>bower/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Url->build('/'); ?>bower/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>bower/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<script>
    $(document).ready(function () {
        /**
         * 
         */
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });

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
                url: '<?= $this->Url->build(['action' => 'saveOption'], true); ?>', // the url where we want to POST
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
            var URL = '<?= $this->Url->build(['action' => 'editRelatedOption', $data['id']], true); ?>';
            $("#related-option-edit").load(URL);

            /**
             * update input META_KEY value in related option list
             */
            var selector = '#related_option_key_' + $('#form-related-option input[name=id]').val();
            var value = $('#form-related-option input[name=option_key]').val();
            $(selector).val(value);

            /**
             * update input META_VALUE value in related option list
             */
            var selector = '#related_option_value_' + $('#form-related-option input[name=id]').val();
            var value = $('#form-related-option textarea[name=option_value]').val();
            $(selector).val(value);
        });
    });
</script>

<form id="form-related-option">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="alert alert-warning" role="alert">
        <h4><?= __('Edit Related Page'); ?></h4>
        <hr/>
        <small><?= __('Key'); ?>:</small>
        <input type="text" name="option_key" class="form-control input-sm" value="<?= $data['option_key'] ?>">
        <small><?= __('Value'); ?>:</small>
        <textarea name="option_value" class="form-control input-sm" rows="3"><?= $data['option_value'] ?></textarea>                            
        <hr/>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
