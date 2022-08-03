<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'View marking guides attached to the course ' . $CourseName, $Msg = null) !!}


</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Marking Guide ', $Icon = 'fa-plus') }} --}}
    <table class="  table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Marking Guide Title</th>
                <th> View Guide </th>
                <th>Date Created</th>

                {{-- <th class="bg-danger fw-bolder text-light"> Delete </th> --}}



            </tr>
        </thead>
        <tbody>
            @isset($Guides)
                @foreach ($Guides as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->MarkingGuideTitle }}</td>


                        <td>
                            <a data-doc="  {{ $data->MarkingGuideTitle }} "
                                data-source="{{ asset('assets/data/' . $data->url) }}"
                                data-bs-toggle="modal" href="#PdfJS"
                                class="btn btn-sm  PdfViewer btn-info"> <i
                                    class="fas fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </td>


                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>




                        {{-- <td>

                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteDoc', ['id' => $data->id, 'TableName' => 'marking_guides']),
        'label' => '<i class="fas fa-trash"></i>',
        'class' => 'btn btn-danger btn-sm deleteConfirm admin',
    ],
) !!}

                        </td> --}}





                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->

{{-- @include('courses.NewMarkingGuide') --}}

@include('pdf.PDFJS')
