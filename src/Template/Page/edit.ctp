<?php
/**
 * Template setting
 */
$this->assign('title', __('Edit Page'));

/**
 * Append this block to layout script block 
 */
$this->append('script');
?>
<!-- Load datepicker -->
<script type="text/javascript" src="<?php echo $this->Url->build('/'); ?>content/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Url->build('/'); ?>content/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>content/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<script>
    $(document).ready(function () {
        /**
         * 
         */
        $('.summernote').summernote({
            height: 250
        });

        /**
         * Iterators
         * @type Number
         */
        var i = 1;
        var j = 1;
        var k = 1;
        var l = 1;

        /**
         * 
         * @returns {undefined}
         */
        function addAttached() {
            $.ajax({
                url: '<?php echo $this->Url->build('/content/CmsContent/addRelatedAttachedBlock/', true); ?>' + i,
                success: function (result) {
                    $("#block-attached").append(result);
                    i++;
                }
            });
        }

        /**
         * 
         * @returns {undefined}
         */
        function removeAttached() {
            if (i > 2) {
                i--;
                var child = "#block-attached-" + i;
                $(child).remove();
            }
        }

        /**
         * 
         * @returns {undefined}
         */
        function addImage() {
            $.ajax({
                url: '<?php echo $this->Url->build('/content/CmsContent/addRelatedImageBlock/', true); ?>' + j,
                success: function (result) {
                    $("#block-image").append(result);
                    j++;
                }
            });
        }

        /**
         * 
         * @returns {undefined}
         */
        function removeImage() {
            if (j > 2) {
                j--;
                var child = "#block-image-" + j;
                $(child).remove();
            }
        }

        /**
         * 
         * @returns {undefined}
         */
        function addPage() {
            $.ajax({
                url: '<?php echo $this->Url->build('/content/CmsContent/addRelatedPageBlock/', true); ?>' + k,
                success: function (result) {
                    $("#block-page").append(result);
                    k++;
                }
            });
        }

        /**
         * 
         * @returns {undefined}
         */
        function removePage() {
            if (k > 2) {
                k--;
                var child = "#block-page-" + k;
                $(child).remove();
            }
        }

        /**
         * 
         * @returns {undefined}
         */
        function addMeta() {
            $.ajax({
                url: '<?php echo $this->Url->build('/content/CmsContent/addRelatedMetaBlock/', true); ?>' + l,
                success: function (result) {
                    $("#block-meta").append(result);
                    l++;
                }
            });
        }

        /**
         * 
         * @returns {undefined}
         */
        function removeMeta() {
            if (l > 2) {
                l--;
                var child = "#block-meta-" + l;
                $(child).remove();
            }
        }

        /**
         * Create first block for Attached
         */
        addAttached();

        /**
         * Create first block for Image
         */
        addImage();

        /**
         * Create first block for Page
         */
        addPage();

        /**
         * Create first block for Meta
         */
        addMeta();

        /**
         * Button action
         */
        $("#add-attached-button").click(addAttached);
        $("#remove-attached-button").click(removeAttached);
        $("#add-image-button").click(addImage);
        $("#remove-image-button").click(removeImage);
        $("#add-page-button").click(addPage);
        $("#remove-page-button").click(removePage);
        $("#add-meta-button").click(addMeta);
        $("#remove-meta-button").click(removeMeta)

        /**
         * 
         */
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        /**
         * 
         */
        $("#sortable-pages").sortable({
            update: function (event, ui) {
                var order = $(this).sortable('toArray').toString();
                $.ajax({
                    data: "order=" + order,
                    type: 'POST',
                    url: '<?php echo $this->Url->build('/content/CmsContent/saveMenuOrder', true); ?>'
                });
            }
        });

        /**
         * 
         */
        $("#sortable-attachments").sortable({
            update: function (event, ui) {
                var order = $(this).sortable('toArray').toString();
                $.ajax({
                    data: "order=" + order,
                    type: 'POST',
                    url: '<?php echo $this->Url->build('/content/CmsContent/saveMenuOrder', true); ?>'
                });
            }
        });

        /**
         * 
         */
        $("#sortable-images").sortable({
            update: function (event, ui) {
                var order = $(this).sortable('toArray').toString();
                $.ajax({
                    data: "order=" + order,
                    type: 'POST',
                    url: '<?php echo $this->Url->build('/content/CmsContent/saveMenuOrder', true); ?>'
                });
            }
        });

        /**
         * 
         */
        $("#sortable-meta").sortable({
            update: function (event, ui) {
                var order = $(this).sortable('toArray').toString();
                $.ajax({
                    data: "order=" + order,
                    type: 'POST',
                    url: '<?php echo $this->Url->build('/content/CmsContentMeta/savePriority', true); ?>'
                });
            }
        });

        /**
         * 
         */
        $(".checkbox-content-taxonomy").change(function () {
            var taxonomy_id = $(this).val();
            if ($(this).is(':checked')) {
                var URL = '<?= $this->Url->build('/content/CmsContent/setContentRelation/' . $data['id'] . '/', true); ?>' + taxonomy_id;
                $.ajax({
                    type: 'POST',
                    url: URL
                });
            } else {
                var URL = '<?= $this->Url->build('/content/CmsContent/unsetContentRelation/' . $data['id'] . '/', true); ?>' + taxonomy_id;
                $.ajax({
                    type: 'POST',
                    url: URL
                });
            }
        });

        /**
         * 
         */
        $(".checkbox-user-permit").change(function () {
            var user_id = $(this).val();
            if ($(this).is(':checked')) {
                var URL = '<?= $this->Url->build('/content/CmsContent/setUserPermit/' . $data['id'] . '/', true); ?>' + user_id;
                $.ajax({
                    type: 'POST',
                    url: URL
                });
            } else {
                var URL = '<?= $this->Url->build('/content/CmsContent/unsetUserPermit/' . $data['id'] . '/', true); ?>' + user_id;
                $.ajax({
                    type: 'POST',
                    url: URL
                });
            }
        });

        /**
         * 
         */
        $(".checkbox-role-permit").change(function () {
            var role_id = $(this).val();
            if ($(this).is(':checked')) {
                var URL = '<?= $this->Url->build('/content/CmsContent/setRolePermit/' . $data['id'] . '/', true); ?>' + role_id;
                $.ajax({
                    type: 'POST',
                    url: URL
                });
            } else {
                var URL = '<?= $this->Url->build('/content/CmsContent/unsetRolePermit/' . $data['id'] . '/', true); ?>' + role_id;
                $.ajax({
                    type: 'POST',
                    url: URL
                });
            }
        });

        /** 
         * Related page
         */
        $(".related-page-edit-button").click(function () {
            var id = $(this).attr("content_id");
            var URL = '<?= $this->Url->build('/content/CmsContent/editRelatedPage/', true); ?>' + id;
            $("#related-page-edit").load(URL);
        });

        /** 
         * Related attached
         */
        $(".related-attached-edit-button").click(function () {
            var id = $(this).attr("content_id");
            var URL = '<?= $this->Url->build('/content/CmsContent/editRelatedAttached/', true); ?>' + id;
            $("#related-attached-edit").load(URL);
        });

        /** 
         * 
         */
        $(".related-image-edit-button").click(function () {
            var id = $(this).attr("content_id");
            var URL = '<?= $this->Url->build('/content/CmsContent/editRelatedImage/', true); ?>' + id;
            $("#related-image-edit").load(URL);
        });

        /** 
         * 
         */
        $(".related-meta-edit-button").click(function () {
            var id = $(this).attr("meta_id");
            var URL = '<?= $this->Url->build('/content/CmsContent/editRelatedMeta/', true); ?>' + id;
            $("#related-meta-edit").load(URL);
        });
    });
</script>
<?php $this->end(); ?>

<?= $this->Form->create(NULL, ['type' => 'file']); ?>
<p class="text-right"><small><?= __('Last modified'); ?>: <?= $data['modified'] ?></small></p>
<div class="pull-right">
    <input type="submit" name="button_save_action" class="btn btn-primary" value="<?= __('Save'); ?>">
</div>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a class="bg-info" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><strong><?= __('Main'); ?></strong></a></li>
        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?= __('Pages'); ?> <span class="badge"><?= count($data['related']['page']); ?></span></a></li>
        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><?= __('Taxonomy'); ?> <span class="badge"><?= count($data['list_of_taxonomy_checked']) ?></span></a></li>
        <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><?= __('Attachments'); ?> <span class="badge"><?= count($data['related']['attached']); ?></span></a></li>
        <li role="presentation"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab"><?= __('Images'); ?> <span class="badge"><?= count($data['related']['image']); ?></span></a></li>
        <li role="presentation"><a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab"><?= __('Options'); ?> <span class="badge"><?= count($data['related']['meta']); ?></span></a></li>
        <li role="presentation"><a class="bg-danger" href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab"><i class="fa fa-lock"></i> <?= __('Roles'); ?> <span class="badge"><?= count($data['list_of_role_checked']); ?></span></a></li>
        <li role="presentation"><a class="bg-danger" href="#tab8" aria-controls="tab8" role="tab" data-toggle="tab"><i class="fa fa-lock"></i> <?= __('Users'); ?> <span class="badge"><?= count($data['list_of_user_checked']); ?></span></a></li>
    </ul>
    <br/>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
                <div class="col-md-9">
                    <div class="well well-sm">
                        <small><?= __('Content slug'); ?>:</small>
                        <div class="input-group">
                            <input type="text" name="name" class="form-control input-sm" id="" placeholder="<?= __('Content slug'); ?>" value="<?= $data['name'] ?>">
                            <span class="input-group-addon input-sm" id="basic-addon2"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></span>
                        </div>
                    </div>
                    <small><?= __('Content title'); ?>:</small>
                    <input name="content_title" type="text" class="form-control" id="" value="<?= $data['content_title'] ?>" placeholder="<?= __('Content title'); ?>">
                    <small><?= __('Content description'); ?>:</small>
                    <textarea name="content_description" class="form-control summernote" id="content-description">
                        <?= $data['content_description'] ?>
                    </textarea>
                </div>
                <div class="col-md-3">
                    <div>
                        <?php if (trim($data['content_status']) != 'publish') { ?>
                            <input type="submit" name="button_publish_action" class="btn btn-success btn-lg btn-block" value="<?= __('Publish'); ?>">
                        <?php } else { ?>
                            <input type="submit" name="" class="btn btn-success btn-lg btn-block" value="<?= __('Update'); ?>">
                        <?php } ?>
                    </div>
                    <br/>
                    <div class="alert alert-warning" role="alert">
                        <h4><?= __('Plublish options'); ?></h4>
                        <hr/>
                        <small><?= __('Publish start'); ?>:</small>
                        <div class="input-group date datetimepicker">
                            <input class="input-sm form-control" type="text" name="publish_start" value="<?= $data['publish_start'] ?>" placeholder="<?= __('Content publish'); ?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <small><?= __('Publish deadline'); ?>:</small>
                        <div class="input-group date datetimepicker">
                            <input class="input-sm form-control" type="text" name="content_deadline" value="<?= $data['content_deadline'] ?>" placeholder="<?= __('Content deadline'); ?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <hr/>
                        <small><?= __('Publish status'); ?>:</small>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </span>
                            <?= $this->Form->select('content_status', $data['content_status_list'], ['default' => $data['content_status'], 'class' => 'form-control input-sm']); ?>
                        </div>
                        <hr/>
                        <small><?= __('Publish stop'); ?>:</small>
                        <div class="input-group date datetimepicker">
                            <input class="input-sm form-control" type="text" name="publish_end" value="<?= $data['publish_end'] ?>" placeholder="<?= __('Publish end'); ?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <small><?= __('Content password'); ?>:</small>
                        <div class="input-group">
                            <input class="input-sm form-control" type="text" name="content_password" value="<?= $data['content_password'] ?>" placeholder="<?= __('Content password'); ?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
            <!-- related pages -->
            <?= $this->element('/Content/related-pages'); ?> 
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
            <!-- related attachments -->
            <?= $this->element('/Content/related-taxonomy'); ?>             
        </div>
        <div role="tabpanel" class="tab-pane" id="tab4">
            <!-- related attachments -->
            <?= $this->element('/Content/related-attachments'); ?> 
        </div>
        <div role="tabpanel" class="tab-pane" id="tab5">
            <!-- related images -->
            <?= $this->element('/Content/related-images'); ?>           
        </div>
        <div role="tabpanel" class="tab-pane" id="tab6">
            <!-- related options -->
            <?= $this->element('/Content/related-options'); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab7">
            <!-- related roles -->
            <?= $this->element('/Content/related-roles'); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab8">
            <!-- related users -->
            <?= $this->element('/Content/related-users'); ?>
        </div>
    </div>
</div>    
<?= $this->Form->end(); ?>
<!-- myModal 1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div id="related-content-edit-modal" class="modal-content"></div>
    </div>
</div>
<!-- myModal 2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= __('Content Info'); ?></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
