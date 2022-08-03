{{-- @if (Auth::user()->role == 'admin') --}}
<div data-kt-menu-trigger="click" class="menu-item viewer_only menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-cog" aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Course Properties</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <?php
        MenuItem($link = route('InstrSelectCourse'), $label = 'Manage Instructors');
        MenuItem($link = route('CourseLinksCourse'), $label = 'Course Live Sessions');
        MenuItem($link = route('NotesSelectCourse'), $label = 'Course Notes');
        // MenuItem($link = route('SelectCourseModule'), $label = 'Manage Facilitator Checklist');
        MenuItem($link = route('InstructorGuides'), $label = ' Facilitator Guides');
        MenuItem($link = route('MgtCourseSchedule'), $label = 'Course Schedule');
        
        MenuItem($link = route('MgtMarkingGuide'), $label = 'Marking Guides');
        
        // MenuItem($link = route('SelectPretestCourse'), $label = 'Marking Guide');
        
        ?>


    </div>
</div>

{{-- @endif --}}
