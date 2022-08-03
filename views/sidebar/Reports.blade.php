{{-- @if (Auth::user()->role == 'admin') --}}
<div data-kt-menu-trigger="click" class="menu-item viewer_only menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-chart-line" aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Reports and Analytics</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        MenuItem($link = route('StudentDatabase'), $label = 'Students Database');
        MenuItem($link = route('CourseEnrollment'), $label = 'Course Enrollment');
        MenuItem($link = route('CountryEnrollment'), $label = 'Country Enrollment');
        MenuItem($link = route('CertifiedStudents'), $label = 'Certificates Issued');

        MenuItem($link = route('StudentEvaluationReport'), $label = 'Student Course Evaluation');
        // MenuItem($link = route('MgtCourses'), $label = 'Certification VS Enrollment');
        // // MenuItem($link = route('MgtCourses'), $label = 'Course Enrollment');
        // MenuItem($link = route('MgtCourses'), $label = 'Student Performance');
        // MenuItem($link = route('MgtCourses'), $label = 'Student Attendance');
        // MenuItem($link = route('MgtCourses'), $label = 'Certification VS Enrollment');
        // MenuItem($link = route('MgtCourses'), $label = 'Instructors By Course');
        // MenuItem($link = route('MgtCourses'), $label = 'Modular Tests By Course');
        // MenuItem($link = route('MgtCourses'), $label = 'Practical Tests By Course');
        // MenuItem($link = route('MgtCourses'), $label = 'Pre-Test Results');
        // MenuItem($link = route('MgtCourses'), $label = 'Facilitator Checklists');
        // MenuItem($link = route('MgtCourses'), $label = 'Overall Training Evaluation');
        // MenuItem($link = route('MgtCourses'), $label = 'Training Evaluation');
        ?>


    </div>
</div>

{{-- @endif --}}
