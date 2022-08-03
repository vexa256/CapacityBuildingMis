<div class="row">
    <div class="col-md-12">
        <!--begin::Card body-->
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">
            {!! Alert(
                $icon = 'fa-info',
                $class = 'alert-primary',
                $Title = $ModuleName . ' (' . $CourseName . ') Document Notes',
                $Msg = null,
            ) !!}


        </div>
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">
            {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Document Notes ', $Icon = 'fa-plus') }} --}}

            {{ HeaderBtn($Toggle = 'MgtVid', $Class = 'btn-dark', $Label = 'View Video Notes ', $Icon = 'fa-check') }}


            <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                <thead>
                    <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                        <th>Course Name</th>
                        <th>Module Name</th>
                        <th>Notes Title</th>
                        <th>Brief Description</th>
                        <th>View Notes</th>

                        <th>Date Created</th>

                        {{-- <th class="bg-danger fw-bolder text-light"> Delete </th> --}}



                    </tr>
                </thead>
                <tbody>
                    @isset($Notes)
                        @foreach ($Notes as $data)
                            <tr>

                                <td>{{ $CourseName }}</td>
                                <td>{{ $ModuleName }}</td>

                                <td>{{ $data->Title }}</td>
                                <td>{{ $data->BriefDescription }}</td>

                                <td>
                                    <a data-doc="  {{ $data->Title }} ({{ $data->BriefDescription }})"
                                        data-source="{{ asset('assets/data/' . $data->url) }}" data-bs-toggle="modal"
                                        href="#PdfJS" class="btn btn-sm  PdfViewer btn-info"> <i class="fas fa-file-pdf"
                                            aria-hidden="true"></i>
                                    </a>
                                </td>


                                <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>





                                {{-- <td>

                                    {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteDoc', ['id' => $data->id, 'TableName' => 'notes']),
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

    </div>
</div>


{{-- <!--end::Card body-->
@include('notes.NewDocument')
@include('notes.NewVideo') --}}
@include('notes.MgtVideos')


@include('pdf.PDFJS')
