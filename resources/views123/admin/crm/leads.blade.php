@extends('layouts.app')
@section('section')
@push('styles')

    <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
	
@endpush

     
        <div class="pb-6">
      

<h2 class="mb-4">Leads  
@can('Lead Add')
<a class="btn btn-phoenix-primary me-4" href="{{route('crm.contacts')}}"><span class="fas fa-plus me-1"></span>Add Lead</a>
@endcan
</h2>
<div class="row g-3 justify-content-between align-items-end mb-4">
<div class="col-12 col-sm-auto">
<ul class="nav nav-links mx-n2">
 <?php
        $stype = '0';
        ?>
        @if (request()->has('status_type'))
    	@php
        $stype = request()->input('status_type');
    	@endphp

@endif



<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==0){ ?>active<?php } ?>" aria-current="page" href="{{URL::to('myleads?status_type=0')}}"><span>All</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==1){ ?>active<?php } ?>" href="{{URL::to('myleads?status_type=1')}}"><span>Completed</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==2){ ?>active<?php } ?>" href="{{URL::to('myleads?status_type=2')}}"><span>Junk</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1" href="#" onclick="exportTableToExcel('myTable', 'MyTableData')"><span>Export</span></a></li>

</ul>
</div>
              <div class="col-12 col-sm-auto">
                
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
    </div>
              </div> 
                <div class="col-12 col-sm-auto">
      <form method="GET" action="{{ route('crm.myleads') }}">
  <div class="input-group">
      <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
      <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
      <button class="btn btn-phoenix-primary" type="submit">Filter</button>
      @if(request()->has('search') || request()->has('from_date') || request()->has('to_date') || request()->has('status') || request()->has('status_type'))
          <a href="{{ route('crm.myleads') }}" class="btn btn-phoenix-secondary">Reset</a>
      @endif
  </div>
      </form>
  </div>

              
    
    
                      <div class="col-12 col-sm-auto"><div class="d-flex align-items-center">
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
                       
				  <a class="btn btn-phoenix-primary " href="#" id="viewToggle" data-bs-title="Kanban">
                    <svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0.5C0 0.223858 0.223858 0 0.5 0H3.5C3.77614 0 4 0.223858 4 0.5V3.5C4 3.77614 3.77614 4 3.5 4H0.5C0.223858 4 0 3.77614 0 3.5V0.5Z" fill="currentColor"></path>
                      <path d="M0 5.5C0 5.22386 0.223858 5 0.5 5H3.5C3.77614 5 4 5.22386 4 5.5V8.5C4 8.77614 3.77614 9 3.5 9H0.5C0.223858 9 0 8.77614 0 8.5V5.5Z" fill="currentColor"></path>
                      <path d="M5 0.5C5 0.223858 5.22386 0 5.5 0H8.5C8.77614 0 9 0.223858 9 0.5V3.5C9 3.77614 8.77614 4 8.5 4H5.5C5.22386 4 5 3.77614 5 3.5V0.5Z" fill="currentColor"></path>
                      <path d="M5 5.5C5 5.22386 5.22386 5 5.5 5H8.5C8.77614 5 9 5.22386 9 5.5V8.5C9 8.77614 8.77614 9 8.5 9H5.5C5.22386 9 5 8.77614 5 8.5V5.5Z" fill="currentColor"></path>
                    </svg></a>
                    <a class="btn btn-phoenix-primary px-3 me-1" href="#" id="viewTogglecard"  data-bs-title="Card view">
                    <svg width="9" height="9" viewbox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0.5C0 0.223857 0.223858 0 0.5 0H1.83333C2.10948 0 2.33333 0.223858 2.33333 0.5V1.83333C2.33333 2.10948 2.10948 2.33333 1.83333 2.33333H0.5C0.223857 2.33333 0 2.10948 0 1.83333V0.5Z" fill="currentColor"></path>
                      <path d="M3.33333 0.5C3.33333 0.223857 3.55719 0 3.83333 0H5.16667C5.44281 0 5.66667 0.223858 5.66667 0.5V1.83333C5.66667 2.10948 5.44281 2.33333 5.16667 2.33333H3.83333C3.55719 2.33333 3.33333 2.10948 3.33333 1.83333V0.5Z" fill="currentColor"></path>
                      <path d="M6.66667 0.5C6.66667 0.223857 6.89052 0 7.16667 0H8.5C8.77614 0 9 0.223858 9 0.5V1.83333C9 2.10948 8.77614 2.33333 8.5 2.33333H7.16667C6.89052 2.33333 6.66667 2.10948 6.66667 1.83333V0.5Z" fill="currentColor"></path>
                      <path d="M0 3.83333C0 3.55719 0.223858 3.33333 0.5 3.33333H1.83333C2.10948 3.33333 2.33333 3.55719 2.33333 3.83333V5.16667C2.33333 5.44281 2.10948 5.66667 1.83333 5.66667H0.5C0.223857 5.66667 0 5.44281 0 5.16667V3.83333Z" fill="currentColor"></path>
                      <path d="M3.33333 3.83333C3.33333 3.55719 3.55719 3.33333 3.83333 3.33333H5.16667C5.44281 3.33333 5.66667 3.55719 5.66667 3.83333V5.16667C5.66667 5.44281 5.44281 5.66667 5.16667 5.66667H3.83333C3.55719 5.66667 3.33333 5.44281 3.33333 5.16667V3.83333Z" fill="currentColor"></path>
                      <path d="M6.66667 3.83333C6.66667 3.55719 6.89052 3.33333 7.16667 3.33333H8.5C8.77614 3.33333 9 3.55719 9 3.83333V5.16667C9 5.44281 8.77614 5.66667 8.5 5.66667H7.16667C6.89052 5.66667 6.66667 5.44281 6.66667 5.16667V3.83333Z" fill="currentColor"></path>
                      <path d="M0 7.16667C0 6.89052 0.223858 6.66667 0.5 6.66667H1.83333C2.10948 6.66667 2.33333 6.89052 2.33333 7.16667V8.5C2.33333 8.77614 2.10948 9 1.83333 9H0.5C0.223857 9 0 8.77614 0 8.5V7.16667Z" fill="currentColor"></path>
                      <path d="M3.33333 7.16667C3.33333 6.89052 3.55719 6.66667 3.83333 6.66667H5.16667C5.44281 6.66667 5.66667 6.89052 5.66667 7.16667V8.5C5.66667 8.77614 5.44281 9 5.16667 9H3.83333C3.55719 9 3.33333 8.77614 3.33333 8.5V7.16667Z" fill="currentColor"></path>
                      <path d="M6.66667 7.16667C6.66667 6.89052 6.89052 6.66667 7.16667 6.66667H8.5C8.77614 6.66667 9 6.89052 9 7.16667V8.5C9 8.77614 8.77614 9 8.5 9H7.16667C6.89052 9 6.66667 8.77614 6.66667 8.5V7.16667Z" fill="currentColor"></path>
                    </svg></a>
                     </div>  </div> 
            </div>
          <div id="lealsTable" >
            <div class="row g-3 justify-content-between mb-4">
              
              
            </div>
            <div class="table-responsive scrollbar">
           
              <table class="table fs-9 mb-0 border-top border-translucent" id="myTable">
                <thead>
<tr>

<th class="sort white-space-nowrap align-middle text-uppercase ps-0" scope="col" data-sort="name" style="width:25%;">Title</th>
<th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="assigne" style="width:25%;">Assignee</th>
<th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="email" style="width:15%;">Email</th>
<th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="phone" style="width:15%;">Phone</th>
<th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="phone" style="width:15%;">Stage</th>
<th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Create date</th>
<th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
</tr>
                </thead>
                <tbody class="list" id="leal-tables-body">
                @foreach ($leads as $lead)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                   
                    <td class="name align-middle white-space-nowrap ps-0">
                      <div class="d-flex align-items-center"><a href="#!">
                          
                        </a>
                        <div><a class="fs-0 fw-bold" href="#!">{{$lead->title}} {{$lead->last_name}}</a>
                         
                        </div>
                      </div>
                    </td>
                    <td class="align-middle white-space-nowrap assignees ps-3 py-4">
                      <div class="avatar-group avatar-group-dense">
                          <div class="avatar avatar-s  rounded-circle">
                            <img class="rounded-circle " src="../../assets/img/team/34.webp" alt="" />
                          </div>                       
                      </div>
                    </td>
                    <td class="email align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="mailto:{{$lead->email}}">{{$lead->email}}</a></td>
                    <td class="phone align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="tel:{{$lead->phone}}">{{$lead->phone}}</a></td>
                     <td class="phone align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="tel:{{$lead->phone}}">
                      
     <select class="form-control-sm badge badge-phoenix fs-10 badge-phoenix-success stage-questions" data-lead-id="{{ $lead->id }}">
            @foreach ($lstage as $ls)
                <option value="{{ $ls->id }}" {{ $ls->name == $lead->status ? 'selected' : '' }}>
                    {{ $ls->name }}
                </option>
            @endforeach
        </select>
                     </a></td>
                   
                  
                    <td class="date align-middle white-space-nowrap text-600 ps-4 text-700">{{$lead->created_at}}</td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                      <div class="font-sans-serif btn-reveal-trigger position-static ">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2 badge badge-phoenix fs-10 badge-phoenix-danger" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
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
	 document.addEventListener("DOMContentLoaded", function () {
        let toggleIcon = document.getElementById('viewTogglecard');

        toggleIcon.addEventListener('click', function () {
		
            let newView = 'card' ;

           

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
                    window.location.href = newView === 'card' ? "{{ route('admin.leadcard') }}" : "{{ route('crm.myleads') }}";
                }
            });
        });
    });
</script>
  @endpush
        @endsection