<div class="row">
    <div class="col-md-12">
        <!--begin::Card body-->
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">
            {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Course Practical Test Activation Management', $Msg = null) !!}


        </div>
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">



            <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                <thead>
                    <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                        <th>Course Name</th>
                        <th>Post Test</th>
                        <th>Description</th>
                        <th>Activation Status</th>
                        {{-- <th>Brief Description</th> --}}
                        {{-- <th>View Notes</th> --}}
                        <th class="bg-danger fw-bolder text-light"> Activate / Disable </th>







                    </tr>
                </thead>
                <tbody>
                    @isset($Tests)
                        @foreach ($Tests as $data)
                            <tr>

                                <td>{{ $data->CourseName }}</td>
                                <td>{{ $data->PracticalTestTitle }}</td>
                                <td>{{ $data->BriefDescription }}</td>


                                @if ($data->Active == 'true')
                                    <td class="bg-success text-dark fw-bolder">
                                        Test Activated
                                    </td>
                                @else
                                    <td class="bg-dark text-light fw-bolder">
                                        Test Disabled
                                    </td>
                                @endif


                                @if ($data->Active == 'true')
                                    <td>

                                        {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to disable this Test',
        'route' => route('DeActivateSelectedTest', ['id' => $data->id, 'TableName' => 'practical_tests']),
        'label' => '<i class="fas fa-times"></i>',
        'class' => 'btn btn-danger btn-sm deleteConfirm admin',
    ],
) !!}

                                    </td>
                                @else
                                    <td>

                                        {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to enable this Test',
        'route' => route('ActivateSelectedTest', ['id' => $data->id, 'TableName' => 'practical_tests']),
        'label' => '<i class="fas fa-check"></i>',
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

    </div>
</div>
