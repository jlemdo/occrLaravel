@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush
<div class="kanban-header">
  <div class="row gx-0 justify-content-between justify-content-md-start">
    <div class="col-auto">
      

        <button class="btn btn-link text-decoration-none text-1100 fs-0 ps-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fs-1 me-2">Leads</span></button>
@can('Lead Add')
      <a class="btn btn-phoenix-primary me-4" href="{{route('crm.contacts')}}"><span class="fas fa-plus me-2"></span>Add Lead</a>

@endcan

      
    </div>
    
    
               
    
  </div>
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



<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==0){ ?>active<?php } ?>" aria-current="page" href="{{URL::to('leadkanban?status_type=0')}}"><span>All</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==1){ ?>active<?php } ?>" href="{{URL::to('leadkanban?status_type=1')}}"><span>Completed</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==2){ ?>active<?php } ?>" href="{{URL::to('leadkanban?status_type=2')}}"><span>Junk</span></a></li>


</ul>
</div>
              <div class="col-12 col-sm-auto">
                
        <div class="search-box">
    <form class="position-relative" style="display:flex" data-bs-toggle="search" data-bs-display="static" method="GET" action="{{ route('admin.leadkanban') }}">
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
      <form method="GET" action="{{ route('admin.leadkanban') }}">
  <div class="input-group">
      <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
      <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
      <button class="btn btn-phoenix-primary" type="submit">Filter</button>
      @if(request()->has('search') || request()->has('from_date') || request()->has('to_date') || request()->has('status') || request()->has('status_type'))
          <a href="{{ route('admin.leadkanban') }}" class="btn btn-phoenix-secondary">Reset</a>
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
<a class="dropdown-item" href="{{URL::to('leadkanban?sdays=7')}}" <?php if($sdays==7){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 7 Days</a>
<a class="dropdown-item" href="{{URL::to('leadkanban?sdays=14')}}" <?php if($sdays==14){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 14 Days</a>
<a class="dropdown-item" href="{{URL::to('leadkanban?sdays=21')}}" <?php if($sdays==21){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 21 Days</a>
<a class="dropdown-item" href="{{URL::to('leadkanban?sdays=30')}}" <?php if($sdays==30){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 30 Days</a>


                        </div>
                      </div>
                    
    
                 <a class="btn btn-phoenix-primary px-3 me-1 border-0 text-body" href="#" id="viewToggle" data-bs-title="List view"><span class="fa-solid fa-list fs-10"></span></a>
				         
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
</div>
<div class="kanban-container scrollbar" data-kanban-container="data-kanban-container">

  @foreach ($lstage as $lstg)
  <div class="kanban-column scrollbar" data-status="{{$lstg->name}}">
    <div class="kanban-column-header px-4 hover-actions-trigger">
      <div class="d-flex align-items-center border-bottom border-3 py-3 border-300">
        <h5 class="mb-0 kanban-column-title">{{$lstg->name}}<span class="kanban-title-badge">
        @php $rowleadid=0;
    $count = App\Models\Leads::where('status', $lstg->name)->count();
@endphp
{{ $count }}					
                        </span></h5>
        <div class="hover-actions-trigger">

        </div><span class="uil uil-left-arrow-to-left fs-0 ms-auto kanban-collapse-icon" data-kanban-collapse="data-kanban-collapse"></span><span class="uil uil-arrow-from-right fs-0 ms-auto kanban-collapse-icon" data-kanban-collapse="data-kanban-collapse"></span>
      </div>
    </div>
    
    <div class="kanban-items-container sortable" id="kanban-{{ $lstg->name }}">
     @php
    $leadsQuery = App\Models\Leads::where('status', $lstg->name);
	 if (auth()->user()->usertype === 'admin') {
        $leadsQuery = $leadsQuery->latest();
    } else {
        $leadsQuery = $leadsQuery->where(function ($query) use ($current_user) {
            $query->where('created_by', auth()->user()->id)
                  ->orWhere('assigned_to', auth()->user()->id);
        })->latest();
    }
    if (request()->has('status_type')) {
        $statusType = request()->input('status_type');
        $leadsQuery->where('lead_status', $statusType);
    } else {
        $leadsQuery->where('lead_status', 0);
    }
    if (request()->has('from_date') && request()->has('to_date')) {
        $fromDate = request()->input('from_date');
        $toDate = request()->input('to_date');
        $leadsQuery->whereBetween('created_at', [$fromDate, $toDate]);
    }
     if (request()->has('sdays')) {
        $sdays = (int) request()->input('sdays'); 
        $toDatee = now(); 
        $fromDatee = now()->subDays($sdays); 
        $leadsQuery->whereBetween('created_at', [$fromDatee, $toDatee]);
    }
    if (request()->has('search')) {
        $search = request()->input('search');
        $sby = request()->input('sby');
        $leadsQuery->where($sby, 'like', '%' . $search . '%');
    }

    $projects = $leadsQuery->get();
@endphp

@foreach($projects as $project)

     @if($project->id)
        
      <div class="sortable-item-wrapper border-bottom px-2 py-2" data-id="{{$project->id}}">

        <div class="card sortable-item hover-actions-trigger">
          <div class="card-body py-3 px-3" >
            <div class="kanban-status mb-1 position-relative lh-1">
           
              <div class="font-sans-serif">
                <button class="btn btn-sm btn-phoenix-default kanban-item-dropdown-btn hover-actions" type="button" data-boundary="viewport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fa-rotate-90" data-fa-transform="shrink-2"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2" style="width: 15rem;">
<a class="dropdown-item" href="{{URL::to('convertlead/'.$project->id)}}">Convert Deal</a>
<a class="dropdown-item" href="{{URL::to('junklead/'.$project->id)}}">Junk Lead</a>
@can('Lead Delete')
              <form id="destroy-data{{ $i }}" action="{{ route('deletelead', $project->id)}}" method="post">
                @csrf

                <button class="dropdown-item d-flex flex-between-center border-1 text-danger" type="submit">Delete</button>
              </form>
@endcan
                </div>
              </div>
            </div>
            <?php $rowleadid=$project->id; ?>
            <div  onclick="showprofile('{{$project->id}}');">
             <div class="d-flex align-items-center"><span class="me-2 text-body-tertiary" data-feather="user"></span>
                                    <p class="mb-0 stretched-link fs-9" onclick="showprofile('{{$project->id}}');">{{ $project->first_name }}{{ $project->last_name }}</p>
                                  </div>
                                  
                 <div class="d-flex align-items-center" onclick="showprofile('{{$project->id}}');"><span class="me-2 text-body-tertiary" data-feather="inbox"></span>
                  <p class="mb-0 stretched-link fs-9" onclick="showprofile('{{$project->id}}');">{{ $project->email }}</p>
                </div>
                
                  <div class="d-flex align-items-center"><span class="me-2 text-body-tertiary" data-feather="bookmark"></span>
                  <p class="mb-0 stretched-link fs-9" onclick="showprofile('{{$project->id}}');">{{ $project->source }}</p>
                </div>
 
  
 
  
  <div class="d-flex mt-2 align-items-center">
    <p class="mb-0 text-600 fs--1 lh-1 me-3 white-space-nowrap"><span class="fa-solid fa-calendar-xmark fs--1 me-2 d-inline-block" style="min-width: 1rem;"></span>{{ $project->created_at }}</p>
    <div class="avatar-group ms-auto">
       
        <div class="avatar avatar-s  border border-white rounded-pill">
         @php 
$user = App\Models\User::where('id', $project->assigned_to)->first();
@endphp


@if($user->image)
                <img class="rounded-circle" src="{{asset('profile/'.$user->image)}}" alt="" />
                @else
                <img class="rounded-circle" src="{{asset('profile/avatar.png')}}" alt="" />	
                @endif
        </div>
        <div>
         
           
<label class="mb-0 stretched-link fs-9" >{{$user->first_name}}</label>

        </div>
      </div>
    </div>
     
          </div>  </div>
          
        </div>
<div class="py-1" style="width:50% !important">
   
  
    <select class="form-select form-select-sm py-0 ms-n3 border-0 shadow-none" onchange="changeStatus({{ $project->id }}, this.value)">
        @foreach ($lstage as $lstgnew) 
        <option value="{{$lstgnew->id}}"  @if($lstg->name==$lstgnew->name) selected @endif>{{$lstgnew->name}}</option> 
        @endforeach
   </select>
  
     </div>

      </div>
      
     @endif
     
      @endforeach
    </div>
  </div>

@endforeach
</div>


@push('scripts')
<script src="{{asset('vendors/sortablejs/sortable.min.js')}}"></script>
<script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  function showprofile(id) {
     event.preventDefault();
	 //alert(0);
     window.location.href = 'leadsdetails/' + id;
  }
</script>
<script>
    function changeStatus(leadId, newStatus) {
        // Confirmation dialog
        if (confirm("Are you sure you want to change the status to " + newStatus + "?")) {
            window.location.href = `{{ url('changestagequestions') }}?lead_id=${leadId}&stage_id=${newStatus}`;
        } else {
            alert('Status change canceled.');
        }
    }
</script>

<script>
  document.querySelectorAll('.sortable').forEach(function(element) {
    new Sortable(element, {
      group: 'kanban',
      animation: 150,
      onEnd: function(evt) {
        const leadId = evt.item.dataset.id;
        const newStatus = evt.to.closest('.kanban-column').dataset.status;

        // AJAX call to update lead status
        $.ajax({
          url: "{{ route('leads.changeStatusdd') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: leadId,
            status: newStatus
          },
          success: function(response) {
            if (response.success) {
              console.log(response.message);
            } else {
              alert(response.message);
            }
          },
          error: function(xhr) {
            alert('An error occurred while updating the status.');
          }
        });
      }
    });
  });
</script>
<script>
function openModal(leadId) {
    // Set the lead ID in the modal
	//alert(leadId);
    document.getElementById('leadidtask').value = leadId;

    // Manually open the modal using Bootstrap's JavaScript API
    const modal = new bootstrap.Modal(document.getElementById('kanbanAddTaskTask'));
    modal.show();
}
//openModalact
function openModalact(leadId) {
    // Set the lead ID in the modal
	//alert(leadId);
    document.getElementById('leadidact').value = leadId;

    // Manually open the modal using Bootstrap's JavaScript API
    const modal = new bootstrap.Modal(document.getElementById('kanbanAddTask'));
    modal.show();
}
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let toggleIcon = document.getElementById('viewToggle');

        toggleIcon.addEventListener('click', function () {
		
            let newView = this.classList.contains('fa-table') ? 'kanban' : 'table';

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