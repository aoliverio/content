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