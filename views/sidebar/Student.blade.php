<div data-kt-menu-trigger="click" class="menu-item menu-accordion viewer_only">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-users" aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Student Dashboard</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        @if (Auth::user()->role == 'student')
            <?php

            MenuItem($link = '/', $label = 'Home');
            MenuItem($link = route('StudentModules'), $label = 'All Course Modules');

            MenuItem($link = route('SelectLinksCourse'), $label = 'Live Lecture Sessions');

            MenuItem($link = route('NotesSelectCourse'), $label = 'Course Notes');

            MenuItem($link = route('StartModularExam'), $label = 'Modular Questions');

            MenuItem($link = route('StartPracticalExam'), $label = 'Practical Questions');

            MenuItem($link = route('StudentAttendance'), $label = 'Attendance Sheet');

            MenuItem($link = route('RunScoreTotal'), $label = 'Score Board');

            MenuItem($link = route('Certify'), $label = 'Print Certificate');

            MenuItem($link = route('StudentCourseEvaluation'), $label = 'Student Course Evaluation');

            // MenuItem($link = route('StartPostExam'), $label = 'Print Certificate');

            ?>
        @else
            <?php

            MenuItem($link = route('ApplicationStatus'), $label = 'Application Status');

            ?>
        @endif


    </div>
</div>
