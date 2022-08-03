{{-- @if (Auth::user()->role == 'admin') --}}
<div data-kt-menu-trigger="click" class="menu-item viewer_only menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-people-carry" aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Instructor Dashboard</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        // MenuItem($link = route('MgtCourses'), $label = 'Facilitator Console');
        MenuItem($link = route('InstructorViewCourses'), $label = 'Course Notes');
        MenuItem($link = route('SelectLinksCourse'), $label = 'Live Lecture Sessions');
        MenuItem($link = route('ViewCourseSchedule'), $label = 'Course Schedule');
        MenuItem($link = route('SelectCourseMarkingGuide'), $label = 'Marking Guides');
        
        // MenuItem($link = route('MgtCourses'), $label = 'Mark Student Attendance');
        MenuItem($link = route('FacilitatorCheckList'), $label = 'Facilitator Checklist');
        MenuItem($link = route('InstructorGuides'), $label = ' Facilitator Guides');
        MenuItem($link = route('SelectCourseAttend'), $label = 'Mark Student Attendance');
        // MenuItem($link = route('SelectPretestCourse'), $label = 'Mark Pre-Tests');
        // MenuItem($link = route('SelectCourseForPostTest'), $label = 'Mark Post-Tests');
        ?>


    </div>
</div>

{{-- @endif --}}
