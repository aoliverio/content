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
        $('#form-related-meta').submit(function (event) {

            /**
             * stop form from submitting normally 
             */
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?= $this->Url->build('/content/CmsContent/saveMeta/', true); ?>', // the url where we want to POST
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
            var URL = '<?= $this->Url->build('/content/CmsContent/editRelatedMeta/' . $data['id'], true); ?>';
            $("#related-meta-edit").load(URL);

            /**
             * update input META_KEY value in related meta list
             */
            var selector = '#related_meta_key_' + $('#form-related-meta input[name=id]').val();
            var value = $('#form-related-meta input[name=meta_key]').val();
            $(selector).val(value);

            /**
             * update input META_VALUE value in related meta list
             */
            var selector = '#related_meta_value_' + $('#form-related-meta input[name=id]').val();
            var value = $('#form-related-meta textarea[name=meta_value]').val();
            $(selector).val(value);
        });
    });
</script>

<form id="form-related-meta">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="alert alert-warning" role="alert">
        <h4><?= __('Edit Related Page'); ?></h4>
        <hr/>
        <small><?= __('Key'); ?>:</small>
        <input type="text" name="meta_key" class="form-control input-sm" value="<?= $data['meta_key'] ?>">
        <small><?= __('Value'); ?>:</small>
        <textarea name="meta_value" class="form-control input-sm" rows="3"><?= $data['meta_value'] ?></textarea>                            
        <hr/>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>