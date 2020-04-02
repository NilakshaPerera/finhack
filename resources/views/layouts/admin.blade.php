<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{url('images/favicon.ico')}}" type="image/ico" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap {{url('')}}-->
        <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{url('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="{{url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{url('vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

        <!-- Selectize -->
        <!--<link href="vendors/selectize.js-master/dist/css/selectize.css" rel="stylesheet">-->
        <link href="{{url('vendors/selectize.js-master/dist/css/selectize.default.css')}}" rel="stylesheet">

        <!-- Datatables -->
        <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

        <!-- Summernote -->
        <link href="{{url('vendors/summernote-master/dist/summernote.css')}}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{url('vendors/custom.min.css')}}" rel="stylesheet">
        <link href="{{url('vendors/admin.css')}}" rel="stylesheet">

    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div style="margin-top: 10px;" class="navbar nav_title" style="border: 0;">
                            <a href="{{ url('admin/home') }}" class="site_title"> <span>{{ config('app.name', 'Laravel') }}</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <!--  <div class="profile_pic">
                                      <img src="{{url('images/0.jpg')}}" alt="..." class="img-circle profile_img">
                             </div>-->
                            <div class="profile_info text-left">
                                <span><strong>Welcome,</strong></span>
                                <h2><strong>{{ Auth::user()->name }}</strong></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <hr>
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <!--<h3>General</h3>-->


                                <ul class="nav side-menu">

                                <?php if(Auth::user()->role_id == 1){ ?>
                                    <li><a><i class="fa fa-user"></i>Users<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('admin/user') }}">Manage</a></li>
                                        </ul>
                                    </li>


                                    <li><a><i class="fa fa-paper-plane"></i>Quizes<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            
                                            <li><a href="{{ url('admin/presentations') }}">Presentation</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>

                                    <li><a><i class="fa fa-paper-plane"></i>Exams<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('admin/exams') }}">Sessions</a></li>
                                        </ul>
                                    </li>
                                </ul>



                            </div>
                        </div>
                        <!-- /sidebar menu -->
                        <!-- /menu footer buttons  -->
                        <!-- /menu footer buttons -->
                    </div>
                </div>
                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i style="margin: 0 5px" class="fa fa-user"></i>{{ Auth::user()->name }}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <?php if(Auth::user()->role_id == 1){ ?>
                                        <li><a data-toggle="modal" data-target="#myModal" href="javascript:void(alert(0)">Settings</a></li>
                                        <li><a href="{{ route('admin.changePassword')}}">Change Password</a></li>
                                        <?php } ?>   
                                        <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <!-- /top navigation -->
                <div class="right_col" role="main">
                    <!-- page content -->

                    <div class="row">
                        <div id="alertSuccess" name="alertSuccess" class="alert alert-success alert-dismissible text-center"  style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>SUCCESS!</strong> 
                        </div>
                        <div id="alertWarning" name="alertWarning" class="alert alert-warning alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none"  role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Warning!</strong> <span id="alertWarningMessage"></span>
                        </div>
                        <div id="alertError" name="alertError" class="alert alert-danger alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none"  role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> <span id="alertErrorMessage"></span>
                        </div>
                    </div>

                    @yield('content')        

                    <!-- /page content -->
                </div>
                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Created by <a href="https://github.com/NilakshaPerera">Nilaksha</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <div class="row">
            <div id="alertSuccess" name="alertSuccess" class="alert alert-success alert-dismissible text-center"  style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>SUCCESS!</strong> 
            </div>
            <div id="alertWarning" name="alertWarning" class="alert alert-warning alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none"  role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Warning!</strong> <span id="alertWarningMessage"></span>
            </div>
            <div id="alertError" name="alertError" class="alert alert-danger alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none"  role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Error!</strong> <span id="alertErrorMessage"></span>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Settings</h4>
                    </div>
                    <form id="formSettings" name="formSettings" method="POST"  class="form-horizontal" action="">
                         @csrf
                    <div class="modal-body"> 
                       
                            <?php foreach (App\Setting::all() as $setting) { ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label"> {{  $setting->display_name  }}</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="{{ $setting->setting }}" name="{{ $setting->setting }}" value="{{ $setting->data }}" >
                                    </div>
                                </div>
                            <?php } ?>    
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- jQuery --> 
        <script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{url('vendors/fastclick/lib/fastclick.js')}}"></script>
        <!-- NProgress -->
        <script src="{{url('vendors/nprogress/nprogress.js')}}"></script>
        <!-- Chart.js -->
        <script src="{{url('vendors/Chart.js/dist/Chart.min.js')}}"></script>
        <!-- gauge.js -->
        <script src="{{url('vendors/gauge.js/dist/gauge.min.js')}}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>
        <!-- Skycons -->
        <script src="{{url('vendors/skycons/skycons.js')}}"></script>
        <!-- Flot -->
        <script src="{{url('vendors/Flot/jquery.flot.js')}}"></script>
        <script src="{{url('vendors/Flot/jquery.flot.pie.js')}}"></script>
        <script src="{{url('vendors/Flot/jquery.flot.time.js')}}"></script>
        <script src="{{url('vendors/Flot/jquery.flot.stack.js')}}"></script>
        <script src="{{url('vendors/Flot/jquery.flot.resize.js')}}"></script>
        <!-- Flot plugins -->
        <script src="{{url('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
        <script src="{{url('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
        <script src="{{url('vendors/flot.curvedlines/curvedLines.js')}}"></script>
        <!-- DateJS -->
        <script src="{{url('vendors/DateJS/build/date.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{url('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
        <script src="{{url('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
        <script src="{{url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{url('vendors/moment/min/moment.min.js')}}"></script>
        <script src="{{url('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

        <!-- Parsley -->
        <script src="{{url('vendors/parsleyjs/dist/parsley.min.js')}}"></script>

        <!-- Selectize -->
        <script src="{{url('vendors/selectize.js-master/dist/js/standalone/selectize.min.js')}}"></script>

        <!-- Datatables -->
        <script src="{{url('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
        <script src="{{url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
        <script src="{{url('vendors/jszip/dist/jszip.min.js')}}"></script>
        <script src="{{url('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{url('vendors/pdfmake/build/vfs_fonts.js')}}"></script>

        <!-- Summernote -->
        <script src="{{url('vendors/summernote-master/dist/summernote.js')}}"></script>

        <script>
                                            var base = '{{url("/")}}/';
        </script>
        <script src="{{url('vendors/custom.min.js')}}"></script>
        <script src="{{url('vendors/admin.js')}}"></script>
    </body>
</html>

@yield('scripts')  