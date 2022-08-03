@if ($errors->any()) <script type="text/javascript"> Swal.fire({ title: 'An error occured, try again', icon: 'error', html: ` <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> `, showCancelButton: false, focusConfirm: false, confirmButtonText: '<i class="fas fa-times"></i> Close!', confirmButtonAriaLabel: 'Close', }); </script> @endif

@isset($Status)
    <script type="text/javascript">
        $(function() { Swal.fire('Information', '{{ $Status }}', 'success'); });
    </script>
@endisset


@isset($Policy) <script type="text/javascript"> $(function() {

    $( ".terms" ).click(function() {

        Swal.fire({ title: 'Our Policies', icon: 'info', html: `<strong><h3>Information Accuracy</h3></strong> <p> By submitting the course application form, you confirm that the information provided  in the application is true and can be used by the training organizers for purposes of training only.</p> <strong><h3>Non-discrimination policy</h3></strong> Uganda NTRL/SRL does not and shall not discriminate on the basis of race, color, religion (creed), gender, gender expression, age, national origin (ancestry), disability, marital status, sexual orientation, or military status; in any of its activities including training therefore the Uganda NTRL/SRL gives equal opportunity to learners seeking training. <br> <b><h3>  Conflict of interest disclosure</h3></b> Persons or groups are required to disclose a potential, perceived, and actual conflict of interest while executing their duties at the Uganda NTRL/SRL. There is no conflict of interest for all the learning courses offered <br> <b><h3> Confidentiality Policy</h3></b> Correspondences and information related to training courses shall be kept confidential unless consent for disclosure has been granted in writing by Uganda NTRL / SRL. `, showCloseButton: true, showCancelButton: false, focusConfirm: false, confirmButtonText: '<i class="fa fa-thumbs-up"></i> I Understand', confirmButtonAriaLabel: 'Thumbs up, I Accept', cancelButtonText: '<i class="fa fa-thumbs-down"></i>', cancelButtonAriaLabel: 'Thumbs down' })
    });

    });
 </script>
@endisset
@if (session('status'))
    <script type="text/javascript">
        $(function() { Swal.fire('Information', '{{ session('status') }}', 'success'); });
    </script>
@endif



@if (session('error_a')) <script type="text/javascript"> $(function() { Swal.fire('Information', '{{ session('error_a') }}', 'error'); }); </script> @endif



@if (isset($rem)) <script> $(function() { if ($('.x_analyzed').length > 0) { $('.x_ExtendedValidity').remove(); } if ($('.x_analyzed').length > 0) { $('.x_analyzed').remove(); } @foreach ($rem as $val) $(".x_{{ $val }}").remove(); @endforeach BootEditor(); }); </script> @else <script> $(function() { BootEditor(); }); </script> @endif @if (isset($rem2)) <script> $(function() { @foreach ($rem2 as $val) $(".x_{{ $val }}").remove(); @endforeach BootEditor(); }); </script> @else <script> $(function() { BootEditor(); }); </script> @endif

{{-- @if (isset($rem))
    <script>

        $(function() {

            if ($('.x_analyzed').length > 0) {
                $('.x_ExtendedValidity').remove();
            }
            if ($('.x_analyzed').length > 0) {

                $('.x_analyzed').remove();

            }
            @foreach ($rem as $val)
                $(".x_{{ $val }}").remove();
            @endforeach

            BootEditor();
        });
    </script>
@else
    <script>
        $(function() {

            BootEditor();

        });
    </script>

@endif

--}}

@if (isset($rem2)) <script> $(function() { @foreach ($rem2 as $val) $(".x_{{ $val }}").remove(); @endforeach BootEditor(); }); </script> @else <script> $(function() { BootEditor(); }); </script> @endif

