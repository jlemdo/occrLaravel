@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/dropzone/dropzone.min.css')}}" rel="stylesheet">

@endpush

<nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
            <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
            <li class="breadcrumb-item active">Default</li>
          </ol>
        </nav>
        <div class="pb-9">
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col-12 col-md-auto">
              <h2 class="mb-0">Deal details</h2>
            </div>
            <div class="col-12 col-md-auto d-flex">
              <button class="btn btn-phoenix-secondary px-3 px-sm-5 me-2"><span class="fa-solid fa-edit me-sm-2"></span><span class="d-none d-sm-inline">Edit		</span></button>
              <button class="btn btn-phoenix-danger me-2"><span class="fa-solid fa-trash me-2"></span><span>Delete Deal</span></button>
              <div>
                <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                <ul class="dropdown-menu dropdown-menu-end p-0" style="z-index: 9999;">
                  <li><a class="dropdown-item" href="#!">View profile</a></li>
                  <li><a class="dropdown-item" href="#!">Report</a></li>
                  <li><a class="dropdown-item" href="#!">Manage notifications</a></li>
                  <li><a class="dropdown-item text-danger" href="#!">Delete Lead</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row g-4 g-xl-6">
            <div class="col-xl-5 col-xxl-4">
              <div class="sticky-leads-sidebar">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row align-items-center g-3">
                      <div class="col-12 col-sm-auto flex-1">
                        <h3 class="fw-bolder mb-2 line-clamp-1">Start-Up Growth Suite</h3>
                        <div class="d-flex align-items-center mb-4">
                          <h5 class="mb-0 me-4">USD $12,000.00</h5>
                          <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1" data-feather="grid" style="height:16px;width:16px;"></span><span class="d-inline-block lh-sm">Financial</span></h5>
                        </div>
                        <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                          <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                            <div class="avatar avatar-xl me-3"><img class="rounded-circle" src="../../assets/img/team/72x72/58.webp" alt="" /></div>
                            <div>
                              <h5>Ansolo Lazinatov</h5>
                              <div class="dropdown"><a class="text-800 dropdown-toggle text-decoration-none dropdown-caret-none" href="#!" data-bs-toggle="dropdown" aria-expanded="false">
                                  Owner<span class="fa-solid fa-caret-down text-800 fs--1 ms-2"></span></a>
                                <div class="dropdown-menu shadow-sm" style="min-width:20rem">
                                  <div class="card position-relative border-0">
                                    <div class="card-body p-0">
                                      <div class="mx-3">
                                        <h4 class="mb-3 fw-bold">Switch ownership</h4>
                                        <h5 class="mb-3">Deal Owner</h5>
                                        <select class="form-select mb-3" aria-label="Default select">
                                          <option selected="selected">Select</option>
                                          <option value="1">Jerry Seinfield</option>
                                          <option value="2">Anthoney Michael</option>
                                          <option value="3">Ansolo Lazinatov</option>
                                        </select>
                                        <div class="text-end">
                                          <button class="btn btn-link text-danger" type="button">Cancel</button>
                                          <button class="btn btn-sm btn-primary px-5" type="button">Save</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div><span class="badge badge-phoenix badge-phoenix-success me-2">Success</span><span class="badge badge-phoenix badge-phoenix-danger me-2">Lost</span><span class="badge badge-phoenix badge-phoenix-secondary">Close</span></div>
                        </div>
                        <div class="progress mb-2" style="height:5px">
                          <div class="progress-bar bg-primary-200" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <p class="mb-0"> New</p>
                          <div><span class="d-inline-block lh-sm me-1" data-feather="clock" style="height:16px;width:16px;"></span><span class="d-inline-block lh-sm"> Dec 15, 05:00AM</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h4 class="mb-5">Others Information</h4>
                    <div class="row g-3">
                      <div class="col-12">
                        <div class="mb-4">
                          <div class="d-flex flex-wrap justify-content-between mb-2">
                            <h5 class="mb-0 text-1000 me-2">Category</h5><a class="fw-bold fs--1" href="#!">Add new category</a>
                          </div>
                          <select class="form-select mb-3" aria-label="category">
                            <option value="financial">Financial</option>
                            <option value="marketplace">Marketplace</option>
                            <option value="travel">Travel</option>
                            <option value="e-commerce">E-commerce</option>
                            <option value="cloud-computing">Cloud Computing</option>
                          </select>
                        </div>
                        <div class="mb-4">
                          <h5 class="mb-0 text-1000 mb-2">Priority</h5>
                          <select class="form-select mb-3" aria-label="priority">
                            <option value="low">Low</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="urgent">Urgent</option>
                          </select>
                        </div>
                        <div class="mb-4">
                          <h5 class="mb-0 text-1000 mb-2">Stage</h5>
                          <select class="form-select mb-3" aria-label="stage">
                            <option value="new">New</option>
                            <option value="in-progress">In Progress</option>
                            <option value="pending">Pending</option>
                            <option value="canceled">Canceled</option>
                            <option value="completed">Completed</option>
                          </select>
                        </div>
                        <div class="mb-4">
                          <div class="d-flex flex-wrap justify-content-between mb-2">
                            <h5 class="mb-0 text-1000 me-2">Lead Source</h5><a class="fw-bold fs--1" href="#!">Add new</a>
                          </div>
                          <select class="form-select mb-3" aria-label="lead-source">
                            <option value="referrals">Referrals</option>
                            <option value="former_clients">Former Clients</option>
                            <option value="competitors">Competitors</option>
                            <option value="business_sales">Business &amp; sales</option>
                            <option value="google_resources">Google resources</option>
                            <option value="linkedin">Linkedin</option>
                            <option value="marketing">Marketing</option>
                          </select>
                        </div>
                        <div>
                          <div class="d-flex flex-wrap justify-content-between mb-2">
                            <h5 class="mb-0 text-1000 me-2">Campaign Source</h5><a class="fw-bold fs--1" href="#!">Add new</a>
                          </div>
                          <select class="form-select" aria-label="lead-source">
                            <option value="online_campaign">Online Campaign</option>
                            <option value="offline_campaign">Offline Campaign</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-7 col-xxl-8">
              <div class="card mb-5">
                <div class="card-body">
                  <div class="row g-4 g-xl-1 g-xxl-3 justify-content-between">
                    <div class="col-sm-auto">
                      <div class="d-sm-block d-inline-flex d-md-flex flex-xl-column flex-xxl-row align-items-center align-items-xl-start align-items-xxl-center">
                        <div class="d-flex bg-success-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px"><span class="text-success-600 dark__text-success-300" data-feather="dollar-sign" style="width:24px; height:24px"></span></div>
                        <div>
                          <p class="fw-bold mb-1">Deal Amount</p>
                          <h4 class="fw-bolder text-nowrap">$12,000.00</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-auto">
                      <div class="d-sm-block d-inline-flex d-md-flex flex-xl-column flex-xxl-row align-items-center align-items-xl-start align-items-xxl-center border-start-sm ps-sm-5">
                        <div class="d-flex bg-info-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px"><span class="text-info-600 dark__text-info-300" data-feather="code" style="width:24px; height:24px"></span></div>
                        <div>
                          <p class="fw-bold mb-1">Deal Code</p>
                          <h4 class="fw-bolder text-nowrap">PHO1234</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-auto">
                      <div class="d-sm-block d-inline-flex d-md-flex flex-xl-column flex-xxl-row align-items-center align-items-xl-start align-items-xxl-center border-start-sm ps-sm-5">
                        <div class="d-flex bg-primary-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px"><span class="text-primary-600 dark__text-primary-300" data-feather="layout" style="width:24px; height:24px"></span></div>
                        <div>
                          <p class="fw-bold mb-1">Deal Type</p>
                          <h4 class="fw-bolder text-nowrap">New Business</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-xl-4 mb-7">
                <div class="row mx-0 mx-sm-3 mx-lg-0 px-lg-0">
                  <div class="col-sm-12 col-xxl-6 border-bottom border-end-xxl py-3">
                    <table class="w-100 table-stats table-stats">
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-inline-flex align-items-center">
                            <div class="d-flex bg-success-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-success-600 dark__text-success-300" data-feather="bar-chart-2" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Probability (%)</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2">
                          <p class="ps-6 ps-sm-0 fw-semi-bold mb-0 mb-0 pb-3 pb-sm-0">12.5</p>
                        </td>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-flex align-items-center">
                            <div class="d-flex bg-info-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-info-600 dark__text-info-300" data-feather="trending-up" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Revenue</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2">
                          <p class="ps-6 ps-sm-0 fw-semi-bold mb-0">$1,500.00</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm-12 col-xxl-6 border-bottom py-3">
                    <table class="w-100 table-stats">
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-inline-flex align-items-center">
                            <div class="d-flex bg-primary-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-primary-600 dark__text-primary-300" data-feather="phone" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Phone</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2"><a class="ps-6 ps-sm-0 fw-semi-bold mb-0 pb-3 pb-sm-0 text-900" href="tel:+11123456789">+11 123 456 789</a></td>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-flex align-items-center">
                            <div class="d-flex bg-warning-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-warning-600 dark__text-warning-300" data-feather="mail" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Email</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2"><a class="ps-6 ps-sm-0 fw-semi-bold mb-0 text-900" href="mailto:jacksonpol@email.com">jacksonpol@email.com</a></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm-12 col-xxl-6 border-end-xxl border-bottom border-bottom-xxl-0 py-3">
                    <table class="w-100 table-stats">
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-inline-flex align-items-center">
                            <div class="d-flex bg-success-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-success-600 dark__text-success-300" data-feather="users" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Contact Name</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2">
                          <div class="ps-6 ps-sm-0 fw-semi-bold mb-0 pb-3 pb-sm-0">Jackson Pollock</div>
                        </td>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-flex align-items-center">
                            <div class="d-flex bg-info-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-info-600 dark__text-info-300" data-feather="edit" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Modified By</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2">
                          <div class="ps-6 ps-sm-0 fw-semi-bold mb-0">Ansolo Lazinatov</div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm-12 col-xxl-6 py-3">
                    <table class="w-100 table-stats">
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-inline-flex align-items-center">
                            <div class="d-flex bg-info-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-info-600 dark__text-info-300" data-feather="clock" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Create Date</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2">
                          <div class="ps-6 ps-sm-0 fw-semi-bold mb-0 pb-3 pb-sm-0">Nov 30, 2022</div>
                        </td>
                      </tr>
                      <tr>
                        <td class="py-2">
                          <div class="d-flex align-items-center">
                            <div class="d-flex bg-warning-100 rounded-circle flex-center me-3" style="width:24px; height:24px"><span class="text-warning-600 dark__text-warning-300" data-feather="clock" style="width:16px; height:16px"></span></div>
                            <p class="fw-bold mb-0">Closing Date</p>
                          </div>
                        </td>
                        <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                        <td class="py-2">
                          <div class="ps-6 ps-sm-0 fw-semi-bold mb-0">Dec 15, 2022</div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <ul class="nav nav-underline deal-details scrollbar flex-nowrap w-100 pb-1 mb-6" id="myTab" role="tablist" style="overflow-y: hidden;">
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link active" id="activity-tab" data-bs-toggle="tab" href="#tab-activity" role="tab" aria-controls="tab-activity" aria-selected="false" tabindex="-1"> <span class="fa-solid fa-chart-line me-2 tab-icon-color"></span>Activity</a></li>
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link" id="notes-tab" data-bs-toggle="tab" href="#tab-notes" role="tab" aria-controls="tab-notes" aria-selected="false" tabindex="-1"> <span class="fa-solid fa-clipboard me-2 tab-icon-color"></span>Notes</a></li>
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link" id="meeting-tab" data-bs-toggle="tab" href="#tab-meeting" role="tab" aria-controls="tab-meeting" aria-selected="true"> <span class="fa-solid fa-video me-2 tab-icon-color"></span>Meeting</a></li>
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link" id="task-tab" data-bs-toggle="tab" href="#tab-task" role="tab" aria-controls="tab-task" aria-selected="true"> <span class="fa-solid fa-square-check me-2 tab-icon-color"></span>Task</a></li>
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link" id="call-tab" data-bs-toggle="tab" href="#tab-call" role="tab" aria-controls="tab-call" aria-selected="true"> <span class="fa-solid fa-phone me-2 tab-icon-color"></span>Call</a></li>
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link" id="emails-tab" data-bs-toggle="tab" href="#tab-emails" role="tab" aria-controls="tab-emails" aria-selected="true"> <span class="fa-solid fa-envelope me-2 tab-icon-color"></span>Emails </a></li>
                <li class="nav-item text-nowrap me-2" role="presentation"><a class="nav-link" id="attachments-tab" data-bs-toggle="tab" href="#tab-attachments" role="tab" aria-controls="tab-attachments" aria-selected="true"> <span class="fa-solid fa-paperclip me-2 tab-icon-color"></span>Attachments</a></li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="tab-activity" role="tabpanel" aria-labelledby="activity-tab">
                  <h2 class="mb-4">Activity</h2>
                  <div class="row align-items-center g-3 justify-content-between justify-content-start">
                    <div class="col-12 col-sm-auto">
                      <div class="search-box mb-2 mb-sm-0">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                          <input class="form-control search-input search" type="search" placeholder="Search Activity" aria-label="Search" />
                          <span class="fas fa-search search-box-icon"></span>

                        </form>
                      </div>
                    </div>
                    <div class="col-auto">
                      <button class="btn btn-phoenix-primary px-6">Add Activity</button>
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                    <div class="d-flex">
                      <div class="d-flex bg-primary-100 rounded-circle flex-center me-3 bg-primary-100" style="width:25px; height:25px"><span class="fa-solid text-primary-600 dark__text-primary-300 fs--1 fa-clipboard text-primary-600 dark__text-primary-300"></span></div>
                      <div class="flex-1">
                        <div class="d-flex justify-content-between flex-column flex-xl-row mb-2 mb-sm-0">
                          <div class="flex-1 me-2">
                            <h5 class="text-1000 lh-sm">Assigned as a director for Project The Chewing Gum Attack</h5>
                            <p class="fs--1 mb-0">by<a class="ms-1" href="#!">Jackson Pollock</a></p>
                          </div>
                          <div class="fs--1"><span class="fa-regular fa-calendar-days text-primary me-2"></span><span class="fw-semi-bold">22 September, 2022, 4:33 PM</span></div>
                        </div>
                        <p class="fs--1 mb-0">Utilizing best practices to better leverage our assets, we must engage in black sky leadership thinking, not the usual band-aid solution. </p>
                      </div>
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                    <div class="d-flex">
                      <div class="d-flex bg-primary-100 rounded-circle flex-center me-3 bg-info-100" style="width:25px; height:25px"><span class="fa-solid text-primary-600 dark__text-primary-300 fs--1 fa-video text-info-600 dark__text-info-300"></span></div>
                      <div class="flex-1">
                        <div class="d-flex justify-content-between flex-column flex-xl-row mb-2 mb-sm-0">
                          <div class="flex-1 me-2">
                            <h5 class="text-1000 lh-sm">Onboarding Meeting</h5>
                            <p class="fs--1 mb-0">by<a class="ms-1" href="#!">Jackson Pollock</a></p>
                          </div>
                          <div class="fs--1"><span class="fa-regular fa-calendar-days text-primary me-2"></span><span class="fw-semi-bold">20 September, 2022, 5:31pm</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                    <div class="d-flex">
                      <div class="d-flex bg-primary-100 rounded-circle flex-center me-3 bg-success-100" style="width:25px; height:25px"><span class="fa-solid text-primary-600 dark__text-primary-300 fs--1 fa-square-check text-success-600 dark__text-success-300"></span></div>
                      <div class="flex-1">
                        <div class="d-flex justify-content-between flex-column flex-xl-row mb-2 mb-sm-0">
                          <div class="flex-1 me-2">
                            <h5 class="text-1000 lh-sm">Designing the dungeon</h5>
                            <p class="fs--1 mb-0">by<a class="ms-1" href="#!">Jackson Pollock</a></p>
                          </div>
                          <div class="fs--1"><span class="fa-regular fa-calendar-days text-primary me-2"></span><span class="fw-semi-bold">19 September, 2022, 4:39pm </span></div>
                        </div>
                        <p class="fs--1 mb-0">To get off the runway and paradigm shift, we should take brass tacks with above-the-board actionable analytics, ramp up with viral partnering, not the usual goat rodeo putting socks on an octopus. </p>
                      </div>
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                    <div class="d-flex">
                      <div class="d-flex bg-primary-100 rounded-circle flex-center me-3 bg-warning-100" style="width:25px; height:25px"><span class="fa-solid text-primary-600 dark__text-primary-300 fs--1 fa-phone-alt text-warning-600 dark__text-warning-300"></span></div>
                      <div class="flex-1">
                        <div class="d-flex justify-content-between flex-column flex-xl-row mb-2 mb-sm-0">
                          <div class="flex-1 me-2">
                            <h5 class="text-1000 lh-sm">Purchasing-Related Vendors</h5>
                            <p class="fs--1 mb-0">by<a class="ms-1" href="#!">Ansolo Lazinatov</a></p>
                          </div>
                          <div class="fs--1"><span class="fa-regular fa-calendar-days text-primary me-2"></span><span class="fw-semi-bold">22 September, 2022, 4:30pm</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                    <div class="d-flex">
                      <div class="d-flex bg-primary-100 rounded-circle flex-center me-3 bg-danger-100" style="width:25px; height:25px"><span class="fa-solid text-primary-600 dark__text-primary-300 fs--1 fa-envelope text-danger-600 dark__text-danger-300"></span></div>
                      <div class="flex-1">
                        <div class="d-flex justify-content-between flex-column flex-xl-row mb-2 mb-sm-0">
                          <div class="flex-1 me-2">
                            <h5 class="text-1000 lh-sm">Quary about purchased soccer socks</h5>
                            <p class="fs--1 mb-0">by<a class="ms-1" href="#!">Ansolo Lazinatov</a></p>
                          </div>
                          <div class="fs--1"><span class="fa-regular fa-calendar-days text-primary me-2"></span><span class="fw-semi-bold">15 September, 2022, 3:33pm</span></div>
                        </div>
                        <p class="fs--1 mb-0">I’ve come across your posts and found some favorable deals on your page. I’ve added a load of products to the cart and I don’t know the payment options you avail. Also, can you enlighten me about any discount.</p>
                      </div>
                    </div>
                  </div>
                  <div class="pt-4">
                    <div class="d-flex">
                      <div class="d-flex bg-primary-100 rounded-circle flex-center me-3 bg-primary-100" style="width:25px; height:25px"><span class="fa-solid text-primary-600 dark__text-primary-300 fs--1 fa-paperclip text-primary-600 dark__text-primary-300"></span></div>
                      <div class="flex-1">
                        <div class="d-flex justify-content-between flex-column flex-xl-row mb-2 mb-sm-0">
                          <div class="flex-1 me-2">
                            <h5 class="text-1000 lh-sm">Added image</h5>
                            <p class="fs--1 mb-0">by<a class="ms-1" href="#!">Ansolo Lazinatov</a></p>
                          </div>
                          <div class="fs--1"><span class="fa-regular fa-calendar-days text-primary me-2"></span><span class="fw-semi-bold">11 September, 2022, 12:15am </span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab-notes" role="tabpanel" aria-labelledby="notes-tab">
                  <h2 class="mb-4">Notes</h2>
                  <textarea class="form-control mb-3" id="notes" rows="4"> </textarea>
                  <div class="row gy-4">
                    <div class="col-12 col-xl-auto flex-1">
                      <div class="border-2 border-dashed mb-4 pb-4 border-bottom">
                        <p class="mb-1 text-1000">Gave us a nice feedback</p>
                        <div class="d-flex">
                          <div class="fs--1 text-600"><span class="fa-solid fa-clock me-2"></span><span class="fw-semi-bold me-1">clock 12 Nov, 2018</span></div>
                          <p class="fs--1 mb-0 text-600">by<a class="ms-1 fw-semi-bold" href="#!">Ansolo Lazinatov</a></p>
                        </div>
                      </div>
                      <div class="border-2 border-dashed mb-4 pb-4 border-bottom">
                        <p class="mb-1 text-1000">I also want to let you know that I am available to you as your real estate insider from now on. If you have any questions about the market, even if they sound silly, call or text anytime. </p>
                        <div class="d-flex">
                          <div class="fs--1 text-600"><span class="fa-solid fa-clock me-2"></span><span class="fw-semi-bold me-1"> 30 Jan, 2019</span></div>
                          <p class="fs--1 mb-0 text-600">by<a class="ms-1 fw-semi-bold" href="#!">Ansolo Lazinatov</a></p>
                        </div>
                      </div>
                      <div class="border-2 border-dashed mb-4 pb-4 border-bottom">
                        <p class="mb-1 text-1000">To get off the runway and paradigm shift, we should take brass tacks with above-the-board actionable analytics, ramp up with viral partnering, not the usual goat rodeo putting socks on an octopus. </p>
                        <div class="d-flex">
                          <div class="fs--1 text-600"><span class="fa-solid fa-clock me-2"></span><span class="fw-semi-bold me-1">19 September, 2022, 4:39pm </span></div>
                          <p class="fs--1 mb-0 text-600">by<a class="ms-1 fw-semi-bold" href="#!">Jackson Pollock</a></p>
                        </div>
                      </div>
                      <div class="border-2 border-dashed">
                        <p class="mb-1 text-1000">Utilizing best practices to better leverage our assets, we must engage in black sky leadership thinking, not the usual band-aid solution. </p>
                        <div class="d-flex">
                          <div class="fs--1 text-600"><span class="fa-solid fa-clock me-2"></span><span class="fw-semi-bold me-1">22 September, 2022, 4:30pm</span></div>
                          <p class="fs--1 mb-0 text-600">by<a class="ms-1 fw-semi-bold" href="#!">Ansolo Lazinatov</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab-meeting" role="tabpanel" aria-labelledby="meeting-tab">
                  <h2 class="mb-4">Meeting</h2>
                  <div class="row align-items-center g-2 flex-wrap justify-content-start mb-3">
                    <div class="col-12 col-sm-auto">
                      <div class="search-box mb-2 mb-sm-0">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                          <input class="form-control search-input search" type="search" placeholder="Search meeting" aria-label="Search" />
                          <span class="fas fa-search search-box-icon"></span>

                        </form>
                      </div>
                    </div>
                    <div class="col-auto d-flex flex-md-grow-1">
                      <p class="mb-0 fs--1 text-700 fw-bold"><span class="fas fa-filter me-1 fw-extra-bold fs--2"></span>23 tasks</p>
                      <button class="btn btn-link p-0 ms-3 fs--1 text-primary fw-bold text-decoration-none"><span class="fas fa-sort me-1 fw-extra-bold fs--2"></span>Sorting</button>
                    </div>
                    <div class="col-auto">
                      <button class="btn btn-primary"><span class="fa-solid fa-plus me-2"></span>Add Meeting </button>
                    </div>
                  </div>
                  <div class="row g-3">
                    <div class="col-xxl-6">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-start flex-wrap mb-4 gap-2">
                            <div class="mb-3 mb-sm-0">
                              <h4 class="line-clamp-1 mb-2 mb-sm-1">Onboarding Meeting</h4>
                              <div><span class="uil uil-calendar-alt text-primary me-2"></span><span class="fw-semi-bold text-800 fs--1">5:30 pm</span><span class="text-600"> to</span><span class="fw-semi-bold text-800 fs--1">7:00pm</span><span class="text-800 fs--1"> - 1h 30min</span></div>
                            </div>
                            <div class="avatar-group avatar-group-dense">
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/9.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/25.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/32.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/35.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <div class="avatar-name rounded-circle "><span>+1</span></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center"><span class="badge badge-phoenix me-2 badge-phoenix-primary ">today</span>
                            <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-circle me-1 text-danger" data-fa-transform="shrink-6 up-1"></span><span class="fw-bold fs--1 text-900">Urgent</span></div>
                            <button class="btn btn-phoenix-primary"><span class="fa-solid fa-video me-2 d-none d-sm-inline-block"></span>Join</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xxl-6">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-start flex-wrap mb-4 gap-2">
                            <div class="mb-3 mb-sm-0">
                              <h4 class="line-clamp-1 mb-2 mb-sm-1">Agile Mindset Meetup</h4>
                              <div><span class="uil uil-calendar-alt text-primary me-2"></span><span class="fw-semi-bold text-800 fs--1">4:30 pm</span><span class="text-600"> to</span><span class="fw-semi-bold text-800 fs--1">6:00pm</span><span class="text-800 fs--1"> - 1h 30min</span></div>
                            </div>
                            <div class="avatar-group avatar-group-dense">
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/11.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/26.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/33.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/30.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <div class="avatar-name rounded-circle "><span>+1</span></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center"><span class="badge badge-phoenix me-2 badge-phoenix-warning">tomorrow</span>
                            <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-circle me-1 text-success" data-fa-transform="shrink-6 up-1"></span><span class="fw-bold fs--1 text-900">Medium</span></div>
                            <button class="btn btn-phoenix-primary"><span class="fa-solid fa-video me-2 d-none d-sm-inline-block"></span>Join</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xxl-6">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-start flex-wrap mb-4 gap-2">
                            <div class="mb-3 mb-sm-0">
                              <h4 class="line-clamp-1 mb-2 mb-sm-1">Meeting Fundamentals</h4>
                              <div><span class="uil uil-calendar-alt text-primary me-2"></span><span class="fw-semi-bold text-800 fs--1">6:00 pm</span><span class="text-600"> to</span><span class="fw-semi-bold text-800 fs--1">7:20pm</span><span class="text-800 fs--1"> - 1h 20min</span></div>
                            </div>
                            <div class="avatar-group avatar-group-dense">
                              <div class="avatar avatar-s  rounded-circle">
                                <div class="avatar-name rounded-circle"><span>R</span></div>
                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/12.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/28.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/22.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <div class="avatar-name rounded-circle "><span>+2</span></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center"><span class="badge badge-phoenix me-2 badge-phoenix-warning">tomorrow</span>
                            <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-circle me-1 text-warning" data-fa-transform="shrink-6 up-1"></span><span class="fw-bold fs--1 text-900">High</span></div>
                            <button class="btn btn-phoenix-primary"><span class="fa-solid fa-video me-2 d-none d-sm-inline-block"></span>Join</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xxl-6">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-start flex-wrap mb-4 gap-2">
                            <div class="mb-3 mb-sm-0">
                              <h4 class="line-clamp-1 mb-2 mb-sm-1">Design System Meeting</h4>
                              <div><span class="uil uil-calendar-alt text-primary me-2"></span><span class="fw-semi-bold text-800 fs--1">7:30 pm</span><span class="text-600"> to</span><span class="fw-semi-bold text-800 fs--1">8:45pm</span><span class="text-800 fs--1"> - 1h 45min</span></div>
                            </div>
                            <div class="avatar-group avatar-group-dense">
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/13.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/24.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/62.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <img class="rounded-circle " src="../../assets/img/team/34.webp" alt="" />

                              </div>
                              <div class="avatar avatar-s  rounded-circle">
                                <div class="avatar-name rounded-circle "><span>+4</span></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center"><span class="badge badge-phoenix me-2 badge-phoenix-warning">tomorrow</span>
                            <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-circle me-1 text-info" data-fa-transform="shrink-6 up-1"></span><span class="fw-bold fs--1 text-900">Low</span></div>
                            <button class="btn btn-phoenix-primary"><span class="fa-solid fa-video me-2 d-none d-sm-inline-block"></span>Join</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab-task" role="tabpanel" aria-labelledby="task-tab">
                  <h2 class="mb-4">Tasks</h2>
                  <div class="row align-items-center g-0 justify-content-start mb-3">
                    <div class="col-12 col-sm-auto">
                      <div class="search-box w-100 mb-2 mb-sm-0" style="max-width:30rem;">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                          <input class="form-control search-input search" type="search" placeholder="Search tasks" aria-label="Search" />
                          <span class="fas fa-search search-box-icon"></span>

                        </form>
                      </div>
                    </div>
                    <div class="col-auto d-flex">
                      <p class="mb-0 ms-sm-3 fs--1 text-700 fw-bold"><span class="fas fa-filter me-1 fw-extra-bold fs--2"></span>23 tasks</p>
                      <button class="btn btn-link p-0 ms-3 fs--1 text-primary fw-bold"><span class="fas fa-sort me-1 fw-extra-bold fs--2"></span>Sorting</button>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-1">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-0" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-0">Platforms for data administration</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">19 Nov, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">11:56 PM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-2">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-1" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-1">Make wiser business choices.</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">05 Nov, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">09:30 PM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-3">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-2" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-2">Market and consumer insights</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">02 Nov, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">05:25 AM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-4">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-3" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-3">Dashboards for business insights</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">29 Oct, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">08:21 PM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-5">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-4" checked="checked" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-4">Analytics and consultancy for data</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">21 Oct, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">03:45 PM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-6">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-5" checked="checked" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-5">Planning your locations Customer data platform</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">14 Oct, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">10:00 PM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
                    <div class="col-12 col-lg-auto flex-1">
                      <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-7">
                        <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                          <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-6" checked="checked" />
                          <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-6">Promotion of technology</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <div class="d-flex ms-4 lh-1 align-items-center">
                        <p class="text-700 fs--2 mb-md-0 me-2 me-lg-3 mb-0">12 Oct, 2022</p>
                        <div class="d-none d-lg-block end-0 position-absolute" style="top: 23%;">
                          <div class="hover-actions end-0">
                            <button class="btn btn-phoenix-secondary btn-icon me-1 fs--2 text-900 px-0 me-1"><span class="fas fa-edit"></span></button>
                            <button class="btn btn-phoenix-secondary btn-icon fs--2 text-danger px-0"><span class="fas fa-trash"></span></button>
                          </div>
                        </div>
                        <div class="hover-lg-hide">
                          <p class="text-700 fs--2 ps-lg-3 border-start-lg border-300 fw-bold mb-md-0 mb-0">02:00 AM</p>
                        </div>
                      </div>
                    </div>
                  </div><a class="fw-bold fs--1 mt-4" href="#!"><span class="fas fa-plus me-1"></span>Add new task</a>
                </div>
                <div class="tab-pane fade" id="tab-call" role="tabpanel" aria-labelledby="call-tab">
                  <div class="row align-items-center gx-4 gy-3 flex-wrap mb-3">
                    <div class="col-auto d-flex flex-1">
                      <h2 class="mb-0">Call</h2>
                    </div>
                    <div class="col-auto">
                      <div class="d-flex gap-3 gap-sm-4">
                        <div class="form-check">
                          <input class="form-check-input" id="allCall" type="radio" name="allCall" checked="checked" />
                          <label class="form-check-label" for="allCall">All Call</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" id="incomingCall" type="radio" name="allCall" />
                          <label class="form-check-label" for="incomingCall">Incoming Call</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" id="outgoingCall" type="radio" name="allCall" />
                          <label class="form-check-label" for="outgoingCall">OutgoingCall</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <button class="btn btn-primary"><span class="fa-solid fa-plus me-2"></span>Add Call</button>
                    </div>
                  </div>
                  <div class="border-top border-bottom border-200" id="leadDetailsTable" data-list='{"valueNames":["name","description","create_date","create_by","last_activity"],"page":5,"pagination":true}'>
                    <div class="table-responsive scrollbar mx-n1 px-1">
                      <table class="table fs--1 mb-0">
                        <thead>
                          <tr>
                            <th class="white-space-nowrap fs--1 align-middle ps-0" style="width:26px;">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select='{"body":"lead-details-table-body"}' />
                              </div>
                            </th>
                            <th class="sort white-space-nowrap align-middle pe-3 ps-0 text-uppercase" scope="col" data-sort="name" style="width:20%; min-width:100px">Name</th>
                            <th class="sort align-middle pe-6 text-uppercase" scope="col" data-sort="description" style="width:20%; max-width:60px">description</th>
                            <th class="sort align-middle text-start text-uppercase" scope="col" data-sort="create_date" style="width:20%; min-width:115px">create date</th>
                            <th class="sort align-middle text-start text-uppercase" scope="col" data-sort="create_by" style="width:20%; min-width:150px">create by</th>
                            <th class="sort align-middle ps-0 text-end text-uppercase" scope="col" data-sort="last_activity" style="width:20%; max-width:115px">Last Activity</th>
                            <th class="align-middle pe-0 text-end" scope="col" style="width:15%;"></th>
                          </tr>
                        </thead>
                        <tbody class="list" id="lead-details-table-body">
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs--1 align-middle px-0 py-3">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select-row='{"Name":{"avatar":"/team/35.webp","name":"Ansolo Lazinatov","status":"online"},"description":"Purchasing-Related Vendors","date":"Dec 29, 2021","creatBy":"Ansolo Lazinarov","lastActivity":{"iconColor":"text-success","label":"Active"}}' />
                              </div>
                            </td>
                            <td class="name align-middle white-space-nowrap py-2 ps-0"><a class="d-flex align-items-center text-1000" href="#!">
                                <div class="avatar avatar-m me-3 status-online"><img class="rounded-circle" src="../../assets/img/team/35.webp" alt="" />
                                </div>
                                <h6 class="mb-0 text-1000 fw-bold">Ansolo Lazinatov</h6>
                              </a></td>
                            <td class="description align-middle white-space-nowrap text-start fw-bold text-700 py-2 pe-6">Purchasing-Related Vendors</td>
                            <td class="create_date text-end align-middle white-space-nowrap text-900 py-2">Dec 29, 2021</td>
                            <td class="create_by align-middle white-space-nowrap fw-semi-bold text-1000">Ansolo Lazinarov</td>
                            <td class="last_activity align-middle text-center py-2">
                              <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-clock me-1 text-success" data-fa-transform="shrink-2 up-1"></span><span class="fw-bold fs--1 text-900">Active</span></div>
                            </td>
                            <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                              <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs--1 align-middle px-0 py-3">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select-row='{"Name":{"avatar":"/team/9.webp","name":"Jackson Pollock","status":"offline"},"description":"Based on emails sent rate, the top 10 users","date":"Mar 27, 2021","creatBy":"Jackson Pollock","lastActivity":{"iconColor":"text-500","label":"6 hours ago"}}' />
                              </div>
                            </td>
                            <td class="name align-middle white-space-nowrap py-2 ps-0"><a class="d-flex align-items-center text-1000" href="#!">
                                <div class="avatar avatar-m me-3 status-offline"><img class="rounded-circle" src="../../assets/img/team/9.webp" alt="" />
                                </div>
                                <h6 class="mb-0 text-1000 fw-bold">Jackson Pollock</h6>
                              </a></td>
                            <td class="description align-middle white-space-nowrap text-start fw-bold text-700 py-2 pe-6">Based on emails sent rate, the top 10 users</td>
                            <td class="create_date text-end align-middle white-space-nowrap text-900 py-2">Mar 27, 2021</td>
                            <td class="create_by align-middle white-space-nowrap fw-semi-bold text-1000">Jackson Pollock</td>
                            <td class="last_activity align-middle text-center py-2">
                              <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-clock me-1 text-500" data-fa-transform="shrink-2 up-1"></span><span class="fw-bold fs--1 text-900">6 hours ago</span></div>
                            </td>
                            <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                              <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs--1 align-middle px-0 py-3">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select-row='{"Name":{"avatar":"/team/35.webp","name":"Ansolo Lazinatov","status":"online"},"description":"Based on the percentage of recipients","date":"Jun 24, 2021","creatBy":"Ansolo Lazinarov","lastActivity":{"iconColor":"text-success","label":"Active"}}' />
                              </div>
                            </td>
                            <td class="name align-middle white-space-nowrap py-2 ps-0"><a class="d-flex align-items-center text-1000" href="#!">
                                <div class="avatar avatar-m me-3 status-online"><img class="rounded-circle" src="../../assets/img/team/35.webp" alt="" />
                                </div>
                                <h6 class="mb-0 text-1000 fw-bold">Ansolo Lazinatov</h6>
                              </a></td>
                            <td class="description align-middle white-space-nowrap text-start fw-bold text-700 py-2 pe-6">Based on the percentage of recipients</td>
                            <td class="create_date text-end align-middle white-space-nowrap text-900 py-2">Jun 24, 2021</td>
                            <td class="create_by align-middle white-space-nowrap fw-semi-bold text-1000">Ansolo Lazinarov</td>
                            <td class="last_activity align-middle text-center py-2">
                              <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-clock me-1 text-success" data-fa-transform="shrink-2 up-1"></span><span class="fw-bold fs--1 text-900">Active</span></div>
                            </td>
                            <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                              <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs--1 align-middle px-0 py-3">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select-row='{"Name":{"avatar":"/team/9.webp","name":"Jackson Pollock","status":"offline"},"description":"Obtaining leads today","date":"May 19, 2024","creatBy":"Jackson Pollock","lastActivity":{"iconColor":"text-500","label":"6 hours ago"}}' />
                              </div>
                            </td>
                            <td class="name align-middle white-space-nowrap py-2 ps-0"><a class="d-flex align-items-center text-1000" href="#!">
                                <div class="avatar avatar-m me-3 status-offline"><img class="rounded-circle" src="../../assets/img/team/9.webp" alt="" />
                                </div>
                                <h6 class="mb-0 text-1000 fw-bold">Jackson Pollock</h6>
                              </a></td>
                            <td class="description align-middle white-space-nowrap text-start fw-bold text-700 py-2 pe-6">Obtaining leads today</td>
                            <td class="create_date text-end align-middle white-space-nowrap text-900 py-2">May 19, 2024</td>
                            <td class="create_by align-middle white-space-nowrap fw-semi-bold text-1000">Jackson Pollock</td>
                            <td class="last_activity align-middle text-center py-2">
                              <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-clock me-1 text-500" data-fa-transform="shrink-2 up-1"></span><span class="fw-bold fs--1 text-900">6 hours ago</span></div>
                            </td>
                            <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                              <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs--1 align-middle px-0 py-3">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select-row='{"Name":{"avatar":"/team/35.webp","name":"Ansolo Lazinatov","status":"online"},"description":"Sums up the many phases of new and existing businesses.","date":"Aug 19, 2024","creatBy":"Ansolo Lazinarov","lastActivity":{"iconColor":"text-success","label":"Active"}}' />
                              </div>
                            </td>
                            <td class="name align-middle white-space-nowrap py-2 ps-0"><a class="d-flex align-items-center text-1000" href="#!">
                                <div class="avatar avatar-m me-3 status-online"><img class="rounded-circle" src="../../assets/img/team/35.webp" alt="" />
                                </div>
                                <h6 class="mb-0 text-1000 fw-bold">Ansolo Lazinatov</h6>
                              </a></td>
                            <td class="description align-middle white-space-nowrap text-start fw-bold text-700 py-2 pe-6">Sums up the many phases of new and existing businesses.</td>
                            <td class="create_date text-end align-middle white-space-nowrap text-900 py-2">Aug 19, 2024</td>
                            <td class="create_by align-middle white-space-nowrap fw-semi-bold text-1000">Ansolo Lazinarov</td>
                            <td class="last_activity align-middle text-center py-2">
                              <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-clock me-1 text-success" data-fa-transform="shrink-2 up-1"></span><span class="fw-bold fs--1 text-900">Active</span></div>
                            </td>
                            <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                              <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs--1 align-middle px-0 py-3">
                              <div class="form-check mb-0 fs-0">
                                <input class="form-check-input" type="checkbox" data-bulk-select-row='{"Name":{"avatar":"/team/35.webp","name":"Ansolo Lazinatov","status":"online"},"description":"Purchasing-Related Vendors","date":"Aug 19, 2024","creatBy":"Ansolo Lazinarov","lastActivity":{"iconColor":"text-success","label":"Active"}}' />
                              </div>
                            </td>
                            <td class="name align-middle white-space-nowrap py-2 ps-0"><a class="d-flex align-items-center text-1000" href="#!">
                                <div class="avatar avatar-m me-3 status-online"><img class="rounded-circle" src="../../assets/img/team/35.webp" alt="" />
                                </div>
                                <h6 class="mb-0 text-1000 fw-bold">Ansolo Lazinatov</h6>
                              </a></td>
                            <td class="description align-middle white-space-nowrap text-start fw-bold text-700 py-2 pe-6">Purchasing-Related Vendors</td>
                            <td class="create_date text-end align-middle white-space-nowrap text-900 py-2">Aug 19, 2024</td>
                            <td class="create_by align-middle white-space-nowrap fw-semi-bold text-1000">Ansolo Lazinarov</td>
                            <td class="last_activity align-middle text-center py-2">
                              <div class="d-flex align-items-center flex-1"><span class="fa-solid fa-clock me-1 text-success" data-fa-transform="shrink-2 up-1"></span><span class="fw-bold fs--1 text-900">Active</span></div>
                            </td>
                            <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                              <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                      <div class="col-auto d-flex">
                        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p><a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                      </div>
                      <div class="col-auto d-flex">
                        <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                        <ul class="mb-0 pagination"></ul>
                        <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab-emails" role="tabpanel" aria-labelledby="emails-tab">
                  <h2 class="mb-4">Emails</h2>
                  <div>
                    <div class="scrollbar">
                      <ul class="nav nav-underline flex-nowrap mb-1" id="emailTab" role="tablist">
                        <li class="nav-item me-3"><a class="nav-link text-nowrap border-0 active" id="mail-tab" data-bs-toggle="tab" href="#tab-mail" aria-controls="mail-tab" role="tab" aria-selected="true">Mails (68)<span class="text-700 fw-normal"></span></a></li>
                        <li class="nav-item me-3"><a class="nav-link text-nowrap border-0" id="drafts-tab" data-bs-toggle="tab" href="#tab-drafts" aria-controls="drafts-tab" role="tab" aria-selected="true">Drafts (6)<span class="text-700 fw-normal"></span></a></li>
                        <li class="nav-item me-3"><a class="nav-link text-nowrap border-0" id="schedule-tab" data-bs-toggle="tab" href="#tab-schedule" aria-controls="schedule-tab" role="tab" aria-selected="true">Scheduled (17)</a></li>
                      </ul>
                    </div>
                    <div class="search-box w-100 mb-3">
                      <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                        <input class="form-control search-input search" type="search" placeholder="Search..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>

                      </form>
                    </div>
                    <div class="tab-content" id="profileTabContent">
                      <div class="tab-pane fade show active" id="tab-mail" role="tabpanel" aria-labelledby="mail-tab">
                        <div class="border-top border-bottom border-200" id="allEmailsTable" data-list='{"valueNames":["subject","sent","date","source","status"],"page":7,"pagination":true}'>
                          <div class="table-responsive scrollbar mx-n1 px-1">
                            <table class="table fs--1 mb-0">
                              <thead>
                                <tr>
                                  <th class="white-space-nowrap fs--1 align-middle ps-0" style="width:26px;">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select='{"body":"all-email-table-body"}' />
                                    </div>
                                  </th>
                                  <th class="sort white-space-nowrap align-middle pe-3 ps-0 text-uppercase" scope="col" data-sort="subject" style="width:31%; min-width:350px">Subject</th>
                                  <th class="sort align-middle pe-3 text-uppercase" scope="col" data-sort="sent" style="width:15%; min-width:130px">Sent by</th>
                                  <th class="sort align-middle text-start text-uppercase" scope="col" data-sort="date" style="min-width:165px">Date</th>
                                  <th class="sort align-middle pe-0 text-uppercase" scope="col" style="width:15%; min-width:100px">Action</th>
                                  <th class="sort align-middle text-end text-uppercase" scope="col" data-sort="status" style="width:15%; min-width:100px">Status</th>
                                </tr>
                              </thead>
                              <tbody class="list" id="all-email-table-body">
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"Quary about purchased soccer socks","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 29, 2021 10:23 am","source":"Call","type_status":{"label":"sent","type":"badge-phoenix-success"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">Quary about purchased soccer socks</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 29, 2021 10:23 am</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-success">sent</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"How to take the headache out of Order","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 27, 2021 3:27 pm","source":"Call","type_status":{"label":"delivered","type":"badge-phoenix-info"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">How to take the headache out of Order</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 27, 2021 3:27 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-info">delivered</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"The Arnold Schwarzenegger of Order","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 24, 2021 10:44 am","source":"Call","type_status":{"label":"Bounce","type":"badge-phoenix-warning"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">The Arnold Schwarzenegger of Order</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 24, 2021 10:44 am</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-warning">Bounce</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"My order is not being taken","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 19, 2021 4:55 pm","source":"Call","type_status":{"label":"Spam","type":"badge-phoenix-danger"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">My order is not being taken</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 19, 2021 4:55 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-danger">Spam</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"Shipment is missing","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 19, 2021 2:43 pm","source":"Call","type_status":{"label":"sent","type":"badge-phoenix-success"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">Shipment is missing</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 19, 2021 2:43 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-success">sent</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"How can I order something urgently?","email":"ansolo45@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 19, 2021 2:43 pm","source":"Call","type_status":{"label":"Delivered","type":"badge-phoenix-info"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">How can I order something urgently?</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 19, 2021 2:43 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-info">Delivered</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"How the delicacy of the products will be handled?","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 16, 2021 5:18 pm","source":"Call","type_status":{"label":"bounced","type":"badge-phoenix-warning"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">How the delicacy of the products will be handled?</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 16, 2021 5:18 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-warning">bounced</span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                            <div class="col-auto d-flex">
                              <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p><a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                            </div>
                            <div class="col-auto d-flex">
                              <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                              <ul class="mb-0 pagination"></ul>
                              <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="tab-drafts" role="tabpanel" aria-labelledby="drafts-tab">
                        <div class="border-top border-bottom border-200" id="draftsEmailsTable" data-list='{"valueNames":["subject","sent","date","source","status"],"page":7,"pagination":true}'>
                          <div class="table-responsive scrollbar mx-n1 px-1">
                            <table class="table fs--1 mb-0">
                              <thead>
                                <tr>
                                  <th class="white-space-nowrap fs--1 align-middle ps-0" style="width:26px;">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select='{"body":"drafts-email-table-body"}' />
                                    </div>
                                  </th>
                                  <th class="sort white-space-nowrap align-middle pe-3 ps-0 text-uppercase" scope="col" data-sort="subject" style="width:31%; min-width:350px">Subject</th>
                                  <th class="sort align-middle pe-3 text-uppercase" scope="col" data-sort="sent" style="width:15%; min-width:130px">Sent by</th>
                                  <th class="sort align-middle text-start text-uppercase" scope="col" data-sort="date" style="min-width:165px">Date</th>
                                  <th class="sort align-middle pe-0 text-uppercase" scope="col" style="width:15%; min-width:100px">Action</th>
                                  <th class="sort align-middle text-end text-uppercase" scope="col" data-sort="status" style="width:15%; min-width:100px">Status</th>
                                </tr>
                              </thead>
                              <tbody class="list" id="drafts-email-table-body">
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"Quary about purchased soccer socks","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 29, 2021 10:23 am","source":"Call","type_status":{"label":"sent","type":"badge-phoenix-success"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">Quary about purchased soccer socks</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 29, 2021 10:23 am</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-success">sent</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"How to take the headache out of Order","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 27, 2021 3:27 pm","source":"Call","type_status":{"label":"delivered","type":"badge-phoenix-info"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">How to take the headache out of Order</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 27, 2021 3:27 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-info">delivered</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"The Arnold Schwarzenegger of Order","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 24, 2021 10:44 am","source":"Call","type_status":{"label":"Bounce","type":"badge-phoenix-warning"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">The Arnold Schwarzenegger of Order</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 24, 2021 10:44 am</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-warning">Bounce</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"My order is not being taken","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 19, 2021 4:55 pm","source":"Call","type_status":{"label":"Spam","type":"badge-phoenix-danger"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">My order is not being taken</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 19, 2021 4:55 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-danger">Spam</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"Shipment is missing","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 19, 2021 2:43 pm","source":"Call","type_status":{"label":"sent","type":"badge-phoenix-success"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">Shipment is missing</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 19, 2021 2:43 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-success">sent</span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                            <div class="col-auto d-flex">
                              <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p><a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                            </div>
                            <div class="col-auto d-flex">
                              <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                              <ul class="mb-0 pagination"></ul>
                              <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="tab-schedule" role="tabpanel" aria-labelledby="schedule-tab">
                        <div class="border-top border-bottom border-200" id="scheduledEmailsTable" data-list='{"valueNames":["subject","sent","date","source","status"],"page":7,"pagination":true}'>
                          <div class="table-responsive scrollbar mx-n1 px-1">
                            <table class="table fs--1 mb-0">
                              <thead>
                                <tr>
                                  <th class="white-space-nowrap fs--1 align-middle ps-0" style="width:26px;">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select='{"body":"scheduled-email-table-body"}' />
                                    </div>
                                  </th>
                                  <th class="sort white-space-nowrap align-middle pe-3 ps-0 text-uppercase" scope="col" data-sort="subject" style="width:31%; min-width:350px">Subject</th>
                                  <th class="sort align-middle pe-3 text-uppercase" scope="col" data-sort="sent" style="width:15%; min-width:130px">Sent by</th>
                                  <th class="sort align-middle text-start text-uppercase" scope="col" data-sort="date" style="min-width:165px">Date</th>
                                  <th class="sort align-middle pe-0 text-uppercase" scope="col" style="width:15%; min-width:100px">Action</th>
                                  <th class="sort align-middle text-end text-uppercase" scope="col" data-sort="status" style="width:15%; min-width:100px">Status</th>
                                </tr>
                              </thead>
                              <tbody class="list" id="scheduled-email-table-body">
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"Quary about purchased soccer socks","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 29, 2021 10:23 am","source":"Call","type_status":{"label":"sent","type":"badge-phoenix-success"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">Quary about purchased soccer socks</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 29, 2021 10:23 am</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-success">sent</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"How to take the headache out of Order","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 27, 2021 3:27 pm","source":"Call","type_status":{"label":"delivered","type":"badge-phoenix-info"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">How to take the headache out of Order</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 27, 2021 3:27 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-info">delivered</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"The Arnold Schwarzenegger of Order","email":"ansolo45@mail.com"},"active":true,"sent":"Ansolo Lazinatov","date":"Dec 24, 2021 10:44 am","source":"Call","type_status":{"label":"Bounce","type":"badge-phoenix-warning"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">The Arnold Schwarzenegger of Order</a>
                                    <div class="fs--2 d-block">ansolo45@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Ansolo Lazinatov</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 24, 2021 10:44 am</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-warning">Bounce</span></td>
                                </tr>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                  <td class="fs--1 align-middle px-0 py-3">
                                    <div class="form-check mb-0 fs-0">
                                      <input class="form-check-input" type="checkbox" data-bulk-select-row='{"mail":{"subject":"My order is not being taken","email":"jackson@mail.com"},"active":true,"sent":"Jackson Pollock","date":"Dec 19, 2021 4:55 pm","source":"Call","type_status":{"label":"Spam","type":"badge-phoenix-danger"}}' />
                                    </div>
                                  </td>
                                  <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">My order is not being taken</a>
                                    <div class="fs--2 d-block">jackson@mail.com</div>
                                  </td>
                                  <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">Jackson Pollock</td>
                                  <td class="date align-middle white-space-nowrap text-900 py-2">Dec 19, 2021 4:55 pm</td>
                                  <td class="align-middle white-space-nowrap ps-3"><span class="fa-solid fa-phone text-primary me-2"></span>Call
                                  </td>
                                  <td class="status align-middle fw-semi-bold text-end py-2"><span class="badge badge-phoenix fs--2 badge-phoenix-danger">Spam</span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                            <div class="col-auto d-flex">
                              <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p><a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                            </div>
                            <div class="col-auto d-flex">
                              <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                              <ul class="mb-0 pagination"></ul>
                              <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab-attachments" role="tabpanel" aria-labelledby="attachments-tab">
                  <h2 class="mb-4">Attachments</h2>
                  <div class="border-top border-dashed border-300 pt-3 pb-4">
                    <div class="d-flex flex-between-center">
                      <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-700 fs--1"></span>
                        <p class="text-1000 mb-0 lh-1">Silly_sight_1.png</p>
                      </div>
                      <div class="font-sans-serif btn-reveal-trigger">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                      </div>
                    </div>
                    <p class="fs--1 text-700 mb-2"><span>768kB</span><span class="text-400 mx-1">| </span><a href="#!">Shantinan Mekalan </a><span class="text-400 mx-1">| </span><span class="text-nowrap">21st Dec, 12:56 PM</span></p><img class="rounded-2" src="../../assets/img/generic/40.png" alt="" />
                  </div>
                  <div class="border-top border-dashed border-300 py-4">
                    <div class="d-flex flex-between-center">
                      <div>
                        <div class="d-flex align-items-center mb-1"><span class="fa-solid fa-image me-2 fs--1 text-700"></span>
                          <p class="text-1000 mb-0 lh-1">All_images.zip</p>
                        </div>
                        <p class="fs--1 text-700 mb-0"><span>12.8 mB</span><span class="text-400 mx-1">|</span><a href="#!">Yves Tanguy </a><span class="text-400 mx-1">| </span><span class="text-nowrap">19th Dec, 08:56 PM</span></p>
                      </div>
                      <div class="font-sans-serif btn-reveal-trigger">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                      </div>
                    </div>
                  </div>
                  <div class="border-top border-dashed border-300 py-4">
                    <div class="d-flex flex-between-center">
                      <div>
                        <div class="d-flex align-items-center mb-1"><span class="fa-solid fa-file-lines me-2 fs--1 text-700"></span>
                          <p class="text-1000 mb-0 lh-1">Project.txt</p>
                        </div>
                        <p class="fs--1 text-700 mb-0"><span>123 kB</span><span class="text-400 mx-1">| </span><a href="#!">Shantinan Mekalan </a><span class="text-400 mx-1">| </span><span class="text-nowrap">12th Dec, 12:56 PM</span></p>
                      </div>
                      <div class="font-sans-serif btn-reveal-trigger">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse </a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
       
    @push('scripts') 
    <script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
   
  @endpush
        @endsection