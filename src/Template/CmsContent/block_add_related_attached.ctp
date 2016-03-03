<div id="block-attached-<?php echo $id ?>">
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <small><?= __('Title'); ?></small>
                <input type="text" name="related[attached][<?php echo $id ?>][content_title]" class="input-sm form-control" />
            </div>
            <div class="col-md-6">
                <small><?= __('File'); ?></small>
                <input type="file" name="related[attached][<?php echo $id ?>][content_path]" class="input-sm form-control" />
            </div>
            <div></div>
        </div>
    </div>
</div>