<div class="row">
    <div class="col-md-9">
        <h4 class="page-header"><?= __('Content Permits for Roles'); ?></h4>
        <div class="thumbnail">
            <?php
            $ROLE_CHECKED = array();
            foreach ($data['list_of_role_checked'] as $row):
                $ROLE_CHECKED[$row['role_id']] = 1;
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
        <div id="related-meta-edit">
            <div class="text-center">
                <h4><?= __('Edit Related Meta'); ?></h4>
                <p><?= __('Use the related edit button to change the content and settings of meta'); ?></p>
                <i class="fa fa-3x fa-pencil"></i>
            </div>
        </div>
    </div>
</div>