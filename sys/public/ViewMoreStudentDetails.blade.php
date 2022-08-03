@isset($Apps)
    @foreach ($Apps as $data)
        <div class="modal fade" id="ViewMore{{ $data->ID }}" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View more details about selected
                            application for the student

                            <span class="text-danger fw-bolder">
                                {{ $data->name }}
                            </span>


                        </h5>
                        <button type="button" class="closse btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                            <thead>
                                <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">

                                    <th>Course</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    <th>Title</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Application Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($Apps)
                                    @foreach ($Apps as $data)
                                        <tr>


                                            <td>{{ $data->CourseName }}</td>

                                            <td>{{ $data->nationality }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td>{{ $data->JobTitle }}</td>
                                            <td>{{ $data->Address }}</td>
                                            <td>{{ $data->email }}</td>

                                            <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>

                                        </tr>
                                    @endforeach
                                @endisset



                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endisset
