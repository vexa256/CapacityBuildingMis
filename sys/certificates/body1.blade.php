<div id="pf2" class="pf w0 h0" data-page-no="2">
    <div class="pc pc2 w0 h0">
        <div class="c x0 y1 w1 h1" style="padding-top: 100px">

            <h3 style="margin-left:100px">
                <strong style="color: rgb(164,0,132);">Training Modules</strong>
            </h3>



            <ul style="margin-left:100px">
                @isset($Modules)

                @foreach ($Modules as $data)


                <li>
                    <span>{{ $data->Module }}</span>
                </li>


                @endforeach

                @endisset
            </ul>
