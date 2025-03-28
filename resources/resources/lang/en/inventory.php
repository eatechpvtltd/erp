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
                'name'      =>  __('module.inventory'),
                'child'     =>    [
                                        'class_assets'  =>
                                                            [
                                                                'name'      =>  'Class Assets',
                                                                'child'       =>
                                                                                [
                                                                                    'assets'  =>  'Assets',
                                                                                    'faculty_sem_assets'  =>  'Class Assets',
                                                                                ]
                                                                ],
                                        'assets'        =>
                                                            [
                                                                'name'      =>  'Product/Assets',
                                                                'child'       =>
                                                                                [
                                                                                    'add'  =>  'Add',
                                                                                    'detail'  =>  'Detail',
                                                                                    'category'  =>  'Category',

                                                                                ]
                                                                ],
                                        'customer'      =>
                                                            [
                                                                'name'          =>  'Customer',
                                                                'child'         =>
                                                                                    [
                                                                                        'detail'        =>  'Detail',
                                                                                        'register'      =>  'Registration',
                                                                                        'documents'     =>  'Documents',
                                                                                        'notes'         =>  'Notes',
                                                                                    ]
                                                                ],
                                        'vendor'        =>
                                                            [
                                                                'name'      =>  'Vendor',
                                                                'child'         =>
                                                                                    [
                                                                                        'detail'        =>  'Detail',
                                                                                        'register'      =>  'Registration',
                                                                                        'documents'     =>  'Documents',
                                                                                        'notes'         =>  'Notes',
                                                                                    ],
                                                            ],
                                        'purchase'      =>
                                                            [
                                                                'name'      =>  'Purchase',
                                                                'child'       =>
                                                                                [
                                                                                    'detail'    =>  'Detail',
                                                                                    'new'       =>  'New',
                                                                                    'return'    =>  'Return',
                                                                                ]
                                                                ],
                                        'sales'         =>
                                                            [
                                                                'name'      =>  'Sales',
                                                                'child'       =>
                                                                                [
                                                                                    'detail'    =>  'Detail',
                                                                                    'new'       =>  'New',
                                                                                    'return'    =>  'Return',
                                                                                ]
                                                                ],
                                    ],
    ];