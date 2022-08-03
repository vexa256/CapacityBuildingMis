<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->


<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>



<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

@include('scripts.editor')

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@include('not.not')


<script src="{{ asset('js/notify.js') }}"></script>
@isset($PrintCert)
    <script src="{{ asset('assets/jQuery.print.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".PrintMe").on("click", function() {


                $.print("#PrinterThis");
            });

        });
    </script>
@endisset



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



@isset($TermsYes)
    <script>
        $(document).ready(function() {
            var myModal = new bootstrap.Modal(document.getElementById('TnCs'), {
                keyboard: false
            });

            myModal.toggle()

        });
    </script>
@endisset
</body>
<!--end::Body-->

</html>
