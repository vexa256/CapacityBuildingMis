<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'View  All Applicable Course Modules',
        $Msg = null,
    ) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th> Module</th>
                <th>Module Presentation</th>
                {{-- <th>Date Added</th> --}}


            </tr>
        </thead>
        <tbody>
            @isset($Modules)
                @foreach ($Modules as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $data->Module }}</td>
                        <td>
                            <a data-doc="  {{ $data->Module }} "
                                data-source="{{ asset('assets/data/' . $data->ModulePresentation) }}" data-bs-toggle="modal"
                                href="#PdfJS" class="btn btn-sm  PdfViewer btn-info"> <i class="fas fa-file-pdf"
                                    aria-hidden="true"></i>
                            </a>
                        </td>

                        {{-- <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td> --}}









                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
@include('pdf.PDFJS')
