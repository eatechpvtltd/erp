<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="{{ route('home') }}" class="navbar-brand">
                <small class="text-capitalize">
                    <!--<i class="fa fa-graduation-cap orange2" aria-hidden="true"></i>-->
                    @if(isset($generalSetting->institute))
                      <div class="logo-contain">
                          <img src="{{ asset('assets/images/logo.png') }}" alt="logo"/>
                      </div>
                    @else
                        {{ env('APP_NAME') }}
                    @endif
                </small>
            </a>

            <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
                <span class="sr-only">Toggle user menu</span>
                @if(isset($profileImageSrc) && $profileImageSrc !== null)
                    <img alt="" src="{{ asset($profileImageSrc) }}" width="300px" />
                @else
                    <img src="{{ asset('assets/images/avatars/user.jpg') }}" alt="" />
                @endif


            </button>

            <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>
        </div>

        @if(Auth::check())
            <div class="navbar-buttons navbar-header pull-right collapse navbar-collapse" role="navigation">
                <ul class="nav ace-nav">
                    <li class="light-blue dropdown-modal user-min">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            @if(isset($profileImageSrc) && $profileImageSrc !== null)
                                <img id="avatar" class="nav-user-photo" alt="" src="{{ asset($profileImageSrc) }}" width="300px" />
                            @else
                                <img class="nav-user-photo" src="{{ asset('assets/images/avatars/user.jpg') }}" alt="" />
                            @endif

                            <span class="user-info">
                            <small>Welcome,</small>
                            {{isset(auth()->user()->name)?auth()->user()->name:""}}
                        </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            @if(isset($profileImageSrc) && $profileImageSrc !== '')
                                <li>
                                    <img id="avatar" class="img-responsive" alt="" src="{{ asset($profileImageSrc) }}" width="300px" />
                                </li>
                            @endif
                            <li>
                                @if(isset(auth()->user()->id))
                                    <a href="{{ route('user.view', ['id' => encrypt(auth()->user()->id)]) }}">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                @else
                                    <a href="#">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                @endif
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        @else
            <nav role="navigation" class="navbar-menu pull-right collapse navbar-collapse">

                <ul class="nav navbar-nav">
                    @if(isset($generalSetting) && $generalSetting->public_registration == 1)
                        <li class="light-blue">
                            <a href="{{ route('online-registration.registration') }}">
                                <i class="ace-icon fa fa-user bigger-120"></i> Online Registration
                            </a>
                        </li>
                        <li class="light-blue">
                            <a href="{{ route('online-registration.find') }}">
                                <i class="ace-icon fa fa-search bigger-120"></i>&nbsp;Find Registration
                            </a>
                        </li>
                        <li class="light-blue">
                            <a href="{{ route('verification.certificate') }}">
                                <i class="ace-icon fa fa-certificate bigger-120"></i> Certificate Verification
                            </a>
                        </li>
                    @endif
                    <li class="light-blue">
                        <a href="{{ route('login') }}" target="_blank">
                            <i class="ace-icon fa fa-sign-in bigger-120"></i>&nbsp;Login
                        </a>
                    </li>
                    <li class="light-blue">
                        <a href="{{ route('web.home') }}" target="_blank">
                            <i class="ace-icon fa fa-globe bigger-120"></i>&nbsp;WebPortal
                        </a>
                    </li>
                </ul>
            </nav>
        @endif



        @ability('super-admin','expand-action-menu')
            <div class="navbar-buttons navbar-header pull-left  collapse navbar-collapse" role="navigation">
                <div class="collapse navbar-collapse js-navbar-collapse col-md-12">
                    <ul class="nav navbar-nav navbar-nav-mega col-md-12">
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-list ace-icon bigger-180"></span></a>
                            <ul class="dropdown-menu mega-dropdown-menu row">
                                <li class="col-sm-3">
                                    <ul>
                                        {{-- Staff & Student --}}
                                        @ability('super-admin','student-staff')
                                            @if( isset($generalSetting) && $generalSetting->student_staff ==1)
                                                <li class="dropdown-header"><i class="fa fa-users" aria-hidden="true"></i> Student</li>
                                                <li><a href="{{ route('student') }}">Detail</a></li>
                                                <li><a href="{{ route('student.registration') }}">Registration</a></li>
                                                <li><a href="{{ route('student.import') }}">Bulk Import</a></li>
                                                <li><a href="{{ route('student.transfer') }}">Transfer</a></li>
                                                <li><a href="{{ route('student.document') }}">Documents</a></li>
                                                <li><a href="{{ route('student.note') }}">Notes</a></li>
                                                <li class="divider"></li>
                                                <li class="dropdown-header"><i class="fa fa-user-secret" aria-hidden="true"></i> Guardian</li>
                                                <li><a href="{{ route('guardian') }}">Detail</a></li>
                                                <li><a href="{{ route('guardian.registration') }}">Registration</a></li>
                                                <li class="divider"></li>
                                                <li class="dropdown-header"><i class="fa fa-user-secret" aria-hidden="true"></i> Staff</li>
                                                <li><a href="{{ route('staff') }}">Detail</a></li>
                                                <li><a href="{{ route('staff.add') }}">Registration</a></li>
                                                <li><a href="{{ route('staff.import') }}">Bulk Import</a></li>
                                                <li><a href="{{ route('staff.document') }}">Documents</a></li>
                                                <li><a href="{{ route('staff.note') }}">Notes</a></li>
                                                <li class="divider"></li>
                                            @endif
                                        @endability
                                        <li class="dropdown-header"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Attendance</li>
                                        <li><a href="{{ route('attendance.student') }}">Regular Attendance</a></li>
                                        <li><a href="{{ route('attendance.subject') }}">Subject Attendance</a></li>
                                        <li><a href="{{ route('attendance.staff') }}">Staff Attendance</a></li>

                                    </ul>
                                </li>
                                <li class="col-sm-3">
                                    <ul>
                                        <li class="dropdown-header"><i class="fa fa-calculator" aria-hidden="true"></i> Account</li>
                                        <li><a href="{{ route('account.fees.quick-receive') }}">Quick Receive</a></li>
                                        <li><a href="{{ route('account.fees.collection') }}">Collect Fees</a></li>
                                        <li><a href="{{ route('account.fees.balance') }}">Balance Fees</a></li>
                                        <li><a href="{{ route('account.fees.master.add') }}">Add Fees</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('account.payroll.master.add') }}">Add Salary</a></li>
                                        <li><a href="{{ route('account.salary.payment') }}">Pay Salary</a></li>
                                        <li><a href="{{ route('account.payroll.balance') }}">Balance Salary</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('account.transaction') }}">Transaction</a></li>
                                        <li><a href="{{ route('account.transaction-head') }}">Legers</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('account.bank') }}">Bank AC</a></li>
                                        <li><a href="{{ route('account.bank-transaction') }}">Bank Transaction</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="fa fa-book" aria-hidden="true"></i> Library</li>
                                        <li><a href="{{ route('library.book') }}">Books Detail</a></li>
                                        <li><a href="{{ route('library.student') }}">Student Member</a></li>
                                        <li><a href="{{ route('library.staff') }}">Staff Member</a></li>
                                        <li><a href="{{ route('library.issue-history') }}">Issue History</a></li>
                                        <li><a href="{{ route('library.return-over') }}">Return Period Over</a></li>
                                    </ul>
                                </li>
                                <li class="col-sm-3">
                                    <ul>
                                        <li class="dropdown-header"><i class="fa fa-line-chart" aria-hidden="true"></i> Examination</li>
                                        <li><a href="{{ route('exam.schedule') }}">Exam Schedule </a></li>
                                        <li><a href="{{ route('exam.mark-ledger') }}">Mark Ledger</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('exam.admit-card') }}">Admit Card</a></li>
                                        <li><a href="{{ route('exam.routine') }}">Routine</a></li>
                                        <li><a href="{{ route('exam.mark-sheet') }}">MarkSheet/Score</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="fa fa-certificate" aria-hidden="true"></i> Certificate</li>
                                        <li><a href="{{ route('certificate.issue') }}">Issue</a></li>
                                        <li><a href="{{ route('certificate.issue-history') }}">Issue History</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('certificate.attendance') }}">Attendance</a></li>
                                        <li><a href="{{ route('certificate.transfer') }}">Transfer</a></li>
                                        <li><a href="{{ route('certificate.character') }}">Character</a></li>
                                        <li><a href="{{ route('certificate.bonafide') }}">Bonafide</a></li>
                                        <li><a href="{{ route('certificate.course-completion') }}">Course Completion</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('certificate.generate') }}">Generate</a></li>
                                        <li><a href="{{ route('certificate.template') }}">Templating</a></li>
                                        <li class="divider"></li>

                                    </ul>
                                </li>
                                <li class="col-sm-3">
                                    <ul>
                                        <li class="dropdown-header"><i class="fa fa-car" aria-hidden="true"></i> Transport</li>
                                        <li><a href="{{ route('transport.user.history') }}">User Hstory</a></li>
                                        <li><a href="{{ route('transport.user') }}">Traveller/User</a></li>
                                        <li><a href="{{ route('transport.route') }}">Route</a></li>
                                        <li><a href="{{ route('transport.vehicle') }}">Vehicle</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="fa fa-bed" aria-hidden="true"></i> Hostel</li>
                                        <li><a href="{{ route('hostel.resident') }}">Resident</a></li>
                                        <li><a href="{{ route('hostel.resident.history') }}">Resident History</a></li>
                                        <li><a href="{{ route('hostel') }}">Hostel Detail</a></li>
                                        <li><a href="{{ route('hostel.food') }}">Food & Meal</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="fa fa-bullhorn" aria-hidden="true"></i> Alert</li>
                                        <li><a href="{{ route('info.notice') }}">User Notice</a></li>
                                        <li><a href="{{ route('info.smsemail') }}">Send SMS/Email</a></li>
                                        <li><a href="{{ route('setting.alert') }}">Alert Templating</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="fa fa-th-list" aria-hidden="true"></i> More</li>
                                        <li><a href="{{ route('meeting') }}">Meeting/OnlineClass</a></li>
                                        <li><a href="{{ route('info.notice') }}">Assignment</a></li>
                                        <li><a href="{{ route('info.smsemail') }}">Upload/Download</a></li>
                                        <li><a href="{{ route('info.smsemail') }}">Upload/Download</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        @endability
        @if(Auth::check())
            <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
            {!! Form::open(['route' => 'student', 'method' => 'GET', 'class' => 'navbar-form navbar-left form-search','role' => 'search',
                        "enctype" => "multipart/form-data"]) !!}
                    <div class="form-group">
                        <input type="text" name="fast_finder" placeholder="Search Students..." title="Search Student with : Reg No., University Reg., Name, Gender, Blood Group, Nationality, Religion, Caste, Mother Tongue, Email, Mobile No."/>
                    </div>

                    <button type="submit" class="btn btn-mini btn-info2">
                        <i class="ace-icon fa fa-search icon-only bigger-110"></i>
                    </button>
            {!! Form::close() !!}
        </nav>
        @endif

        @ability('super-admin', 'admin-control')
        <nav role="navigation" class="navbar-menu pull-right collapse navbar-collapse">
            <ul class="nav navbar-nav">
{{--                <li class="light-blue">--}}
{{--                    <button onclick="openFullscreen()">--}}
{{--                        <i class="ace-icon fa fa-globe bigger-180"></i>--}}
{{--                    </button>--}}
{{--                </li>--}}
                <li class="light-blue">
                    <a href="{{ route('web.home') }}" target="_blank">
                        <i class="ace-icon fa fa-globe bigger-180"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{__('admin_control.name')}}
                        <i class="ace-icon fa fa-angle-down bigger-110"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-light-blue dropdown-caret admin-control-dropdown">

                        <li> <a href="{{ route('user') }}"> <i class="ace-icon fa fa-users bigger-110 blue"></i> {{__('admin_control.child.user')}} </a></li>
                        <li> <a href="{{ route('role') }}"> <i class="ace-icon fa fa-certificate bigger-110 blue"></i> {{__('admin_control.child.role_permission')}} </a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('setting.general') }}"><i class="fa fa-cog  bigger-110 blue"></i>&nbsp;{{__('admin_control.child.general_branding_setting')}} <span class="red">*</span></a></li>
                        <li><a href="{{ route('setting.online-registration') }}"><i class="fa fa-archive bigger-110 blue"></i> {{__('admin_control.child.online_registration')}}</a></li>
                        <li><a href="{{ route('setting.meeting') }}"><i class="fa fa-video-camera bigger-110 blue"></i>&nbsp;{{__('admin_control.child.meeting_remote_class')}}</a></li>
                        <li><a href="{{ route('setting.sms') }}"><i class="fa fa-mobile bigger-180 blue"></i>&nbsp;{{__('admin_control.child.sms_setting')}}</a></li>
                        <li><a href="{{ route('setting.email') }}"><i class="fa fa-envelope  bigger-110 blue"></i>&nbsp;{{__('admin_control.child.email_setting')}}</a></li>
                        <li><a href="{{ route('setting.alert') }}"><i class="fa fa-bell bigger-110 blue"></i>&nbsp;{{__('admin_control.child.alert_template_setting')}}</a></li>
                        <li><a href="{{ route('setting.payment-gateway') }}"><i class="fa fa-dollar  bigger-110 blue"></i>&nbsp;{{__('admin_control.child.payment_gateway')}}</a></li>
{{--                        <li><a href="{{ route('payment-method') }}"><i class=" fa fa-dollar bigger-110 blue"></i> {{__('admin_control.child.payment_methods')}}</a></li>--}}
                        <li class="divider"></li>
                        <li> <a href="{{ route('super-suit.cleaner') }}"> <i class="ace-icon fa fa-eraser bigger-110 blue"></i> {{__('admin_control.child.cache_clear')}} </a></li>
                        <li> <a href="{{ route('super-suit.user-activity') }}"> <i class="ace-icon fa fa-history bigger-110 blue"></i> {{__('admin_control.child.user_activity')}} </a></li>
                        <li> <a href="#"> <i class="ace-icon fa fa-database bigger-110 blue"></i> {{__('admin_control.child.database_backup')}}</a></li>
                        <li> <a href="#"> <i class="ace-icon fa fa-magnet bigger-110 blue"></i> {{__('admin_control.child.automation_cron_jobs')}} </a></li>
                        <li style="display:none"> <a href="{{ route('developer-info') }}"> <i class="ace-icon fa fa-question bigger-110 blue"></i> {{__('admin_control.child.developer_info')}} </a></li>
                        <li class="divider"></li>
                        <li class="text-center" style="display:none"><strong>TOUCH WITH DEVELOPER</strong></li>
                        <li class="divider"></li>
<!--                        <li> <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=HP3DPMBDA3WM8"> <i class="ace-icon fa fa-paypal bigger-110 blue"></i> Donate Now</a></li>-->
                        <li> <a target="_blank" style="display:none" href="mailto:freelancerumeshnepal@gmail.com"> <i class="ace-icon fa fa-envelope bigger-110 blue"></i> Email</a></li>
                        <li> <a target="_blank" style="display:none" href="https://wa.me/9779868156047"> <i class="ace-icon fa fa-whatsapp bigger-110 blue"></i> WhatsApp </a></li>
                        <li> <a target="_blank" style="display:none" href="skype:freelancerumeshnepal@gmail.com"> <i class="ace-icon fa fa-skype bigger-110 blue"></i> Skype</a></li>
<!--                        <li> <a target="_blank" href="viber://chat?number=9779868156047"> <i class="ace-icon fa fa-viber bigger-110 blue"></i> Viber</a></li>-->
                        <li class="divider"></li>
                        <li> <a target="_blank" style="display:none" href="{{route('license-info')}}"> <i class="ace-icon fa fa-certificate bigger-110 blue"></i> License Info </a></li>
                        @if(env('APP_STATUS')==1)
                            <li style="display:none"> <a href="{{ route('license-info') }}"> <i class="ace-icon fa fa-certificate bigger-110 red"></i> License Expired  </a></li>
                        @endif
                        @if(env('HELP_STATUS')==1)
                            <li style="display:none"> <a href="{{ route('license-info') }}"> <i class="ace-icon fa fa-phone bigger-110 red"></i> Support Expired  </a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
        @endability
    </div><!-- /.navbar-container -->
</div>

