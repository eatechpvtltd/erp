<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
            'name'      =>  __('module.attendance'),
            'child'     =>    [
                                'student'    =>      [
                                                                'name'  => 'Student Attendance',
                                                                'child' =>  [
                                                                    'regular'  => 'Regular Attendance',
                                                                    'subject'  => 'Subject Wise Attendance',
                                                                ]
                                ],
                                'staff'      =>      [
                                                                'name'  => 'Staff Attendance',
                                                                'child' =>  [
                                                                    ''  => '',
                                                                ]
                                ],
                                'attendance_report'     =>      [
                                                                'name'  => 'Attendance Report',
                                                                'child' =>  [
                                                                    'student'  => 'Student Report',
                                                                    'staff'  => 'Staff Report',
                                                                ]
                                ],
                                'monthly_calendar'      =>      [
                                                                'name'  => 'Monthly Calendar',
                                                                'child' =>  [
                                                                    ''  => '',
                                                                ]
                                ],
                            ],
    ];