@extends('layouts.app')
@section('section')
@push('styles')
<link href="{{asset('vendors/dropzone/dropzone.min.css')}}" rel="stylesheet">

    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
    
@endpush


<div class="pb-9">
  <div class="row">
    <div class="col-12">
      <div class="row align-items-center justify-content-between g-3 mb-3">
        <div class="col-12 col-md-auto">
          <h2 class="mb-0">Lead details</h2>
        </div>
        <div class="col-12 col-md-auto">
          <div class="d-flex">
            <div class="flex-1 d-md-none">
              <button class="btn px-3 btn-phoenix-secondary text-700 me-2" data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn"><span class="fa-solid fa-bars"></span></button>
            </div>
            <a href="{{URL::to('leadkanban')}}" class="btn btn-phoenix-info me-2"><span class="fa-solid fa-arrow-left me-2"></span><span>Go Back</span></a>
             <a href="{{URL::to('place-call/'.$lead->phone)}}" class="btn btn-phoenix-primary me-2"><span class="fa-solid fa-phone me-2"></span><span>Call</span></a>
			<a href="{{URL::to('transcribe')}}" class="btn btn-phoenix-danger me-2"><span class="fa-solid fa-phone me-2"></span><span>Call Transcriptions</span></a>
            <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
            <ul class="dropdown-menu dropdown-menu-end p-0" style="z-index: 9999;">
            <li> <a class="dropdown-item" href="{{URL::to('leadedit/'.$lead->id)}}">Edit</a></li>
              <li>
                <form id="destroy-data{{ $lead->id }}" action="{{ route('deletelead', $lead->id)}}" method="post">
                  @csrf

                  <button class="dropdown-item text-danger" type="submit">Remove</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row g-0 g-md-4 g-xl-6">
    <div class="col-md-5 col-lg-5 col-xl-4">
      <div class="sticky-leads-sidebar">
        <div class="lead-details-offcanvas bg-soft scrollbar phoenix-offcanvas phoenix-offcanvas-fixed" id="productFilterColumn">
          <div class="d-flex justify-content-between align-items-center mb-2 d-md-none">
            <h3 class="mb-0">Lead Details</h3>
            <button class="btn p-0" data-phoenix-dismiss="offcanvas"><span class="uil uil-times fs-1"></span></button>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <div class="row align-items-center g-3 text-center text-xxl-start">

                <div class="col-12 col-sm-auto flex-1">
                  <h3 class="fw-bolder mb-2">{{$lead->first_name}} {{$lead->last_name}}</h3>
                  <p class="mb-0">{{$lead->street}}, {{$lead->zipcode}}, </p><a class="fw-bold" href="#!">{{$lead->city}}</a>
                </div>
                
                
              </div>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">

              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-envelope-alt"> </span>
                  <h5 class="text-1000 mb-0">Email</h5>
                </div><a href="mailto:shatinon@jeemail.com:">{{$lead->email}}</a>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-phone"> </span>
                  <h5 class="text-1000 mb-0">Phone</h5>
                </div><a href="tel:+1234567890">{{$lead->phone}}</a>
              </div>
              




              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-file-check-alt"></span>
                  <h5 class="text-1000 mb-0">Lead source</h5>
                </div>
                <p class="mb-0 text-800">{{$lead->source}}</p>
              </div>
              <div>
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-check-circle"></span>
                  <h5 class="text-1000 mb-0">Lead status</h5>
                </div><span class="badge badge-phoenix badge-phoenix-primary">{{$lead->status}}</span>
              </div>
            </div>
          </div>
          
        </div>
        <div class="phoenix-offcanvas-backdrop d-lg-none top-0" data-phoenix-backdrop="data-phoenix-backdrop"></div>
      </div>
    </div>
    <div class="col-md-7 col-lg-7 col-xl-8">
      <div class="lead-details-container">
        <nav class="navbar pb-4 px-0 sticky-top bg-soft nav-underline-scrollspy" id="navbar-deals-detail">
          <ul class="nav nav-underline">
            <li class="nav-item"><a class="nav-link pe-3" href="#scrollspyTask">Activities</a></li>
            <li class="nav-item"><a class="nav-link pe-3" href="#scrollspyTaskTask">Tasks</a></li>
            <li class="nav-item"><a class="nav-link pe-3" href="#scrollspyEmails">Emails</a></li>
                    <li class="nav-item"><a class="nav-link" href="#scrollspyAttachments">Attachments </a></li>
          </ul>
        </nav>
        <div class="scrollspy-example bg-body-tertiary rounded-2" data-bs-spy="scroll" data-bs-offset="0" data-bs-target="#navbar-deals-detail" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
          <!-- <div class="mb-8">
            <h2 class="mb-4" id="scrollspyTask">Attached Project</h2>
            @foreach ($projects as $project)

            @php
            $decodedData = json_decode($project->os_json);

            @endphp







            <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-200 py-3 gx-0 border-top">
              <div class="col-12 col-lg-auto flex-1">
                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                  <label class="form-check-label mb-0 fs-0 me-2 line-clamp-1" for="checkbox-todo-0">{{ $decodedData->title }}</label>
                </div>
              </div>
              <div class="col-12 col-lg-auto">
                <div class="d-flex ms-4 lh-1 align-items-center">
                  <a href="{{URL::to('viewospproject/'.$project->os_id)}}" class="btn btn-phoenix-secondary btn-icon fs--2 text-success px-0"><span class="fas fa-eye"></span></a>
                </div>
              </div>
            </div>
            @endforeach



          </div> -->
          <div class="mb-8">
            <div class="d-flex justify-content-between align-items-center mb-1" id="scrollspyTask">
              <h3 class="text-body-highlight fw-bold">Activity</h3>
              <button class="btn btn-phoenix-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kanbanAddTask"><span class="fa-solid fa-plus me-2"></span>Add Activity</button>
            </div>
            
            <div class="col-12 col-xxl-4 px-0 border-start-xxl border-top-sm">
            <div class="h-100">
              <div>
               
                <div class="timeline-vertical timeline-with-details">
                 @foreach($lactivity as $lactivit)
                  <div class="timeline-item position-relative">
                    <div class="row g-md-3">
                      <div class="col-12 col-md-auto d-flex">
                        <div class="timeline-item-date order-1 order-md-0 me-md-4">
                      <p class="form-check-label mb-0 fs-8  cursor-pointer">
    {{ \Carbon\Carbon::parse($lactivit->created_at)->format('Y-m-d') }}<br class="d-none d-md-block" />
    {{ \Carbon\Carbon::parse($lactivit->created_at)->format('h:i A') }}
</p>
                        </div>
                        <div class="timeline-item-bar position-md-relative me-3 me-md-0">
                          <div class="icon-item icon-item-sm rounded-7 shadow-none bg-primary-subtle"><span class="fa-solid fa-chess text-primary-dark fs-10"></span></div><span class="timeline-bar border-end border-dashed"></span>
                        </div>
                      </div>
                      <div class="col">
                        <div class="timeline-item-content ps-6 ps-md-3">
                          <h5 class="fs-9 lh-sm">{{$lactivit->title}}</h5>
                          <p class="fs-9">by <a class="fw-semibold" href="#!">{{$lactivit->act_by}}</a></p>
                          <p class="fs-9 text-body-secondary mb-5">{{$lactivit->description}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                   @endforeach
                </div>
              </div>
              
            </div>
          </div>
          </div>
         
           <div class="mb-4 todo-list">
           <div class="d-flex justify-content-between align-items-center mb-4" id="scrollspyTaskTask">
              <h2 class="mb-0">Tasks</h2>
              <button class="btn btn-phoenix-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kanbanAddTaskTask">
              	<span class="fa-solid fa-plus me-2"></span>Add Task</button>
            </div>
           @foreach($ltask as $lactivit)
             @php
          $startDateTime = \Carbon\Carbon::parse($lactivit->date . ' ' . $lactivit->time)->format('Ymd\THis\Z');
          $endDateTime = \Carbon\Carbon::parse($lactivit->date . ' ' . $lactivit->time)->addHour()->format('Ymd\THis\Z');
          $googleCalendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE' .
                               '&text=' . urlencode($lactivit->title) .
                               '&details=' . urlencode($lactivit->description) .
                               '&dates=' . $startDateTime . '/' . $endDateTime;
    @endphp
            <div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 cursor-pointer border-top" data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-1">
              <div class="col-12 col-md-auto flex-1">
                <div>
                  <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">
                    <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined todo-checkbox" type="checkbox" id="checkbox-todo-{{ $lactivit->id }}" data-event-propagation-prevent="data-event-propagation-prevent"  data-id="{{ $lactivit->id }}" 
       @if($lactivit->status) checked @endif />
                    
                  
       
       
                    <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1 flex-grow-1 flex-md-grow-0 cursor-pointer">{{$lactivit->title}}</label><span class="badge badge-phoenix fs-10 badge-phoenix-primary">{{$lactivit->prio}}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-auto">
                <div class="d-flex ms-4 lh-1 align-items-center">
                 
                  <p class="form-check-label mb-0 fs-8 me-2 line-clamp-1 flex-grow-1 flex-md-grow-0 cursor-pointer">{{$lactivit->date}}</p>
                  <div class="d-none d-md-block end-0 position-absolute" style="top: 23%;">
                    <div class="hover-actions end-0">
                    <form id="destroy-data{{ $lactivit->id }}" action="{{ route('deletedeal_task', $lactivit->id)}}" method="post">
                                                @csrf
                   <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" type="submit" ><span class="fas fa-trash"></span></button>
                                            </form>
                      
                    </div>
                  </div>
                  <div class="hover-md-hide hover-lg-show hover-xl-hide">
                    <p class="form-check-label mb-0 fs-8 me-2 line-clamp-1 flex-grow-1 flex-md-grow-0 cursor-pointer">{{$lactivit->time}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="offcanvas offcanvas-end content-offcanvas offcanvas-backdrop-transparent border-start shadow-none bg-body-highlight" tabindex="-1" data-todo-content-offcanvas="data-todo-content-offcanvas" id="todoOffcanvas-1">
              <div class="offcanvas-body p-0">
                <div class="p-5 p-md-6">
                  <div class="d-flex flex-between-center align-items-start gap-5 mb-4">
                    <h3 class="fw-bold fs-6 mb-0 text-body-highlight">{{$lactivit->title}}</h3>
                    
                  </div>
                  <div class="mb-6">
                    <div class="d-flex align-items-center mb-3">
                      <h4 class="text-body me-3">Description</h4>
                    </div>
                    <p class="text-body-highlight mb-0">{{$lactivit->description}}</p>
                  </div>
                 
                </div>
                
                <div class="px-5 px-md-6">
                 
                  <h5 class="text-body-highlight mb-2">Priority</h5>
                  <select class="form-select mb-4" aria-label="Default select example">
                  
                    <option value="{{$lactivit->prio}}">{{$lactivit->prio}}</option>
                   
                  </select>
                  <h5 class="text-body-highlight mb-2">Due Date</h5>
                  <div class="flatpickr-input-container mb-4">
                    <input class="form-control datetimepicker ps-6" type="text" value="{{$lactivit->date}}" placeholder="Set the due date" data-options='{"disableMobile":true}' /><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                  </div>
                  <h5 class="text-body-highlight mb-2">Time</h5>
                  <div class="flatpickr-input-container mb-4">
                    <input class="form-control datetimepicker ps-6" type="text" placeholder="Reminder" value="{{$lactivit->time}}" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true,"static":true}' /><span class="uil uil-bell-school flatpickr-icon text-body-tertiary"></span>
                  </div>
                <div class="text-start mb-1">
                    <a href="{{ $googleCalendarUrl }}" target="_blank" class="btn btn-phoenix-primary btn-sm" title="add to google calendar"><span class="fa fa-calendar"></span></a>
                    </div>
                  <div class="text-end mb-9">
                   
                     <form id="destroy-data{{ $lactivit->id }}" action="{{ route('deletedeal_task', $lactivit->id)}}" method="post">
                                                @csrf
                    <button class="btn btn-phoenix-danger">Delete Task</button>
                                            </form>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div> 
            <div class="mb-8">
             <div class="d-flex justify-content-between align-items-center mb-4" id="scrollspyTaskTaskkkk">
              <h2 class="mb-0">Checklist</h2>
              
            </div>
            <div class="border-top border-bottom border-200" id="leadDetailsTabletask" >
              <div class="table-responsive scrollbar mx-n1 px-1">
                <table class="table fs--1 mb-0">
                  <thead>
                    <tr>

                      <th class="sort text-uppercase" style="width:15%; min-width:200px">Question</th>
                      <th class="sort align-middle pe-6 text-uppercase " scope="col" data-sort="amount">Answer</th>
                      

                    </tr>
                  </thead>
           
                  <tbody class="list" id="lead-details-table-body">
                    @foreach ($answers as $answer)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="dealName text-uppercase fw-semi-bold">{{ $answer->question_label }}</td>
                      <td class="amount align-middle white-space-nowrap text-start fw-bold text-700">{{ $answer->answer }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              
            </div>
             




          </div>
          <div class="mb-8">
            <h2 class="mb-2" id="scrollspyEmails">Emails</h2>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sendEmailModel"><span class="fa-solid fa-plus me-2"></span>Send Mail</button>
            <div>
              <div class="scrollbar">
                <ul class="nav nav-underline flex-nowrap mb-1" id="emailTab" role="tablist">
                  <li class="nav-item me-3"><a class="nav-link text-nowrap border-0 active" id="mail-tab" data-bs-toggle="tab" href="#tab-mail" aria-controls="mail-tab" role="tab" aria-selected="true">Sent ({{ $emails->where('type', 'Sent')->count() }})<span class="text-700 fw-normal"></span></a></li>
                 
              
                </ul>
              </div>
            
              <div class="tab-content" id="profileTabContent">
                <div class="tab-pane fade show active" id="tab-mail" role="tabpanel" aria-labelledby="mail-tab">
                  <div class="border-top border-bottom border-200" id="allEmailsTable" data-list='{"valueNames":["subject","sent","date","source","status"],"page":7,"pagination":true}'>
                    <div class="table-responsive scrollbar mx-n1 px-1">
                      <table class="table fs--1 mb-0">
                        <thead>
                          <tr>
                        
                            <th class="sort white-space-nowrap align-middle pe-3 ps-0 text-uppercase" scope="col" data-sort="subject" style="width:31%; min-width:350px">Subject</th>
                            <th class="sort align-middle pe-3 text-uppercase" scope="col" data-sort="sent" style="width:15%; min-width:130px">Content</th>
                            <th class="sort align-middle text-start text-uppercase" scope="col" data-sort="date" style="min-width:165px">Date</th>
                           
                          </tr>
                        </thead>
                        <tbody class="list" id="drafts-email-table-body">
                        @forelse($emails->where('type', 'Sent') as $inbox)
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                         
                            <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">{{$inbox->subject}}</a>
                             
                            </td>
                            <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">{{$inbox->content}}</td>
                            <td class="date align-middle white-space-nowrap text-900 py-2">{{$inbox->created_at}}</td>
                           
                          </tr>
                          @empty
                          <tr><td colspan="3"> No Email Sent</td></tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                </div>
                
            
              </div>
            </div>
          </div>
          <!-- Attachments -->
          <div>
            <h2 class="mb-4" id="scrollspyAttachments">Attachments</h2>
            <form method="post" action="{{route('leadattachments.store')}}" class="position-relative mb-3" enctype="multipart/form-data">
              @csrf
              <div class="row">
              <div class="col-4">
                <label class="form-label" for="customFile">Upload File/Image</label>
                <input class="form-control" name="file" id="customFile" type="file"  required/>
                <input type="hidden" name="lead_id" value="{{$lead->id}}">
                </div>
                
                 <div class="col-3">
                <label class="form-label" for="customFile">Category</label>
                 <select class="form-select" name="category" >
				  @foreach($attachc as $cat)
                    <option value="{{$cat->name}}"> {{$cat->name}}</option>
                   @endforeach   
                  </select>
                </div>
                
                 <div class="col-3">
                <label class="form-label" for="customFile">Type</label>
                 <select class="form-select" name="type" >
				 
                    <option value="Internal"> Internal </option>
                    <option value="Shared"> Shared </option>
                  
                  </select>
                </div>
                
                
                <div class="col-2"><br />
                        <button class="btn btn-phoenix-primary" type="submit" >Submit</button>
                </div>
              </div>
              
                        
            </form>
            @if($lead->attachments)
            @foreach($lead->attachments as $attachment)
            <div class="border-top border-dashed border-300 pt-3 pb-4">
              <div class="d-flex flex-between-center">
                <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-700 fs--1"></span>
                  <p class="text-1000 mb-0 lh-1">{{$attachment->file_name}}</p>
                </div>
                <div class="font-sans-serif btn-reveal-trigger">
                  <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                  <div class="dropdown-menu dropdown-menu-end py-2"> <form action="{{ route('leadattachments.destroy', $attachment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                </form><a class="dropdown-item" href="{{ route('leadattachments.show', $attachment->id) }}">Download</a></div>
                </div>
              </div>
              <p class="fs--1 text-700 mb-2"><span>{{$attachment->file_size}}</span><span class="text-400 mx-1">| </span><span class="text-nowrap">{{date('D-m-Y h:i a',strtotime($attachment->created_at))}}</span></p>
              <p class="fs--1 text-700 mb-2"><span>{{$attachment->category}}</span><span class="text-400 mx-1">| </span><span class="text-nowrap">{{$attachment->type}}</span></p>
             @if($attachment->type=='Shared')
              <p class="fs--1 mt-1">
        <a href="{{ asset($attachment->file_path) }}" target="_blank" class="text-primary">{{ asset($attachment->file_path) }}</a>
    </p>
    @endif
              @if(in_array($attachment->file_type,['png','jpg','jpeg','webp']))<img class="rounded-2" src="{{asset($attachment->file_path)}}" style="width:50px" alt="" /> @endif
            </div>
            @endforeach
            @endif
          
          </div>
          <div>
              
              @php
					$os_id = null;
    if ($lead->projectdetails) {
    $os_id = json_decode($lead->projectdetails->os_id);
	}
@endphp
@php 
    $system = App\Models\Ossystem::where('os_id', $os_id)->first();
    $rooftypefetch = DB::table('adders')->where('os_id', $os_id)->where('typed', 'mount')->first();
    $rooftype = $rooftypefetch ? $rooftypefetch->adder_name : 'Roof Mount';
@endphp
@if($system)
<h2 class="mb-4" id="scrollspyAttachmentsdetails">System Details</h2>
<p>System Size:  {{ $system->system_size }} kwh</p>
<p>Proposal Link: <a href="{{ URL::to('viewospprojectnewthree/'.$os_id) }}">Proposal View</a></p>
<p>Number of Panels: {{ $system->module_quantity }}</p>
<p>Panel Code: {{ $system->modules_code }} - {{ $system->modules_manuf }}</p>
<p>Roof Type: {{ $rooftype }}</p>
<p>Inverter's Code: {{ $system->inverters_code }} - {{ $system->inverters_name }}</p>
<p>
<img class="abt-img-object" style="object-fit: cover; width: 100%; height: 100%;  border-radius:10px !important" src="{{asset('mysystem/'.$system->image)}}"> 
</p>
@endif

@php 
    $visits = App\Models\Pvisits::where('os_id', $os_id)->latest()->get();
   
@endphp
@if($visits)
<h2 class="mb-4" id="scrollspyAttachmentsdetails">Online Proposal Visits</h2>
<table class="table fs--1 mb-0">
<thead>
<tr>
<th class="sort text-uppercase" >IP address</th>
<th class="sort text-uppercase" >Visited At</th>
<th class="sort text-uppercase" >Time Spent</th>
</tr>
</thead>
<tbody class="list" id="lead-details-table-body">
@foreach($visits as $vis)
<tr>
<td>{{ $vis->ip_address }}</td>
<td>{{ $vis->created_at }}</td>
<td>{{ gmdate("i:s", $vis->time_spent) }}</td>
</tr>
@endforeach
</tbody>
@endif


                 
                 
                  
                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="kanbanAddTaskTask" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{route('addleadactivitytask')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="title" name="title" value="{{old('title')}}" />
                <input class="form-control" id="leadid" type="hidden" name="leadid" value="{{$lead->id}}" />
                <label for="kanbanTaskTitle">Task Title</label>
              </div>
            </div><div class="col-6">
               <div class="form-floating">
                  <select class="form-select" name="prio" id="floatingSelectOwner">
				  
                    <option value="Meduim"> Meduim</option>
                    <option value="High"> High</option>
                    <option value="Low"> Low</option>
                    <option value="Urgent"> Urgent</option>
                 
                  </select>
                  <label for="floatingSelectOwner">Priority</label>
                </div>
            </div>
            <div class="col-12 gy-4">
              <div class="form-floating">
<textarea class="form-control" id="contentToCopyyy" placeholder="text" name="description" style="height:128px">{{old('description')}}</textarea>
<label for="contentToCopyyy">ADD A DESCRIPTION</label>

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
<div class="modal fade" id="kanbanAddTask" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{route('addleadactivity')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="title" name="title" value="{{old('title')}}" />
                <input class="form-control" id="leadid" type="hidden" name="leadid" value="{{$lead->id}}" />
                <label for="kanbanTaskTitle">Title</label>
              </div>
            </div>
             <div class="col-6">
              <div class="form-floating">
<input class="form-control" id="kanbanTaskTitleby" type="text" placeholder="Activity By" name="act_by" value="{{old('act_by')}}" />
                <label for="kanbanTaskTitle">Activity By</label>
              </div>
            </div>
            <div class="col-12 gy-4">
              <div class="form-floating">
<textarea class="form-control" id="contentToCopy" placeholder="text" name="description" style="height:128px">{{old('description')}}</textarea>
<label for="contentToCopy">ADD A DESCRIPTION</label>



  <input id="lng" type="hidden" name="lng" value="en-US" />
  <button id="start-button" type="button" class="btn btn-phoenix-success" ><span class="fa fa-microphone"></span></button>
  <button class="btn btn-phoenix-danger" type="button" id="stop-button" style="display:none" ><i class="fa fa-microphone-slash"></i></button>
		<div id="error" class="isa_error"></div>
       
                <input
    type="hidden"
    id="access_id"
    placeholder="ACCESS ID"
    value="AKIAX5ZI57UBWIKJQOW4"
  />
  <input
    type="hidden"
    id="secret_key"
    placeholder="SECRET KEY"
    value="slQcpML5RIQieftBJp6NAfuo/B3LDjITOyYiFZp6"
  />
                <input type="hidden" id="session_token" placeholder="SESSION TOKEN" value="" />
                <input type="hidden" id="region" placeholder="SESSION TOKEN" value="ap-south-1" />
  
 
  
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
      <form method="post" action="{{route('leads.sendemail')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-sm-6 col-md-12">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="Email Subject" name="subject"  />
                <input class="form-control"  type="hidden" name="email" value="{{$lead->email}}"  />
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".todo-checkbox").forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            let taskId = this.dataset.id;
            let status = this.checked ? 1 : 0; // Assuming 1 = Completed, 0 = Pending

            fetch(`/update-task-status/${taskId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Status updated successfully");
                } else {
                    console.error("Failed to update status");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

</script>
@push('scripts')
<script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('dist/main.js')}}"></script>


@endpush
@endsection