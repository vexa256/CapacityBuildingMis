<script defer src="<?php echo e(asset('assets/editor/ckeditor.js')); ?>"></script>
<script defer src="<?php echo e(asset('assets/editor/adapters/jquery.js')); ?>"></script>
<script>
    $(document).ready(function() {

        if ($('textarea.editorme').length > 0) {
            CKEDITOR.config.height = 300;
            setTimeout(function() {
                $('textarea.editorme').ckeditor();
            }, 700);
        }

    });
</script>
<?php /**PATH /var/www/html/srl.local/views/scripts/editor.blade.php ENDPATH**/ ?>