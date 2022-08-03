<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = $Name . "'s  Module Attendance For The Course " . $CourseName,
        $Msg = null,
    ) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Attendance Record', $Icon = 'fa-plus') }} --}}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course</th>
                <th>Module</th>
                <th class="bg-danger text-light fw-bolder">Attendance Status</th>
                {{-- <th class="bg-dark text-light"> Revoke Attendance</th> --}}

                {{-- <th class="bg-danger fw-bolder text-light"> Mark As Missed </th> --}}



            </tr>
        </thead>
        <tbody>
            @isset($Modules)
                @foreach ($Modules as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $data->Module }}</td>
                        <td class="bg-danger text-light fw-bolder">

                            @if ($data->status == 'true')
                                Module Attended
                            @else
                                Module Missed
                            @endif



                        </td>






                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>

{{-- @include('attendance.Mark') --}}
