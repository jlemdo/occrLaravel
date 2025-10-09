@extends('layouts.app')
@section('section')
@push('styles')

@endpush
 <div class="pb-5">
          <div class="row g-4">
            <div class="col-12 col-xxl-6">
              <div class="mb-1">
                <h2 class="mb-1">Notifications</h2>
              </div>
              
            </div>
           
        <div class="mx-n4 mx-lg-n6 mb-5 border-bottom">
          @forelse(auth()->user()->notifications as $notification)
                       @if($notification->read_at !=NULL)
          <div class="d-flex align-items-center justify-content-between py-3 px-lg-6 px-4 notification-card border-top read">
           @else 
           <div class="d-flex align-items-center justify-content-between py-3 px-lg-6 px-4 notification-card border-top unread">
             @endif
            <div class="d-flex">
              <div class="avatar avatar-xl me-3"><i class="fas fa-bell fa-lg text-primary"></i>
              </div>
              <div class="me-3 flex-1 mt-2">
                <h4 class="fs-9 text-body-emphasis">{{ $notification->data['title'] }}</h4>
                <p class="fs-9 text-body-highlight">{{$notification->data['message']}}
                @if(isset($notification->data['url']))
    <a href="{{ $notification->data['url'] }}" class="btn btn-link">View Details</a>
@endif</p>
               
                <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span>{{$notification->created_at}}</p>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
              <div class="dropdown-menu dropdown-menu-end py-2"> 
              @if($notification->read_at !=NULL)
              <a class="dropdown-item" href="{{ route('notifications.markAsUNRead', $notification->id) }}">Mark as UN-Read</a>
              @else 
              <a class="dropdown-item" href="{{ route('notifications.markAsRead', $notification->id) }}">Mark as Read</a>
              @endif
              </div>
            </div>
          </div>
          @empty
                                @endforelse
          
          
        </div>
        
          </div>
        </div>
       
        
       
@push('scripts')

@endpush
@endsection