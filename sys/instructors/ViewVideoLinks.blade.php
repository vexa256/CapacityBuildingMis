<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Select the live course lesson session to start', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Video Link', $Icon = 'fa-plus') }} --}}
    <table class="table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course</th>
                <th>Link Title</th>
                <th>Link Description</th>
                <th>Link Url</th>
                <th>Valid From</th>
                <th>Valid To</th>
                {{-- <th>Validity Status</th> --}}
                <th>Date Added</th>
                {{-- <th class="bg-dark text-light"> Update </th>
                <th class="bg-danger fw-bolder text-light"> Delete </th> --}}


            </tr>
        </thead>
        <tbody>
            @isset($Links)
                @foreach ($Links as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->LinkTitle }}</td>
                        <td>{{ $data->LinkDescription }}</td>
                        <td>
                            <a target="_blank" class="btn btn-danger shadow-lg"
                                href="{{ $data->LinkUrl }}">

                                Attend Session
                            </a>

                        </td>
                        <td>{!! date('F j, Y', strtotime($data->ValidFrom)) !!}</td>
                        <td>{!! date('F j, Y', strtotime($data->ValidTo)) !!}</td>
                        {{-- <td>{{ $data->status }}</td> --}}
                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>





                        {{-- <td>

                            <a data-bs-toggle="modal"
                                class="btn shadow-lg btn-danger btn-sm admin"
                                href="#Update{{ $data->id }}">

                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>

                        </td> --}}

                        {{-- <td>

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
@include('VideoLinks.NewLink')

{{-- @isset($Links)
    @include('viewer.viewer', [
        'PassedData' => $Links,
        'Title' => 'View the Description of the selected course',
        'DescriptionTableColumn' => 'CourseDescription',
    ])
@endisset --}}


{{-- @isset($Links)
    @foreach ($Links as $data)
        {{ UpdateModalHeader($Title = 'Update the selected  record', $ModalID = $data->id) }}
        <form novalidate action="{{ route('MassUpdate') }}" class=""
            method="POST">
            @csrf

            <div class="row">




                <input type="hidden" name="id" value="{{ $data->id }}">

                <input type="hidden" name="TableName" value="course_links">

                {{ RunUpdateModalFinal($ModalID = $data->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $data->id, $col = '4', $te = '12', $TableName = 'course_links') }}
            </div>


            {{ UpdateModalFooter() }}

        </form>
    @endforeach
@endisset --}}
