<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Explore Available Courses', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Course', $Icon = 'fa-plus') }} --}}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Course Code</th>
                <th>CEUs</th>
                {{-- <th>Thumbnail</th> --}}
                <th>Date Added</th>
                <th>Description</th>
                <th>View Notes and Modules</th>
                {{-- <th class="bg-dark text-light"> Update </th>
                <th class="bg-danger fw-bolder text-light"> Delete </th> --}}



            </tr>
        </thead>
        <tbody>
            @isset($Courses)
                @foreach ($Courses as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->CourseCode }}</td>
                        <td>{{ $data->CEU }}</td>


                        {{-- <td>
                            <a class="btn btn-danger btn-sm shadow-lg"
                                data-fslightbox="gallery"
                                href="{{ asset('assets/data/' . $data->Thumbnail) }}">
                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>
                        </td> --}}
                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>


                        <td>
                            <a data-bs-toggle="modal" class="btn btn-dark shadow-lg btn-sm"
                                href="#Desc{{ $data->id }}">

                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>

                        </td>



                        <td>
                            <a class="btn btn-danger shadow-lg btn-sm"
                                href="{{ route('ViewModules', ['id' => $data->id]) }}">

                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>

                        </td>


                        {{-- <td>

                            <a data-bs-toggle="modal"
                                class="btn shadow-lg btn-danger btn-sm admin"
                                href="#Update{{ $data->id }}">

                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>

                        </td>


                        <td>

                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteData', ['id' => $data->id, 'TableName' => 'courses']),
        'label' => '<i class="fas fa-trash"></i>',
        'class' => 'btn btn-danger btn-sm deleteConfirm admin',
    ],
) !!}

                        </td> --}}





                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
{{-- <!--end::Card body-->
@include('courses.NewCourse') --}}


@isset($Courses)
    @include('viewer.viewer', [
        'PassedData' => $Courses,
        'Title' => 'View the Description of the selected course',
        'DescriptionTableColumn' => 'CourseDescription',
    ])
@endisset


{{-- @isset($Courses)
    @foreach ($Courses as $data)
        {{ UpdateModalHeader($Title = 'Update the selected  record', $ModalID = $data->id) }}
        <form novalidate action="{{ route('MassUpdate') }}" class=""
            method="POST">
            @csrf

            <div class="row">




                <input type="hidden" name="id" value="{{ $data->id }}">

                <input type="hidden" name="TableName" value="courses">

                {{ RunUpdateModalFinal($ModalID = $data->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $data->id, $col = '12', $te = '12', $TableName = 'courses') }}
            </div>


            {{ UpdateModalFooter() }}

        </form>
    @endforeach
@endisset --}}
