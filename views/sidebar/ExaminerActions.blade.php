{{-- @if (Auth::user()->role == 'admin') --}}
<div data-kt-menu-trigger="click" class="menu-item viewer_only menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-check" aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Examiner Actions</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        MenuItem($link = route('SelectModularTestActivate'), $label = ' Modular Test Activation');
        MenuItem($link = route('SelectPracticalTestActivate'), $label = ' Practical Test Activation');
        MenuItem($link = route('EnablePostTestSelectCourse'), $label = ' Post Test Activation');
        MenuItem($link = route('SelectCourseToMarkPreTest'), $label = 'Mark Pre-Tests');
        MenuItem($link = route('SelectCourseToMark'), $label = 'Mark Post-Tests');
        MenuItem($link = route('SelectCourseToMarkModular'), $label = 'Mark Modular-Tests');
        
        MenuItem($link = route('SelectCourseToMarkPractical'), $label = 'Mark Practical-Tests');
        
        ?>


    </div>
</div>

{{-- @endif --}}
