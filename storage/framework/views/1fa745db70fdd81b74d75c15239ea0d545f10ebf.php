<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8" />

<head>
    <base href="">
    <title>SRL Uganda | <?php if(isset($Title)): ?>
            <?php echo e($Title); ?> | The Uganda National Tuberculosis Reference
            Laboratory was started as the Uganda Bacteriological Investigation Unit
            in the late 1950’s under the then East African Community. The laboratory
            participated in anti TB clinical trials and drug toxicities under the
            then British Medical Research Council (MRC).

            After the collapse of the East African Community in 1970’s, the
            laboratory reverted to the line ministries. Its name changed to Central
            Tuberculosis laboratory (CTBL) in 1980’s and National Tuberculosis
            Reference Laboratory in the 1990’S.
            The Uganda National Tuberculosis Reference Laboratory established under
            the National Tuberculosis and Leprosy Programme (NLTP) of the Ministry
            of Health (MoH) received accreditation from the WHO in April 2013,
            making it the first SRL in East Africa, and the second in Sub-Saharan
            Africa to achieve this status.

            Organogram
        <?php endif; ?> </title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="<?php echo e(asset('logos/logo.png')); ?>" />

    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->role == 'viewer'): ?>
            <style>
                .viewer_only {
                    display: none !important;
                }
            </style>
        <?php endif; ?>



    <?php endif; ?>





    <style>
        select,
        input,
        textarea,
        .select2-container--bootstrap5,
        .select2-dropdown,
        .select2-search,
        .select2-search__field {

            color: black !important;

        }

        select,
        input,
        textarea,
        label {

            color: black !important;

        }


        option,
        label {

            color: black !important;

        }





        .CutText {

            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            max-width: 400px !important;
        }

        body::-webkit-scrollbar {
            width: 12px;
            /* width of the entire scrollbar */
        }

        body::-webkit-scrollbar-track {
            background: #181c32;
            /* color of the tracking area */
        }

        body::-webkit-scrollbar-thumb {
            background-color: #f1416c;
            /* color of the scroll thumb */
            border-radius: 20px;
            /* roundness of the scroll thumb */
            border: 3px solid;
            /* creates padding around scroll thumb */
        }

        /* ubuntu-regular - latin-ext_latin_greek-ext_greek_cyrillic-ext_cyrillic */
        @font-face {
            font-family: 'Ubuntu';
            font-style: normal;
            font-weight: 400;
            src: local(''),
                url("<?php echo e(asset('assets/fonts/ubuntu-v20-latin.woff2')); ?>") format('woff2'),
                /* Chrome 26+, Opera 23+, Firefox 39+ */
                url("<?php echo e(asset('assets/fonts/ubuntu-v20-regular.woff')); ?>") format('woff');
            /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
        }

        body,
        aside,
        header,
        section,
        html,
        span,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        div,
        p,
        strong,
        a,
        li,
        ul,
        ol {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 30px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #51c4ca;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #51c4ca;
        }


        .select2-container--bootstrap5 .select2-selection--single .select2-selection__rendered {
            color: black !important;
        }

        select {
            color: black !important
        }
    </style>
    <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    <style>
        .aside-menu .menu-item .menu-link.active {
            background-color: #f1416c !important;
        }

        .btn-group-sm>.btn,
        .btn-sm {
            padding: .25rem .4rem;
            font-size: .875rem;
            line-height: .5;
            border-radius: .2rem;
        }

        .table-pad {
            padding-top: 3px !important;
        }

        table>tbody>tr>td {
            font-weight: 900 !important;
        }

        #boomRoom {
            display: none;
        }

        tr,
        td,
        th,
        tbody,
        thead {
            font-size: 11px !important;
            padding: 6px !important;
        }

        .redMe {
            color: red !important;
        }

        .pulse_note:hover {
            color: black !important;
        }

        .form-select-solid,
        .form-select {
            background-color: white !important;
            color: black !important;
        }

        .spinner {
            position: absolute;
            left: 46%;
            top: 40%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 8px solid lightgray;
            border-top: 8px solid tomato;
            border-bottom: 8px solid tomato;
            animation: anime 1.4s ease infinite
        }

        @keyframes  anime {
            from {
                transform: rotate(0deg)
            }

            to {
                transform: rotate(360deg)
            }
        }

        .spinner::before {
            position: absolute;
            content: "";
            width: 200%;
            height: 200%;
            left: 50%;
            top: 50%;
            border-radius: inherit;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            border: 10px solid lightgray;
            border-left: 10px solid red;
            border-right: 10px solid red
        }

        .spinner::after {
            position: absolute;
            content: "";
            width: 300%;
            height: 300%;
            left: 50%;
            top: 50%;
            border-radius: inherit;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            border: 12px solid lightgray;
            border-top: 12px solid red;
            border-bottom: 12px solid red
        }
    </style>

</head>
<!--end::Head-->
<!--begin::Body-->
<?php /**PATH /var/www/html/srl.local/views/header/header.blade.php ENDPATH**/ ?>