<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Time Duration', $Msg = 'Please Attempt The Given Test In the Assigned Time. Assessments Submitted After The Deadline Will Not Be Considered') !!}

    {!! Alert($icon = 'fa-info', $class = 'alert-danger', $Title = 'Deadline ,  Authenticity and guidelines', $Msg = ' Submission deadline  is ' . $Deadline . '. An advanced plagiarism checker will be used to determine the authenticity of your  submission. Do not open other browser tabs as the system will record the action as malpractice') !!}



</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Modular Test Question', $Icon = 'fa-plus') }} --}}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Practical Test</th>
                <th>Description</th>
                <th class="bg-dark text-light"> Attempt Test </th>




            </tr>
        </thead>
        <tbody>
            @isset($ModularTests)
                @foreach ($ModularTests as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->Module }}</td>
                        <td>{{ $data->PracticalTestTitle }}</td>
                        <td>{{ $data->BriefDescription }}</td>







                        <td>
                            <a data-bs-toggle="modal" href="#New" class="btn   PdfViewer btn-info"> <i class="fas fa-book"
                                    aria-hidden="true"></i>
                                Attempt Test</a>
                        </td>



                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->

@include('AttemptExams.PracticalAnswer')
