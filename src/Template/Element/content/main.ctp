<?php
/**
 * This element is used to edit CmsContent
 */
?>

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