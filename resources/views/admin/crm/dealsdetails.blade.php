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
          <h2 class="mb-0">Deal details</h2>
        </div>
        <div class="col-12 col-md-auto">
          <div class="d-flex">
            <div class="flex-1 d-md-none">
              <button class="btn px-3 btn-phoenix-secondary text-700 me-2" data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn"><span class="fa-solid fa-bars"></span></button>
            </div>
          <a href="{{URL::to('dealkanban')}}" class="btn btn-info me-2"><span class="fa-solid fa-arrow-left me-2"></span><span>Go Back</span></a>
             <a href="{{URL::to('place-call/'.$lead->phone)}}" class="btn btn-primary me-2"><span class="fa-solid fa-phone me-2"></span><span>Call</span></a>
			<a href="{{URL::to('transcribe')}}" class="btn btn-danger me-2"><span class="fa-solid fa-phone me-2"></span><span>Call Transcriptions</span></a>
            <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
            <ul class="dropdown-menu dropdown-menu-end p-0" style="z-index: 9999;">
            <!--<li> <a class="dropdown-item" href="{{URL::to('leadedit/'.$lead->id)}}">Edit</a></li>-->
              <li>
                <form id="destroy-data{{ $lead->id }}" action="{{ route('deletedeal', $lead->id)}}" method="post">
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
                  <h3 class="fw-bolder mb-2">{{$lead->name}}</h3>
                  <p class="mb-0">{{$real_lead->street}},</p><a class="fw-bold" href="#!">{{$real_lead->city}}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">

              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-envelope-alt"> </span>
                  <h5 class="text-1000 mb-0">Email</h5>
                </div><a href="{{$real_lead->email}}">{{$real_lead->email}}</a>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-phone"> </span>
                  <h5 class="text-1000 mb-0">Phone</h5>
                </div><a href="tel:+1234567890">{{$real_lead->phone}}</a>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-globe"></span>
                  <h5 class="text-1000 mb-0">Website</h5>
                </div><a href="#!">{{$real_lead->website}}</a>
              </div>




              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-file-check-alt"></span>
                  <h5 class="text-1000 mb-0">Lead source</h5>
                </div>
                <p class="mb-0 text-800">{{$lead->lead_source}}</p>
              </div>
              <div>
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-check-circle"></span>
                  <h5 class="text-1000 mb-0">Lead status</h5>
                </div><span class="badge badge-phoenix badge-phoenix-primary">{{$lead->stage}}</span>
              </div>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center mb-5">
                <h3>Address</h3>

              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-estate"></span>
                  <h5 class="mb-0">Street</h5>
                </div>
                <p class="mb-0 text-800">{{$real_lead->street}}</p>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-map-pin-alt"></span>
                  <h5 class="mb-0 text-1000">Zip code</h5>
                </div>
                <p class="mb-0 text-800">{{$real_lead->zipcode}}</p>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-map"></span>
                  <h5 class="mb-0 text-1000">City</h5>
                </div>
                <p class="mb-0 text-800">{{$real_lead->city}}</p>
              </div>
              <div>
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-windsock"></span>
                  <h5 class="mb-0 text-1000">Country</h5>
                </div>
                <p class="mb-0 text-800">{{$real_lead->country}}</p>
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
         
          <div class="mb-8">
            <div class="d-flex justify-content-between align-items-center mb-4" id="scrollspyTask">
              <h2 class="mb-0">Activity</h2>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kanbanAddTask"><span class="fa-solid fa-plus me-2"></span>Add Activity</button>
            </div>
            <div class="border-top border-bottom border-200" id="leadDetailsTable" data-list='{"valueNames":["dealName","amount","stage","probability","date","type"],"page":5,"pagination":true}'>
              <div class="table-responsive scrollbar mx-n1 px-1">
                <table class="table fs--1 mb-0">
                  <thead>
                    <tr>

                      <th class="sort text-uppercase" style="width:15%; min-width:200px">Title</th>
                      <th class="sort align-middle pe-6 text-uppercase " scope="col" data-sort="amount">Description</th>

                    </tr>
                  </thead>
                  <tbody class="list" id="lead-details-table-body">
                    @foreach($lactivity as $lactivit)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">

                      <td class="dealName text-uppercase fw-semi-bold">{{$lactivit->title}}</td>
                      <td class="amount align-middle white-space-nowrap text-start fw-bold text-700">{{$lactivit->description}}</td>
                    </tr>
                    @endforeach

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
           <div class="mb-8">
            <div class="d-flex justify-content-between align-items-center mb-4" id="scrollspyTaskTask">
              <h2 class="mb-0">Tasks</h2>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kanbanAddTaskTask"><span class="fa-solid fa-plus me-2"></span>Add Task</button>
            </div>
            <div class="border-top border-bottom border-200" id="leadDetailsTable" data-list='{"valueNames":["dealName","amount","stage","probability","date","type"],"page":5,"pagination":true}'>
              <div class="table-responsive scrollbar mx-n1 px-1">
                <table class="table fs--1 mb-0">
                  <thead>
                    <tr>

                      <th class="sort text-uppercase" style="width:15%; min-width:200px">Title</th>
                      <th class="sort align-middle pe-6 text-uppercase " scope="col" data-sort="amount">Date</th>
                      <th class="sort align-middle pe-6 text-uppercase " scope="col" data-sort="amount">Description</th>

                    </tr>
                  </thead>
                  <tbody class="list" id="lead-details-table-body">
                    @foreach($ltask as $lactivit)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="dealName text-uppercase fw-semi-bold">{{$lactivit->title}}</td>
                      <td class="dealName text-uppercase fw-semi-bold">{{$lactivit->date}} {{$lactivit->time}}</td>
                      <td class="amount align-middle white-space-nowrap text-start fw-bold text-700">{{$lactivit->description}}</td>
                    </tr>
                    @endforeach

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
          <div class="mb-8">
            <h2 class="mb-2" id="scrollspyEmails">Emails</h2>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sendEmailModel"><span class="fa-solid fa-plus me-2"></span>Send Mail</button>
            <div>
              <div class="scrollbar">
                <ul class="nav nav-underline flex-nowrap mb-1" id="emailTab" role="tablist">
                  <li class="nav-item me-3"><a class="nav-link text-nowrap border-0 active" id="mail-tab" data-bs-toggle="tab" href="#tab-mail" aria-controls="mail-tab" role="tab" aria-selected="true">Inbox ({{ $emails->where('type', 'Inbox')->count() }})<span class="text-700 fw-normal"></span></a></li>
                  <li class="nav-item me-3"><a class="nav-link text-nowrap border-0" id="drafts-tab" data-bs-toggle="tab" href="#tab-drafts" aria-controls="drafts-tab" role="tab" aria-selected="true">Sent ({{ $emails->where('type', 'Sent')->count() }})<span class="text-700 fw-normal"></span></a></li>
              
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
                        <tbody class="list" id="all-email-table-body">
                          @forelse($emails->where('type', 'Inbox') as $inbox)
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                          
                            <td class="subject order align-middle white-space-nowrap py-2 ps-0 text-"><a class="fw-semi-bold text-primary" href="#!">{{$inbox->subject}}</a>
                              
                            </td>
                            <td class="sent align-middle white-space-nowrap text-start fw-bold text-700 py-2">{{$inbox->content}}</td>
                            <td class="date align-middle white-space-nowrap text-900 py-2">{{$inbox->created_at}}</td>
                           
                          </tr>
                          @empty
                          <tr><td colspan="3"> No Email Recieved</td></tr>
                          @endforelse
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
          <!-- Attachments -->
          <div>
            <h2 class="mb-4" id="scrollspyAttachments">Attachments</h2>
  <form method="post" action="{{route('haji.storedealfile')}}" class="position-relative mb-3" enctype="multipart/form-data">
  				
              @csrf
              <div class="row">
              <div class="col-6">

                <label class="form-label" for="customFile">Upload File/Image</label>

                <input class="form-control" name="file" id="customFile" type="file"  required/>
                </div>
                <input type="hidden" name="lead_id" value="{{$lead->id}}">
                <div class="col-6">
                        <button class="btn btn-primary px-6 px-sm-6" type="submit" >Next</button>
                </div>
              </div>
              
                        
            </form>
            @if($attachs)
            @foreach($attachs as $attachment)
            <div class="border-top border-dashed border-300 pt-3 pb-4">
              <div class="d-flex flex-between-center">
                <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-700 fs--1"></span>
                  <p class="text-1000 mb-0 lh-1">{{$attachment->file_name}}</p>
                </div>
                <div class="font-sans-serif btn-reveal-trigger">
                  <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                  <div class="dropdown-menu dropdown-menu-end py-2"> <form action="{{ route('destroynew', $attachment->id) }}" method="GET" style="display:inline;">
                    @csrf
                   
                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                </form></div>
                </div>
              </div>
              <p class="fs--1 text-700 mb-2"><span>{{$attachment->file_size}}</span><span class="text-400 mx-1">| </span><span class="text-nowrap">{{date('D-m-Y h:i a',strtotime($attachment->created_at))}}</span></p>@if(in_array($attachment->file_type,['png','jpg','jpeg','webp']))
              <a class="dropdown-item" href="{{asset($attachment->file_path)}}" target="_blank">
              <img class="rounded-2" width="100px" src="{{asset($attachment->file_path)}}" alt="" />
              </a>
               @endif
            </div>
            @endforeach
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
      <form method="post" action="{{route('adddealtask')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-sm-6 col-md-12">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="title" name="title" value="{{old('title')}}" />
                <input class="form-control" id="leadid" type="hidden" name="leadid" value="{{$lead->id}}" />
                <label for="kanbanTaskTitle">Task Title</label>
              </div>
            </div>
            <div class="col-12 gy-4">
              <div class="form-floating">
                <textarea class="form-control" id="floatingProjectDescription" placeholder="Leave a comment here" name="description" style="height: 128px">{{old('description')}}</textarea>
                <label for="floatingProjectDescription">ADD A DESCRIPTION</label>
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
      <form method="post" action="{{route('adddealactivity')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row gx-3 gy-4">
            <div class="col-sm-6 col-md-12">
              <div class="form-floating">
                <input class="form-control" id="kanbanTaskTitle" type="text" placeholder="title" name="title" value="{{old('title')}}" />
                <input class="form-control" id="leadid" type="hidden" name="leadid" value="{{$lead->id}}" />
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
@push('scripts')
<script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>

@endpush
@endsection