<div class="row">
    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas me-1 fa-tags text-light fw-bolder fa-2x" aria-hidden="true"></i> <span
                        class="text-light fw-bolder">
                        Course Modules</span>
                </span>
                <!--end::Svg Icon-->
                <div class="text-inverse-info fw-bolder fs-5 mb-1 mt-3">
                    {{ $Modules }}

                </div>
                <div class="fw-bold text-inverse-info fs-4">Total Modules


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>

    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class=" me-1 fas fa-book-open	 text-light fw-bolder fa-2x" aria-hidden="true"></i> <span
                        class="text-light fw-bolder">
                        Notes</span>
                </span>
                <!--end::Svg Icon-->
                <div class="text-inverse-info fw-bolder fs-5 mb-1 mt-3"> {{ $Notes }}

                </div>
                <div class="fw-bold text-inverse-info fs-4">Total Notes


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>

    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-light-warning hoverable card-xl-stretch mb-1 ">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas fa-hand-holding-medical text-success fw-bolder fa-2x" aria-hidden="true"></i>
                </span>
                <!--end::Svg Icon-->
                <div class="text-dark fw-bolder fs-5 mb-1 mt-1">
                    {{ $Prac }}
                </div>
                <div class="progress h-7px bg-success bg-opacity-50 mt-1">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-bolder text-danger fs-4">Practical Tests


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>

    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-light-danger hoverable card-xl-stretch mb-1 ">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas fa-low-vision text-success fw-bolder fa-2x" aria-hidden="true"></i>
                </span>
                <!--end::Svg Icon-->
                <div class="text-dark fw-bolder fs-5 mb-1 mt-1">
                    {{ $Mods }}
                </div>
                <div class="progress h-7px bg-success bg-opacity-50 mt-1">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-bolder text-danger fs-4">Modular Tests


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>


    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-danger hoverable card-xl-stretch mb-2 ">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas fa-box-open text-light fw-bolder fa-2x" aria-hidden="true"></i>
                </span>
                <!--end::Svg Icon-->
                <div class="text-light fw-bolder fs-5 mb-1 mt-1">
                    {{ $PostTests }}
                </div>
                <div class="progress h-7px bg-success bg-opacity-50 mt-1">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-bolder text-light fs-4">Post-Tests


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-dark hoverable card-xl-stretch mb-2 ">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas fa-bell-slash text-light fw-bolder fa-2x" aria-hidden="true"></i>
                </span>
                <!--end::Svg Icon-->
                <div class="text-light fw-bolder fs-5 mb-1 mt-1">
                    {{ $AttemptPostTests }}
                </div>
                <div class="progress h-7px bg-success bg-opacity-50 mt-1">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-bolder text-light fs-4">Attempted Post-Tests


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-primary hoverable card-xl-stretch mb-2 ">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas fa-chalkboard	 text-light fw-bolder fa-2x" aria-hidden="true"></i>
                </span>
                <!--end::Svg Icon-->
                <div class="text-light fw-bolder fs-5 mb-1 mt-1">
                    {{ $AttemptModTests }}
                </div>
                <div class="progress h-7px bg-success bg-opacity-50 mt-1">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-bolder text-light fs-4">Attempted Modular


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>

    <div class="col-md-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card shadow-lg bg-info hoverable card-xl-stretch mb-2 ">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-pie.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <i class="fas fa-user-shield text-light fw-bolder fa-2x" aria-hidden="true"></i>
                </span>
                <!--end::Svg Icon-->
                <div class="text-light fw-bolder fs-5 mb-1 mt-1">
                    {{ $AttemptPracTests }}
                </div>
                <div class="progress h-7px bg-success bg-opacity-50 mt-1">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-bolder text-light fs-4">Attempted Practicals


                </div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>

</div>
