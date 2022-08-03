<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Instructor guides for specific course modules', $Msg = null) !!}
</div>


<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    @if (Auth::user()->role == 'admin')
        {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Facilitator Guide  ', $Icon = 'fa-plus') }}
    @endif

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Facilitator Guide Title</th>
                <th>View Guide</th>
                <th>Date Created</th>

                @if (Auth::user()->role == 'admin')
                    <th class="bg-danger fw-bolder text-light"> Delete </th>
                @endif




            </tr>
        </thead>
        <tbody>
            @isset($Guides)
                @foreach ($Guides as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->Module }}</td>
                        <td>{{ $data->InstructorGuidelineTitle }}</td>


                        <td>
                            <a data-doc="  {{ $data->InstructorGuidelineTitle }} "
                                data-source="{{ asset('assets/data/' . $data->url) }}" data-bs-toggle="modal" href="#PdfJS"
                                class="btn btn-sm  PdfViewer btn-info"> <i class="fas fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </td>


                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>



                        @if (Auth::user()->role == 'admin')
                            <td>

                                {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteDoc', ['id' => $data->id, 'TableName' => 'instructor_guidelines']),
        'label' => '<i class="fas fa-trash"></i>',
        'class' => 'btn btn-danger btn-sm deleteConfirm admin',
    ],
) !!}

                            </td>
                        @endif






                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</div>
<!--end::Card body-->

@include('instructors.NewGuide')

@include('pdf.PDFJS')
