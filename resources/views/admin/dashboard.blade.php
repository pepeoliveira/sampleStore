@extends('layouts.adminLayout.admin_design')
@section('content')

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"><a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home</a></div>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"><span class="icon"><i class="icon-ok"></i></span>
                            <h5>Progress Box</h5>
                        </div>
                        <div class="widget-content">
                            <ul class="unstyled">
                                <li><span class="icon24 icomoon-icon-arrow-up-2 green"></span> 81% Clicks <span
                                        class="pull-right strong">567</span>
                                    <div class="progress progress-striped ">
                                        <div style="width: 81%;" class="bar"></div>
                                    </div>
                                </li>
                                <li><span class="icon24 icomoon-icon-arrow-up-2 green"></span> 72% Uniquie Clicks <span
                                        class="pull-right strong">507</span>
                                    <div class="progress progress-success progress-striped ">
                                        <div style="width: 72%;" class="bar"></div>
                                    </div>
                                </li>
                                <li><span class="icon24 icomoon-icon-arrow-down-2 red"></span> 53% Impressions <span
                                        class="pull-right strong">457</span>
                                    <div class="progress progress-warning progress-striped ">
                                        <div style="width: 53%;" class="bar"></div>
                                    </div>
                                </li>
                                <li><span class="icon24 icomoon-icon-arrow-up-2 green"></span> 3% Online Users <span
                                        class="pull-right strong">8</span>
                                    <div class="progress progress-danger progress-striped ">
                                        <div style="width: 3%;" class="bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!--end-main-container-part-->
@endsection
