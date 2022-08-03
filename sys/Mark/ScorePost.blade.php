@isset($PostTests)
    @foreach ($PostTests as $res)
        <div class="modal fade" id="Marker{{ $res->SelectedExamID }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> SRL Uganda |

                            <span class="text-danger">

                                Mark Post Test Answer Submitted by the Student

                                {{ $res->Name }} . | The Course is {{ $CourseName }}

                            </span>


                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body ">

                        <form action="{{ route('MassUpdate') }}" class="row" method="POST">
                            @csrf
                            <div class="row">



                                <input type="hidden" name="TableName" value="attempt_post_tests">


                                <div class="mt-3  mb-3 col-md-12 ">
                                    <label id="label" for="" class=" required form-label">Enter the Score for
                                        this student

                                        (Follow the assessment rules)
                                    </label>

                                    <input type="text" required name="Score" class="form-control IntOnlyNow">

                                </div>



                                <div class="mt-3  mb-3 col-md-12 ">
                                    <label id="label" for="" class=" required form-label">Student Answer
                                    </label>

                                    <textarea class="editorme">

                                        {!! $res->StudentAnswer !!}
                                    </textarea>
                                </div>

                                <input type="hidden" name="id" value="{{ $data->SelectedExamID }}">


                                <input type="hidden" name="Marked" value="true">


                            </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-dark">Save
                            Changes</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endisset
