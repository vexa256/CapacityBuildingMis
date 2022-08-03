<div class="modal fade" id="ResultsNow">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> SRL Uganda |

                    <span class="text-danger">

                        Post Results For the Course

                        {{ $CourseName }}. Use the search engine to filter students

                    </span>


                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                    <thead>
                        <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                            <th>Student</th>
                            <th>Parent Organization</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Post-Test Title</th>
                            <th>Description</th>
                            <th>Test Question</th>
                            <th>Student Answer</th>
                            <th class="bg-dark text-light">Non Percent Score </th>
                            <th class="bg-dark text-light">Date Attempted </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($Marked)
                            @foreach ($Marked as $data)
                                <tr>

                                    <td>{{ $data->Name }}</td>
                                    <td>{{ $data->ParentOrganization }}</td>
                                    <td>{{ $data->Email }}</td>
                                    <td>{{ $data->WorkTelephoneNumber }}</td>
                                    <td>{{ $data->CourseName }}</td>
                                    <td>{{ $data->PostTestTitle }}</td>
                                    <td>{{ $data->BriefDescription }}</td>
                                    <td> <a data-bs-dismiss="modal" data-bs-toggle="modal"
                                            class="btn btn-info shadow-lg btn-sm" href="#Qtn{{ $data->SelectedExamID }}">



                                            View Qtn
                                        </a>


                                    </td>
                                    <td> <a data-bs-dismiss="modal" data-bs-toggle="modal"
                                            class="btn btn-danger shadow-lg btn-sm"
                                            href="#AnsNow{{ $data->SelectedExamID }}">


                                            View Answer</a></td>

                                    <td>
                                        {{ $data->Score }}

                                    </td>



                                    <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>







                                </tr>
                            @endforeach
                        @endisset



                    </tbody>
                </table>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>

                {{-- <button type="submit" class="btn btn-dark">Save
                            Changes</button>

                        </form> --}}
            </div>

        </div>
    </div>
</div>


{{-- @include('pdf.PDFJS') --}}
