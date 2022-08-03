@include('public.letterHeader')

<body style="tab-interval:36pt;">
    <!--StartFragment-->
    <div class="Section0" style="layout-grid:18.0000pt;">
        <p class=MsoNormal align=center style="text-align:center;"><img width="198" height="56"
                src="{{ asset('assets/CT001 F26 Admission letter_1.00.png') }}" align="left" hspace="12"><img
                width="139" height="66" src="{{ asset('assets/CT001 F26 Admission letter_1.01.png') }}"
                align="left" hspace="12">

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>




            <b style="mso-bidi-font-weight:normal"><u><span
                        style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    mso-ansi-font-weight:bold;text-decoration:underline;text-underline:single;
    font-size:18.0000pt;">Course
                        Admission Letter</span></u></b><b><u><span
                        style="mso-spacerun:'yes';font-family:'Times New Roman';mso-fareast-font-family:Calibri;
    font-weight:bold;text-decoration:underline;text-underline:single;
    font-size:18.0000pt;">
                        <o:p></o:p>
                    </span></u></b>
        </p>
        <p class=MsoNormal><b><u><span
                        style="mso-spacerun:'yes';font-family:'Times New Roman';mso-fareast-font-family:Calibri;
    font-weight:bold;text-decoration:underline;text-underline:single;
    font-size:11.0000pt;">
                        <o:p>&nbsp;</o:p>
                    </span></u></b></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p>&nbsp;</o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">Dear
                {{ Auth::user()->name }}</span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <p class=MsoNormal align=center style="text-align:center;"><b><u><span
                        style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-weight:bold;text-decoration:underline;text-underline:single;
    font-size:11.0000pt;">
                        <o:p>&nbsp;</o:p>
                    </span></u></b></p>


        <p class=MsoNormal align=center style="text-align:center;"><b><u><span
                        style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-weight:bold;text-decoration:underline;text-underline:single;
    font-size:11.0000pt;">Re:
                        Course Admission letter to {{ $data['Course'] }}</span></u></b><b><u><span
                        style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-weight:bold;text-decoration:underline;text-underline:single;
    font-size:11.0000pt;">
                        <o:p></o:p>
                    </span></u></b></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">This
                is to communicate that you have successfully met the requirements and admitted to participate in the
                above mentioned course at the Uganda NTRL/SRL Continuous Education and Training program from
                {{ date('F j, Y', strtotime($data['From'])) }} to
                {{ date('F j, Y', strtotime($data['To'])) }}.</span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p>&nbsp;</o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">Thank
                you </span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p>&nbsp;</o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">Yours
                sincerely</span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p>&nbsp;</o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">{{ $data['Cord'] }}</span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <br>

        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <p class=MsoNormal align=center style="text-align:center;"><img width="198" height="56"
                        align="left" hspace="12" src="{{ asset($data['Signature']) }}" hspace="12">
                </p>










                {{-- {{  }} --}}
            </span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <br>
        <br>
        <br>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">Training
                Coordinator</span><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p></o:p>
            </span></p>
        <p class=MsoNormal><span
                style="mso-spacerun:'yes';font-family:Calibri;mso-bidi-font-family:'Times New Roman';
    font-size:11.0000pt;">
                <o:p>&nbsp;</o:p>
            </span></p>
    </div>
    <!--EndFragment-->
</body>

</html>
