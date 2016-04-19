<style>
    .gallery{
        display: inline-block;
        margin-top: 20px;
    }
</style>

<!-- References: https://github.com/fancyapps/fancyBox -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function () {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>

<h4 class="page-header">Photo Gallery:</h4>
<div class="row">
    <div class="gallery">
        <?php foreach ($data as $row) : ?> 
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a class="thumbnail fancybox" rel="ligthbox" href="<?= uploadBaseUrl . $row->content_path ?>">
                    <img class="img-responsive" alt="" src="<?= uploadBaseUrl . $row->content_path ?>" />
                    <div class="text-right">
                        <small class="text-muted"><?= $row->content_description ?></small>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>