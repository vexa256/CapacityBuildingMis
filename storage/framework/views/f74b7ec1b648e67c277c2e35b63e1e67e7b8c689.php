<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->


<script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>



<script src="<?php echo e(asset('assets/js/scripts.bundle.js')); ?>"></script>

<script src="<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>

<script src="<?php echo e(asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js')); ?>"></script>

<?php echo $__env->make('scripts.editor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<?php echo $__env->make('not.not', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script src="<?php echo e(asset('js/notify.js')); ?>"></script>
<?php if(isset($PrintCert)): ?>
    <script src="<?php echo e(asset('assets/jQuery.print.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $(".PrintMe").on("click", function() {


                $.print("#PrinterThis");
            });

        });
    </script>
<?php endif; ?>



<script>
    $(document).ready(function() {


        $(" .Number").click(function() {
            Swal.fire('Not Enough Data Available',
                'This system lacks enough data to compiled the requested report', 'info')
        });
        $(".Setter").click(function() {
            Swal.fire('Super Admin Privileges Required',
                'This option requires a super admin privileges, You have admin privileges', 'info')
        });
    });
</script>



<?php if(isset($TermsYes)): ?>
    <script>
        $(document).ready(function() {
            var myModal = new bootstrap.Modal(document.getElementById('TnCs'), {
                keyboard: false
            });

            myModal.toggle()

        });
    </script>
<?php endif; ?>
</body>
<!--end::Body-->

</html>
<?php /**PATH /var/www/html/srl.local/views/scripts/scripts.blade.php ENDPATH**/ ?>