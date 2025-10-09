@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush
<div >
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



<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==0){ ?>active<?php } ?>" aria-current="page" href="{{URL::to('leadcard?status_type=0')}}"><span>All</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==1){ ?>active<?php } ?>" href="{{URL::to('leadcard?status_type=1')}}"><span>Completed</span></a></li>
<li class="nav-item"><a class="nav-link px-2 py-1 <?php if($stype==2){ ?>active<?php } ?>" href="{{URL::to('leadcard?status_type=2')}}"><span>Junk</span></a></li>


</ul>
</div>
              <div class="col-12 col-sm-auto">
                
        <div class="search-box">
    <form class="position-relative" style="display:flex" data-bs-toggle="search" data-bs-display="static" method="GET" action="{{ route('admin.leadcard') }}">
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
      <form method="GET" action="{{ route('admin.leadcard') }}">
  <div class="input-group">
      <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
      <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
      <button class="btn btn-phoenix-primary" type="submit">Filter</button>
      @if(request()->has('search') || request()->has('from_date') || request()->has('to_date') || request()->has('status') || request()->has('status_type'))
          <a href="{{ route('admin.leadcard') }}" class="btn btn-phoenix-secondary">Reset</a>
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
<a class="dropdown-item" href="{{URL::to('leadcard?sdays=7')}}" <?php if($sdays==7){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 7 Days</a>
<a class="dropdown-item" href="{{URL::to('leadcard?sdays=14')}}" <?php if($sdays==14){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 14 Days</a>
<a class="dropdown-item" href="{{URL::to('leadcard?sdays=21')}}" <?php if($sdays==21){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 21 Days</a>
<a class="dropdown-item" href="{{URL::to('leadcard?sdays=30')}}" <?php if($sdays==30){ ?>style="background-color:#C3C3C3"<?php } ?>>Last 30 Days</a>


                        </div>
                      </div>
                      <div class="font-sans-serif btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                        <?php
        $lsg = '0';
        ?>
        @if (request()->has('status'))
    	@php
        $lsg = request()->input('status');
    	@endphp

@endif

@foreach ($lstage as $ls)
 <a class="dropdown-item" href="{{ URL::to('leadcard?status=' . $ls->name) }}" 
       @if ($lsg == $ls->name) style="background-color:#C3C3C3" @endif>
        {{ $ls->name }}
    </a>
@endforeach

                        </div>
                      </div>
                    
    
                 <a class="btn btn-phoenix-primary px-3 me-1 border-0 text-body" href="#" id="viewToggle" data-bs-title="List view"><span class="fa-solid fa-list fs-10"></span></a>
				         
				<a class="btn btn-phoenix-primary " href="#" id="viewTogglek" data-bs-title="Kanban">
                    <svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0.5C0 0.223858 0.223858 0 0.5 0H3.5C3.77614 0 4 0.223858 4 0.5V3.5C4 3.77614 3.77614 4 3.5 4H0.5C0.223858 4 0 3.77614 0 3.5V0.5Z" fill="currentColor"></path>
                      <path d="M0 5.5C0 5.22386 0.223858 5 0.5 5H3.5C3.77614 5 4 5.22386 4 5.5V8.5C4 8.77614 3.77614 9 3.5 9H0.5C0.223858 9 0 8.77614 0 8.5V5.5Z" fill="currentColor"></path>
                      <path d="M5 0.5C5 0.223858 5.22386 0 5.5 0H8.5C8.77614 0 9 0.223858 9 0.5V3.5C9 3.77614 8.77614 4 8.5 4H5.5C5.22386 4 5 3.77614 5 3.5V0.5Z" fill="currentColor"></path>
                      <path d="M5 5.5C5 5.22386 5.22386 5 5.5 5H8.5C8.77614 5 9 5.22386 9 5.5V8.5C9 8.77614 8.77614 9 8.5 9H5.5C5.22386 9 5 8.77614 5 8.5V5.5Z" fill="currentColor"></path>
                    </svg></a> 
                     </div>  </div> 
            </div>
</div>


 
       
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 row-cols-xxl-4 g-3 mb-9">
         @php
    $leadsQuery = App\Models\Leads::query();
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
    }
    if (request()->has('status')) {
        $statusType = request()->input('status');
        $leadsQuery->where('status', $statusType);
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
          <div class="col">
            <div class="card h-100 hover-actions-trigger">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h4 class="mb-2 line-clamp-1 lh-sm flex-1 me-3" style="display:flex">{{ $project->title }}   <div class="font-sans-serif">
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
              </div></h4>
                 
                   <div class="hover-actions top-0 end-0 mt-4 me-2" >
                  <a class="btn btn-primary btn-icon flex-shrink-0" href="{{URL::to('leadsdetails/'.$project->id)}}"><span class="fa-solid fa-chevron-right"></span></a>
                    <!--<button class="btn btn-primary btn-icon flex-shrink-0" data-bs-toggle="modal" data-bs-target="#projectsCardViewModal"><span class="fa-solid fa-chevron-right"></span></button>-->
                  </div>
                </div>
                @if($project->lead_status == 0)
                <span class="badge badge-phoenix fs-10 mb-4 badge-phoenix-info">Opened</span>
                @elseif($project->lead_status == 1)
                <span class="badge badge-phoenix fs-10 mb-4 badge-phoenix-success">Completed</span>
                @else
                <span class="badge badge-phoenix fs-10 mb-4 badge-phoenix-danger">Junk</span>
                @endif
                
                <div class="d-flex align-items-center mb-2"><span class="fa-solid fa-user me-2 text-body-tertiary fs-9 fw-extra-bold"></span>
                  <p class="fw-bold mb-0 text-truncate lh-1">Client : <span class="fw-semibold text-primary ms-1"> {{ $project->first_name }}{{ $project->last_name }}</span></p>
                </div>
                <div class="d-flex align-items-center mb-4"><span class="fa-solid fa-inbox me-2 text-body-tertiary fs-9 fw-extra-bold"></span>
                  <p class="fw-bold mb-0 lh-1">Email : <span class="ms-1 text-body-emphasis">{{ $project->email }}</span></p>
                </div>
                <div class="d-flex justify-content-between text-body-tertiary fw-semibold">
                  <p class="mb-2"> Stage</p>
                  <p class="mb-2 text-body-emphasis"><select class="form-select form-select-sm py-0 ms-n3 border-0 shadow-none " onchange="changeStatus({{ $project->id }}, this.value)">
                  
        @foreach ($lstage as $lstgnew) 
        <option value="{{$lstgnew->id}}"  @if($project->status==$lstgnew->name) selected @endif>{{$lstgnew->name}}</option> 
        @endforeach
   </select></p>
                </div>
               
                <div class="d-flex align-items-center mt-4">
                  <p class="mb-0 fw-bold fs-9">Started :<span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">	{{$project->created_at}}</span></p>
                </div>
                
                <div class="d-flex d-lg-block d-xl-flex justify-content-between align-items-center mt-3">
                  <div class="avatar-group"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                      <div class="avatar avatar-m  rounded-circle">
                           @php 
$user = App\Models\User::where('id', $project->assigned_to)->first();
@endphp


@if($user->image)
                <img class="rounded-circle" src="{{asset('profile/'.$user->image)}}" alt="" />
                @else
                <img class="rounded-circle" src="{{asset('profile/avatar.png')}}" alt="" />	
                @endif

                      </div>
                    </a>
                
             
                
                  </div>
                  <div class="mt-lg-3 mt-xl-0"> <i class="fa-solid fa-list-check me-1"></i>
                    <p class="d-inline-block fw-bold mb-0">
                      @php 
$userCount = App\Models\Leadtask::where('leadid', $project->id)->count();
@endphp

{{$userCount}}
<span class="fw-normal">	Task</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
     
      @endforeach
        </div>
        <div class="modal fade" id="projectsCardViewModal" tabindex="-1" aria-labelledby="projectsCardViewModal" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content overflow-hidden">
              <div class="modal-header position-relative p-0">
                <input class="d-none" id="projectCoverInput" type="file" />
                <label class="position-absolute top-0 start-0" for="projectCoverInput"><span class="project-modal-btn d-inline-block bg-body-emphasis dark__text-gray-100 rounded-2 py-2 px-3 fs-9 fw-bolder mt-3 ms-3 cursor-pointer"><span class="fa-solid fa-image me-1"></span>Change</span></label>
                <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal"><span class="fa-solid fa-xmark text-body dark__text-gray-100"></span></button><img class="w-100" src="../../assets/img/generic/43.png" alt="" style="max-height: 200px;min-height: 150px;" />
              </div>
              <div class="modal-body p-5 px-md-6">
                <div class="row g-5">
                  <div class="col-12 col-md-9">
                    <div class="mb-4">
                      <h3 class="fw-bolder lh-sm">It was popularised in the 1960s with the release of Letraset</h3>
                      <p class="text-body-highlight fw-semibold mb-0">In list<a class="ms-1 fw-bold" href="#!">Review </a></p>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                      <p class="text-body-highlight fw-700 mb-0 me-2">64%</p>
                      <div class="progress flex-1">
                        <div class="progress-bar rounded-3" role="progressbar" style="width: 64%"></div>
                      </div>
                    </div>
                    <h6 class="text-body-secondary mb-2">Due date</h6>
                    <div class="flatpickr-input-container flatpickr-input-sm w-50 mb-3">
                      <input class="form-control form-control-sm ps-6 datetimepicker" id="datepicker" type="text" data-options='{"dateFormat":"M j, Y","disableMobile":true,"defaultDate":"Mar 1, 2022"}' /><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary mt-1"></span>
                    </div>
                    <div class="mb-3">
                      <h6 class="text-body-secondary mb-2">Assignees</h6>
                      <div class="d-flex">
                        <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <div class="avatar avatar-m  me-1">
                              <img class="rounded-circle " src="../../assets/img/team/60.webp" alt="" />

                            </div>
                          </a>
                          <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                            <div class="position-relative">
                              <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                              </div>
                              <!--/.bg-holder-->

                              <div class="p-3">
                                <div class="text-end">
                                  <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                  <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                  <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/60.webp" alt="" /></div>
                                  <h6 class="text-white">Emma Watson</h6>
                                  <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                  <div class="d-flex flex-center mb-3">
                                    <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                    <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="bg-body-emphasis">
                              <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                  <div class="d-flex">
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                  </div>
                                  <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                              </div>
                              <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                              </ul>
                            </div>
                            <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                          </div>
                        </div>
                        <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <div class="avatar avatar-m  me-1">
                              <img class="rounded-circle " src="../../assets/img/team/58.webp" alt="" />

                            </div>
                          </a>
                          <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                            <div class="position-relative">
                              <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                              </div>
                              <!--/.bg-holder-->

                              <div class="p-3">
                                <div class="text-end">
                                  <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                  <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                  <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/58.webp" alt="" /></div>
                                  <h6 class="text-white">Igor Borvibson</h6>
                                  <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                  <div class="d-flex flex-center mb-3">
                                    <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                    <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="bg-body-emphasis">
                              <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                  <div class="d-flex">
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                  </div>
                                  <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                              </div>
                              <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                              </ul>
                            </div>
                            <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                          </div>
                        </div>
                        <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <div class="avatar avatar-m  me-1">
                              <img class="rounded-circle " src="../../assets/img/team/59.webp" alt="" />

                            </div>
                          </a>
                          <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                            <div class="position-relative">
                              <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                              </div>
                              <!--/.bg-holder-->

                              <div class="p-3">
                                <div class="text-end">
                                  <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                  <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                  <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/59.webp" alt="" /></div>
                                  <h6 class="text-white">Katerina Karenin</h6>
                                  <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                  <div class="d-flex flex-center mb-3">
                                    <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                    <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="bg-body-emphasis">
                              <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                  <div class="d-flex">
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                  </div>
                                  <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                              </div>
                              <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                              </ul>
                            </div>
                            <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                          </div>
                        </div>
                        <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <div class="avatar avatar-m  me-1">
                              <img class="rounded-circle " src="../../assets/img/team/34.webp" alt="" />

                            </div>
                          </a>
                          <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                            <div class="position-relative">
                              <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                              </div>
                              <!--/.bg-holder-->

                              <div class="p-3">
                                <div class="text-end">
                                  <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                  <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                  <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/34.webp" alt="" /></div>
                                  <h6 class="text-white">Jean Renoir</h6>
                                  <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                  <div class="d-flex flex-center mb-3">
                                    <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                    <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="bg-body-emphasis">
                              <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                  <div class="d-flex">
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                    <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                  </div>
                                  <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                              </div>
                              <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                              </ul>
                            </div>
                            <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                          </div>
                        </div>
                        <button class="btn btn-sm btn-phoenix-secondary btn-circle"><span class="fa-solid fa-plus"></span></button>
                      </div>
                    </div>
                    <div class="mb-5">
                      <h6 class="text-body-secondary mb-2">Labels</h6>
                      <div class="d-flex align-items-center"><span class="badge badge-phoenix badge-phoenix-info fs-10 me-2">INFO</span><span class="badge badge-phoenix badge-phoenix-warning fs-10 me-2">URGENT</span><span class="badge badge-phoenix badge-phoenix-success fs-10 me-2">DONE</span><a class="text-body fw-bolder fs-9 lh-1 text-decoration-none" href="#!"> <span class="fa-solid fa-plus me-1"></span>Add another</a></div>
                    </div>
                    <div class="mb-6">
                      <div class="d-flex align-items-center mb-2">
                        <h4 class="me-3">Description</h4>
                        <button class="btn btn-link p-0"><span class="fa-solid fa-pen"></span></button>
                      </div>
                      <p class="text-body-highlight">The female circus horse-rider is a recurring subject in Chagall’s work. In 1926 the art dealer Ambroise Vollard invited Chagall to make a project based on the circus. They visited Paris’s historic Cirque d’Hiver Bouglione together; Vollard lent Chagall his private box seats. Chagall completed 19 gouaches...<a class="fw-semibold" href="#!">see more </a></p>
                    </div>
                    <div class="bg-body-highlight rounded-2 p-4 mb-3">
                      <div class="row justify-contnet-between border-bottom border-translucent g-0 gy-2 pb-3">
                        <div class="col-12 col-sm">
                          <p class="fs-9 text-body-secondary mb-2"><a class="fw-semibold" href="#!">Anthony Van Dyck </a>uploaded a file </p><img class="rounded-2 mb-2" src="../../assets/img/generic/42.png" alt="" width="220" />
                          <p class="text-body-highlight fw-semibold fs-9 mb-0">Fruit blast</p>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <p class="text-body-secondary fw-semibold fs-10 mb-0">Oct 3 at 4:38 pm</p>
                        </div>
                      </div>
                      <div class="row justify-contnet-between border-bottom border-translucent g-0 gy-1 py-3 align-items-center">
                        <div class="col-12 col-sm">
                          <p class="fs-9 text-body-secondary mb-0"><span class="text-body-highlight fw-semibold me-1">You</span>created this task</p>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <p class="text-body-secondary fw-semibold fs-10 mb-0">Oct 4 at 12:18 pm</p>
                        </div>
                      </div>
                      <div class="row justify-contnet-between border-bottom border-translucent g-0 gy-1 py-3 align-items-center">
                        <div class="col-12 col-sm">
                          <p class="fs-9 text-body-secondary mb-1"><a class="fw-semibold" href="#!">Kazimir Malevich </a>added a subtask</p>
                          <div class="d-flex">
                            <p class="mb-0 fs-9 fw-semibold text-body-highlight"><span class="fa-solid fa-circle text-primary" data-fa-transform="shrink-8"> </span>Doing</p><span class="text-body-secondary fs-9 mx-2">to</span>
                            <p class="mb-0 fs-9 fw-semibold text-body-highlight"><span class="fa-solid fa-circle text-primary" data-fa-transform="shrink-8"> </span>Review</p>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <p class="text-body-secondary fw-semibold fs-10 mb-0">Oct 5 at 9:59 am</p>
                        </div>
                      </div>
                      <div class="row justify-contnet-between gx-2 align-items-center pt-3">
                        <div class="col col-auto">
                          <div class="avatar avatar-m status-online ">
                            <img class="rounded-circle " src="../../assets/img//team/30.webp" alt="" />

                          </div>
                        </div>
                        <div class="col col-auto flex-1">
                          <p class="fs-9 text-body-secondary mb-0"><a class="fw-semibold" href="#!">Peter Paul Rubens </a>commented</p>
                        </div>
                        <div class="col-12 col-sm-auto order-1 order-sm-0">
                          <p class="text-body-secondary fw-semibold fs-10 mb-0">Oct 5 at 9:59 am</p>
                        </div>
                        <div class="col-sm-11">
                          <p class="text-body fs-9 mb-0 ms-6">Great job on the Phoenix template! The overall design and layout are visually appealing and user-friendly.</p>
                        </div>
                      </div>
                    </div>
                    <textarea class="form-control form-control mb-3" rows="3" placeholder="Add comment"></textarea>
                    <div class="d-flex flex-between-center pb-3 border-bottom border-translucent mb-6">
                      <div class="d-flex">
                        <button class="btn btn-sm ps-0 pe-2 py-0"><span class="fa-solid fa-image fs-8"></span></button>
                        <button class="btn btn-sm px-2 py-0"><span class="fa-solid fa-calendar-days fs-8"></span></button>
                        <button class="btn btn-sm px-2 py-0"><span class="fa-solid fa-location-dot fs-8"></span></button>
                        <button class="btn btn-sm px-2 py-0"><span class="fa-solid fa-tag fs-8"></span></button>
                      </div>
                      <button class="btn btn-sm btn-primary px-6">Comment</button>
                    </div>
                    <div class="mb-6">
                      <div class="mb-7">
                        <h4 class="mb-4">To do list <span class="text-body-tertiary fw-normal fs-6">(23)</span></h4>
                        <div class="row align-items-center g-0 justify-content-between mb-3">
                          <div class="col-12 col-sm-auto">
                            <div class="search-box w-100 mb-2 mb-sm-0" style="max-width:30rem;">
                              <form class="position-relative">
                                <input class="form-control search-input search" type="search" placeholder="Search tasks" aria-label="Search" />
                                <span class="fas fa-search search-box-icon"></span>

                              </form>
                            </div>
                          </div>
                          <div class="col-auto d-flex">
                            <p class="mb-0 ms-sm-3 fs-9 text-body-tertiary fw-bold"><span class="fas fa-filter me-1 fw-extra-bold fs-10"></span>23 tasks</p>
                            <button class="btn btn-link p-0 ms-3 fs-9 text-primary fw-bold"><span class="fas fa-sort me-1 fw-extra-bold fs-10"></span>Sorting</button>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-1">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-0" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-0">Designing the dungeon</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-primary">DRAFT</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>2</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">12 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">12:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-2">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-1" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-1">Hiring a motion graphic designer</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-warning">URGENT</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>2</button>
                                <button class="btn p-0 text-warning fs-10 me-2"><span class="fas fa-tasks me-1"></span>3</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">12 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">12:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-3">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-2" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-2">Daily Meetings Purpose, participants</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-info">ON PROCESS</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>4</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">12 Dec, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">05:00 AM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-4">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-3" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-3">Finalizing the geometric shapes</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>3</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">12 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">12:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-5">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-4" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-4">Daily meeting with team members</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">1 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">12:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-6">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-5" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-5">Daily Standup Meetings</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">13 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">10:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-7">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-6" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-6">Procrastinate for a month</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-info">ON PROCESS</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>3</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">12 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">12:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-8">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-7" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-7">warming up</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-info">CLOSE</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>3</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">12 Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">12:00 PM</p>
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top border-bottom">
                            <div class="col-12">
                              <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-9">
                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                                  <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-8" />
                                  <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-8">Make ready for release</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex ms-4 lh-1 align-items-center">
                                <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>2</button>
                                <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">2o Nov, 2021</p>
                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">1:00 AM</p>
                              </div>
                            </div>
                          </div>
                        </div><a class="fw-bold fs-9 mt-4" href="#!"><span class="fas fa-plus me-1"></span>Add new task</a>
                      </div>
                    </div>
                    <h4 class="mb-3">Files</h4>
                    <div class="border-top pt-3 pb-4">
                      <div class="me-n3">
                        <div class="d-flex flex-between-center">
                          <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>
                            <p class="text-body-highlight mb-0 lh-1">Silly_sight_1.png</p>
                          </div>
                          <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                          <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                        </div>
                        <p class="fs-9 text-body-tertiary mb-2"><span>768 kb</span><span class="text-body-quaternary mx-1">| </span><a href="#!">Shantinan Mekalan </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">21st Dec, 12:56 PM</span></p><img class="rounded-2" src="../../assets/img/generic/40.png" alt="" />
                      </div>
                    </div>
                    <div class="border-top py-3">
                      <div class="me-n3">
                        <div class="d-flex flex-between-center">
                          <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>
                            <p class="text-body-highlight mb-0 lh-1">Silly_sight_1.png</p>
                          </div>
                          <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                          <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                        </div>
                        <p class="fs-9 text-body-tertiary mb-1"><span>12.8 mb</span><span class="text-body-quaternary mx-1">| </span><a href="#!">Yves Tanguy </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">19th Dec, 08:56 PM</span></p>
                      </div>
                    </div>
                    <div class="border-top border-bottom py-3 mb-3">
                      <div class="me-n3">
                        <div class="d-flex flex-between-center">
                          <div class="d-flex align-items-center mb-1"><span class="fa-solid fa-file-lines me-2 fs-9 text-body-tertiary"></span>
                            <p class="text-body-highlight mb-0 lh-1">Project.txt</p>
                          </div>
                          <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                          <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                        </div>
                        <p class="fs-9 text-body-tertiary mb-1"><span>123 kb</span><span class="text-body-quaternary mx-1">|</span><a href="#!">Shantinan Mekalan</a><span class="text-body-quaternary mx-1">|</span><span class="text-nowrap">12th Dec, 12:56 PM</span></p>
                      </div>
                    </div>
                    <label class="btn btn-link p-0" for="customFile"><span class="fas fa-plus me-1"></span>Add file(s)</label>
                    <input class="d-none" id="customFile" type="file" />
                  </div>
                  <div class="col-12 col-md-3">
                    <h5 class="text-body-secondary mb-3">Add to card</h5>
                    <div class="mb-6">
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-user-plus"></span>Assignee</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-tag"></span>Labels</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-paperclip"></span>Attachments</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-square-check"></span>Checklist</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-calendar-days"></span>Dates</button>
                    </div>
                    <h5 class="text-body-secondary mb-3">Actions</h5>
                    <div class="mb-6">
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-arrow-right"></span>Move</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-copy"></span>Copy</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-trash"></span>Remove</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-box-archive"></span>Archive</button>
                      <button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-share-nodes"></span>Share</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
        let toggleIcon = document.getElementById('viewTogglek');

        toggleIcon.addEventListener('click', function () {
		
            let newView = 'kanban' ;

           

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