<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Attach instructors to the course ' . $CourseName, $Msg = null) !!}

    {!! Alert($icon = 'fa-info', $class = 'alert-danger', $Title = 'A new instructor by default will be created with a user account whose username and password are the assigned email', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Instructor ', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Instructor</th>
                <th>Email</th>
                <th>Phone</th>
                {{-- <th>Nationality</th> --}}
                <th>Profile</th>
                <th>Date Created</th>
                <th class="bg-dark text-light"> Update </th>
                <th class="bg-danger fw-bolder text-light"> Delete </th>



            </tr>
        </thead>
        <tbody>
            @isset($Instructors)
                @foreach ($Instructors as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->Name }}</td>
                        <td>{{ $data->Email }}</td>
                        <td>{{ $data->Phone }}</td>
                        {{-- <td>{{ $data->Nationality }}</td> --}}

                        <td>
                            <a data-bs-toggle="modal" class="btn btn-dark shadow-lg btn-sm"
                                href="#Desc{{ $data->id }}">

                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>

                        </td>

                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>





                        <td>

                            <a data-bs-toggle="modal"
                                class="btn shadow-lg btn-danger btn-sm admin"
                                href="#Update{{ $data->id }}">

                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>

                        </td>


                        <td>

                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteInstructor', ['id' => $data->id, 'TableName' => 'instructors']),
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

@include('instructors.NewInstructor')

@isset($Instructors)
    @include('viewer.viewer', [
        'PassedData' => $Instructors,
        'Title' => 'View the selected Instructor\'s Profile',
        'DescriptionTableColumn' => 'Profile',
    ])
@endisset


@isset($Instructors)
    @foreach ($Instructors as $data)
        {{ UpdateModalHeader($Title = 'Update the selected  record. The original login email and password will be retained.', $ModalID = $data->id) }}
        <form novalidate action="{{ route('MassUpdate') }}" class=""
            method="POST">
            @csrf

            <div class="row">




                <input type="hidden" name="id" value="{{ $data->id }}">

                <input type="hidden" name="TableName" value="instructors">

                {{ RunUpdateModalFinal($ModalID = $data->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $data->id, $col = '3', $te = '12', $TableName = 'instructors') }}
            </div>


            {{ UpdateModalFooter() }}

        </form>
    @endforeach
@endisset
