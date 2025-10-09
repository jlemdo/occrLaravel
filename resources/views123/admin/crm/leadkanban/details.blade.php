 <div class="modal-body p-0">
            

  <div class="row">
    
 
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
                  <p class="mb-0">{{$lead->street}},</p><a class="fw-bold" href="#!">{{$lead->city}}</a>
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
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-globe"></span>
                  <h5 class="text-1000 mb-0">Website</h5>
                </div><a href="#!">{{$lead->website}}</a>
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
          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center mb-5">
                <h3>Address</h3>

              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-estate"></span>
                  <h5 class="mb-0">Street</h5>
                </div>
                <p class="mb-0 text-800">{{$lead->street}}</p>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-map-pin-alt"></span>
                  <h5 class="mb-0 text-1000">Zip code</h5>
                </div>
                <p class="mb-0 text-800">{{$lead->zipcode}}</p>
              </div>
              <div class="mb-4">
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-map"></span>
                  <h5 class="mb-0 text-1000">City</h5>
                </div>
                <p class="mb-0 text-800">{{$lead->city}}</p>
              </div>
              <div>
                <div class="d-flex align-items-center mb-1"><span class="me-2 uil uil-windsock"></span>
                  <h5 class="mb-0 text-1000">Country</h5>
                </div>
                <p class="mb-0 text-800">{{$lead->country}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="phoenix-offcanvas-backdrop d-lg-none top-0" data-phoenix-backdrop="data-phoenix-backdrop"></div>
      </div>
    </div>
    <div class="col-md-7 col-lg-7 col-xl-8">
      <div class="lead-details-container">
        
        <div class="scrollspy-example bg-body-tertiary rounded-2" data-bs-spy="scroll" data-bs-offset="0" data-bs-target="#navbar-deals-detail" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
         
          <div class="mb-8">
            <div class="d-flex justify-content-between align-items-center mb-4" id="scrollspyTask">
              <h2 class="mb-0">Activity</h2>
             
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
              
            </div>
          </div>
          <div class="mb-8">
            <h2 class="mb-2" id="scrollspyEmails">Emails</h2>
           
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
                    
                  </div>
                </div>
            
              </div>
            </div>
          </div>
          <!-- Attachments -->
          <div>
            <h2 class="mb-4" id="scrollspyAttachments">Attachments</h2>
            
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
              <p class="fs--1 text-700 mb-2"><span>{{$attachment->file_size}}</span><span class="text-400 mx-1">| </span><span class="text-nowrap">{{date('D-m-Y h:i a',strtotime($attachment->created_at))}}</span></p>@if(in_array($attachment->file_type,['png','jpg','jpeg','webp']))<img class="rounded-2" src="{{asset($attachment->file_path)}}" alt="" /> @endif
            </div>
            @endforeach
            @endif
          
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>



          </div>
          <div class="modal-footer justify-content-between">
            <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--2 me-1" data-fa-transform="up-1"></span>Close</button>
           
          </div>