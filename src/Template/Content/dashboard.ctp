<?php 

/**
 * 
 */
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * 
 */
$this->CmsContent = TableRegistry::get('Content.CmsContent');
$this->CmsTermTaxonomy = TableRegistry::get('Content.CmsTermTaxonomy');
$_number_of_page = $this->CmsContent->find('all')->where(['content_type' => 'page'])->count();
$_number_of_news = $this->CmsContent->find('all')->where(['content_type' => 'news'])->count();
$_number_of_taxonomy = $this->CmsTermTaxonomy->find('all')->count();

?>


<h1 class="page-header">Content Plugin</h1>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><?= __('Dashboard'); ?></a></li>
        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?= __('Database'); ?></a></li>
    </ul>
    <br/>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                        <span class="pull-right"><i class="fa fa-file-text fa-3x"></i></span>
                        <h2><?= $_number_of_page ?> Pagine</h2>
                        <br/>
                        <div>
                            <a href="<?= $this->Url->build(['controller' => 'page']); ?>" class="btn btn-primary btn-sm">Manage</a>
                            <a href="<?= $this->Url->build(['controller' => 'page', 'action' => 'add']); ?>" class="btn btn-success btn-sm">Add New</a>
                        </div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <span class="pull-right"><i class="fa fa-newspaper-o fa-3x"></i></span>
                        <h2><?= $_number_of_news ?> News</h2>
                        <br/>
                        <div>
                            <a href="<?= $this->Url->build(['controller' => 'news']); ?>" class="btn btn-primary btn-sm">Manage</a>
                            <a href="<?= $this->Url->build(['controller' => 'news', 'action' => 'add']); ?>" class="btn btn-success btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <span class="pull-right"><i class="fa fa-list fa-3x"></i></span>
                        <h2><?= $_number_of_taxonomy ?> Categorie</h2>
                        <br/>
                        <div>
                            <a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomy']); ?>" class="btn btn-primary btn-sm">Manage</a>
                            <a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomy', 'action' => 'add']); ?>" class="btn btn-success btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_content']); ?>">CMS CONTENT</a> - Gestione dei Contenuti (ogni elemento può essere gestito come contenuto).
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_content_meta']); ?>">CMS CONTENT META</a> - Aggiunge meta informazioni ai Contenuti.
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_term']); ?>">CMS TERM</a> - Organizza i Contenuti in base a condizioni.
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomy']); ?>">CMS TERM TAXONOMY</a> - Classificazione dei Contenuti ad aree di appartenenza.
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_term_relation']); ?>">CMS TERM RELATION</a> - Associa un Contenuto alla Tassonomia.
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_permission']); ?>">CMS PERMISSION</a> - Gestione dei Permessi sui Contenuti.
            </div> 
        </div>
    </div>
</div>



<?php if (FALSE) : ?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <?= __('List of the latest page updates') ?>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <!-- Using datatables script for this table -->
                    <script>
                        $(document).ready(function () {
                            $('#last-page-table').dataTable({
                                "order": [[3, "desc"]]
                            });
                        });
                    </script>
                    <table id="last-page-table" class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Title') ?></th>
                                <th class="text-center"><?= __('Status') ?></th>
                                <th class="text-center"><?= __('Updated') ?></th>
                                <th class="actions no-sorting"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($last_page as $cmsContent): ?>
                                <?php
                                $classContentStatus = 'label label-default';
                                if (trim($cmsContent->content_status) == 'draft')
                                    $classContentStatus = 'label label-warning';
                                if (trim($cmsContent->content_status) == 'publish')
                                    $classContentStatus = 'label label-success';
                                ?>
                                <tr>
                                    <td><?= $cmsContent->id ?></td>
                                    <td><?= h($cmsContent->content_title) ?></td>
                                    <td class="text-center"><span class="<?= $classContentStatus ?>"><?= h($cmsContent->content_status) ?></span></td>
                                    <td class="text-center"><small><?= $cmsContent->modified ?></small></td>
                                    <td class="actions text-right">
                                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'page', 'action' => 'edit', $cmsContent->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <?= __('List of the latest news updates') ?>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <!-- Using datatables script for this table -->
                    <script>
                        $(document).ready(function () {
                            $('#last-news-table').dataTable({
                                "order": [[3, "desc"]]
                            });
                        });
                    </script>
                    <table id="last-news-table" class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Title') ?></th>
                                <th class="text-center"><?= __('Status') ?></th>
                                <th class="text-center"><?= __('Updated') ?></th>
                                <th class="actions no-sorting"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($last_news as $cmsContent): ?>
                                <?php
                                $classContentStatus = 'label label-default';
                                if (trim($cmsContent->content_status) == 'draft')
                                    $classContentStatus = 'label label-warning';
                                if (trim($cmsContent->content_status) == 'publish')
                                    $classContentStatus = 'label label-success';
                                ?>
                                <tr>
                                    <td><?= $cmsContent->id ?></td>
                                    <td><?= h($cmsContent->content_title) ?></td>
                                    <td class="text-center"><span class="<?= $classContentStatus ?>"><?= h($cmsContent->content_status) ?></span></td>
                                    <td class="text-center"><small><?= $cmsContent->modified ?></small></td>
                                    <td class="actions text-right">
                                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'news', 'action' => 'edit', $cmsContent->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>