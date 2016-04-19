<h4 class="page-header">Elenco Allegati:</h4>
<?php foreach ($data as $row) : ?>
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-9">
                <h4>
                    <a href="<?= uploadBaseUrl . $row->content_path ?>">
                        <i class="fa fa-file-text-o"></i> <?= $row->content_title ?>
                    </a>
                </h4>
            </div>
        </div>
    </div>
<?php endforeach; ?>
 