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
        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><strong><?= __('MAIN'); ?></strong></a></li>
        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?= __('Pages'); ?> <span class="badge"><?= count($data['related']['page']); ?></span></a></li>
        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><?= __('Taxonomy'); ?> <span class="badge"><?= count($data['list_of_taxonomy_checked']) ?></span></a></li>
        <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><?= __('Attachments'); ?> <span class="badge"><?= count($data['related']['attached']); ?></span></a></li>
        <li role="presentation"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab"><?= __('Images'); ?> <span class="badge"><?= count($data['related']['image']); ?></span></a></li>
        <li role="presentation"><a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab"><?= __('Meta Key'); ?> <span class="badge"><?= count($data['related']['meta']); ?></span></a></li>
        <li role="presentation"><a href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab"><?= __('Permits'); ?></a></li>
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
            <div class="row">
                <div class="col-md-9">
                    <div class="alert alert-danger">
                        <small><?= __('Change the Parent for this Page'); ?>:</small>
                        <?= $this->Form->select('parent', $data['parent_page_list'], ['default' => $data['parent'], 'empty' => __('Root Page'), 'class' => 'form-control input-sm']); ?>
                    </div>
                    <h4 class="page-header"><?= __('List of Related Page'); ?></h4>
                    <?php if (count($data['related']['page']) > 0) { ?>
                        <ul id="sortable-pages" class="sortable" >
                            <?php foreach ($data['related']['page'] as $row) : ?>
                                <li id="<?= $row['id'] ?>" class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa fa-arrows-v"></i> <?= $row->menu_order ?>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="input-sm form-control text-center" value="<?= $row->id ?>" readonly="" />
                                        </div>
                                        <div class="col-md-5">
                                            <input id="related_content_title_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->content_title ?>" readonly="" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="text-danger">
                                                <input type="checkbox" name="delete_ck[content_id][<?= $row->id ?>]" value="1" /> <i class="fa fa-trash-o"></i> <?= __('Delete'); ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a class="btn btn-sm btn-warning" href="<?= $this->Url->Build('/content/page/edit/' . $row->id) ?>"><i class="fa fa-link"></i></a>
                                            <a class="btn btn-sm btn-primary related-page-edit-button" content_id="<?= $row->id ?>"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </li>                    
                            <?php endforeach; ?>                        
                        </ul>
                    <?php } else { ?>
                        <p class="text-center"><?= __('Empty') ?></p>
                    <?php } ?>
                    <h4 class="page-header"><?= __('Add Related Page'); ?></h4>
                    <div id="block-page"></div>
                    <div class="text-right">
                        <a id="add-page-button" class="btn btn-sm btn-success">+</a>
                        <a id="remove-page-button" class="btn btn-sm btn-danger">-</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="related-page-edit">
                        <div class="text-center">
                            <h4><?= __('Edit Related Page'); ?></h4>
                            <p><?= __('Use the related edit button to change the content and settings'); ?></p>
                            <i class="fa fa-3x fa-pencil"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="page-header"><?= __('Content Taxonomy'); ?></h4>
                    <div class="thumbnail">
                        <?php
                        $TAXONOMY_CHECKED = array();
                        foreach ($data['list_of_taxonomy_checked'] as $row):
                            $TAXONOMY_CHECKED[$row['cms_term_taxonomy_id']] = 1;
                        endforeach;
                        ?>
                        <div id="asd">
                            <table id="content-category-table" class="table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Descrizione</th>
                                        <th class="no-sorting"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['list_of_taxonomy'] as $row): ?>
                                        <tr>
                                            <td><?= $row['title']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <?php $CHECKED = array_key_exists($row['id'], $TAXONOMY_CHECKED) ? ' checked' : '' ?>
                                            <td class="text-right"><input type="checkbox" class="checkbox-content-taxonomy" value="<?= $row['id'] ?>" <?= $CHECKED ?>/></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well well-sm">
                        <h4><?= __('Info'); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab4">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="page-header"><?= __('List of Attachments'); ?></h4>
                    <?php if (count($data['related']['attached']) > 0) { ?>
                        <ul id="sortable-attachments" class="sortable">
                            <?php foreach ($data['related']['attached'] as $row) : ?>
                                <li id="<?= $row['id'] ?>" class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa fa-arrows-v"></i> <?= $row->menu_order ?>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="input-sm form-control text-center" value="<?= $row->id ?>" readonly="" />
                                        </div>
                                        <div class="col-md-5">
                                            <input id="related_content_title_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->content_title ?>" readonly="" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="text-danger">
                                                <input type="checkbox" name="delete_ck[content_id][<?= $row->id ?>]" value="1" /> <i class="fa fa-trash-o"></i> <?= __('Delete'); ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a class="btn btn-sm btn-default" href="<?= $this->Url->Build() ?>"><i class="fa fa-download"></i></a>
                                            <a class="btn btn-sm btn-primary related-attached-edit-button" content_id="<?= $row->id ?>"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </li>                    
                            <?php endforeach; ?>                       
                        </ul>
                    <?php } else { ?>
                        <p class="text-center"><?= __('Empty') ?></p>
                    <?php } ?>
                    <h4 class="page-header"><?= __('Add Attachments'); ?></h4>
                    <div id="block-attached"></div>
                    <div class="text-right">
                        <a id="add-attached-button" class="btn btn-sm btn-success">+</a>
                        <a id="remove-attached-button" class="btn btn-sm btn-danger">-</a>
                    </div> 
                </div>
                <div class="col-md-3">
                    <div id="related-attached-edit">
                        <div class="text-center">
                            <h4><?= __('Edit Related Attached'); ?></h4>
                            <p><?= __('Use the related edit button to change the content and settings'); ?></p>
                            <i class="fa fa-3x fa-pencil"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab5">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="page-header"><?= __('List of Images'); ?></h4>
                    <?php if (count($data['related']['image']) > 0) { ?>
                        <ul id="sortable-images" class="sortable">
                            <?php foreach ($data['related']['image'] as $row) : ?>
                                <li id="<?= $row['id'] ?>" class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa fa-arrows-v"></i> <?= $row->menu_order ?>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="input-sm form-control text-center" value="<?= $row->id ?>" readonly="" />
                                        </div>
                                        <div class="col-md-5">
                                            <input id="related_content_title_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->content_title ?>" readonly="" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="text-danger">
                                                <input type="checkbox" name="delete_ck[content_id][<?= $row->id ?>]" value="1" /> <i class="fa fa-trash-o"></i> <?= __('Delete'); ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a class="btn btn-sm btn-default" href="<?= $this->Url->Build('/') ?>"><i class="fa fa-picture-o"></i></a>
                                            <a class="btn btn-sm btn-primary related-image-edit-button" content_id="<?= $row->id ?>"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </li>                    
                            <?php endforeach; ?>                         
                        </ul>
                    <?php } else { ?>
                        <p class="text-center"><?= __('Empty') ?></p>
                    <?php } ?> 
                    <h4 class="page-header"><?= __('Add Images'); ?></h4>
                    <div id="block-image"></div>
                    <div class="text-right">
                        <a id="add-image-button" class="btn btn-sm btn-success">+</a>
                        <a id="remove-image-button" class="btn btn-sm btn-danger">-</a>
                    </div> 
                </div>
                <div class="col-md-3">
                    <div id="related-image-edit">
                        <div class="text-center">
                            <h4><?= __('Edit Related Image'); ?></h4>
                            <p><?= __('Use the related edit button to change the content and settings'); ?></p>
                            <i class="fa fa-3x fa-pencil"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab6">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="page-header"><?= __('List of Meta Key'); ?></h4>
                    <?php if (count($data['related']['meta']) > 0) { ?>
                        <ul id="sortable-meta" class="sortable"> 
                            <?php foreach ($data['related']['meta'] as $row) : ?>
                                <li id="<?= $row['id'] ?>" class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa fa-arrows-v"></i> <?= $row->priority ?>
                                        </div>
                                        <div class="col-md-3">
                                            <input id="related_meta_key_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->meta_key ?>" readonly="" />
                                        </div>
                                        <div class="col-md-4">
                                            <input id="related_meta_value_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->meta_value ?>" readonly="" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="text-danger">
                                                <input type="checkbox" name="delete_ck[meta_id][<?= $row->id ?>]" value="1" /> <i class="fa fa-trash-o"></i> <?= __('Delete'); ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a class="btn btn-sm btn-primary related-meta-edit-button" meta_id="<?= $row->id ?>"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </li>                    
                            <?php endforeach; ?>   
                        </ul>
                    <?php } else { ?>
                        <p class="text-center"><?= __('Empty') ?></p>
                    <?php } ?>
                    <h4 class="page-header"><?= __('Add Meta Key'); ?></h4>
                    <div id="block-meta"></div>
                    <div class="text-right">
                        <a id="add-meta-button" class="btn btn-sm btn-success">+</a>
                        <a id="remove-meta-button" class="btn btn-sm btn-danger">-</a>
                    </div> 
                </div>
                <div class="col-md-3">
                    <div id="related-meta-edit">
                        <div class="text-center">
                            <h4><?= __('Edit Related Meta'); ?></h4>
                            <p><?= __('Use the related edit button to change the content and settings of meta'); ?></p>
                            <i class="fa fa-3x fa-pencil"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab7">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="page-header"><?= __('Content Permits for Users'); ?></h4>
                    <div class="thumbnail">
                        <?php
                        $USER_CHECKED = array();
                        foreach ($data['list_of_user_checked'] as $row):
                            $USER_CHECKED[$row['sys_user_id']] = 1;
                        endforeach;
                        ?>
                        <table id="user-permits-table" class="table table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th class="no-sorting"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['list_of_user'] as $row): ?>
                                    <tr>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <?php $CHECKED = array_key_exists($row['id'], $USER_CHECKED) ? ' checked' : '' ?>
                                        <td class="text-right"><input type="checkbox" class="checkbox-user-permit" value="<?= $row['id'] ?>" <?= $CHECKED ?>/></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="page-header"><?= __('Content Permits for Roles'); ?></h4>
                    <div class="thumbnail">
                        <?php
                        $ROLE_CHECKED = array();
                        foreach ($data['list_of_role_checked'] as $row):
                            $ROLE_CHECKED[$row['sys_role_id']] = 1;
                        endforeach;
                        ?>
                        <table id="role-permits-table" class="table table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="no-sorting"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['list_of_role'] as $row): ?>
                                    <tr>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['description']; ?></td>
                                        <?php $CHECKED = array_key_exists($row['id'], $ROLE_CHECKED) ? ' checked' : '' ?>
                                        <td class="text-right"><input type="checkbox" class="checkbox-role-permit" value="<?= $row['id'] ?>" <?= $CHECKED ?>/></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well well-sm">
                        <h4><?= __('Info'); ?></h4>
                    </div>
                </div>
            </div>
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
