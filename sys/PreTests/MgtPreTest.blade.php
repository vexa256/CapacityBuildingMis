<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Let\'s manage applicable course Pre-Test questions.| Only one test record is supported', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New  Question', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Pre-Test Question</th>
                <th>Date Created</th>
                <th>Test Question</th>
                <th class="bg-dark text-light"> Update </th>
                <th class="bg-danger fw-bolder text-light"> Delete </th>



            </tr>
        </thead>
        <tbody>
            @isset($Pretests)
                @foreach ($Pretests as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $data->BriefDescription }}</td>

                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>


                        <td>
                            <a data-bs-toggle="modal"
                                class="btn btn-dark shadow-lg btn-sm"
                                href="#Desc{{ $data->id }}">

                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>

                        </td>


                        <td>

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
        'route' => route('DeleteData', ['id' => $data->id, 'TableName' => 'pre_tests']),
        'label' => '<i class="fas fa-trash"></i>',
        'class' => 'btn btn-danger btn-sm deleteConfirm admin',
    ],
) !!}

                        </td>





                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->
@include('PreTests.NewPretest')


@isset($Pretests)
    @include('viewer.viewer', [
        'PassedData' => $Pretests,
        'Title' => 'View the selected Pre Test Question',
        'DescriptionTableColumn' => 'TestQuestion',
    ])
@endisset


@isset($Pretests)
    @foreach ($Pretests as $data)
        {{ UpdateModalHeader($Title = 'Update the selected  record', $ModalID = $data->id) }}
        <form novalidate action="{{ route('MassUpdate') }}" class=""
            method="POST">
            @csrf

            <div class="row">




                <input type="hidden" name="id" value="{{ $data->id }}">

                <input type="hidden" name="TableName" value="pre_tests">

                {{ RunUpdateModalFinal($ModalID = $data->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $data->id, $col = '12', $te = '12', $TableName = 'pre_tests') }}
            </div>


            {{ UpdateModalFooter() }}

        </form>
    @endforeach
@endisset
