@isset($Courses)
    @foreach ($Courses as $data)
        <div class="modal fade" id="Desc{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">

                            View more information about the course
                            {{ $data->CourseName }}
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control editorme">

                                    {{ $data->CourseDescription }}
                                </textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endisset
