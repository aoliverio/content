<div id="block-option-<?php echo $id ?>">
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <small><?= __('Key'); ?></small>
                <input type="text" name="related[option][<?php echo $id ?>][option_key]" class="input-sm form-control" />
            </div>
            <div class="col-md-6">
                <small><?= __('Value'); ?></small>
                <textarea name="related[option][<?php echo $id ?>][option_value]" class="input-sm form-control"></textarea>
            </div>
            <div></div>
        </div>
    </div>
</div>
