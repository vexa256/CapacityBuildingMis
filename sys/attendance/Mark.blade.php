<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Select Module to Mark As Attended <span class="text-danger">

                        This is the {{ $Name }}'s attendance record and will contribute to the assement matrix.


                    </span>



                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="{{ route('MarkStudentAttendanceLogic') }}" class="row" method="POST"> @csrf
                    <div class="row">

                        <div class="col-12">
                            <label id="label" for="" class="px-5   my-5 required form-label">Select
                                Course Module Attended By {{ $Name }}</label>
                            <select required name="MID" class="form-select  py-5   my-5 form-select-solid"
                                data-control="select2" data-placeholder="Select a option">
                                <option></option>
                                @isset($Mods)

                                    @foreach ($Mods as $data)
                                        <option value="{{ $data->MID }}">
                                            {{ $data->Module }}
                                            {{-- ({{ $data->CourseName }}) --}}
                                        </option>
                                    @endforeach
                                @endisset

                            </select>
                        </div>



                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:i:s') }}">

                        <input type="hidden" name="TableName" value="student_attendances">

                        <input type="hidden" name="CID" value="{{ $CID }}">
                        <input type="hidden" name="UserID" value="{{ $UserID }}">


                        {{-- <input type="hidden" name="CID" value="{{ $CID }}"> --}}

                        <input type="hidden" name="uuid"
                            value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">







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
