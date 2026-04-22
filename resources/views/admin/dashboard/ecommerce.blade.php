@extends('admin.layouts.app')

@section('title', 'Kijir Dashboard')
@push('styles')
@endpush

@section('content')


    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Analytics</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hash</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Analytics</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-xxl-4 col-xl-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h4 class="fs-13 mb-2 fw-bold text-uppercase text-muted">Total Orders</h4>
                                <div class="d-flex align-items-center gap-2 mb-2 py-1">
                                    <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-success rounded-circle">
                                            <i class="ti ti-basket fs-xxl"></i>
                                        </span>
                                    </div>
                                    <h3 class="mb-0">$<span data-target="659.8">0</span>k</h3>
                                    <span class="badge fs-13 ms-auto badge-soft-danger"><i class="ti ti-arrow-down"></i>
                                        3.21%</span>
                                </div>
                            </div>
                            <!-- Filter -->
                            <div class="app-search app-search-sm">
                                <select class="form-select form-control form-select-sm">
                                    <option value="All">All Time</option>
                                    <option value="today">Today</option>
                                    <option value="last_7_days">Last 7 Days</option>
                                    <option value="last_30_days">Last 30 Days</option>
                                    <option value="last_90_days" selected>Last 90 Days</option>
                                    <option value="this_month">This Month</option>
                                    <option value="last_month">Last Month</option>
                                </select>
                                <i class="ti ti-calendar app-search-icon text-muted"></i>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-12">
                                <div dir="ltr">
                                    <div id="total-orders-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-xxl-4 col-xl-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h4 class="fs-13 mb-2 fw-bold text-uppercase text-muted">Total Visitors</h4>
                                <div class="d-flex align-items-center gap-2 mb-2 py-1">
                                    <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-secondary rounded-circle">
                                            <i class="ti ti-eye fs-xxl"></i>
                                        </span>
                                    </div>
                                    <h3 class="mb-0"><span data-target="82.3">0</span>M</h3>
                                    <span class="badge fs-13 ms-auto badge-soft-success"> <i class="ti ti-arrow-up"></i>
                                        6.84% </span>
                                </div>
                            </div>

                            <!-- Filter -->
                            <div class="app-search app-search-sm">
                                <select class="form-select form-control form-select-sm">
                                    <option value="All">All Time</option>
                                    <option value="today">Today</option>
                                    <option value="last_7_days">Last 7 Days</option>
                                    <option value="last_30_days">Last 30 Days</option>
                                    <option value="last_90_days" selected>Last 90 Days</option>
                                    <option value="this_month">This Month</option>
                                    <option value="last_month">Last Month</option>
                                </select>
                                <i class="ti ti-calendar app-search-icon text-muted"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between gap-1">
                            <div style="width: 69.4%">
                                <p class="mb-1 mt-2 text-muted text-uppercase fs-13 fw-medium">Mobile Phone</p>
                                <h3 class="fw-normal mb-2 fs-xl">69.40%</h3>
                                <div class="progress progress-lg rounded-0 rounded-start mb-1">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"
                                        aria-valuenow="100"></div>
                                </div>
                                <p class="text-muted mb-0">41,927 Sessions</p>
                            </div>

                            <div style="width: 30.6%">
                                <p class="mb-1 mt-2 text-muted text-uppercase fs-13 fw-medium">Desktop</p>
                                <h3 class="fw-normal mb-2 fs-xl">30.60%</h3>
                                <div class="progress progress-lg rounded-0 rounded-end mb-1">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                        aria-valuenow="100"></div>
                                </div>
                                <p class="text-muted mb-0">18,476 Sessions</p>
                            </div>
                        </div>

                        <div class="table-responsive mb-n2 mt-3">
                            <table class="table table-sm table-nowrap table-borderless table-centered mb-0">
                                <thead class="bg-light bg-opacity-50 thead-sm">
                                    <tr class="text-uppercase fs-xxs">
                                        <th>Goal</th>
                                        <th>Completed</th>
                                        <th>Target</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Visitors</td>
                                        <td>824,300</td>
                                        <td>1,000,000</td>
                                        <td>82%</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Traffic</td>
                                        <td>41,927</td>
                                        <td>60,000</td>
                                        <td>69%</td>
                                    </tr>
                                    <tr>
                                        <td>Desktop Traffic</td>
                                        <td>18,476</td>
                                        <td>30,000</td>
                                        <td>61%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-xxl-4 col-xl-12">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h4 class="fs-13 mb-2 fw-bold text-uppercase text-muted">Total Subscribers</h4>
                                <div class="d-flex align-items-center gap-2 mb-2 py-1">
                                    <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-info rounded-circle">
                                            <i class="ti ti-mail fs-xxl"></i>
                                        </span>
                                    </div>
                                    <h3 class="mb-0"><span data-target="55.6">0</span>k</h3>
                                    <span class="badge fs-13 ms-auto badge-soft-success"> <i class="ti ti-arrow-up"></i>
                                        4.87% </span>
                                </div>
                            </div>

                            <!-- Filter -->
                            <div class="app-search app-search-sm">
                                <select class="form-select form-control form-select-sm">
                                    <option value="All">All Time</option>
                                    <option value="today">Today</option>
                                    <option value="last_7_days">Last 7 Days</option>
                                    <option value="last_30_days">Last 30 Days</option>
                                    <option value="last_90_days" selected>Last 90 Days</option>
                                    <option value="this_month">This Month</option>
                                    <option value="last_month">Last Month</option>
                                </select>
                                <i class="ti ti-calendar app-search-icon text-muted"></i>
                            </div>
                        </div>

                        <!-- Email Marketing -->
                        <div class="mt-2 pt-1">
                            <div class="d-flex justify-content-between">
                                <h5 class="fs-base mb-2">Email Marketing</h5>
                                <div>
                                    <span>+ <span data-target="34,920">0</span></span>
                                    <span><i class="ti ti-circle-filled text-light mx-3 fs-10"></i> 27.41%</span>
                                </div>
                            </div>
                            <div class="progress progress-sm mb-1">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 27.41%"
                                    aria-valuenow="27.41" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Social Marketing -->
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="fs-base mb-2">Social Marketing</h5>
                                <div>
                                    <span>+ <span data-target="58,775">0</span></span>
                                    <span><i class="ti ti-circle-filled text-light mx-3 fs-10"></i> 46.13%</span>
                                </div>
                            </div>
                            <div class="progress progress-sm mb-1">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 46.13%"
                                    aria-valuenow="46.13" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Direct -->
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="fs-base mb-2">Direct</h5>
                                <div>
                                    <span>+ <span data-target="33,645">0</span></span>
                                    <span><i class="ti ti-circle-filled text-light mx-3 fs-10"></i> 26.46%</span>
                                </div>
                            </div>
                            <div class="progress progress-sm mb-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 26.46%"
                                    aria-valuenow="26.46" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Milestone Card -->
                        <div class="p-2 mt-3 border-dashed border rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-xl flex-shrink-0 me-2">
                                    <span class="avatar-title bg-warning-subtle rounded-circle fs-1">
                                        <i class="ti ti-medal text-warning"></i>
                                    </span>
                                </div>
                                <div class="flex-gow-1">
                                    <h5 class="mb-0 fw-semibold">Congratulations !...</h5>
                                    <p class="mb-0 text-muted">You've reached a new subscriber milestone.</p>
                                </div>
                                <div class="ms-auto">
                                    <h4 class="fs-16 mt-1 mb-0">29.4k</h4>
                                    <span class="text-muted fw-semibold fs-12">SUBSCRIBERS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-xxl-9 col-xl-8">
                <div class="card card-h-100">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">Sessions Overview <span class="text-muted fs-base fw-normal">(609.5k
                                Sessions)</span></h4>
                        <div>
                            <a href="#" class="btn btn-sm btn-default"> <i class="ti ti-cloud-upload me-1"></i>
                                Export </a>
                            <a href="#" class="btn btn-sm btn-light"> <i class="ti ti-download me-1"></i>
                                Import </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-justified nav-bordered">
                            <li class="nav-item text-start">
                                <button id="session-users"
                                    class="nav-link py-3 active gap-2 d-flex align-items-center text-start justify-content-center">
                                    <span class="avatar-md flex-shrink-0 d-none d-xxl-block">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle">
                                            <i class="ti ti-users fs-xxl"></i>
                                        </span>
                                    </span>
                                    <span>
                                        <span class="text-muted">Users</span>
                                        <p class="fs-xl mb-0 text-dark fw-semibold">
                                            <span data-target="39.03">0</span>k <span class="text-success fs-sm ms-2"><i
                                                    class="ti ti-arrow-up"></i>3.02%</span>
                                        </p>
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item text-start">
                                <button id="total-sessions"
                                    class="nav-link py-3 gap-2 d-flex align-items-center text-start justify-content-center">
                                    <span class="avatar-md flex-shrink-0 d-none d-xxl-block">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle">
                                            <i class="ti ti-eye fs-xxl"></i>
                                        </span>
                                    </span>
                                    <span>
                                        <span class="text-muted">Sessions</span>
                                        <p class="fs-xl mb-0 text-dark fw-semibold">
                                            <span data-target="42.15">0</span>k <span class="text-danger fs-sm ms-2"><i
                                                    class="ti ti-arrow-down"></i>4.78%</span>
                                        </p>
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item text-start">
                                <button id="session-bounce-rate"
                                    class="nav-link py-3 gap-2 d-flex align-items-center text-start justify-content-center">
                                    <span class="avatar-md flex-shrink-0 d-none d-xxl-block">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle">
                                            <i class="ti ti-trending-up fs-xxl"></i>
                                        </span>
                                    </span>
                                    <span>
                                        <span class="text-muted">Bounce Rate</span>
                                        <p class="fs-xl mb-0 text-dark fw-semibold">
                                            <span data-target="21.2">0</span>% <span class="text-danger fs-sm ms-2"><i
                                                    class="ti ti-arrow-down"></i>31.39%</span>
                                        </p>
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item text-start">
                                <button id="session-duration"
                                    class="nav-link py-3 gap-2 d-flex align-items-center text-start justify-content-center">
                                    <span class="avatar-md flex-shrink-0 d-none d-xxl-block">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle">
                                            <i class="ti ti-clock fs-xxl"></i>
                                        </span>
                                    </span>
                                    <span>
                                        <span class="text-muted">Session Duration</span>
                                        <p class="fs-xl mb-0 text-dark fw-semibold">
                                            3m 12s <span class="text-success fs-sm ms-2"><i
                                                    class="ti ti-arrow-up"></i>7.92%</span>
                                        </p>
                                    </span>
                                </button>
                            </li>
                        </ul>
                        <div class="p-3">
                            <div dir="ltr">
                                <div id="sessions-overview-users" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card-->
            </div>

            <div class="col-xxl-3 col-xl-4">
                <div class="card card-h-100">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">Audience Insights</h4>
                        <div class="dropdown ms-auto">
                            <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical fs-lg"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-chart-bar me-2"></i>
                                        View Detailed Report </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i>
                                        Export Analytics </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-filter-2 me-2"></i>
                                        Apply Filters </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"> <i class="ti ti-trash me-2"></i>
                                        Remove Widget </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col">
                                <div class="border-bottom p-2 border-end border-dashed">
                                    <h3 class="mb-0 d-flex gap-2 align-items-center justify-content-center">
                                        <i class="ti ti-users"></i>
                                        <span id="active-users-count">125</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="col">
                                <div class="border-bottom p-2 border-dashed">
                                    <h3 class="mb-0 d-flex gap-2 align-items-center justify-content-center">
                                        <i class="ti ti-device-analytics"></i>
                                        <span id="active-views-count">125</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>

                    <div class="card-body">
                        <div dir="ltr">
                            <div id="total-users-chart" class="apex-charts"></div>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table table-sm table-nowrap table-borderless table-centered mb-0">
                                <thead class="bg-light bg-opacity-50 thead-sm">
                                    <tr class="text-uppercase fs-xxs">
                                        <th>Page</th>
                                        <th>Views</th>
                                        <th>B. Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" class="text-muted">/dashboard-analytics</a>
                                        </td>
                                        <td>25</td>
                                        <td>87.5%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" class="text-muted">/dashboard-crm</a>
                                        </td>
                                        <td>15</td>
                                        <td>21.48%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" class="text-muted">/ubold/dashboard</a>
                                        </td>
                                        <td>10</td>
                                        <td>63.59%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end .table-responsive-->
                        <div class="text-center mt-2">
                            <a href="#" class="btn btn-sm btn-secondary">View All <i
                                    class="ti ti-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col -->
        </div>

        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">
                            User Geography Intelligence
                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Deep insight into user distribution across the globe."><i
                                    class="ti ti-info-circle text-muted ms-1"></i></span>
                        </h4>
                        <div class="dropdown ms-auto">
                            <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical fs-lg"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#"><i class="ti ti-map me-2"></i> Open Geo
                                        Visualization</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"><i class="ti ti-download me-2"></i>
                                        Export Geo Metrics</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"><i class="ti ti-filter-2 me-2"></i>
                                        Country Filters</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"><i class="ti ti-trash me-2"></i>
                                        Remove Widget</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div id="session-by-countries" style="height: 300px"></div>
                            </div>
                            <div class="col-lg-5" dir="ltr">
                                <div class="p-3">
                                    <!-- Country Data -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1"><img src="{{ asset('assets/images/flags/us.svg') }}" alt="user-image"
                                                class="me-1 rounded-circle" height="20" /> <span
                                                class="align-middle">United States</span></p>
                                        <div>
                                            <h5 class="fw-semibold mb-0">67.5k</h5>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="progress progress-soft progress-sm">
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    style="width: 72.15%" aria-valuenow="72.15" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p class="mb-0 text-muted fs-13">72.15%</p>
                                        </div>
                                    </div>

                                    <!-- Country Data -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1"><img src="{{ asset('assets/images/flags/in.svg') }}" alt="user-image"
                                                class="me-1 rounded-circle" height="20" /> <span
                                                class="align-middle">India</span></p>
                                        <div>
                                            <h5 class="fw-semibold mb-0">7.92k</h5>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="progress progress-soft progress-sm">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 28.65%" aria-valuenow="28.65" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p class="mb-0 text-muted fs-13">28.65%</p>
                                        </div>
                                    </div>

                                    <!-- Country Data -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1"><img src="{{ asset('assets/images/flags/br.svg') }}" alt="user-image"
                                                class="me-1 rounded-circle" height="20" /> <span
                                                class="align-middle">Brazil</span></p>
                                        <div>
                                            <h5 class="fw-semibold mb-0">89.05k</h5>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <div class="progress progress-soft progress-sm">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 62.5%" aria-valuenow="62.5" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p class="mb-0 text-muted fs-13">62.5%</p>
                                        </div>
                                    </div>

                                    <!-- Country Data -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1"><img src="{{ asset('assets/images/flags/ca.svg') }}" alt="user-image"
                                                class="me-1 rounded-circle" height="20" /> <span
                                                class="align-middle">Canada</span></p>
                                        <div>
                                            <h5 class="fw-semibold mb-0">5.3k</h5>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="progress progress-soft progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 42.2%" aria-valuenow="42.2" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p class="mb-0 text-muted fs-13">42.2%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">
                            Top Traffic Sources
                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Shows which channels drive the most traffic."><i
                                    class="ti ti-info-circle text-muted ms-1"></i></span>
                        </h4>

                        <div class="dropdown ms-auto">
                            <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical fs-lg"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-chart-bar me-2"></i>
                                        View Detailed Report </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i>
                                        Export Traffic Data </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-filter-2 me-2"></i>
                                        Filter by Source </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"> <i class="ti ti-trash me-2"></i>
                                        Remove Widget </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/google.svg') }}" alt="user-image" class="me-1"
                                                height="24" />
                                            <span class="align-middle fw-semibold fs-md">Google</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">87.8k</span>
                                    </div>
                                    <div class="progress-data bg-warning" style="width: 72%"></div>
                                </div>
                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/instagram.svg') }}" alt="user-image" class="me-1"
                                                height="24" />
                                            <span class="align-middle fw-semibold fs-md">Instagram</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">42.9k</span>
                                    </div>
                                    <div class="progress-data bg-danger" style="width: 30%"></div>
                                </div>

                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/linkedin.svg') }}" alt="user-image" class="me-1"
                                                height="20" />
                                            <span class="align-middle fw-semibold fs-md">LinkedIn</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">58.5k</span>
                                    </div>
                                    <div class="progress-data bg-info" style="width: 43%"></div>
                                </div>

                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/dribbble.svg') }}" alt="user-image" class="me-1"
                                                height="24" />
                                            <span class="align-middle fw-semibold fs-md">Dribbble</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">2.85k</span>
                                    </div>
                                    <div class="progress-data bg-secondary" style="width: 12%"></div>
                                </div>

                                <div class="custom-progress">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/messenger.svg') }}" alt="user-image" class="me-1"
                                                height="24" />
                                            <span class="align-middle fw-semibold fs-md">Messenger</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">9.08k</span>
                                    </div>
                                    <div class="progress-data bg-primary" style="width: 18%"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/meta.svg') }}" alt="user-image" class="me-1"
                                                height="18" />
                                            <span class="align-middle fw-semibold fs-md">Meta</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">77.7k</span>
                                    </div>
                                    <div class="progress-data bg-primary" style="width: 66%"></div>
                                </div>
                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/telegram.svg') }}" alt="user-image" class="me-1"
                                                height="24" />
                                            <span class="align-middle fw-semibold fs-md">Telegram</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">31.5k</span>
                                    </div>
                                    <div class="progress-data bg-success" style="width: 46%"></div>
                                </div>

                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/x.svg') }}" alt="user-image" class="me-1"
                                                height="16" />
                                            <span class="align-middle fw-semibold fs-md">Twitter X</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">22.6k</span>
                                    </div>
                                    <div class="progress-data bg-dark" style="width: 29%"></div>
                                </div>

                                <div class="custom-progress mb-3">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/whatsapp.svg') }}" alt="user-image" class="me-1"
                                                height="24" />
                                            <span class="align-middle fw-semibold fs-md">WhatsApp</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">3.1k</span>
                                    </div>
                                    <div class="progress-data bg-danger" style="width: 18%"></div>
                                </div>

                                <div class="custom-progress">
                                    <div class="progress-info d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/images/logos/snapchat.svg') }}" alt="user-image" class="me-1"
                                                height="28" />
                                            <span class="align-middle fw-semibold fs-md">Snapchat</span>
                                        </div>
                                        <span class="fw-semibold text-muted float-end">5.8k</span>
                                    </div>
                                    <div class="progress-data bg-warning" style="width: 9%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">Sessions by Browser</h4>

                        <div class="dropdown ms-auto">
                            <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical fs-lg"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-report me-2"></i> View
                                        Browser Report </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i>
                                        Export Session Data </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-filter-2 me-2"></i>
                                        Filter Browsers </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"> <i class="ti ti-trash me-2"></i>
                                        Remove Widget </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body py-2 px-0">
                        <div class="px-2" data-simplebar style="height: 364px">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/chrome.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Chrome</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">62.5%</span>
                                <span class="fw-semibold text-muted float-end"><i
                                        class="ti ti-arrow-down text-danger"></i> 5.06%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/firefox.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Firefox</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">12.3%</span>
                                <span class="fw-semibold text-muted float-end"><i
                                        class="ti ti-arrow-down text-danger"></i> 1.5%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/safari.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Safari</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">9.86%</span>
                                <span class="fw-semibold text-muted float-end"><i class="ti ti-arrow-up text-success"></i>
                                    1.03%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/brave.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Brave</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">3.15%</span>
                                <span class="fw-semibold text-muted float-end"><i
                                        class="ti ti-arrow-down text-danger"></i> 0.3%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/opera.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Opera</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">3.01%</span>
                                <span class="fw-semibold text-muted float-end"><i class="ti ti-arrow-up text-success"></i>
                                    1.58%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/tor.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Tor</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">2.8%</span>
                                <span class="fw-semibold text-muted float-end"><i class="ti ti-arrow-up text-success"></i>
                                    0.01%</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/edge.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Edge</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">4.25%</span>
                                <span class="fw-semibold text-muted float-end"> <i
                                        class="ti ti-arrow-up text-success"></i> 0.75% </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div>
                                    <img src="{{ asset('assets/images/browsers/globe.svg') }}" alt="user-image" class="me-1"
                                        height="26" />
                                    <span class="align-middle fw-semibold fs-md">Other</span>
                                </div>
                                <span class="fw-semibold text-muted float-end">6.38%</span>
                                <span class="fw-semibold text-muted float-end"><i class="ti ti-arrow-up text-success"></i>
                                    3.6%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div data-table data-table-rows-per-page="5" class="card">
                    <div class="card-header border-light justify-content-between">
                        <h4 class="card-title">Page Analytics Overview</h4>

                        <div class="d-flex align-items-center gap-2">
                            <!-- Delete Selected -->
                            <button data-table-delete-selected class="btn btn-danger d-none">Delete Selected</button>

                            <!-- Search -->
                            <div class="app-search">
                                <input data-table-search type="text" class="form-control"
                                    placeholder="Search pages..." />
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

                    <div class="table-responsive">
                        <table class="table table-custom table-centered table-hover w-100 mb-0">
                            <thead class="bg-light bg-opacity-25 thead-sm">
                                <tr class="text-uppercase table-nowrap fs-xxs">
                                    <th scope="col" style="width: 1%">
                                        <input data-table-select-all
                                            class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" />
                                    </th>
                                    <th data-table-sort>Page Path</th>
                                    <th data-table-sort>Top Referral Source</th>
                                    <th data-table-sort>Page Views</th>
                                    <th data-table-sort>Avg Time on Page</th>
                                    <th data-table-sort>Bounce Rate</th>
                                    <th data-table-sort>Conversion Rate</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/dashboard</td>
                                    <td>Direct</td>
                                    <td><i class="ti ti-eye me-1"></i> 3,980</td>
                                    <td><i class="ti ti-clock me-1"></i> 02m:12s</td>
                                    <td>19.5%</td>
                                    <td>4.3%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/pricing</td>
                                    <td>Google</td>
                                    <td><i class="ti ti-eye me-1"></i> 1,742</td>
                                    <td><i class="ti ti-clock me-1"></i> 01m:49s</td>
                                    <td>22.1%</td>
                                    <td>6.7%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/features</td>
                                    <td>LinkedIn</td>
                                    <td><i class="ti ti-eye me-1"></i> 2,310</td>
                                    <td><i class="ti ti-clock me-1"></i> 02m:05s</td>
                                    <td>17.8%</td>
                                    <td>5.4%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/blog/how-to-boost-sales</td>
                                    <td>Twitter</td>
                                    <td><i class="ti ti-eye me-1"></i> 1,128</td>
                                    <td><i class="ti ti-clock me-1"></i> 03m:14s</td>
                                    <td>14.9%</td>
                                    <td>2.2%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 5 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/docs/get-started</td>
                                    <td>Reddit</td>
                                    <td><i class="ti ti-eye me-1"></i> 2,540</td>
                                    <td><i class="ti ti-clock me-1"></i> 04m:01s</td>
                                    <td>11.2%</td>
                                    <td>7.9%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 6 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/signup</td>
                                    <td>Newsletter</td>
                                    <td><i class="ti ti-eye me-1"></i> 3,780</td>
                                    <td><i class="ti ti-clock me-1"></i> 02m:29s</td>
                                    <td>28.5%</td>
                                    <td>9.1%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 7 -->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/account/settings</td>
                                    <td>Instagram</td>
                                    <td><i class="ti ti-eye me-1"></i> 1,690</td>
                                    <td><i class="ti ti-clock me-1"></i> 01m:36s</td>
                                    <td>16.3%</td>
                                    <td>3.9%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 8-->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/reports/weekly-performance</td>
                                    <td>Direct</td>
                                    <td><i class="ti ti-eye me-1"></i> 2,245</td>
                                    <td><i class="ti ti-clock me-1"></i> 02m:08s</td>
                                    <td>17.2%</td>
                                    <td>4.1%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 9-->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/help/faq</td>
                                    <td>Google</td>
                                    <td><i class="ti ti-eye me-1"></i> 3,015</td>
                                    <td><i class="ti ti-clock me-1"></i> 01m:23s</td>
                                    <td>23.9%</td>
                                    <td>2.8%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 10-->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/products</td>
                                    <td>Instagram</td>
                                    <td><i class="ti ti-eye me-1"></i> 4,680</td>
                                    <td><i class="ti ti-clock me-1"></i> 02m:51s</td>
                                    <td>18.4%</td>
                                    <td>6.3%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 11-->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/downloads</td>
                                    <td>Referral</td>
                                    <td><i class="ti ti-eye me-1"></i> 1,395</td>
                                    <td><i class="ti ti-clock me-1"></i> 03m:22s</td>
                                    <td>13.6%</td>
                                    <td>7.4%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 12-->
                                <tr>
                                    <td><input class="form-check-input form-check-input-light fs-14 mt-0"
                                            type="checkbox" /></td>
                                    <td>/contact</td>
                                    <td>Facebook</td>
                                    <td><i class="ti ti-eye me-1"></i> 2,920</td>
                                    <td><i class="ti ti-clock me-1"></i> 01m:41s</td>
                                    <td>21.7%</td>
                                    <td>3.6%</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="javascript:void(0);" data-table-delete-row
                                                class="btn btn-default btn-icon btn-sm"><i
                                                    class="ti ti-trash fs-lg"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div data-table-pagination-info="entries"></div>

                            <div data-table-pagination></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-->
        </div>
        <!-- row-->
    </div>
    <!-- container -->
@endsection
