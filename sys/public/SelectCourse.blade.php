<div class="mt-3  mb-3 col-md-4  ">
    <label id="label" for="" class=" required form-label">Course your
        applying for</label>
    <select required name="CID" class="form-select  " data-control="select2" data-placeholder="Select an option">
        <option> </option>
        @isset($Courses)
            @foreach ($Courses as $data)
                <option value="{{ $data->CID }}">
                    {{ $data->CourseName }}</option>
            @endforeach
        @endisset

    </select>

</div>
