<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'SRL E-learning Student Enrollment By Country Statistics',
        $Msg = null,
    ) !!}

</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                {{-- <th>Approve</th>
                <th>Decline</th> --}}
                <th>Country</th>
                <th>Students</th>


            </tr>
        </thead>
        <tbody>
            @isset($Apps)
                @foreach ($Apps as $data)
                    <tr>

                        <td>{{ $data->nationality }}</td>
                        <td>{{ $data->Students }}</td>


                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->
