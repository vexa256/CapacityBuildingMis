<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Manage all UnMarked Modular Tests For ' . $Module, $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'GuideNow', $Class = 'btn-danger', $Label = 'Marking Guides', $Icon = 'fa-info') }}


    {{ HeaderBtn($Toggle = 'ResultsNow', $Class = 'btn-danger', $Label = 'Course Results Database', $Icon = 'fa-check') }}


    <table class="  table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Student</th>
                <th>Course Module</th>
                <th>Parent Organization</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Modular-Test</th>
                <th>Description</th>
                <th>Test Question</th>
                <th>Student Answer</th>
                <th class="bg-dark text-light"> Mark </th>
            </tr>
        </thead>
        <tbody>
            @isset($ModularTests)
                @foreach ($ModularTests as $data)
                    <tr>

                        <td>{{ $data->Name }}</td>
                        <td>{{ $data->Module }}</td>
                        <td>{{ $data->ParentOrganization }}</td>
                        <td>{{ $data->Email }}</td>
                        <td>{{ $data->WorkTelephoneNumber }}</td>
                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->ModularTestTitle }}</td>
                        <td>{{ $data->BriefDescription }}</td>
                        <td> <a data-bs-toggle="modal" class="btn btn-info shadow-lg btn-sm"
                                href="#Qtn{{ $data->SelectedExamID }}">



                                View
                            </a>


                        </td>
                        <td> <a data-bs-toggle="modal" class="btn btn-danger shadow-lg btn-sm"
                                href="#AnsNow{{ $data->SelectedExamID }}">


                                View </a></td>

                        <td>
                            <a data-bs-toggle="modal" class="btn btn-dark btn-sm shadow-lg "
                                href="#Marker{{ $data->SelectedExamID }}">


                                Mark
                            </a>

                        </td>







                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
@isset($Marked)
    @foreach ($Marked as $mark)
        <div class="modal fade" id="Qtn{{ $mark->SelectedExamID }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> SRL Uganda |

                            <span class="text-danger">

                                View Modular Test Question Attempted by the Student

                                {{ $mark->Name }} . | The Course is {{ $CourseName }}

                            </span>


                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon  btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body ">

                        <form action="#" class="row" method="POST">
                            @csrf
                            <div class="row">

                                <input type="hidden" name="id" value="{{ $mark->SelectedExamID }}">

                                <div class="col-12">
                                    <textarea class="editorme">

                                        {!! $mark->ModularQuestion !!}
                                    </textarea>
                                </div>


                            </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="submit" class="btn btn-dark">Save
                            Changes</button> --}}

                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endisset



@isset($ModularTests)
    @foreach ($ModularTests as $post)
        <div class="modal fade" id="Qtn{{ $post->SelectedExamID }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> SRL Uganda |

                            <span class="text-danger">

                                View Modular Test Question Attempted by the Student

                                {{ $post->Name }} . | The Course is {{ $CourseName }} ({{ $Module }})

                            </span>


                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon  btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body ">

                        <form action="#" class="row" method="POST">
                            @csrf
                            <div class="row">

                                <input type="hidden" name="id" value="{{ $post->SelectedExamID }}">

                                <div class="col-12">
                                    <textarea class="editorme">

                                        {!! $post->ModularQuestion !!}
                                    </textarea>
                                </div>


                            </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="submit" class="btn btn-dark">Save
                            Changes</button> --}}

                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endisset



@include('MarkModular.ModularAns')
@include('MarkModular.ScoreModular')
@include('MarkModular.Guide')
@include('MarkModular.Results')
