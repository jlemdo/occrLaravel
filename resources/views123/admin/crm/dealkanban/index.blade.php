@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush
<div class="kanban-header">
 <h2 class="mb-4">Deals  @can('Deal Add')
      <button class="btn btn-phoenix-primary me-4" type="button" data-bs-toggle="modal" data-bs-target="#addDealModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-plus me-2"></span>Create Deal</button>
@endcan
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
            <button class="btn btn-phoenix-primary my-0">Create Deal</button>
          </div>
        </div>
      </form>
      </div>
    </div></h2>
                  
  <div class="row gx-0 justify-content-between justify-content-md-start">
    
      <div class="col-auto">
      <form method="GET" action="{{ route('admin.dealkanban') }}">
          <div class="input-group">
              <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
              <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
              <button class="btn btn-phoenix-primary" type="submit">Filter</button>
              @if(request()->has('search') || request()->has('from_date') || request()->has('to_date'))
                  <a href="{{ route('admin.dealkanban') }}" class="btn btn-phoenix-secondary">Reset</a>
              @endif
          </div>
      </form>
  </div>

              <div class="col col-auto">
        <div class="search-box">
    <form class="position-relative" style="display:flex" data-bs-toggle="search" data-bs-display="static" method="GET" action="{{ route('admin.dealkanban') }}">
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
<a class="dropdown-item" href="{{URL::to('dealkanban?status_type=0')}}" <?php if($stype==0){ ?>style="background-color:#C3C3C3"<?php } ?>>All</a>
<a class="dropdown-item" href="{{URL::to('dealkanban?status_type=won')}}" <?php if($stype=='won'){ ?>style="background-color:#C3C3C3"<?php } ?>>Won</a>
<a class="dropdown-item" href="{{URL::to('dealkanban?status_type=loss')}}" <?php if($stype=='loss'){ ?>style="background-color:#C3C3C3"<?php } ?>>Loss</a>

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
<a class="dropdown-item" href="{{URL::to('dealkanban?sdays=7')}}" <?php if($sdays==7){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 7 Days</a>
<a class="dropdown-item" href="{{URL::to('dealkanban?sdays=14')}}" <?php if($sdays==14){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 14 Days</a>
<a class="dropdown-item" href="{{URL::to('dealkanban?sdays=21')}}" <?php if($sdays==21){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 21 Days</a>
<a class="dropdown-item" href="{{URL::to('dealkanban?sdays=30')}}" <?php if($sdays==30){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 30 Days</a>


                        </div>
                      </div>
                     </div>
                     <div class="col-12 col-sm-auto"><div class="d-flex align-items-center">
    
                    
    
                 <a class="btn btn-phoenix-primary px-3 me-1 border-0 text-body" href="#" id="viewToggle" data-bs-title="List view"><span class="fa-solid fa-list fs-10"></span></a>
				         
				 
                     </div>  </div>
  </div>
</div>
<div class="kanban-container scrollbar" data-kanban-container="data-kanban-container">

  @foreach ($lstage as $lstg)
  <div class="kanban-column scrollbar" data-status="{{$lstg->name}}">
    <div class="kanban-column-header px-4 hover-actions-trigger">
      <div class="d-flex align-items-center border-bottom border-3 py-3 border-300">
        <h5 class="mb-0 kanban-column-title">{{$lstg->name}}<span class="kanban-title-badge">
        @php 
    $count = App\Models\Deals::where('stage', $lstg->name)->count();
@endphp
{{ $count }}					
                        </span></h5>
        <div class="hover-actions-trigger">

        </div><span class="uil uil-left-arrow-to-left fs-0 ms-auto kanban-collapse-icon" data-kanban-collapse="data-kanban-collapse"></span><span class="uil uil-arrow-from-right fs-0 ms-auto kanban-collapse-icon" data-kanban-collapse="data-kanban-collapse"></span>
      </div>
    </div>
   
    <div class="kanban-items-container sortable" id="kanban-{{ $lstg->name }}">
    
      
         @php
    $leadsQuery = App\Models\Deals::where('stage', $lstg->name);
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
        $leadsQuery->where('deal_status', $statusType);
    } else {
        $leadsQuery->where('deal_status', 0);
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
        
      <div class="sortable-item-wrapper border-bottom px-2 py-2" data-id="{{$project->id}}">

        <div class="card sortable-item hover-actions-trigger">
          <div class="card-body py-3 px-3">
            <div class="kanban-status mb-1 position-relative lh-1">
           
              <div class="font-sans-serif">
                <button class="btn btn-sm btn-phoenix-default kanban-item-dropdown-btn hover-actions" type="button" data-boundary="viewport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fa-rotate-90" data-fa-transform="shrink-2"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2" style="width: 15rem;">
						  <a class="dropdown-item" href="{{URL::to('wondeal/'.$project->id)}}">Won</a>
                          <a class="dropdown-item" href="{{URL::to('lossdeal/'.$project->id)}}">Loss</a>
                          @can('Deal Delete')
                  <form id="destroy-data{{ $i }}" action="{{ route('deletedeal', $project->id)}}" method="post">
                    @csrf

                    <button class="dropdown-item d-flex flex-between-center border-1 text-danger" type="submit">Delete</button>
                  </form>
@endcan
                </div>
              </div>
            </div>
             
             <div class="d-flex align-items-center"><span class="me-2 text-body-tertiary" data-feather="user"></span>
                         
                         <p class="mb-0 stretched-link" onclick="showprofile('{{$project->id}}');"> {{ $project->name }} </p>
                        </div>
       <div class="d-flex align-items-center"><span class="me-2 text-body-tertiary" data-feather="inbox"></span>
                         <p class="mb-0 stretched-link" onclick="showprofile('{{$project->id}}');">{{ $project->email }}</p>
                        </div>


    <div class="d-flex align-items-center"><span class="me-2 text-body-tertiary" data-feather="bookmark"></span>
                         <p class="mb-0 stretched-link" onclick="showprofile('{{$project->id}}');">{{ $project->lead_source }}</p>
                        </div>


   
    <div class="d-flex mt-2 align-items-center">
      <p class="mb-0 text-600 fs--1 lh-1 me-3 white-space-nowrap"><span class="fa-solid fa-calendar-xmark fs--1 me-2 d-inline-block" style="min-width: 1rem;"></span>{{ $project->created_at }}</p>
      <div class="avatar-group ms-auto">
       
        <div class="avatar avatar-s  border border-white rounded-pill">
       


        </div>
       
      </div>
    </div>
     
          </div>
          
        </div>
<div class="py-1" style="width:50% !important">
     	

    <select class="form-select form-select-sm py-0 ms-n3 border-0 shadow-none" onchange="changeStatus({{ $project->id }}, this.value)">
        @foreach ($lstage as $lstgnew) <option value="{{$lstgnew->name}}"  @if($lstg->name==$lstgnew->name) selected @endif>{{$lstgnew->name}}</option> @endforeach
   </select>
  
     </div>
<div class="modal fade" id="kanbanAddTask" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{route('adddealactivity')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-sm-6 col-md-12">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="title" name="title" value="{{old('title')}}" />
                <input class="form-control" id="leadid" type="hidden" name="leadid" value="{{$project->id}}" />
                <label for="kanbanTaskTitle">Title</label>
              </div>
            </div>
            <div class="col-12 gy-4">
              <div class="form-floating">
                <textarea class="form-control" id="floatingProjectDescription" placeholder="Leave a comment here" name="description" style="height: 128px">{{old('description')}}</textarea>
                <label for="floatingProjectDescription">ADD A DESCRIPTION</label>
              </div>
            </div>



          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--2 me-1" data-fa-transform="up-1"></span>Close</button>
          <button class="btn btn-primary px-6" type="submit" data-bs-dismiss="modal">Done</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="sendEmailModel" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{route('leads.sendemaildeals')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-sm-6 col-md-12">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="Email Subject" name="subject"  />
                <input class="form-control"  type="hidden" name="email" value="{{$project->email}}"  />
                <label for="kanbanTaskTitle">Subject</label>
              </div>
            </div>
            <div class="col-12 gy-4">
              <div class="form-floating">
                <textarea class="form-control" id="floatingProjectDescription" placeholder="Leave a comment here" name="content" style="height: 128px">{{old('description')}}</textarea>
                <label for="floatingProjectDescription">ADD A Message</label>
              </div>
            </div>



          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--2 me-1" data-fa-transform="up-1"></span>Close</button>
          <button class="btn btn-primary px-6" type="submit" data-bs-dismiss="modal">Done</button>
        </div>
      </form>
    </div>
  </div>
</div>
      </div>
      @endforeach
    </div>
  </div>

@endforeach
</div>







<div class="modal fade" id="KanbanItemDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered">
    <div class="modal-content overflow-hidden" id="speaker-profile-content">

    </div>
  </div>
</div>

 <div class="modal fade" id="kanbanAddTaskTask" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{route('adddealtask')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-sm-6 col-md-12">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="title" name="title" value="{{old('title')}}" />
                <input class="form-control" id="leadidtask" type="hidden" name="leadid" value="" />
                <label for="kanbanTaskTitle">Task Title </label>
              </div>
            </div>
            <div class="col-12 gy-4">
              <div class="form-floating">
<textarea class="form-control" id="contentToCopy" placeholder="text" name="description" style="height:128px">{{old('description')}}</textarea>
<label for="contentToCopy">ADD A DESCRIPTION</label>

              </div>
            </div>
            <div class="col-12 gy-4">
            <div class="row g-3">
            <div class="col-6">
                      <label class="text-1000 fw-bold mb-2"> Date</label>
                      <input class="form-control datetimepicker" name="date" type="text" placeholder="dd / mm / yyyy" data-options='{"disableMobile":true}' />
                    </div>
                    <div class="col-6">
                      <label class="text-1000 fw-bold mb-2"> Time</label>
                      <input class="form-control datetimepicker" name="time" type="text" placeholder="H:i" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' />
                    </div>
            </div></div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--2 me-1" data-fa-transform="up-1"></span>Close</button>
          <button class="btn btn-primary px-6" type="submit" data-bs-dismiss="modal">Done</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script src="{{asset('vendors/choices/choices.min.js')}}"></script>
<script src="{{asset('vendors/sortablejs/sortable.min.js')}}"></script>
<script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  function showprofile(id) {
     event.preventDefault();
  window.location.href = 'dealsdetails/' + id;
  }
</script>
<script>
    function changeStatus(leadId, newStatus) {
        // Confirmation dialog
        if (confirm("Are you sure you want to change the status to " + newStatus + "?")) {
            $.ajax({
                url: "{{ route('deal.changeStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: leadId,
                    status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                       // alert(response.message);
                        location.reload(); // Reload to reflect changes (optional)
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while updating the status.');
                }
            });
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
          url: "{{ route('deal.changeStatusdd') }}",
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
  
 
function openModal(leadId) {
    // Set the lead ID in the modal
	//alert(leadId);
    document.getElementById('leadidtask').value = leadId;

    // Manually open the modal using Bootstrap's JavaScript API
    const modal = new bootstrap.Modal(document.getElementById('kanbanAddTaskTask'));
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