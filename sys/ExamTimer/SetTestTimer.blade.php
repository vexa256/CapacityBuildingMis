<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Manage the allowed duration of all tests', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Timer', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Assement Type</th>
                <th>Time Duration (Minutes)</th>
                <th class="bg-danger fw-bolder text-light"> Reset </th>



            </tr>
        </thead>
        <tbody>
            @isset($Timer)
                @foreach ($Timer as $data)
                    <tr>

                        <td>{{ $data->AssessmentType }}</td>
                        <td>{{ $data->TimeInMinutes }}</td>


                        <td>
                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('ResetTimer', ['id' => $data->id]),
        'label' => '<i class="fas fa-trash"></i>',
        'class' => 'btn btn-danger btn-sm deleteConfirm admin',
    ],
) !!}

                        </td>
                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>

@include('ExamTimer.NewTimer')
<!--end::Card body-->
{{-- @include('modules.NewModule') --}}
