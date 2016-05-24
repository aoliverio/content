<div class="row">
    <div class="col-md-9">
        <h4 class="page-header"><?= __('List of Option'); ?></h4>
        <?php if (count($data['related']['option']) > 0) { ?>
            <ul id="sortable-option" class="sortable"> 
                <?php foreach ($data['related']['option'] as $row) : ?>
                    <li id="<?= $row['id'] ?>" class="well well-sm">
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa fa-arrows-v"></i> <?= $row->menu_order ?>
                            </div>
                            <div class="col-md-3">
                                <input id="related_option_key_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->option_key ?>" readonly="" />
                            </div>
                            <div class="col-md-4">
                                <input id="related_option_value_<?= $row->id ?>" class="input-sm form-control" value="<?= $row->option_value ?>" readonly="" />
                            </div>
                            <div class="col-md-2">
                                <label class="text-danger">
                                    <input type="checkbox" name="delete_ck[option_id][<?= $row->id ?>]" value="1" /> <i class="fa fa-trash-o"></i> <?= __('Delete'); ?>
                                </label>
                            </div>
                            <div class="col-md-2 text-right">
                                <a class="btn btn-sm btn-primary related-option-edit-button" option_id="<?= $row->id ?>"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </li>                    
                <?php endforeach; ?>   
            </ul>
        <?php } else { ?>
            <p class="text-center"><?= __('Empty') ?></p>
        <?php } ?>
        <h4 class="page-header"><?= __('Add Option'); ?></h4>
        <div id="block-option"></div>
        <div class="text-right">
            <a id="add-option-button" class="btn btn-sm btn-success">+</a>
            <a id="remove-option-button" class="btn btn-sm btn-danger">-</a>
        </div> 
    </div>
    <div class="col-md-3">
        <div id="related-option-edit">
            <div class="text-center">
                <h4><?= __('Edit Related Option'); ?></h4>
                <p><?= __('Use the related edit button to change the content and settings of option'); ?></p>
                <i class="fa fa-3x fa-pencil"></i>
            </div>
        </div>
    </div>
</div>