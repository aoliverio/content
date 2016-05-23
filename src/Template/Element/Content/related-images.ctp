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