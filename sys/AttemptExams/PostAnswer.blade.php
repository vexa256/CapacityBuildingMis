<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> SRL Uganda Student Assessment Answer Area


                    <span class="text-danger fw-bolder">

                        | Attempt Test Within Assigned Time | Submission Deadline is
                        {{ $Deadline }} | Scroll down to write your answer
                    </span>


                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="{{ route('SubmitPostAnswer') }}" class="row" method="POST">
                    @csrf
                    <div class="mt-5  mb-5 col-md-12 ">
                        <label id="label" for="" class=" required form-label">Post Test Assessment
                            Question(s) </label>
                        <textarea class="editorme">

                            {!! $data->TestQuestion !!}

                        </textarea>

                    </div>


                    <div class="mt-5  mb-5 col-md-12 ">
                        <label id="label" for="" class="text-danger fw-bolder required form-label">
                            {{ Auth::user()->name }}, Record your answer(s) here

                        </label>
                        <textarea class="editorme" name="StudentAnswer">

                         <h3>Write your answer(s) here</h3>

                        </textarea>

                    </div>

                    <input type="hidden" name="PostTestUuid" value="{{ $data->uuid }}">

                    <input type="hidden" name="CID" value="{{ $data->CID }}">
                    <input type="hidden" name="created_at" value="{{ date('Y-m-d') }}">


                    <input type="hidden" name="uuid" value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">


                    <input type="hidden" name="Marked" value="false">

                    {{-- <input type="hidden" name="MID" value="{{ $data->MID }}"> --}}


                    <input type="hidden" name="UserID" value="{{ Auth::user()->UserID }}">

                    <textarea name="PostQuestion" class="d-none">

                        {!! $data->TestQuestion !!}
                    </textarea>





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
