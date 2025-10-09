@extends('layouts.app')
@section('section')
@push('styles')

   
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
	
@endpush

     
      
        
         
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 border-y border-translucent">
          <div class="row py-3 gy-3 gx-0">
            <div class="col-6 col-md-4 order-1 d-flex align-items-center">
            
            </div>
            <div class="col-12 col-md-4 order-md-1 d-flex align-items-center justify-content-center">
             
              <h3 class="px-3 text-body-emphasis fw-semibold calendar-title mb-0"> </h3>
            
            </div>
            <div class="col-6 col-md-4 ms-auto order-1 d-flex justify-content-end">
              <div>
                <div class="btn-group btn-group-sm" role="group">
                  <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addEventModal"> <span class="fas fa-plus pe-2 fs-10"></span>Add new task </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="calendar-outline mt-1 mb-1" id="appCalendar"></div>
       
   
 <div class="modal fade" id="addEventModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content border border-translucent">
            <form  autocomplete="off" action="{{route('createcaltask')}}" method="post" >
             @csrf    
              <div class="modal-header px-card border-0">
                <div class="w-100 d-flex justify-content-between align-items-start">
                  <div>
                    <h5 class="mb-0 lh-sm text-body-highlight">Add new</h5>
                    <div class="mt-2">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="inlineRadio1" type="radio" name="type" value="Event" checked="checked" />
                        <label class="form-check-label" for="inlineRadio1">Event</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="inlineRadio2" type="radio" name="type" value="Task" />
                        <label class="form-check-label" for="inlineRadio2">Task</label>
                      </div>
                    </div>
                  </div>
                  <button class="btn p-1 fs-10 text-body" type="button" data-bs-dismiss="modal" aria-label="Close">DISCARD </button>
                </div>
              </div>
              <div class="modal-body p-card py-0">
                <div class="form-floating mb-3">
                  <input class="form-control" id="eventTitle" type="text" name="title" required placeholder="Event title" />
                  <label for="eventTitle">Title</label>
                </div>
                <div class="form-floating mb-5">
                  <select class="form-select" id="eventLabel" name="label">
                    <option value="primary" selected="selected">Business</option>
                    <option value="secondary">Personal</option>
                    <option value="success">Meeting</option>
                    <option value="danger">Birthday</option>
                    <option value="info">Report</option>
                    <option value="warinng">Must attend</option>
                  </select>
                  <label for="eventLabel">Label</label>
                </div>
                <div class="flatpickr-input-container mb-3">
                  <div class="form-floating">
                    <input class="form-control datetimepicker" id="eventStartDate" type="text" name="startDate" placeholder="yyyy/mm/dd hh:mm" data-options='{"disableMobile":true,"enableTime":"true","dateFormat":"Y-m-d H:i"}' /><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                    <label class="ps-6" for="eventStartDate">Starts at</label>
                  </div>
                </div>
                <div class="flatpickr-input-container mb-3">
                  <div class="form-floating">
                    <input class="form-control datetimepicker" id="eventEndDate" type="text" name="endDate" placeholder="yyyy/mm/dd hh:mm" data-options='{"disableMobile":true,"enableTime":"true","dateFormat":"Y-m-d H:i"}' /><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                    <label class="ps-6" for="eventEndDate">Ends at</label>
                  </div>
                </div>
               
                <div class="form-floating my-5">
                  <textarea class="form-control" id="eventDescription" placeholder="Leave a comment here" name="description" style="height: 128px"></textarea>
                  <label for="eventDescription">Description</label>
                </div>
                
                
               
              </div>
              <div class="modal-footer d-flex justify-content-between align-items-center border-0">
                <button class="btn btn-primary px-4" type="submit">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    @push('scripts') 
	 
    
   
    <script src="{{asset('vendors/fullcalendar/index.global.min.js')}}"></script>
    
    <script src="{{asset('vendors/flatpickr/flatpickr.min.js')}}"></script>
   
    <script src="{{asset('assets/js/calendar.js')}}"></script>
    
	<script>
    document.addEventListener('DOMContentLoaded', function () {
        let calendarEl = document.getElementById('appCalendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: function (info, successCallback, failureCallback) {
                // Fetch events from the Laravel API
                fetch('/api/leadactivities')
                    .then(response => response.json())
                    .then(data => successCallback(data))
                    .catch(error => failureCallback(error));
            },
            eventClick: function (info) {
                // Redirect to the event's URL
                if (info.event.url) {
                    window.location.href = info.event.url;
                }
                info.jsEvent.preventDefault(); // Prevent default anchor behavior
            }
        });
        calendar.render();
    });
</script>
    
  @endpush
        @endsection