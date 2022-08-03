@isset($Apps)
    @foreach ($Apps as $data)
        <div class="modal fade" id="ViewQtn">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> Hello,
                            {{ Auth::user()->name }},
                            This is your pre-test Assessment for the course
                            <span class="text-danger">
                                {{ $data->CourseName }}
                            </span>
                        </h5>
                        <a data-bs-toggle="modal" data-bs-dismiss="modal" href="#AnswerQtn"
                            class="btn HideSecondaryShowBtn btn-warning">
                            Attempt Qtn (s)
                        </a>
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                        <!--end::Close-->
                    </div>

                    <div class="modal-body ">

                        <textarea class="editorme">

                            {!! $data->TestQuestion !!}

                    </textarea>
                    </div>



                </div>
            </div>
        </div>
    @endforeach
@endisset
