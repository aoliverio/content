<!-- News title -->
<h1 class="news-header"><?= __('List of News'); ?></h1>

<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('Add News'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('Add News')]) ?>
    </div>
</div>

<!-- Index template -->
<div class="cmsContent thumbnail">
    <!-- Using datatables script for this table -->
    <script>
        $(document).ready(function () {
            $('#cmsContent-table').dataTable();
        });
    </script>
    <table id="cmsContent-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="check no-sorting">
                    <input id="checkall" class="" type="checkbox" name="" value="" />
                </th>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Taxonomy') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Author') ?></th>
                <th><?= __('Publish') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <?php
                $classContentStatus = 'label label-default';
                if (trim($item->content_status) == 'draft')
                    $classContentStatus = 'label label-warning';
                if (trim($item->content_status) == 'publish')
                    $classContentStatus = 'label label-success';
                $taxonomy_label = (count($item->cms_term_relation) > 0) ? '' : 'no taxonomy';
                $this->CmsTermTaxonomy = Cake\ORM\TableRegistry::get('CmsTermTaxonomy');
                foreach ($item->cms_term_relation as $row):
                    $taxonomy_label .= $this->CmsTermTaxonomy->get($row->cms_term_taxonomy_id)->title . '<br/>';
                endforeach;
                ?>
                <tr>
                    <td><input id="" class="check" type="checkbox" name="" value="" /></td>
                    <td><?= $item->id ?></td>
                    <td><?= h($item->content_title) ?></td>
                    <td class="text-center"><small><?= $taxonomy_label ?></small></td>
                    <td class="text-center"><span class="<?= $classContentStatus ?>"><?= h($item->content_status) ?></span></td>
                    <td><?= h($item->author) ?></td>
                    <td><small><?= h($item->publish_start) ?></small></td>
                    <td><small><?= h($item->modified) ?></small></td>
                    <td class="actions text-right">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $item->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $item->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>