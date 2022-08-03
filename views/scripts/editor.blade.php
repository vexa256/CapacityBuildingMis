<script defer src="{{ asset('assets/editor/ckeditor.js') }}"></script>
<script defer src="{{ asset('assets/editor/adapters/jquery.js') }}"></script>
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
