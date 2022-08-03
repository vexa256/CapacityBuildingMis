<div class="row">
    <div class="col-md-12">
        <!--begin::Card body-->
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">
            {!! Alert(
                $icon = 'fa-info',
                $class = 'alert-primary',
                $Title = 'Student Certification Report',
                $Msg = 'View all certified students and the certificates issued',
            ) !!}


        </div>
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">




            <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                <thead>
                    <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                        <th>Student</th>
                        <th>Course</th>
                        <th>Total Score</th>
                        <th>Certificate N.o</th>
                        <th>Post Test Score
                        <th>
                        <th>Pre Test Score</th>
                        <th>Practical Test Score </th>
                        <th>Attendance Score </th>
                        <th>Modular Test Score </th>
                        <th>CEUs</th>
                        <th>Course Start Date</th>
                        <th>Course End Date</th>


                    </tr>
                </thead>
                <tbody>
                    @isset($CertifiedStudents)
                        @foreach ($CertifiedStudents as $data)
                            <tr>

                                <td>{{ $data->name }}</td>
                                <td>{{ $data->CourseName }}</td>
                                <td>{{ $data->Score }}</td>
                                <td>{{ $data->CertNo }}</td>
                                <td>{{ $data->PostTestScore }}</td>
                                <td>{{ $data->PreTestScore }}</td>
                                <td>{{ $data->PracticalTestScore }}</td>
                                <td>{{ $data->AttendanceScore }}</td>
                                <td>{{ $data->ModularScore }}</td>
                                <td>{{ $data->From }}</td>
                                <td>{{ $data->To }}</td>









                            </tr>
                        @endforeach
                    @endisset



                </tbody>
            </table>
        </div>

    </div>
</div>
