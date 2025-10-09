@extends('layouts.app')
@section('section')
@push('styles')

    <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
	
@endpush

     
        <div class="pb-6">
        <div class="d-flex align-items-center">
   
   <a href="#" id="viewToggle"> <i  
       class="fas {{ session('lead_view') == 'table' ? 'fa-th-large' : 'fa-list' }}" 
       style="font-size: 24px; cursor: pointer; color: gray;"></i></a>
</div>


<h2 class="mb-4">Leads  
@can('Lead Add')
<a class="btn btn-primary me-4" href="{{route('crm.contacts')}}"><span class="fas fa-plus me-1"></span>Add Lead</a>
@endcan
</h2>
          <div id="lealsTable" >
            <div class="row g-3 justify-content-between mb-4">
              
                <div class="col-auto">
      <form method="GET" action="{{ route('crm.myleads') }}">
  <div class="input-group">
      <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
      <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
      <button class="btn btn-primary" type="submit">Filter</button>
      @if(request()->has('search') || request()->has('from_date') || request()->has('to_date') || request()->has('status') || request()->has('status_type'))
          <a href="{{ route('crm.myleads') }}" class="btn btn-secondary">Reset</a>
      @endif
  </div>
      </form>
  </div>

              <div class="col col-auto">
        <div class="search-box">
    <form class="position-relative" style="display:flex" data-bs-toggle="search" data-bs-display="static" method="GET" action="{{ route('crm.myleads') }}">
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
        <option value="first_name" @if($sby =='first_name') selected @endif > First Name</option>
        <option value="last_name" @if($sby =='last_name') selected @endif> Last Name</option>
        <option value="title" @if($sby =='title') selected @endif> Title</option>
        <option value="phone" @if($sby =='phone') selected @endif> phone</option>
        <option value="email" @if($sby =='email') selected @endif> Email</option>
        <option value="status" @if($sby =='status') selected @endif> Stage</option>
        <option value="source" @if($sby =='source') selected @endif> Source</option>
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
<a class="dropdown-item" href="{{URL::to('myleads?status_type=0')}}" <?php if($stype==0){ ?>style="background-color:#C3C3C3"<?php } ?>>All</a>
<a class="dropdown-item" href="{{URL::to('myleads?status_type=1')}}" <?php if($stype==1){ ?>style="background-color:#C3C3C3"<?php } ?>>Completed</a>
<a class="dropdown-item" href="{{URL::to('myleads?status_type=2')}}" <?php if($stype==2){ ?>style="background-color:#C3C3C3"<?php } ?>>Junk</a>
<a class="dropdown-item" href="#" onclick="exportTableToExcel('myTable', 'MyTableData')" >Export </a>

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
<a class="dropdown-item" href="{{URL::to('myleads?sdays=7')}}" <?php if($sdays==7){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 7 Days</a>
<a class="dropdown-item" href="{{URL::to('myleads?sdays=14')}}" <?php if($sdays==14){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 14 Days</a>
<a class="dropdown-item" href="{{URL::to('myleads?sdays=21')}}" <?php if($sdays==21){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 21 Days</a>
<a class="dropdown-item" href="{{URL::to('myleads?sdays=30')}}" <?php if($sdays==30){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 30 Days</a>


                        </div>
                      </div>
                     </div>
                     <div class="col col-auto">
    <div class="font-sans-serif btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                        <?php
        $lsg = '0';
        ?>
        @if (request()->has('lsg'))
    	@php
        $lsg = request()->input('lsg');
    	@endphp

@endif

@foreach ($lstage as $ls)
 <a class="dropdown-item" href="{{ URL::to('myleads?status=' . $ls->name) }}" 
       @if ($lsg == $ls->name) style="background-color:#C3C3C3" @endif>
        {{ $ls->name }}
    </a>
@endforeach

                        </div>
                      </div>
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
                     <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="phone" style="width:15%; min-width: 180px;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-primary-100 rounded me-2"><span class="text-primary-600 dark__text-primary-300" data-feather="phone"></span></div><span>Stage</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="contact" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-info-100 rounded me-2"><span class="text-info-600 dark__text-info-300" data-feather="globe"></span></div><span>Address</span>
                      </div>
                    </th>
                   <!-- <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="company" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-warning-100 rounded me-2"><span class="text-warning-600 dark__text-warning-300" data-feather="grid"></span></div><span>System</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Create date</th>-->
                    <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list" id="leal-tables-body">
                @foreach ($leads as $lead)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                   
                    <td class="name align-middle white-space-nowrap ps-0">
                      <div class="d-flex align-items-center"><a href="#!">
                          
                        </a>
                        <div><a class="fs-0 fw-bold" href="#!">{{$lead->first_name}} {{$lead->last_name}}</a>
                         
                        </div>
                      </div>
                    </td>
                    <td class="email align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="mailto:{{$lead->email}}">{{$lead->email}}</a></td>
                    <td class="phone align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="tel:{{$lead->phone}}">{{$lead->phone}}</a></td>
                     <td class="phone align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="tel:{{$lead->phone}}">
                      <select class="form-control lead-status" data-lead-id="{{ $lead->id }}">
        @foreach ($lstage as $ls)
        <option value="{{ $ls->name }}" {{ $ls->name == $lead->status ? 'selected' : '' }}>
            {{ $ls->name }}
        </option>
        @endforeach
    </select>
     <select class="form-control stage-questions" data-lead-id="{{ $lead->id }}">
            @foreach ($lstage as $ls)
                <option value="{{ $ls->id }}" {{ $ls->name == $lead->status ? 'selected' : '' }}>
                    {{ $ls->name }}
                </option>
            @endforeach
        </select>
                     </a></td>
                    <td class="contact align-middle white-space-nowrap ps-4 border-end fw-semi-bold text-1000">{{$lead->street}}, {{$lead->city}}, {{$lead->state}}</td>
                    <!--<td class="company align-middle white-space-nowrap text-600 ps-4 border-end fw-semi-bold text-1000">
					@php
					$decodedData = null;
    if ($lead->projectdetails) {
    $decodedData = json_decode($lead->projectdetails->os_json);
	}
@endphp
					@if ($decodedData)
						@if($decodedData->systems)
    {{ $decodedData->systems[0]->kw_stc }} kwh
@endif
@else
   -
@endif
					</td>
                    <td class="date align-middle white-space-nowrap text-600 ps-4 text-700">{{$lead->created_at}}</td>-->
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                      <div class="font-sans-serif btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                          <a class="dropdown-item" href="{{URL::to('leadsdetails/'.$lead->id)}}">View</a>
                          @can('Lead Edit')
						  <a class="dropdown-item" href="{{URL::to('leadedit/'.$lead->id)}}">Edit</a>
                          @endcan
                          <a class="dropdown-item" href="{{URL::to('convertlead/'.$lead->id)}}">Convert Deal</a>
                          <a class="dropdown-item" href="{{URL::to('junklead/'.$lead->id)}}">Junk Lead</a>
                          @can('Lead Delete')
                          <form id="destroy-data{{ $lead->id }}"
                                                action="{{ route('deletelead', $lead->id)}}"
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
            <div class="row align-items-center justify-content-end py-4 pe-0 fs--1">
            
    <div class="col-auto d-flex">
        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900">
            Showing {{ $leads->firstItem() }} - {{ $leads->lastItem() }} of {{ $leads->total() }} leads
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
        </div>
        
       
   

    @push('scripts') 
	
    <script src="{{asset('vendors/choices/choices.min.js')}}"></script>
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
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.lead-status').forEach(select => {
            select.addEventListener('change', function () {
                const leadId = this.dataset.leadId;
                const status = this.value;
                // Confirm action
                const confirmed = confirm('Do you really want to change the lead stage?');
                if (!confirmed) {
                    this.value = this.dataset.currentStatus || '';
                    return;
                }

                this.dataset.currentStatus = status;
                fetch("{{ route('leads.update.status') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ lead_id: leadId, status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully');
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.stage-questions').forEach(select => {
            select.addEventListener('change', function () {
                const leadId = this.dataset.leadId;
                const stageId = this.value;

                if (stageId) {
                    window.location.href = `{{ url('changestagequestions') }}?lead_id=${leadId}&stage_id=${stageId}`;
                }
            });
        });
    });
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
            fetch("{{ route('crm.setViewMode') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ view: newView })
            }).then(response => {
                if(response.ok) {
                    window.location.href = newView === 'kanban' ? "{{ route('admin.leadkanban') }}" : "{{ route('crm.myleads') }}";
                }
            });
        });
    });
</script>
  @endpush
        @endsection