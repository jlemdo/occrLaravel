@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush

   
        
	
        <div class="pb-6">
        



          <h2 class="mb-4">Deals  @can('Deal Add')
                  <button class="btn btn-phoenix-primary me-4" type="button" data-bs-toggle="modal" data-bs-target="#addDealModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-plus me-2"></span>Create Deal</button>
                  @endcan</h2>
          <div id="lealsTable" data-list='{"valueNames":["name","email","phone","contact","company","date"],"page":10,"pagination":true}'>
            <div class="row g-3 justify-content-between mb-4">
              
                <div class="col-auto">
      <form method="GET" action="{{ route('crm.deals') }}">
          <div class="input-group">
              <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
              <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
              <button class="btn btn-phoenix-primary" type="submit">Filter</button>
              @if(request()->has('search') || request()->has('from_date') || request()->has('to_date'))
                  <a href="{{ route('crm.deals') }}" class="btn btn-phoenix-secondary">Reset</a>
              @endif
          </div>
      </form>
  </div>

              <div class="col col-auto">
        <div class="search-box">
    <form class="position-relative" style="display:flex" data-bs-toggle="search" data-bs-display="static" method="GET" action="{{ route('crm.deals') }}">
       <div> <input class="form-control search-input search" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->get('search') }}" />
        <span class="fas fa-search search-box-icon"></span></div>
        <div>
       <?php
        $sby = 'no one';
        ?>
        @if (request()->has('sby'))
    	@php
        $sby = request()->input('sby');
    	@endphp

@endif
        <select class="form-control" name="sby">
        <option value="contact_name" @if($sby =='contact_name') selected @endif > Name</option>
        <option value="phone" @if($sby =='phone') selected @endif> phone</option>
        <option value="email" @if($sby =='email') selected @endif> Email</option>
        <option value="stage" @if($sby =='stage') selected @endif> Stage</option>
        <option value="lead_source" @if($sby =='lead_source') selected @endif> Source</option>
        </select>
        </div>
    </form>
    </div></div>
    <div class="col col-auto">
    <div class="font-sans-serif btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                        <?php
        $stype = '0';
        ?>
        @if (request()->has('status_type'))
    	@php
        $stype = request()->input('status_type');
    	@endphp

@endif
<a class="dropdown-item" href="{{URL::to('deals?status_type=0')}}" <?php if($stype==0){ ?>style="background-color:#C3C3C3"<?php } ?>>All</a>
<a class="dropdown-item" href="{{URL::to('deals?status_type=won')}}" <?php if($stype=='won'){ ?>style="background-color:#C3C3C3"<?php } ?>>Won</a>
<a class="dropdown-item" href="{{URL::to('deals?status_type=loss')}}" <?php if($stype=='loss'){ ?>style="background-color:#C3C3C3"<?php } ?>>Loss</a>
 <a class="dropdown-item" href="#" onclick="exportTableToExcel('myTable', 'deals data')" >Export </a>

                        </div>
                      </div>
                     </div>
                     <div class="col col-auto">
    <div class="font-sans-serif btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                        <?php
        $sdays = '0';
        ?>
        @if (request()->has('sdays'))
    	@php
        $sdays = request()->input('sdays');
    	@endphp

@endif
<a class="dropdown-item" href="{{URL::to('deals?sdays=7')}}" <?php if($sdays==7){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 7 Days</a>
<a class="dropdown-item" href="{{URL::to('deals?sdays=14')}}" <?php if($sdays==14){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 14 Days</a>
<a class="dropdown-item" href="{{URL::to('deals?sdays=21')}}" <?php if($sdays==21){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 21 Days</a>
<a class="dropdown-item" href="{{URL::to('deals?sdays=30')}}" <?php if($sdays==30){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 30 Days</a>


                        </div>
                      </div></div>
                      <div class="col col-auto"> <a class="btn btn-phoenix-primary " href="#" id="viewToggle" data-bs-title="Kanban">
                    <svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0.5C0 0.223858 0.223858 0 0.5 0H3.5C3.77614 0 4 0.223858 4 0.5V3.5C4 3.77614 3.77614 4 3.5 4H0.5C0.223858 4 0 3.77614 0 3.5V0.5Z" fill="currentColor"></path>
                      <path d="M0 5.5C0 5.22386 0.223858 5 0.5 5H3.5C3.77614 5 4 5.22386 4 5.5V8.5C4 8.77614 3.77614 9 3.5 9H0.5C0.223858 9 0 8.77614 0 8.5V5.5Z" fill="currentColor"></path>
                      <path d="M5 0.5C5 0.223858 5.22386 0 5.5 0H8.5C8.77614 0 9 0.223858 9 0.5V3.5C9 3.77614 8.77614 4 8.5 4H5.5C5.22386 4 5 3.77614 5 3.5V0.5Z" fill="currentColor"></path>
                      <path d="M5 5.5C5 5.22386 5.22386 5 5.5 5H8.5C8.77614 5 9 5.22386 9 5.5V8.5C9 8.77614 8.77614 9 8.5 9H5.5C5.22386 9 5 8.77614 5 8.5V5.5Z" fill="currentColor"></path>
                    </svg></a>
                    </div>
                     
            </div>
            <div class="table-responsive scrollbar mx-n1 px-1 border-top">
              <table class="table fs--1 mb-0 leads-table" id="myTable">
                <thead>
                  <tr>
                   
                    <th class="sort white-space-nowrap align-middle text-uppercase ps-0" scope="col" data-sort="name" style="width:25%;">Name</th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="email" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-success-100 rounded me-2"><span class="text-success-600 dark__text-success-300" data-feather="mail"></span></div><span>Email</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="phone" style="width:15%; min-width: 180px;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-primary-100 rounded me-2"><span class="text-primary-600 dark__text-primary-300" data-feather="phone"></span></div><span>Phone</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="contact" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-info-100 rounded me-2"><span class="text-info-600 dark__text-info-300" data-feather="user"></span></div><span>Contact Person</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="company" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-warning-100 rounded me-2"><span class="text-warning-600 dark__text-warning-300" data-feather="grid"></span></div><span>Stage</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Create date</th>
                    <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list" id="leal-tables-body">
                @foreach ($leads as $lead)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                   
                    <td class="name align-middle white-space-nowrap ps-0">
                      <div class="d-flex align-items-center">
                        <div><a class="fs-0 fw-bold" href="#!">{{$lead->name}}</a>
                          <div class="d-flex align-items-center">
                           <span class="badge badge-phoenix badge-phoenix-primary">{{$lead->status}}</span>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="email align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="mailto:{{$lead->email}}">{{$lead->email}}</a></td>
                    <td class="phone align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="tel:{{$lead->phone}}">{{$lead->phone}}</a></td>
                    <td class="contact align-middle white-space-nowrap ps-4 border-end fw-semi-bold text-1000">{{$lead->contact_name}}</td>
                    <td class="company align-middle white-space-nowrap text-600 ps-4 border-end fw-semi-bold text-1000">{{$lead->stage}}</td>
                    <td class="date align-middle white-space-nowrap text-600 ps-4 text-700">{{$lead->created_at}}</td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                      <div class="font-sans-serif btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                          <a class="dropdown-item" href="{{URL::to('dealsdetails/'.$lead->id)}}">View</a>
                          <a class="dropdown-item" href="{{URL::to('wondeal/'.$lead->id)}}">Won</a>
                          <a class="dropdown-item" href="{{URL::to('lossdeal/'.$lead->id)}}">Loss</a>
                          @can('Deal Delete')
                          <form id="destroy-data{{ $lead->id }}"
                                                action="{{ route('deletedeal', $lead->id)}}"
                                                method="post">
                                                @csrf
                                              
												 <button class="dropdown-item text-danger" type="submit" >Remove</button>
                                            </form>
                             @endcan              
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach 
                </tbody>
              </table>
            </div>
           
          


        
          </div><div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
    <div class="col-auto d-flex">
        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900">
            Showing {{ $leads->firstItem() }} - {{ $leads->lastItem() }} of {{ $leads->total() }} deals
        </p>
    </div>
    <div class="col-auto d-flex">
        @if ($leads->onFirstPage())
            <button class="page-link" disabled><span class="fas fa-chevron-left"></span></button>
        @else
            <a href="{{ $leads->previousPageUrl() }}" class="page-link"><span class="fas fa-chevron-left"></span></a>
        @endif
        <ul class="mb-0 pagination">
            @for ($i = 1; $i <= $leads->lastPage(); $i++)
                <li class="page-item {{ ($leads->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $leads->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endfor
        </ul>
        @if ($leads->hasMorePages())
            <a href="{{ $leads->nextPageUrl() }}" class="page-link pe-0"><span class="fas fa-chevron-right"></span></a>
        @else
            <button class="page-link pe-0" disabled><span class="fas fa-chevron-right"></span></button>
        @endif
    </div>
</div>
        </div>



    <div class="modal fade" id="addDealModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDealModal" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
      <form class="row g-3" method="post" action="{{route('adddeal')}}"  enctype="multipart/form-data">
                                @csrf

                                <div class="modal-content bg-100 p-6">
          <div class="modal-header border-0 p-0 mb-2">
            <h3 class="mb-0">Deal Informations</h3>
            <button class="btn btn-sm btn-phoenix-secondary"  type="button"  data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times text-danger"></span></button>
          </div>
          <div class="modal-body px-0">
            <div class="row g-4">
              <div class="col-lg-6">
                <div class="mb-4">
                  <label class="text-1000 fw-bold mb-2">Lead</label>
                  <select class="form-select" name="dealowner">
                    <option>Select</option>
                    @foreach ($existing_leads as $existing_leads)
                    <option value="{{$existing_leads->id}}">{{$existing_leads->first_name}} - {{$existing_leads->last_name}}</option>
                    @endforeach
                   
                  </select>
                </div>
                <div class="mb-4">
                  <label class="text-1000 fw-bold mb-2">Deal Name</label>
                  <input class="form-control" type="text" placeholder="Enter deal name" name="name" />
                </div>
                <div class="mb-4">
                  <div class="row g-3">
                    <div class="col-sm-6 col-lg-12 col-xl-6">
                      <label class="text-1000 fw-bold mb-2">Deal Amount</label>
                      <div class="row g-2">
                        <div class="col-6">
                          <input class="form-control" type="number" name="amount" placeholder="$ Enter amount" />
                        </div>
                        <div class="col-6">
                          <select class="form-select" name="currency">
                            <option value="USD">USD</option>
                            <option value="GBP">GBP</option>
                            <option value="EUR">EUR</option>
                            <option value="JPY">JPY</option>
                            <option value="CAD">CAD</option>
                            <option value="AUD">AUD</option>
                            <option value="CNY">CNY</option>
                          </select>
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              
              
                <div>
                  <div class="row g-3">
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Stage</label>
                      <select class="form-select" name="stage">
                       @foreach ($dstage as $ls)
                    <option value="{{$ls->name}}">{{$ls->name}}</option>
                  @endforeach
                      </select>
                    </div>
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Priority</label>
                      <select class="form-select" name="priority">
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-4">
                  <label class="text-1000 fw-bold mb-2">Customer Name</label>
                  <input class="form-control" type="text" name="contact_name" placeholder="Enter contact name" />
                </div>
                <div class="mb-4">
                  <div class="row g-3">
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Phone Number</label>
                      <input class="form-control" type="text" name="phone" placeholder="Enter phone number" />
                    </div>
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Email Address</label>
                      <input class="form-control" type="text" name="email" placeholder="Enter email address" />
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label class="text-1000 fw-bold mb-2">Lead Source
                   
                  </label>
                  <select class="form-select" name="lead_source">
                      @foreach ($lsource as $ls)
                    <option value="{{$ls->name}}">{{$ls->name}}</option>
                   @endforeach
                  </select>
                </div>
              
              
                <div class="mb-4">
                  <div class="row g-3">
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Create Date</label>
                      <input class="form-control datetimepicker" name="create_date" type="text" placeholder="dd / mm / yyyy" data-options='{"disableMobile":true}' />
                    </div>
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Start Time</label>
                      <input class="form-control datetimepicker" name="create_time" type="text" placeholder="H:i" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' />
                    </div>
                  </div>
                </div>
                <div>
                  <div class="row g-3">
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Closing Date</label>
                      <input class="form-control datetimepicker" name="close_date" type="text" placeholder="dd / mm / yyyy" data-options='{"disableMobile":true}' />
                    </div>
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2">Closing Time</label>
                      <input class="form-control datetimepicker" name="close_time" type="text" placeholder="H:i" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 pt-6 px-0 pb-0">
            <button class="btn btn-link text-danger px-3 my-0" data-bs-dismiss="modal"  type="button"  aria-label="Close">Cancel</button>
            <button class="btn btn-primary my-0">Create Deal</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  

    @push('scripts') 
    <script src="{{asset('vendors/choices/choices.min.js')}}"></script>
    <script src="{{asset('vendors/sortablejs/sortable.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
   <script>
        function exportTableToExcel(tableID, filename = 'table') {
            // Clone the table to avoid modifying the original table
            let originalTable = document.getElementById(tableID);
            let tableClone = originalTable.cloneNode(true);

            // Remove the last column from the cloned table
            let rows = tableClone.rows;
            for (let i = 0; i < rows.length; i++) {
                rows[i].deleteCell(-1); // Deletes the last cell
            }

            // Convert the modified table to a worksheet
            let workbook = XLSX.utils.table_to_book(tableClone, { sheet: "Sheet1" });

            // Export to Excel file
            XLSX.writeFile(workbook, `${filename}.xlsx`);
        }
    </script>
  
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let toggleIcon = document.getElementById('viewToggle');

        toggleIcon.addEventListener('click', function () {
		
            let newView = this.classList.contains('fa-table') ? 'table' : 'kanban';

            // Change the icon dynamically
            this.classList.toggle('fa-table');
            this.classList.toggle('fa-th-large');

            // Send AJAX request to save preference
            fetch("{{ route('crmdeal.setViewMode') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ view: newView })
            }).then(response => {
                if(response.ok) {
                    window.location.href = newView === 'kanban' ? "{{ route('admin.dealkanban') }}" : "{{ route('crm.deals') }}";
                }
            });
        });
    });
</script>
  @endpush
        @endsection
		
		