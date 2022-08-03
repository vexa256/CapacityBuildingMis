<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <form action="{{ route('SubmitEvaluation') }}" class="row" method="POST">
                <div class="modal-header bg-gray">
                    <h5 class="modal-title">
                        Submit a course evalution for the course
                        <span class="text-danger">
                            {{ $Desc }}
                        </span>
                    </h5>


                    <div class="float-right">

                        <button type="submit" class="btn btn-primary">

                            Submit Evaluation

                        </button>


                    </div>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body " style="max-height:400px; overflow-y:scroll">

                    @csrf
                    <div class="row">

                        <div class="mb-3 col-md-4  py-1  my-1">
                            <label id="label" for="" class=" required form-label">Overall, the training met
                                my expectations.</label>
                            <select required name="OverallTheTrainingMetMyExpectations"
                                class="form-select   form-select-solid" data-control="select2"
                                data-placeholder="Select a option">
                                <option></option>
                                <option value="Strongly
                                Agree">Strongly
                                    Agree</option>
                                <option value="Agree">Agree</option>
                                <option value="Neutral">Neutral</option>
                                <option value="Disagree">Disagree</option>
                                <option value="Strongly
                                Disagree">Strongly
                                    Disagree</option>


                            </select>

                        </div>


                        <div class="mb-3 col-md-4  py-1  my-1">
                            <label id="label" for="" class=" required form-label">I will be able to apply
                                the knowledge learned.</label>
                            <select required name="IWillBeAbleToApplyTheKnowledgeLearned"
                                class="form-select   form-select-solid" data-control="select2"
                                data-placeholder="Select a option">
                                <option></option>
                                <option value="Strongly
                                Agree">Strongly
                                    Agree</option>
                                <option value="Agree">Agree</option>
                                <option value="Neutral">Neutral</option>
                                <option value="Disagree">Disagree</option>
                                <option value="Strongly
                                Disagree">Strongly
                                    Disagree</option>


                            </select>

                        </div>



                        <div class="mb-3 col-md-4  py-1  my-1">
                            <label id="label" for="" class=" required form-label">3. Overall, the training
                                objectives/outcome were met.</label>
                            <select required name="TheTrainingOutcomesWereMet" class="form-select   form-select-solid"
                                data-control="select2" data-placeholder="Select a option">
                                <option></option>
                                <option value="Strongly
                                Agree">Strongly
                                    Agree</option>
                                <option value="Agree">Agree</option>
                                <option value="Neutral">Neutral</option>
                                <option value="Disagree">Disagree</option>
                                <option value="Strongly
                                Disagree">Strongly
                                    Disagree</option>


                            </select>

                        </div>




                        <div class="mb-3 col-md-4  py-1  my-1">
                            <label id="label" for="" class=" required form-label">How do you rate the
                                training overall?</label>
                            <select required name="HowDoYouRateTheTrainingOverall"
                                class="form-select   form-select-solid" data-control="select2"
                                data-placeholder="Select a option">
                                <option></option>
                                <option value="Strongly
                                Agree">Strongly
                                    Agree</option>
                                <option value="Agree">Agree</option>
                                <option value="Neutral">Neutral</option>
                                <option value="Disagree">Disagree</option>
                                <option value="Strongly
                                Disagree">Strongly
                                    Disagree</option>


                            </select>

                        </div>




                        <div class="mb-3 col-md-4  py-1  my-1">
                            <label id="label" for="" class=" required form-label">The training was relevant
                                to my work?</label>
                            <select required name="TheTrainingWasRelevantToMyWork"
                                class="form-select   form-select-solid" data-control="select2"
                                data-placeholder="Select a option">
                                <option></option>
                                <option value="Strongly
                                Agree">Strongly
                                    Agree</option>
                                <option value="Agree">Agree</option>
                                <option value="Neutral">Neutral</option>
                                <option value="Disagree">Disagree</option>
                                <option value="Strongly
                                Disagree">Strongly
                                    Disagree</option>


                            </select>


                        </div>








                        <div class="mb-3 col-md-4  py-1  my-1">
                            <label id="label" for="" class=" required form-label">Did the instructor provide
                                feedback on the achievement of the learning outcomes to the learner? </label>
                            <select required name="InstructorFeedback" class="form-select   form-select-solid"
                                data-control="select2" data-placeholder="Select a option">
                                <option></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>


                            </select>


                        </div>



                        <div class="mb-3 col-md-6  py-1  my-1">
                            <label id="label" for="" class=" required form-label">How do you expect to use
                                the knowledge and skills acquired in the training at your workplace/institution?
                            </label>


                            <textarea class="editorme" name="UseofSkills">


                                <h2>    Type Your Response Here </h2>
                            </textarea>


                        </div>





                        <div class="mb-3 col-md-6  py-1  my-1">
                            <label id="label" for="" class=" required form-label">Other Comments
                            </label>


                            <textarea class="editorme" name="OtherComments">


                                <h2>    Type Your Response Here </h2>
                            </textarea>


                        </div>







                        <input type="hidden" name="UserID" value="{{ Auth::user()->UserID }}">

                        <input type="hidden" name="Country" value="{{ $Student->nationality }}">

                        <input type="hidden" name="CID" value="{{ Auth::user()->CID }}">


                        <input type="hidden" name="uuid"
                            value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">




                    </div>

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-dark">Save
                            Changes</button> --}}

            </form>
        </div>

    </div>
</div>
</div>
