{{-- @if (Auth::user()->role == 'admin') --}}
<div data-kt-menu-trigger="click" class="menu-item viewer_only menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-cogs" aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Course Operations</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        MenuItem($link = route('MgtCourses'), $label = 'Courses');
        MenuItem($link = route('SelectCourseModule'), $label = 'Modules');
        MenuItem($link = route('SelectPretestCourse'), $label = 'Pre-Tests');
        MenuItem($link = route('SelectCourseForPostTest'), $label = 'Post-Tests');
        MenuItem($link = route('ModularSelectCourse'), $label = 'Module Exercises');
        MenuItem($link = route('SelectCoursePractical'), $label = 'Module Practicals');
        
        MenuItem($link = route('SetTestTimer'), $label = 'Test Timer Settings');
        
        MenuItem($link = route('ApproveStudentApps'), $label = 'Approve Applications');
        ?>


    </div>
</div>

{{-- @endif --}}
