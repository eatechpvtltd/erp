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
            'name'      =>  __('module.library'),
            'child'     =>    [
                                'books'                 =>  [
                                                                'name'  => 'Books',
                                                                'child' =>  [
                                                                    'detail'       =>  'Book Detail',
                                                                    'new'          =>  'Add New',
                                                                    'import'       =>  'Bulk Import',
                                                                    'category'     =>  'Category',
                                                                ]
                                                            ],
                                'members'               =>  [
                                                                'name'  => 'Members',
                                                                'child' =>  [
                                                                    'membership'        => 'Membership',
                                                                    'student'    => 'Student Member',
                                                                    'staff'      => 'Staff Member',
                                                                ]
                                                            ],
                                'book_request'          =>  [
                                                                'name'  => 'Book Request',
                                                                'child' =>  [
                                                                    'student'  => 'Student Request',
                                                                    'staff'     => 'Staff Request',
                                                                ]
                                                            ],
                                'issue_history'         =>  [
                                                                'name'  => 'Issue History',
                                                                'child' =>  [
                                                                    ''  => '',
                                                                ]
                                                            ],
                                'return_period_over'    =>  [
                                                                'name'  => 'Return Period Over',
                                                                'child' =>  [
                                                                    ''  => '',
                                                                ]
                                                            ],
                                'circulation_setting'   =>  [
                                                                'name'  => 'Circulation Setting',
                                                                'child' =>  [
                                                                    ''  => '',
                                                                ]
                                                            ],
                            ],
    ];