<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert(
        $icon = 'fa-info',
        $class = 'alert-primary',
        $Title = 'Student Course Evaluation',
        $Msg = 'Submit your course evaluation form',
    ) !!}

</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'Submit Course Evaluation ', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">

                <th>Start Date</th>
                <th>End Date</th>

                <th>Country</th>
                <th>Training met my expectations</th>
                <th>Application of Skills Learned</th>
                <th>Training Objective Achievement</th>
                <th>Overall Training Rating</th>
                <th>Instructor feedback on the achievement of the learning outcomes</th>
                <th>Use of Attained Skills</th>
                <th>Student's Comments</th>
                {{-- <th>Delete Record</th> --}}

            </tr>
        </thead>
        <tbody>
            @isset($Evaluation)
                @foreach ($Evaluation as $data)
                    <tr>


                        <td>{!! date('F j, Y', strtotime($Time->From)) !!} </td>
                        <td>{!! date('F j, Y', strtotime($Time->To)) !!} </td>
                        <td>{{ $Student->nationality }}</td>
                        <td>{{ $data->OverallTheTrainingMetMyExpectations }}</td>
                        <td>{{ $data->IWillBeAbleToApplyTheKnowledgeLearned }}</td>
                        <td>{{ $data->TheTrainingOutcomesWereMet }}</td>
                        <td>{{ $data->HowDoYouRateTheTrainingOverall }}</td>
                        <td>{{ $data->InstructorFeedback }}</td>
                        <td> {{ strip_tags($data->UseofSkills) }} </td>
                        <td> {{ strip_tags($data->OtherComments) }} </td>

                        {{-- <td></td> --}}


                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->

@include('evaluations.NewEval')




{{-- @include('public.ApproveModal') --}}
