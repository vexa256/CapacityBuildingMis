@isset($PostTests)
    @foreach ($PostTests as $res)
        <div class="modal fade" id="AnsNow{{ $res->SelectedExamID }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> SRL Uganda |

                            <span class="text-danger">

                                View Post Test Answer Submitted by the Student

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

                        <form action="#" class="row" method="POST">
                            @csrf
                            <div class="row">

                                <input type="hidden" name="id" value="{{ $res->SelectedExamID }}">

                                <div class="col-12">
                                    <textarea class="editorme">

                                        {!! $res->StudentAnswer !!}
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

@isset($Marked)
    @foreach ($Marked as $data2)
        <div class="modal fade" id="AnsNow{{ $data2->SelectedExamID }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> SRL Uganda |

                            <span class="text-danger">

                                View Post Test Answer Submitted by the Student

                                {{ $data2->Name }} . | The Course is {{ $CourseName }}

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

                        <form action="#" class="row" method="POST">
                            @csrf
                            <div class="row">

                                <input type="hidden" name="id" value="{{ $data2->SelectedExamID }}">

                                <div class="col-12">
                                    <textarea class="editorme">

                                        {!! $data2->StudentAnswer !!}
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
