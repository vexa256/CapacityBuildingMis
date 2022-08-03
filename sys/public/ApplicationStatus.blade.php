<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'Your Application is Pending Approval. You will proceed to the next step upon approval',
        $Msg = null,
    ) !!}

</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                {{-- <th>Approve</th>
                <th>Decline</th> --}}
                <th>Student</th>
                <th>Course</th>
                <th class="bg-danger text-light fw-bolder">Approval Status</th>
                <th>Institution</th>
                <th> Phone</th>
                <th>Work Phone</th>
                <th>Application</th>
                <th>CV</th>
                <th>ID</th>
                <th>View More</th>

            </tr>
        </thead>
        <tbody>
            @isset($Apps)
                @foreach ($Apps as $data)
                    <tr>
                        {{-- <td>
                            <a class="btn btn-dark shadow-lg btn-sm"
                                href="{{ route('MarkAppAsApproved', ['id' => $data->Uid]) }}">

                                <i class="fas fa-check" aria-hidden="true"></i>
                            </a>

                        </td>
                        <td>
                            <a class="btn btn-dark shadow-lg btn-sm"
                                href="{{ route('MarkAppAsDeclined', ['id' => $data->Uid]) }}">

                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>

                        </td> --}}

                        <td>{{ $data->name }}</td>
                        <td>{{ $data->CourseName }}</td>

                        @if ($data->role == 'Approve')
                            <td class="bg-dark text-light">Application Pending
                                Approval</td>
                        @else
                            <td class="bg-dark text-light">Application Approved</td>
                        @endif


                        <td>{{ $data->institution }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->WorkTelephoneNumber }}</td>



                        <td>
                            <a data-bs-toggle="modal" class="btn btn-dark shadow-lg btn-sm" href="#Desc{{ $data->id }}">

                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>

                        </td>


                        <td>
                            <a data-doc="Course Application" data-source="{{ asset('assets/data/' . $data->CV) }}"
                                data-bs-toggle="modal" href="#PdfJS" class="btn btn-sm  PdfViewer btn-info"> <i
                                    class="fas fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </td>


                        <td>
                            <a data-doc="Course Application" data-source="{{ asset('assets/data/' . $data->StudentID) }}"
                                data-bs-toggle="modal" href="#PdfJS" class="btn btn-sm  PdfViewer btn-info"> <i
                                    class="fas fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </td>

                        <td>
                            <a data-bs-toggle="modal" href="#ViewMore{{ $data->ID }}" class="btn btn-sm  btn-warning">
                                <i class="fas fa-binoculars me-1" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->



@isset($Apps)
    @include('viewer.viewer', [
        'PassedData' => $Apps,

        'Title' =>
            'Briefly describe your reasons for applying to this course and how you are hoping it will help you and your organization. ',
        'DescriptionTableColumn' => 'ReasonsForJoining',
    ])
@endisset


@include('public.ViewMoreStudentDetails')

@include('pdf.PDFJS')
