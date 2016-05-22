<div id="block-page-<?php echo $id ?>">
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <small><?= __('Title'); ?></small>
                <input type="text" name="related[page][<?php echo $id ?>][content_title]" class="input-sm form-control" />
            </div>
            <div class="col-md-6">
                <small><?= __('Name'); ?></small>
                <input type="text" name="related[page][<?php echo $id ?>][name]" class="input-sm form-control" />
            </div>
        </div>
    </div>
</div>