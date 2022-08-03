<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = Auth::user()->name . ', View your score board', $Msg = 'Track your performance. Download your certificate after you have attempted all course tests and scored a total of 80% and above. Results will be shown as they become available') !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course</th>
                <th>Modular Exercises</th>
                <th>Practical Assessments</th>
                <th>Attendance</th>
                <th>Post Test</th>
                <th>Total Score</th>

                {{-- <th class="bg-danger fw-bolder text-light"> Print Certificate </th> --}}



            </tr>
        </thead>
        <tbody>

            <tr>

                <td>{{ $CourseName }}</td>
                <td>{{ $ModulaScore }}</td>
                <td>{{ $PracticalScore }}</td>
                <td>{{ $Attendance }}</td>
                <td>{{ $PostScore }}</td>
                <td>{{ $TotalScore }}%</td>
                {{-- <td>
                    <a class="btn btn-sm   btn-info"> <i class="fas fa-file-pdf" aria-hidden="true"></i>
                    </a>
                </td> --}}


            </tr>



        </tbody>
    </table>
</div>
