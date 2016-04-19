<!-- Cookies Directive -->
<?php echo $this->Html->script($this->request->plugin . '.cookies-directive'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $.cookiesDirective({
            position: 'bottom',
            explicitConsent: false,
            duration: 60,
            privacyPolicyUri: 'http://www.icpatarirodari.gov.it/app/web/privacy',
            backgroundColor: '#FCB205',
            backgroundOpacity: '99',
            linkColor: '#ffffff',
            fontSize: '14px',
            buttonClass: 'btn btn-success btn-sm',
            buttonText: 'OK'
        });
    });
</script>