<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Hello, {{ Auth::user()->name }},
                    Use this form to submit your facilitator checklist
                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="{{ route('MassInsert') }}" class="row"
                    method="POST" enctype="multipart/form-data"> @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6  ">
                            <label id="label" for="" class=" required form-label">Select
                                Course</label>
                            <select required name="CID"
                                class="form-select   form-select-solid"
                                data-control="select2" data-placeholder="Select a option">
                                <option></option>
                                @isset($Courses)

                                    @foreach ($Courses as $data)
                                        <option value="{{ $data->CID }}">
                                            {{ $data->CourseName }}</option>
                                    @endforeach
                                @endisset

                            </select>

                        </div>

                        <div class="mb-3 col-md-6  ">
                            <label id="label" for="" class=" required form-label">Select
                                Module</label>
                            <select required name="MID"
                                class="form-select   form-select-solid"
                                data-control="select2" data-placeholder="Select a option">
                                <option></option>
                                @isset($Modules)

                                    @foreach ($Modules as $data)
                                        <option value="{{ $data->MID }}">
                                            {{ $data->Module }} {{ $data->CourseName }}
                                        </option>
                                    @endforeach
                                @endisset

                            </select>

                        </div>

                        <div class="mt-3  mb-3 col-md-12  ">
                            <label id="label" for=""
                                class=" required form-label">Checklist</label>

                            @include('checklist.template')

                        </div>




                        <input type="hidden" name="created_at"
                            value="{{ date('Y-m-d h:i:s') }}">

                        <input type="hidden" name="TableName"
                            value="facili_tator_check_lists">

                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '12') }}
                            @elseif ('smallint' == $data['type'] || 'bigint' === $data['type'] || 'integer' == $data['type'] || 'bigint' == $data['type'])
                                {{ CreateInputInteger($data, $placeholder = null, $col = '4') }}
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




                    <input type="hidden" name="uuid"
                        value="{{ md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">




            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-dark">Save
                    Changes</button>

                </form>
            </div>

        </div>
    </div>
</div>
