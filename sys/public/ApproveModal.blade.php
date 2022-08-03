@isset($Apps)
    @foreach ($Apps as $data)
        <div class="modal fade" aria-hidden="true" id="Approve{{ $data->id }}">
            <div class="modal-dialog modal-lg modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Approve Student Course Application</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form method="post" action="{{ route('ApproveAppLogic') }}">

                            <div class="row">
                                @csrf


                                <div class="mt-3  mb-3 col-md-4">
                                    <label id="label" for="" class="required form-label">Approving Training
                                        Coordinator</label>
                                    <select required name="Coordinator" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Select a option">
                                        <option></option>
                                        @isset($Coordinators)
                                            @foreach ($Coordinators as $c)
                                                <option value="{{ $c->id }}">
                                                    {{ $c->Name }}</option>
                                            @endforeach
                                        @endisset

                                    </select>

                                </div>



                                <div class="mt-3  mb-3 col-md-4 ">
                                    <label id="label" for="" class=" required form-label">

                                        Start Date

                                    </label>

                                    <input type="text" required name="From" class="form-control DateArea"
                                        id="">

                                </div>


                                <div class="mt-3  mb-3 col-md-4 ">
                                    <label id="label" for="" class=" required form-label">

                                        End Date
                                    </label>

                                    <input type="text" required name="To" class="form-control DateArea"
                                        id="">

                                </div>









                            </div>


                            <input type="hidden" name="UserID" value="{{ $data->UserID }}">

                            {{-- <input type="hidden" name="USER_ID" value="{{ Auth::user()->id }}"> --}}



                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-dark">Save
                                    Changes</button>

                        </form>
                    </div>


                </div>

            </div>
        </div>
        </div>
    @endforeach
@endisset
