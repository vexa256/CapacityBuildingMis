@if (Auth::user()->role == 'admin')
    <div data-kt-menu-trigger="click"
        class="menu-item viewer_only menu-accordion">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas text-light fw-bolder fa-2x me-1 fa-chart-line"
                    aria-hidden="true"></i>
            </span>
            <span class="menu-title ms-2 fs-6">Analytics and Reports</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <?php

            MenuItem($link = '#', $label = 'Student Analytics', $class = 'Number');


            MenuItem($link = '#', $label = 'Certification Analytics', $class = 'Number');

            MenuItem($link = '#', $label = 'Nationality Analytics', $class = 'Number');


            MenuItem($link = '#', $label = 'Performance By Course', $class = 'Number');


            MenuItem($link = '#', $label = 'Attendance By Course', $class = 'Number');


            MenuItem($link = '#', $label = 'Instructor Analytics', $class = 'Number');


            MenuItem($link = '#', $label = 'Course Analytics', $class = 'Number');





            //MenuItem($link = route('RestockDrugInventory'), $label = 'Insurance Claims');

            ?>


        </div>
    </div>

    <div data-kt-menu-trigger="click"
    class="menu-item viewer_only menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas text-light fw-bolder fa-2x me-1 fa-cog"
                aria-hidden="true"></i>
        </span>
        <span class="menu-title ms-2 fs-6">Advanced Settings</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php

        MenuItem($link = '#', $label = 'SMTP Settings', $class = 'Setter');


        MenuItem($link = '#', $label = 'Student Settings', $class = 'Setter');

        MenuItem($link = '#', $label = 'Instructor Settings ', $class = 'Setter');

        MenuItem($link = '#', $label = 'Admin Settings ', $class = 'Setter');

        MenuItem($link = '#', $label = 'SuperAdmin Settings ', $class = 'Setter');


        MenuItem($link = '#', $label = 'Examiner Settings ', $class = 'Setter');


        MenuItem($link = '#', $label = 'Exam Timing ', $class = 'Setter');



        //MenuItem($link = route('RestockDrugInventory'), $label = 'Insurance Claims');

        ?>


    </div>
</div>


@endif
