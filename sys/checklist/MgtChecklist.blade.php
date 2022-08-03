<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Hello ' . Auth::user()->name . ' , Use this interface to submit your facilitator checklist', $Msg = null) !!}


</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Checklist ', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Instructor</th>
                <th>Submitted Checklist</th>
                <th>Date Created</th>

                <th class="bg-danger fw-bolder text-light"> Delete </th>



            </tr>
        </thead>
        <tbody>
            @isset($Checklist)
                @foreach ($Checklist as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $ModuleName }}</td>
                        <td>{{ $data->Name }}</td>




                        <td>
                            <a data-bs-toggle="modal" class="btn btn-dark shadow-lg btn-sm"
                                href="#Desc{{ $data->id }}">

                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>

                        </td>



                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>





                        <td>

                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteData', ['id' => $data->id, 'TableName' => 'facili_tator_check_lists']),
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
<!--end::Card body-->

@include('checklist.NewCheckList')


@isset($Checklist)
    @include('viewer.viewer', [
        'PassedData' => $Checklist,
        'Title' => 'View Your Facilitator Checklist',
        'DescriptionTableColumn' => 'Checklist',
    ])
@endisset
