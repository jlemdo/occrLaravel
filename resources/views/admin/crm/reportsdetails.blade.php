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
          <h2 class="mb-4">Purchasers and sellers</h2>
          <div class="row g-3 justify-content-between mb-4">
            <div class="col-auto">
              <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary"><span class="fas fa-envelope me-2"></span>Send mail</button>
                <button class="btn btn-phoenix-primary"><span class="fas fa-pencil me-2"></span>Edit</button>
                <button class="btn btn-phoenix-secondary text-900"><span class="fa-solid fa-file-export fs--1 me-2"></span>Export</button>
              </div>
            </div>
            <div class="col-auto">
              <div class="d-flex">
                <div class="search-box me-2 d-none d-xl-block">
                  <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                    <input class="form-control search-input search" type="search" placeholder="Search by name" aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>

                  </form>
                </div>
                <button class="btn px-3 btn-phoenix-secondary me-2 d-xl-none"><span class="fa-solid fa-search"></span></button>
                <button class="btn px-3 btn-phoenix-primary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-filter" data-fa-transform="down-3"></span></button>
                <div class="modal fade" id="filterModal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border">
                      <form id="addEventForm" autocomplete="off">
                        <div class="modal-header border-200 p-4">
                          <h5 class="modal-title text-1000 fs-2 lh-sm">Filter</h5>
                          <button class="btn p-1 text-900" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
                        </div>
                        <div class="modal-body pt-4 pb-2 px-4">
                          <div class="mb-3">
                            <label class="fw-bold mb-2 text-1000" for="leadStatus">Lead Status</label>
                            <select class="form-select" id="leadStatus">
                              <option value="newLead" selected="selected">New Lead</option>
                              <option value="coldLead">Cold Lead</option>
                              <option value="wonLead">Won Lead</option>
                              <option value="canceled">Canceled</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="fw-bold mb-2 text-1000" for="createDate">Create Date</label>
                            <select class="form-select" id="createDate">
                              <option value="today" selected="selected">Today</option>
                              <option value="last7Days">Last 7 Days</option>
                              <option value="last30Days">Last 30 Days</option>
                              <option value="chooseATimePeriod">Choose a time period</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="fw-bold mb-2 text-1000" for="designation">Designation</label>
                            <select class="form-select" id="designation">
                              <option value="VPAccounting" selected="selected">VP Accounting</option>
                              <option value="ceo">CEO</option>
                              <option value="creativeDirector">Creative Director</option>
                              <option value="accountant">Accountant</option>
                              <option value="executiveManager">Executive Manager</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end align-items-center px-4 pb-4 border-0 pt-3">
                          <button class="btn btn-sm btn-phoenix-primary px-4 fs--2 my-0" type="submit"> <span class="fas fa-arrows-rotate me-2 fs--2"></span>Reset</button>
                          <button class="btn btn-sm btn-primary px-9 fs--2 my-0" type="submit">Done</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row gy-5">
            <div class="col-xl-5 col-xxl-4">
              <div class="card">
                <div class="card-body">
                  <div class="echart-reports-details mb-5" style="height:358px; width:100%"></div>
                  <div class="table-responsive scrollbar">
                    <table class="reports-details-chart-table table table-sm fs--1 mb-0">
                      <thead>
                        <tr>
                          <th class="align-middle pe- text-700 fw-bold fs--2 text-uppercase text-nowrap" scope="col" style="width:35%;">Report stage</th>
                          <th class="align-middle text-end ps-4 text-700 fw-bold fs--2 text-uppercase text-nowrap" scope="col" style="width:35%;">total count</th>
                          <th class="align-middle text-end ps-4 text-700 fw-bold fs--2 text-uppercase" scope="col" style="width:30%;">Status</th>
                        </tr>
                      </thead>
                      <tbody class="list" id="report-data-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="align-middle white-space-nowrap fw-semi-bold text-1000 py-2">Analysis</td>
                          <td class="align-middle text-end white-space-nowrap fw-semi-bold text-1000 ps-4 py-2">03</td>
                          <td class="align-middle text-end white-space-nowrap ps-4 fw-semi-bold text-1000"><span class="badge badge-phoenix badge-phoenix-info">+15.21%</span></td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="align-middle white-space-nowrap fw-semi-bold text-1000 py-2">Statement</td>
                          <td class="align-middle text-end white-space-nowrap fw-semi-bold text-1000 ps-4 py-2">01</td>
                          <td class="align-middle text-end white-space-nowrap ps-4 fw-semi-bold text-1000"><span class="badge badge-phoenix badge-phoenix-warning">+05.21%</span></td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="align-middle white-space-nowrap fw-semi-bold text-1000 py-2">Action</td>
                          <td class="align-middle text-end white-space-nowrap fw-semi-bold text-1000 ps-4 py-2">02</td>
                          <td class="align-middle text-end white-space-nowrap ps-4 fw-semi-bold text-1000"><span class="badge badge-phoenix badge-phoenix-primary">+22.12%</span></td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="align-middle white-space-nowrap fw-semi-bold text-1000 py-2">Offering</td>
                          <td class="align-middle text-end white-space-nowrap fw-semi-bold text-1000 ps-4 py-2">02</td>
                          <td class="align-middle text-end white-space-nowrap ps-4 fw-semi-bold text-1000"><span class="badge badge-phoenix badge-phoenix-danger">-14.21%</span></td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="align-middle white-space-nowrap fw-semi-bold text-1000 py-2">Interlocution</td>
                          <td class="align-middle text-end white-space-nowrap fw-semi-bold text-1000 ps-4 py-2">02</td>
                          <td class="align-middle text-end white-space-nowrap ps-4 fw-semi-bold text-1000"><span class="badge badge-phoenix badge-phoenix-danger">-14.21%</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-7 col-xxl-8">
              <div class="border-top">
                <div id="purchasersSellersTable" data-list='{"valueNames":["deals_name","deal_owner","account_name","stage","amount"],"page":10,"pagination":true}'>
                  <div class="table-responsive scrollbar mx-n1 px-1">
                    <table class="table table-sm fs--1 leads-table">
                      <thead>
                        <tr>
                          <th class="white-space-nowrap fs--1 align-middle ps-0" style="max-width:20px; width:18px;">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select='{"body":"purchasers-sellers-body"}' />
                            </div>
                          </th>
                          <th class="sort align-middle ps-0 pe-5 text-uppercase text-nowrap" scope="col" data-sort="deals_name" style="min-width:120px;">Deals name</th>
                          <th class="sort align-middle ps-4 pe-5 text-uppercase text-nowrap" scope="col" data-sort="deal_owner" style="min-width:50px;">Deal owner</th>
                          <th class="sort align-middle ps-4 pe-5 text-uppercase text-nowrap" scope="col" data-sort="account_name" style="min-width:250px;">Account name</th>
                          <th class="sort align-middle ps-4 pe-5 text-uppercase text-nowrap" scope="col" data-sort="stage" style="min-width:160px;">Stage</th>
                          <th class="sort align-middle ps-4 pe-5 text-uppercase text-nowrap" scope="col" data-sort="amount" style="min-width:50px;">Amount</th>
                          <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="list" id="purchasers-sellers-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Jo_Td01","dealOwner":{"avatar":"team/avatar.webp","name":"Ally Aagaard","placeholder":true},"accountName":"Themewagon","stage":{"label":"Analysis","color":"#3874FF","data":20},"amount":{"totalAmount":"$140","icon":"trending-down","color":"text-danger"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Jo_Td01</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle avatar-placeholder" src="../../assets/img/team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:20">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#3874FF" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Analysis</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$140<span class="ms-2 text-danger" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Printing Dimensions","dealOwner":{"avatar":"/team/35.webp","name":"Alex Abadi"},"accountName":"Black Box","stage":{"label":"Statement","color":"#0097EB","data":40},"amount":{"totalAmount":"$214","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Printing Dimensions</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/35.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Alex Abadi</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Black Box</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:40">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#0097EB" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Statement</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$214<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"MM_TD_120","dealOwner":{"avatar":"/team/32.webp","name":"Kylia Abbott"},"accountName":"Hunter Leader","stage":{"label":"Action","color":"#E5780B","data":50},"amount":{"totalAmount":"$412","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">MM_TD_120</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/32.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Kylia Abbott</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Hunter Leader</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:50">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#E5780B" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Action</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$412<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Truhlar And Truhlar Attys","dealOwner":{"avatar":"/team/32.webp","name":"Kylia Abbott"},"accountName":"Eagle Eye","stage":{"label":"Offering","color":"#6E7891","data":60},"amount":{"totalAmount":"$110","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Truhlar And Truhlar Attys</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/32.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Kylia Abbott</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Eagle Eye</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:60">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#6E7891" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Offering</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$110<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Morlong Associates","dealOwner":{"avatar":"/team/59.webp","name":"Lyla Nicole"},"accountName":"Black Box","stage":{"label":"Negotiation","color":"#25B003","data":100},"amount":{"totalAmount":"$325","icon":"trending-down","color":"text-danger"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Morlong Associates</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/59.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Lyla Nicole</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Black Box</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#25B003" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Negotiation</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$325<span class="ms-2 text-danger" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Product Order","dealOwner":{"avatar":"/team/18.webp","name":"Hunter Leader"},"accountName":"Themewagon","stage":{"label":"Negotiation","color":"#25B003","data":100},"amount":{"totalAmount":"$198","icon":"trending-down","color":"text-warning"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Product Order</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/18.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Hunter Leader</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#25B003" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Negotiation</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$198<span class="ms-2 text-warning" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Feltz Printing Service","dealOwner":{"avatar":"/team/avatar.webp","name":"Ally Aagaard","placeholder":true},"accountName":"Themewagon","stage":{"label":"Offering","color":"#6E7891","data":80},"amount":{"totalAmount":"$142","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Feltz Printing Service</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle avatar-placeholder" src="../../assets/img//team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:80">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#6E7891" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Offering</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$142<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Flat Plate SP","dealOwner":{"avatar":"/team/avatar.webp","name":"Ally Aagaard","placeholder":true},"accountName":"Eagle Eye","stage":{"label":"Offering","color":"#6E7891","data":80},"amount":{"totalAmount":"$457","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Flat Plate SP</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle avatar-placeholder" src="../../assets/img//team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Eagle Eye</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:80">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#6E7891" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Offering</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$457<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Evacuated Tube","dealOwner":{"avatar":"/team/avatar.webp","name":"Ally Aagaard"},"accountName":"Hunter Leader","stage":{"label":"Action","color":"#E5780B","data":100},"amount":{"totalAmount":"$120","icon":"trending-down","color":"text-warning"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Evacuated Tube</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Hunter Leader</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#E5780B" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Action</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$120<span class="ms-2 text-warning" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Product Delivery","dealOwner":{"avatar":"/team/35.webp","name":"Alex Abadi"},"accountName":"Themewagon","stage":{"label":"Analysis","color":"#3874FF","data":100},"amount":{"totalAmount":"$150","icon":"trending-down","color":"text-danger"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Product Delivery</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/35.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Alex Abadi</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#3874FF" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Analysis</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$150<span class="ms-2 text-danger" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Product Order","dealOwner":{"avatar":"/team/18.webp","name":"Hunter Leader"},"accountName":"Themewagon","stage":{"label":"Negotiation","color":"#25B003","data":100},"amount":{"totalAmount":"$140","icon":"trending-down","color":"text-warning"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Product Order</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/18.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Hunter Leader</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#25B003" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Negotiation</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$140<span class="ms-2 text-warning" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Feltz Printing Service","dealOwner":{"avatar":"/team/avatar.webp","name":"Ally Aagaard","placeholder":true},"accountName":"Themewagon","stage":{"label":"Offering","color":"#6E7891","data":80},"amount":{"totalAmount":"$122","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Feltz Printing Service</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle avatar-placeholder" src="../../assets/img//team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:80">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#6E7891" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Offering</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$122<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Flat Plate SP","dealOwner":{"avatar":"/team/avatar.webp","name":"Ally Aagaard","placeholder":true},"accountName":"Eagle Eye","stage":{"label":"Offering","color":"#6E7891","data":80},"amount":{"totalAmount":"$321","icon":"trending-up","color":"text-success"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Flat Plate SP</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle avatar-placeholder" src="../../assets/img//team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Eagle Eye</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:80">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#6E7891" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Offering</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$321<span class="ms-2 text-success" data-feather="trending-up" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Evacuated Tube","dealOwner":{"avatar":"/team/avatar.webp","name":"Ally Aagaard"},"accountName":"Hunter Leader","stage":{"label":"Action","color":"#E5780B","data":100},"amount":{"totalAmount":"$104","icon":"trending-down","color":"text-warning"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Evacuated Tube</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/avatar.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Ally Aagaard</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Hunter Leader</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#E5780B" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Action</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$104<span class="ms-2 text-warning" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          <td class="fs--1 align-middle py-0">
                            <div class="form-check mb-0 fs-0">
                              <input class="form-check-input" type="checkbox" data-bulk-select-row='{"dealsName":"Product Delivery","dealOwner":{"avatar":"/team/35.webp","name":"Alex Abadi"},"accountName":"Themewagon","stage":{"label":"Analysis","color":"#3874FF","data":100},"amount":{"totalAmount":"$124","icon":"trending-down","color":"text-danger"}}' />
                            </div>
                          </td>
                          <td class="deals_name align-middle white-space-nowrap fw-semi-bold text-1000 ps-0 py-0"><a class="fw-bold text-primary" href="#!">Product Delivery</a></td>
                          <td class="deal_owner align-middle white-space-nowrap fw-semi-bold text-1100 ps-4 py-0">
                            <div class="d-flex align-items-center position-relative">
                              <div class="avatar avatar-m me-3"><img class="rounded-circle" src="../../assets/img//team/35.webp" alt="" />
                              </div><a class="text-1000 fw-bold stretched-link" href="#!">Alex Abadi</a>
                            </div>
                          </td>
                          <td class="account_name align-middle white-space-nowrap ps-4 fw-semi-bold text-900 py-0">Themewagon</td>
                          <td class="stage align-middle white-space-nowrap fw-bold text-900 py-0">
                            <div class="d-flex align-items-center gap-3">
                              <div style="--phoenix-circle-progress-bar:100">
                                <svg class="circle-progress-svg" width="54" height="54" viewBox="0 0 170 170">
                                  <circle class="progress-bar-rail" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke-width="12"></circle>
                                  <circle class="progress-bar-top" cx="60" cy="60" r="54" fill="none" stroke-linecap="round" stroke="#3874FF" stroke-width="12"></circle>
                                </svg>
                              </div>
                              <h6 class="mb-0 text-900">Analysis</h6>
                            </div>
                          </td>
                          <td class="amount align-middle white-space-nowrap fw-bold ps-4 text-900 py-0">$124<span class="ms-2 text-danger" data-feather="trending-down" style="min-height:8px; width:14px;"></span></td>
                          <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="row align-items-center justify-content-between pe-0 fs--1">
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
       
        
    @push('scripts') 
    <script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('vendors/echarts/echarts.min.js')}}"></script>

  @endpush
        @endsection