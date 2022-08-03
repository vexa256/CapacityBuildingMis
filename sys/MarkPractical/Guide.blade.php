<div class="modal fade" id="GuideNow">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> SRL Uganda |

                    <span class="text-danger">

                        Marking Guidelines for the course

                        {{ $CourseName }}

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
                            <th>Course Name</th>
                            <th>Marking Guide Title</th>
                            <th> View Guide </th>
                            <th>Date Created</th>

                            {{-- <th class="bg-danger fw-bolder text-light"> Delete </th> --}}



                        </tr>
                    </thead>
                    <tbody>
                        @isset($Guides)
                            @foreach ($Guides as $data)
                                <tr>

                                    <td>{{ $data->CourseName }}</td>
                                    <td>{{ $data->MarkingGuideTitle }}</td>


                                    <td>
                                        <a data-doc="  {{ $data->MarkingGuideTitle }} "
                                            data-source="{{ asset('assets/data/' . $data->url) }}" data-bs-toggle="modal"
                                            href="#PdfJS" class="btn btn-sm  PdfViewer btn-info"> <i
                                                class="fas fa-file-pdf" aria-hidden="true"></i>
                                        </a>
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


@include('pdf.PDFJS')
