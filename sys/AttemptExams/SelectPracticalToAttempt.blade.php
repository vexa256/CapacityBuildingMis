<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Hello ' . Auth::user()->name . '. Select practical test to attempt', $Msg = null) !!}
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

                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to attempt this test. Once you confirm, the exam timer will start and can not be stopped. Please attempt the exam in the assigned time. All exams submitted after the assigned time will not  considered',
        'route' => route('PracticalTestToAttemptSelected', ['id' => $data->id]),
        'label' => '<i class="fas fa-check"></i>',
        'class' => 'btn btn-dark  deleteConfirm admin',
    ],
) !!}

                        </td>





                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->
