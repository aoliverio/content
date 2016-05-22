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
        $('#form-related-content').submit(function (event) {

            /**
             * stop form from submitting normally 
             */
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?= $this->Url->build('/content/CmsContent/saveContent/', true); ?>', // the url where we want to POST
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
            var URL = '<?= $this->Url->build('/content/CmsContent/editRelatedAttached/' . $data['id'], true); ?>';
            $("#related-attached-edit").load(URL);

            /**
             * update input value in related list 
             */
            var selector = '#related_content_title_' + $('#form-related-content input[name=id]').val();
            var value = $('#form-related-content input[name=content_title]').val();
            $(selector).val(value);
        });
    });
</script>

<form id="form-related-content">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="alert alert-warning" role="alert">
        <h4><?= __('Edit Related Page'); ?></h4>
        <hr/>
        <small><?= __('Name'); ?>:</small>
        <input type="text" name="name" class="form-control input-sm" value="<?= $data['name'] ?>">
        <small><?= __('Title'); ?>:</small>
        <input type="text" name="content_title" class="form-control input-sm" value="<?= $data['content_title'] ?>">
        <small><?= __('Description'); ?>:</small>
        <textarea name="content_description" class="form-control input-sm" rows="3"><?= $data['content_description'] ?></textarea>                            
        <hr/>
        <small><?= __('Publish Start'); ?>:</small>
        <div class="input-group date datetimepicker">
            <input class="form-control input-sm" type="text" name="publish_start" value="<?= $data['publish_start'] ?>" placeholder="<?= __('Content publish'); ?>" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <small><?= __('Publish Deadline'); ?>:</small>
        <div class="input-group date datetimepicker">
            <input class="form-control input-sm" type="text" name="content_deadline" value="<?= $data['content_deadline'] ?>" placeholder="<?= __('Content deadline'); ?>" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <small><?= __('Publish End'); ?>:</small>
        <div class="input-group date datetimepicker">
            <input class="form-control input-sm" type="text" name="publish_end" value="<?= $data['publish_end'] ?>" placeholder="<?= __('Content end'); ?>" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>              
        <hr/>
        <small><?= __('File'); ?>:</small>
        <input type="file" name="content_file" class="form-control input-sm">   
        <?php if (trim($data['content_path']) != '') : ?>
            <small><?= __('File URL or download:'); ?></small>
            <div class="input-group">
                <input type="text" class="form-control input-sm" value="<?= $data['content_path'] ?>" readonly="">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-sm" type="button" title="download"><i class="fa fa-download"></i></button>
                </span>
            </div>
            <label><input type="checkbox" name="content_file_remove_ck" value="1"> <span class="text-danger"><?= __('Remove file'); ?></span></label>
        <?php endif; ?>
        <hr/>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>