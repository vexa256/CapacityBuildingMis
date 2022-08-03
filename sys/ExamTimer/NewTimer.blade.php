<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Create a new time for tests <span class="text-danger">

                    </span>



                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="{{ route('MassInsert') }}" class="row" method="POST">
                    @csrf
                    <div class="row">



                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:i:s') }}">

                        <div class="mb-3 col-md-6  ">
                            <label id="label" for="" class="required form-label">Select
                                Assement Type</label>
                            <select required name="AssessmentType" class="form-select   form-select-solid"
                                data-control="select2" data-placeholder="Select a option">
                                <option></option>
                                <option value="ModularTests">Modular Tests</option>
                                <option value="PostTests">Post Tests</option>
                                <option value="PracticalTests">Practical Tests</option>


                            </select>

                        </div>

                        <input type="hidden" name="TableName" value="exam_timer_logics">

                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '6') }}
                            @elseif ('smallint' == $data['type'] || 'bigint' === $data['type'] || 'integer' == $data['type'] || 'bigint' == $data['type'])
                                {{ CreateInputInteger($data, $placeholder = null, $col = '6') }}
                            @elseif ($data['type'] == 'date' || $data['type'] == 'datetime')
                                {{ CreateInputDate($data, $placeholder = null, $col = '4') }}
                            @endif
                        @endforeach

                    </div>

                    <div class="row">
                        @foreach ($Form as $data)
                            @if ($data['type'] == 'text')
                                {{ CreateInputEditor($data, $placeholder = null, $col = '12') }}
                            @endif
                        @endforeach

                    </div>

                    {{-- <input type="hidden" name="MID"
                        value="{{ md5(\Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))) }}">

                    <input type="hidden" name="CID" value="{{ $CID }}"> --}}


                    <input type="hidden" name="uuid"
                        value="{{ md5(\Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))) }}">




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
