 <!--<nav class="navbar navbar-top navbar-slim fixed-top navbar-expand" id="topNavSlim">-->
 <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault">
        <div class="collapse navbar-collapse justify-content-between">
          <div class="navbar-logo">

            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand navbar-brand" href="">
			<!--Holio <span class="text-1000 d-none d-sm-inline">GtT</span>-->
			 <div class="d-flex align-items-center"><img src="{{asset('assets/logo.png')}}" alt="heliogt" width="170" />
                 
                </div>
			</a>
          </div>
          <ul class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item">
              <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim">
      <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="phoenixTheme" value="dark" />
      <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span class="fs--1 fw-bold">Dark</span></label>
      <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span class="fs--1 fw-bold">Light</span></label>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span data-feather="bell" style="height:12px;width:12px;"></span>
               @php
        $unreadCount = auth()->user()->unreadNotifications->count();
    @endphp
    @if($unreadCount > 0)
        <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $unreadCount }}
            <span class="visually-hidden">unread notifications</span>
        </span>
    @endif
    </a>

              <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                <div class="card position-relative border-0">
                  <div class="card-header p-2">
                    <div class="d-flex justify-content-between">
                      <h5 class="text-black mb-0">Notificatons</h5>
                      
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="scrollbar-overlay" style="height: 27rem;">
                    
                      <div class="border-300">
                       @forelse(auth()->user()->notifications as $notification)
                       @if($notification->read_at !=NULL)
                        <div class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                        @else 
                         <div class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                          @endif
                          <div class="d-flex align-items-center justify-content-between position-relative">
                            <div class="d-flex">
                              <div class="avatar avatar-m me-3"><i class="fas fa-bell fa-lg text-primary"></i>
                              </div>
                              <div class="flex-1 me-sm-3">
                                <h4 class="fs--1 text-black">{{ $notification->data['title'] }}</h4>
                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal">{{$notification->data['message']}}@if(isset($notification->data['url']))
    <a href="{{ $notification->data['url'] }}" class="btn btn-link">View Details</a>
@endif</p>
    <p class="text-800 fs--1 mb-0"><span class="me-1 fas fa-clock"></span>{{$notification->created_at}}</p>
                              </div>
                            </div>
                            <div class="font-sans-serif d-none d-sm-block">
                              <button class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                              <div class="dropdown-menu dropdown-menu-end py-2">
                              @if($notification->read_at !=NULL)
              <a class="dropdown-item" href="{{ route('notifications.markAsUNRead', $notification->id) }}">Mark as UN-Read</a>
              @else 
              <a class="dropdown-item" href="{{ route('notifications.markAsRead', $notification->id) }}">Mark as Read</a>
              @endif
                               </div>
                            </div>
                          </div>
                        </div>
                          @empty
                                @endforelse
                        
                       
                        
                    
                      </div>
                      
                    </div>
                  </div>
                  <div class="card-footer p-0 border-top border-0">
                    <div class="my-2 text-center fw-bold fs--2 text-600">
                    <a class="fw-bolder" href="{{route('notifications')}}">All Notifications</a></div>
                  </div>
                </div>
              </div>
            </li>
            
            <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false"> {{auth()->user()->first_name}} <span class="fa-solid fa-chevron-down fs--2"></span></a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300" aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                  <div class="card-body p-0">
                    <div class="text-center pt-4 pb-1">
                      <div class="avatar avatar-xl ">
					  
					    @if(auth()->user()->image)
                        <img class="rounded-circle " src="{{asset('profile/'.auth()->user()->image)}}" alt="" />
						@else
						<img class="rounded-circle " src="{{asset('profile/avatar.png')}}" alt="" />	
						@endif
                                   
                      </div>
                      <h6 class="mt-2 text-black">{{auth()->user()->first_name.' '.auth()->user()->last_name}}</h6>
					  <h6 class="mt-2 text-black">Login as {{auth()->user()->usertype}}</h6>
                      <hr />
                    </div>
                  </div>
    <div class="overflow-auto scrollbar" style="height: 7rem;">
      <ul class="nav d-flex flex-column mb-1 pb-1">
        <li class="nav-item"><a class="nav-link px-3" href="{{route('dashboard')}}"><span class="me-2 text-900" data-feather="settings"></span>Dashboard</a></li>
        <li class="nav-item"><a class="nav-link px-3" href="{{route('users.editprofile')}}"> <span class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
        <li class="nav-item"><a class="nav-link px-3" href="{{route('profile.edit',auth()->user()->id)}}"> <span class="me-2 text-900" data-feather="lock"></span>Edit Account</a></li>
		
		
									
      </ul>
    </div>
    <div class="card-footer p-0">
     
      
      <div class="px-3"> 
	   
<form method="POST" action="{{ route('logout') }}">
@csrf
<a class="btn btn-phoenix-secondary d-flex flex-center w-100" class="dropdown-item" href="javascript:void(0);"
  onclick="event.preventDefault(); this.closest('form').submit();"><span class="me-2" data-feather="log-out"> </span>Sign out</a>
</form>
                                
    
 </div>
      
    </div>
  </div>
</div>
</li>
</ul>
</div>
      </nav>