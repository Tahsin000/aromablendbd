@extends('admin.layouts.app')

@section('title', 'Kijir Dashboard')
@push('styles')
@endpush

@section('content')


    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Projects</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hash</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0 text-center align-items-center">
                            <div class="col border-end border-light border-dashed">
                                <div class="mt-3 mt-md-0 p-3">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Projects</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-3">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title bg-secondary-subtle text-secondary rounded-circle fs-22">
                                                <i class="ti ti-briefcase"></i>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold"><span data-target="6,847">0</span></h3>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="ti ti-chevron-down"></i> 9.19%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col border-end border-light border-dashed">
                                <div class="mt-3 mt-md-0 p-3">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Tasks</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-3">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-22">
                                                <i class="ti ti-invoice"></i>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold"><span data-target="9.6">0</span>k</h3>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="ti ti-chevron-up"></i> 26.87%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col border-end border-light border-dashed">
                                <div class="mt-3 mt-md-0 p-3">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Avg. Project
                                        Earnings</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-3">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-22">
                                                <i class="ti ti-wallet"></i>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">$<span data-target="98.24">0</span>k</h3>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="ti ti-chevron-up"></i> 3.51%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col border-end border-light border-dashed">
                                <div class="mt-3 mt-md-0 p-3">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Productivity</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-3">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-22">
                                                <i class="ti ti-trending-up"></i>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold"><span data-target="87.84">0</span>%</h3>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"> <i class="ti ti-chevron-down"></i> 1.05%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 p-3">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Today's Hours</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-3">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-22">
                                                <i class="ti ti-clock"></i>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold"><span id="tracker-time">05:30:57</span></h3>
                                    </div>
                                    <button type="button"
                                        class="btn btn-sm btn-info time-tracker-btn fw-semibold w-100">Start
                                        Tracker</button>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between">
                                <h4 class="card-title">Project Status Breakdown</h4>
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical fs-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-eye me-2"></i> View All
                                                Status Details </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-filter-2 me-2"></i>
                                                Filter by Status </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-calendar me-2"></i>
                                                Change Date Range </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i>
                                                Export Breakdown </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#"> <i
                                                    class="ti ti-refresh me-2"></i> Reset Status View </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div id="project-status-chart" class="apex-charts"></div>

                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="ti ti-circle-filled fs-12 align-middle me-1 text-secondary"></i>
                                                <span class="align-middle fw-semibold">Completed</span>
                                            </div>
                                            <span class="fw-semibold text-muted float-end"><i
                                                    class="ti ti-chevron-down text-danger"></i> 965</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="ti ti-circle-filled fs-12 align-middle me-1 text-warning"></i>
                                                <span class="align-middle fw-semibold">In Progress</span>
                                            </div>
                                            <span class="fw-semibold text-muted float-end"><i
                                                    class="ti ti-chevron-up text-success"></i> 75</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="ti ti-circle-filled fs-12 align-middle me-1 text-secondary"></i>
                                                <span class="align-middle fw-semibold"> Yet to Start</span>
                                            </div>
                                            <span class="fw-semibold text-muted float-end"><i
                                                    class="ti ti-chevron-up text-success"></i> 102</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="ti ti-circle-filled fs-12 align-middle me-1 text-danger"></i>
                                                <span class="align-middle fw-semibold">Cancelled</span>
                                            </div>
                                            <span class="fw-semibold text-muted float-end"><i
                                                    class="ti ti-chevron-down text-danger"></i> 96</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->
                    <div class="col-xl-8">
                        <div class="card card-h-100">
                            <div class="card-header justify-content-between">
                                <h4 class="card-title">Projects Performance Overview</h4>
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical fs-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#"> <i
                                                    class="ti ti-chart-histogram me-2"></i> View Detailed Report </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-filter-2 me-2"></i>
                                                Filter by Project </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-calendar me-2"></i>
                                                Select Date Range </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i>
                                                Export as CSV </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#"> <i
                                                    class="ti ti-refresh me-2"></i> Reset Analytics </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row text-center g-2">
                                    <div class="col">
                                        <div class="border bg-light-subtle border-dashed border-light p-2 rounded">
                                            <h4><span data-target="7,845">0</span></h4>
                                            <p class="mb-0 text-muted">Number of Projects</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="border bg-light-subtle border-dashed border-light p-2 rounded">
                                            <h4><span data-target="289">0</span></h4>
                                            <p class="mb-0 text-muted">Active Projects</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="border bg-light-subtle border-dashed border-light p-2 rounded">
                                            <h4>$<span data-target="982.5">0</span>k</h4>
                                            <p class="mb-0 text-muted">Revenue</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="border bg-light-subtle border-dashed border-light p-2 rounded">
                                            <h4>~<span data-target="12,559">0</span>h</h4>
                                            <p class="mb-0 text-muted">Working Hours</p>
                                        </div>
                                    </div>
                                </div>
                                <div dir="ltr">
                                    <div id="dash-projects-overviews" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row-->
            </div>
            <!-- end col-->

            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body">
                        <input type="text" class="form-control card-calendar-widget" data-provider="flatpickr"
                            data-date-format="d M, Y" data-default-date="today" data-inline-date="true" />

                        <h4 class="card-title fs-sm my-3">Today's Schedule: <a href="#!"
                                class="float-end fs-sm">View All</a></h4>
                        <ul class="list-unstyled mt-1 mb-0">
                            <li class="mb-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="avatar-sm">
                                        <span
                                            class="avatar-title bg-soft-primary rounded-circle fs-22 text-primary rounded">
                                            <i class="ti ti-briefcase"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 fs-13"><i class="ti ti-calendar"></i> 08:00 AM - 09:30
                                            AM</p>
                                        <h5 class="m-0 fs-14">Project Kickoff Meeting</h5>
                                    </div>
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-sm btn-default btn-icon"><i
                                                class="ti ti-x fs-md"></i></button>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-22 text-info rounded">
                                            <i class="ti ti-brand-figma"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 fs-13"><i class="ti ti-calendar"></i> 10:00 AM - 11:15
                                            AM</p>
                                        <h5 class="m-0 fs-14">UI/UX Review Session</h5>
                                    </div>
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-sm btn-default btn-icon"><i
                                                class="ti ti-x fs-md"></i></button>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="avatar-sm">
                                        <span
                                            class="avatar-title bg-soft-secondary rounded-circle fs-22 text-secondary rounded">
                                            <i class="ti ti-users"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 fs-13"><i class="ti ti-calendar"></i> 04:00 PM - 05:30
                                            PM</p>
                                        <h5 class="m-0 fs-14">Team Collaboration Session</h5>
                                    </div>
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-sm btn-default btn-icon"><i
                                                class="ti ti-x fs-md"></i></button>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="text-center mt-3">
                            <a href="#!" class="btn btn-sm btn-primary"><i class="ti ti-plus me-1"></i> Add New</a>
                        </div>
                    </div>
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
            <div class="col-xxl-6">
                <div data-table data-table-rows-per-page="5" class="card">
                    <div class="card-header border-light justify-content-between">
                        <h4 class="card-title">Ongoing Projects</h4>

                        <div class="d-flex align-items-center gap-2">
                            <!-- Search -->
                            <div class="app-search">
                                <input data-table-search type="text" class="form-control"
                                    placeholder="Search project..." />
                                <i class="ti ti-search app-search-icon text-muted"></i>
                            </div>

                            <!-- Rows Per Page -->
                            <div>
                                <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                    <option value="5">5 rows</option>
                                    <option value="10" selected>10 rows</option>
                                    <option value="15">15 rows</option>
                                    <option value="20">20 rows</option>
                                    <option value="50">50 rows</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light bg-opacity-25 p-2 text-center border-bottom border-dashed">
                        <p class="m-0"><b>31</b> Active projects out of <span class="fw-medium">958</span></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0">
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Google</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">New
                                                Dashboard</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Deadline</span> <br />
                                        <h5 class="fs-base mb-0 fw-normal">17 Aug, 26</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Budget</span>
                                        <h5 class="fs-base mb-0 fw-normal">$8,950</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-2.jpg" alt=""
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">UI/UX Team</span>
                                                <h5 class="fs-base mb-0 fw-normal">Sean Kemper</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><i class="ti ti-circle fs-12 text-info"></i>
                                            Early Stage</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:void(0);" class="dropdown-item">View Project</a>
                                                <a href="javascript:void(0);" class="dropdown-item">Edit Project</a>
                                                <a href="javascript:void(0);" class="dropdown-item">Archive Project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Microsoft</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">Azure
                                                Migration</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Deadline</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">05 Sep, 26</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Budget</span>
                                        <h5 class="fs-base mb-0 fw-normal">$12,500</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-3.jpg" alt=""
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Cloud Team</span>
                                                <h5 class="fs-base mb-0 fw-normal">Emily Carter</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><i class="ti ti-circle fs-12 text-warning"></i>
                                            In Progress</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Project</a>
                                                <a class="dropdown-item" href="#">Edit Project</a>
                                                <a class="dropdown-item" href="#">Archive Project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Amazon</span>
                                        <h5 class="fs-base mb-0"><a href="#" class="text-body">E-Commerce
                                                Redesign</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Deadline</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">29 Oct, 26</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Budget</span>
                                        <h5 class="fs-base mb-0 fw-normal">$18,200</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-4.jpg"
                                                class="avatar-sm rounded-circle me-2" alt="" />
                                            <div>
                                                <span class="text-muted fs-12">Frontend Team</span>
                                                <h5 class="fs-base mb-0 fw-normal">Jacob Wilson</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><i class="ti ti-circle fs-12 text-success"></i>
                                            On Track</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Project</a>
                                                <a class="dropdown-item" href="#">Edit Project</a>
                                                <a class="dropdown-item" href="#">Archive Project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Spotify</span>
                                        <h5 class="fs-base mb-0"><a href="#" class="text-body">Music Analytics
                                                Tool</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Deadline</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">11 Nov, 26</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Budget</span>
                                        <h5 class="fs-base mb-0 fw-normal">$9,750</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-5.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Analytics Team</span>
                                                <h5 class="fs-base mb-0 fw-normal">Laura Chen</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><i class="ti ti-circle fs-12 text-danger"></i>
                                            Delayed</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Project</a>
                                                <a class="dropdown-item" href="#">Edit Project</a>
                                                <a class="dropdown-item" href="#">Archive Project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 5 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Tesla</span>
                                        <h5 class="fs-base mb-0"><a href="#" class="text-body">EV Monitoring
                                                System</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Deadline</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">06 Dec, 26</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Budget</span>
                                        <h5 class="fs-base mb-0 fw-normal">$21,300</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-6.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Tech Team</span>
                                                <h5 class="fs-base mb-0 fw-normal">Daniel Foster</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><i class="ti ti-circle fs-12 text-success"></i>
                                            On Schedule</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Project</a>
                                                <a class="dropdown-item" href="#">Edit Project</a>
                                                <a class="dropdown-item" href="#">Archive Project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 6 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Meta</span>
                                        <h5 class="fs-base mb-0"><a href="#" class="text-body">Social Feed
                                                Optimization</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Deadline</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">21 Jan, 26</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Budget</span>
                                        <h5 class="fs-base mb-0 fw-normal">$14,680</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-7.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">AI Team</span>
                                                <h5 class="fs-base mb-0 fw-normal">Chloe Martin</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><i class="ti ti-circle fs-12 text-info"></i>
                                            Planning</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Project</a>
                                                <a class="dropdown-item" href="#">Edit Project</a>
                                                <a class="dropdown-item" href="#">Archive Project</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div data-table-pagination-info="projects"></div>

                            <div data-table-pagination></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-->

            <div class="col-xxl-6">
                <div data-table data-table-rows-per-page="5" class="card">
                    <div class="card-header border-light justify-content-between">
                        <h4 class="card-title">Tasks</h4>

                        <div class="d-flex align-items-center gap-2">
                            <!-- Search -->
                            <div class="app-search">
                                <input data-table-search type="text" class="form-control"
                                    placeholder="Search task..." />
                                <i class="ti ti-search app-search-icon text-muted"></i>
                            </div>

                            <!-- Rows Per Page -->
                            <div>
                                <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                    <option value="5">5 rows</option>
                                    <option value="10" selected>10 rows</option>
                                    <option value="15">15 rows</option>
                                    <option value="20">20 rows</option>
                                    <option value="50">50 rows</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light bg-opacity-25 p-2 text-center border-bottom border-dashed">
                        <p class="m-0"><b>107</b> Tasks completed out of <span class="fw-medium">195</span></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0">
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Due in 2 days</span>
                                        <h5 class="fs-base mb-0">
                                            <a href="javascript:void(0);" class="text-body">Fix Homepage Layout Issues</a>
                                        </h5>
                                    </td>

                                    <td>
                                        <span class="text-muted fs-12">Due Date</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">14 Sep, 26</h5>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-5.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Assigned To</span>
                                                <h5 class="fs-base mb-0 fw-normal">Mia Turner</h5>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal">
                                            <span class="badge badge-soft-info">In Progress</span>
                                        </h5>
                                    </td>

                                    <td>
                                        <span class="text-muted fs-12">Total time spent</span>
                                        <h5 class="fs-base mb-0 fw-normal">1h 45min</h5>
                                    </td>

                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Task</a>
                                                <a class="dropdown-item" href="#">Edit Task</a>
                                                <a class="dropdown-item" href="#">Mark as Completed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Due in 1 day</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">Update
                                                User Profile API</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Due Date</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">15 Sep, 26</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-6.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Assigned To</span>
                                                <h5 class="fs-base mb-0 fw-normal">Oliver Knight</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><span
                                                class="badge badge-soft-success">Completed</span></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Total time spent</span>
                                        <h5 class="fs-base mb-0 fw-normal">4h 10min</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Task</a>
                                                <a class="dropdown-item" href="#">Edit Task</a>
                                                <a class="dropdown-item" href="#">Mark as Completed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Due in 5 days</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">Create
                                                Dashboard Widgets</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Due Date</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">19 Sep, 26</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-7.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Assigned To</span>
                                                <h5 class="fs-base mb-0 fw-normal">Sofia Reed</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><span
                                                class="badge badge-soft-warning">Pending</span></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Total time spent</span>
                                        <h5 class="fs-base mb-0 fw-normal">0h 00min</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Task</a>
                                                <a class="dropdown-item" href="#">Edit Task</a>
                                                <a class="dropdown-item" href="#">Mark as Completed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Due in 7 days</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">Fix
                                                Login Authentication Bug</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Due Date</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">21 Sep, 26</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-8.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Assigned To</span>
                                                <h5 class="fs-base mb-0 fw-normal">Henry Adams</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><span
                                                class="badge badge-soft-danger">Blocked</span></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Total time spent</span>
                                        <h5 class="fs-base mb-0 fw-normal">1h 05min</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Task</a>
                                                <a class="dropdown-item" href="#">Edit Task</a>
                                                <a class="dropdown-item" href="#">Mark as Completed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Due today</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">Write
                                                Release Notes for v2.1</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Due Date</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">14 Sep, 26</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-9.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Assigned To</span>
                                                <h5 class="fs-base mb-0 fw-normal">Chloe Martin</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><span
                                                class="badge badge-soft-primary">Reviewing</span></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Total time spent</span>
                                        <h5 class="fs-base mb-0 fw-normal">45min</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Task</a>
                                                <a class="dropdown-item" href="#">Edit Task</a>
                                                <a class="dropdown-item" href="#">Mark as Completed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-muted fs-12">Due in 4 days</span>
                                        <h5 class="fs-base mb-0"><a href="javascript:void(0);" class="text-body">Design
                                                New Notification Icons</a></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Due Date</span><br />
                                        <h5 class="fs-base mb-0 fw-normal">18 Sep, 26</h5>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user-10.jpg"
                                                class="avatar-sm rounded-circle me-2" />
                                            <div>
                                                <span class="text-muted fs-12">Assigned To</span>
                                                <h5 class="fs-base mb-0 fw-normal">Victoria Mills</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Status</span>
                                        <h5 class="fs-base mb-0 fw-normal"><span
                                                class="badge badge-soft-success">Completed</span></h5>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-12">Total time spent</span>
                                        <h5 class="fs-base mb-0 fw-normal">2h 30min</h5>
                                    </td>
                                    <td style="width: 30px">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-default btn-icon"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical fs-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Task</a>
                                                <a class="dropdown-item" href="#">Edit Task</a>
                                                <a class="dropdown-item" href="#">Mark as Completed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div data-table-pagination-info="tasks"></div>

                            <div data-table-pagination></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
    </div>


@endsection
