@extends('layouts.app')
@section('section')
<div class="content-wrapper">
<section id="user-profile">
  <div class="row">
    <div class="col-12">
      <div class="card profile-with-cover">
        <div class="card-img-top img-fluid bg-cover height-300" style="background: url('@if($user->userdetail->cover_photo){{ asset('profile/'.$user->userdetail->cover_photo) }}@else{{ asset('app-assets/img/photos/14.jpg') }}@endif') 50%;"
></div>
        <div class="media profil-cover-details row">
          <div class="col-5">
           
          </div>
          <div class="col-2">
            <div class="align-self-center halfway-fab text-center">
              <a class="profile-image">
                <img src="@if($user->image) {{asset('profile/'.$user->image)}}  @else {{asset('app-assets/img/portrait/avatars/avatar-07.png')}} @endif" class="rounded-circle img-border gradient-summer width-100"
                  alt="Card image">
              </a>
            </div>
          </div>
          <div class="col-5">
            
          </div>
          <div class="profile-cover-buttons">
            <div class="media-body halfway-fab align-self-end">
              <div class="text-right d-none d-sm-none d-md-none d-lg-block">
                <a href="{{route('speakers.uploadvideo')}}" class="btn btn-primary btn-raised mr-2"><i class="fa fa-plus"></i> Upload Intro Video</a>
                <a href="{{route('speakers.editprofile')}}" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i> Update Profile</a>
              </div>
              <div class="text-right d-block d-sm-block d-md-block d-lg-none">
                <button type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="profile-section">
          <div class="row">
            <div class="col-lg-5 col-md-5 ">
             
            </div>
            <div class="col-lg-2 col-md-2 text-center">
              <span class="font-medium-2 text-uppercase">{{$user->first_name.' '.$user->last_name}}</span>
              <p class="grey font-small-2">{{$user->usertype}}</p>
            </div>
            <div class="col-lg-5 col-md-5">
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Basic User Details Ends-->

<!--About section starts-->
<section id="about">
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Personal Information</h5>
        </div>
        <div class="card-content">
          <div class="card-body">
        
        
            <div class="mt-3">
              <span class="text-bold-500 primary">Description:</span>
              <span class="d-block overflow-hidden">{{$user->userdetail->long_description}}
              </span>
            </div>
            <hr>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-4">
                <ul class="no-list-style">
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="icon-present font-small-3"></i> Member Since:</a></span>
                    <span class="d-block overflow-hidden">{{date('d-M-Y',strtotime($user->created_at))}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-map-pin font-small-3"></i> Country & State:</a></span>
                    <span class="d-block overflow-hidden">{{$user->country.','.$user->state}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-globe font-small-3"></i> Address:</a></span>
                    <span class="d-block overflow-hidden">{{$user->userdetail->address}}</span>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <ul class="no-list-style">
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-user font-small-3"></i> Denomination:</a></span>
                    <span class="d-block overflow-hidden">{{$user->userdetail->sect->name??''}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-mail font-small-3"></i> Email:</a></span>
                    <a class="d-block overflow-hidden">{{$user->email}}</a>
                  </li>
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> Language:</a></span>
                    <a class="d-block overflow-hidden">@if($user->userdetail->languages) {{ implode(', ', json_decode($user->userdetail->languages)) }} @endif</a>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <ul class="no-list-style">
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> Phone Number:</a></span>
                    <span class="d-block overflow-hidden">{{$user->userdetail->contact_number}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-briefcase font-small-3"></i> Secondary Contact:</a></span>
                    <span class="d-block overflow-hidden">{{$user->userdetail->address}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> Education:</a></span>
                    <span class="d-block overflow-hidden">@if($user->userdetail->qualification) {{ implode(', ', json_decode($user->userdetail->qualification)) }} @endif
</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Bank Information</h5>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <ul class="no-list-style">
                  <li class="mb-2">
                    <span class="primary text-bold-500"><a><i class="ft-home font-small-3"></i> {{$user->bankinfo->bank_name??'No Provided yet'}}</a></span>
                
                    <span class="line-height-2 d-block overflow-hidden">{{$user->bankinfo->bank_account??'No Provided yet'}}</span>
                  </li>
               
                </ul>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--About section ends-->



<!--User's friend section starts-->
<section id="friends">
  <div class="row">
    <div class="col-12">
      <div class="content-header">Reviews</div>
	   @for ($i = 1; $i <= 5; $i++) @if ($i <=round($user->averageRating()))
                  <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 576 512" style="width: 16px; height: 16px;">
                      <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="not-filled" viewBox="0 0 576 512" style="width: 16px; height: 16px;">
                      <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                    @endif
                    @endfor
    </div>
  </div>
  <div class="row">
    @forelse($user->speakerReviews as $reviews)
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card">
        <div class="card-header text-center">
          <img src="{{asset('profile/'.$reviews->user->image)}}" alt="Brek" width="150" class="rounded-circle gradient-mint">
        </div>
        <div class="card-content">
          <div class="card-body text-center">
            <h4 class="card-title">{{$reviews->user->first_name.' '.$reviews->user->last_name}}</h4>
            <p class="category text-gray font-small-4">@for ($i = 1; $i <= 5; $i++) @if ($i <=round($reviews->rating))
                  <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 576 512" style="width: 16px; height: 16px;">
                      <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="not-filled" viewBox="0 0 576 512" style="width: 16px; height: 16px;">
                      <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                    @endif
                    @endfor</p>
           <form class="form form-horizontal" method="post" action="{{route('reviewaction')}}" >
                                @csrf
		    
			 <input type="hidden" name="sts" value="{{$reviews->approved_speaker}}" />
			 <input type="hidden" name="id" value="{{$reviews->id}}" />
			 <button type="submit" class="btn btn-lg gradient-back-to-earth font-small-2 white p-2 mr-2">
			@if($reviews->approved_speaker==0)
			Make Public
		@else
			Hide
		@endif
		</button>
		
            <a class="btn btn-lg btn-outline-grey font-small-2 p-2">
			@if($reviews->approved_admin==0)
			Pending
		@else
			Public
		@endif
			</a>
			</form>
			
            <hr class="grey">
            <div class="row grey">
              <div class="col-12">
                <a> {{date('d-M-Y h:i a',strtotime($reviews->created_at))}}</a>
              </div>
          
		    {{$reviews->comment}} 
            </div>
          </div>
        </div>
      </div>
    </div>
   @empty
   <div class="col-12">
   No Reviews Yet
   </div>
   

   @endforelse
  </div>
</section>


</div>
@endsection