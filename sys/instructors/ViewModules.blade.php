<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'View modules attached to the course ' . $CourseName . ' and explore their notes', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{-- {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Course Module', $Icon = 'fa-plus') }} --}}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th> Module</th>
                <th>Module Presentation</th>
                <th>Date Added</th>

                {{-- <th class="bg-dark text-light"> Update </th> --}}
                <th class="bg-danger fw-bolder text-light"> View Notes </th>



            </tr>
        </thead>
        <tbody>
            @isset($Modules)
                @foreach ($Modules as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $data->Module }}</td>
                        <td>
                            <a data-doc="  {{ $data->Module }} "
                                data-source="{{ asset('assets/data/' . $data->ModulePresentation) }}"
                                data-bs-toggle="modal" href="#PdfJS"
                                class="btn btn-sm  PdfViewer btn-info"> <i
                                    class="fas fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </td>

                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>



                        <td>

                            <a class="btn shadow-lg btn-danger btn-sm admin"
                                href="{{ route('ViewNotes', ['id' => $data->id]) }}">

                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>

                        </td>

                        {{-- <td>

                            {!! ConfirmBtn(
    $data = [
        'msg' => 'You want to delete this record',
        'route' => route('DeleteData', ['id' => $data->id, 'TableName' => 'modules']),
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
<!--end::Card body-->
{{-- @include('modules.NewModule')



@isset($Modules)
    @foreach ($Modules as $data)
        {{ UpdateModalHeader($Title = 'Update the selected  record', $ModalID = $data->id) }}
        <form novalidate action="{{ route('MassUpdate') }}" class=""
            method="POST">
            @csrf

            <div class="row">




                <input type="hidden" name="id" value="{{ $data->id }}">

                <input type="hidden" name="TableName" value="modules">

                {{ RunUpdateModalFinal($ModalID = $data->id, $Extra = '', $csrf = null, $Title = null, $RecordID = $data->id, $col = '12', $te = '12', $TableName = 'modules') }}
            </div>


            {{ UpdateModalFooter() }}

        </form>
    @endforeach
@endisset --}}
@include('pdf.PDFJS')
