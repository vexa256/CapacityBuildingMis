<div class="row" style="max-height: 100%; overflow-y:scroll">

    @isset($Courses)
        @foreach ($Courses as $data)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data->CourseName }}</h3>

                    </div>
                    <div class="card-body p-0">

                        <div class="text-center px-4">
                            <img class="mw-100 shadow-xl h-200px card-rounded-bottom" alt=""
                                src="{{ asset('assets/data/' . $data->Thumbnail) }}" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-toolbar">
                            <a data-bs-toggle="modal" href="#Desc{{ $data->id }}" class="btn btn-sm btn-danger me-2">
                                View More
                            </a>
                            <a data-bs-toggle="modal" href="#New" class="btn btn-sm btn-dark">
                                Apply
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
</div>


@include('public.Viewer')

@include('public.NewApp')

<div class="modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel"
    aria-hidden="true" id="TnCs">
    <div class="modal-dialog modal-lg	">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> E-learning | SRL Uganda Terms and Conditions</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <p><strong>
                        <h3>Information Accuracy</h3>
                    </strong>
                <p> By submitting the course application form, you confirm that the information provided in the
                    application is true and can be used by the training organizers for purposes of training only.</p>
                <strong>
                    <h3>Non-discrimination policy</h3>
                </strong> Uganda NTRL/SRL does not and shall not discriminate on the basis of race, color, religion
                (creed), gender, gender expression, age, national origin (ancestry), disability, marital status, sexual
                orientation, or military status; in any of its activities including training therefore the Uganda
                NTRL/SRL gives equal opportunity to learners seeking training. <br> <b>
                    <h3> Conflict of interest disclosure</h3>
                </b> Persons or groups are required to disclose a potential, perceived, and actual conflict of interest
                while executing their duties at the Uganda NTRL/SRL. There is no conflict of interest for all the
                learning courses offered <br> <b>
                    <h3> Confidentiality Policy</h3>
                </b> Correspondences and information related to training courses shall be kept confidential unless
                consent for disclosure has been granted in writing by Uganda NTRL / SRL. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">I Agree to the Terms and
                    Conditions</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
