<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div style="margin-top: 10px">
                <a href="<?= $this->Url->build('/' . SITE_NAME); ?>"><img src="<?= imageBaseUrl ?>logo.png"/></a>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div id="area-riservata-label">
                <a href="<?= $this->Url->build('/admin') ?>">AREA RISERVATA</a>&nbsp;&nbsp;<i class="fa fa-lock"></i></span>
            </div>
        </div>
    </div>            
</div>
<br/>
<?= $this->element('menu-navbar'); ?>