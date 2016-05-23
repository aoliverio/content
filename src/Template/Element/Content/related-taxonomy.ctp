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