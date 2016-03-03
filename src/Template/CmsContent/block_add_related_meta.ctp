<div id="block-meta-<?php echo $id ?>">
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <small><?= __('Key'); ?></small>
                <input type="text" name="related[meta][<?php echo $id ?>][meta_key]" class="input-sm form-control" />
            </div>
            <div class="col-md-6">
                <small><?= __('Value'); ?></small>
                <textarea name="related[meta][<?php echo $id ?>][meta_value]" class="input-sm form-control"></textarea>
            </div>
            <div></div>
        </div>
    </div>
</div>