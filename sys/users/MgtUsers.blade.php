<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'Manage all registered users accounts | Deleted accounts can not be recovered',
        $Msg = null,
    ) !!}


</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Admin Account ', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>User's Name</th>
                <th>User Name/Email</th>
                <th class="bg-dark text-light">Role</th>
                {{-- <th>Date Created</th> --}}
                <th class="bg-danger fw-bolder text-light"> Delete Account </th>



            </tr>
        </thead>
        <tbody>
            @isset($Users)
                @foreach ($Users as $data)
                    <tr>

                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td class="bg-dark text-light">{{ $data->role }}</td>
                        {{-- <td>{{ $data->Phone }}</td> --}}
                        {{-- <td>{{ $data->Nationality }}</td> --}}
                        <td>

                            {!! ConfirmBtn(
                                $data = [
                                    'msg' => 'You want to delete this record',
                                    'route' => route('DeleteData', ['id' => $data->id, 'TableName' => 'users']),
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

@include('users.NewAdmin')
