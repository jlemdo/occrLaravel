@extends('layouts.app')
@section('section')
<style>
.custom-pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
    margin: 0;
    gap: 5px; /* Spacing between page links */
}

.custom-pagination .page-item {
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
}

.custom-pagination .page-item.active .page-link {
    background-color: #0d6efd; /* Bootstrap primary color */
    color: white;
    border-color: #0d6efd;
}

.custom-pagination .page-link {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    color: #0d6efd; /* Bootstrap primary color */
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    transition: background-color 0.2s, color 0.2s;
}

.custom-pagination .page-link:hover {
    background-color: #e9ecef;
    color: #0a58ca; /* Slightly darker primary color */
}

.custom-pagination .page-link:disabled {
    color: #6c757d; /* Disabled color */
    pointer-events: none;
    background-color: #f8f9fa;
}


</style>
 
		 <h2 class="text-bold text-1100 mb-5">Activity Log</h2>
  <div id="members" data-list='{"valueNames":["customer","email","mobile_number","city","last_active","joined"],"page":10,"pagination":true}'>
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
              <div class="search-box">
              
              </div>
            </div>
            <div class="col-auto">
              <div class="d-flex align-items-center">
               
            
				
              </div>
            </div>
          </div>
         <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1" data-list='{"valueNames":["customer","street","city","state", "zip", "email","phone"]}'>
        <div class="table-responsive scrollbar ms-n1 ps-1">
            <table class="table table-sm fs--1 mb-0">
        <thead>
            <tr>
              
                <th class="sort align-middle" scope="col" data-sort="sr">Log</th>
                <th class="sort align-middle" scope="col" data-sort="sr">Description</th>
                <th class="sort align-middle" scope="col" data-sort="sr">Changes</th>
                <th class="sort align-middle" scope="col" data-sort="sr">Causer</th>
                <th class="sort align-middle" scope="col" data-sort="sr">Created At</th>
            </tr>
        </thead>
       <tbody class="list" id="members-table-body">
            @forelse($projects as $activity)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                 
                    <td>{{ $activity->log_name }}</td> <td>{{ $activity->description }}</td>
                <td>
    @if($activity->event === 'deleted')
        @if($activity->properties->has('old'))
            <ul>
                @foreach($activity->properties['old'] as $key => $value)
                    @if(!in_array($key, ['updated_at', 'created_at', 'deleted_at'])) <!-- Exclude unwanted fields -->
                        <li>
                            <strong>{{ $key }}:</strong> <span style="color: red;">{{ $value }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <span>No details available for this deletion.</span>
        @endif
    @elseif($activity->event === 'updated' || $activity->event === 'created')
        @if($activity->properties->isNotEmpty())
            <ul>
                @foreach($activity->properties['attributes'] ?? [] as $key => $newValue)
                    @if(!in_array($key, ['updated_at', 'created_at', 'deleted_at'])) <!-- Exclude unwanted fields -->
                        <li>
                            <strong>{{ $key }}:</strong>
                            @if(isset($activity->properties['old'][$key]))
                                <span style="color: red;">{{ $activity->properties['old'][$key] }}</span>
                                &rarr; 
                            @endif
                            <span style="color: green;">{{ $newValue }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            N/A
        @endif
    @else
        <span>Unknown activity type.</span>
    @endif
</td>



                    <td>{{ $activity->causer ? $activity->causer->first_name : 'System' }}</td>
                    <td>{{ $activity->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @empty
               
            @endforelse
        </tbody>
    </table>
							
							 </div>
            <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
    <div class="col-auto d-flex">
        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900">
            Showing {{ $projects->firstItem() }} - {{ $projects->lastItem() }} of {{ $projects->total() }} projects
        </p>
    </div>
    <div class="col-auto d-flex">
        @if ($projects->onFirstPage())
        <button class="page-link" disabled><span class="fas fa-chevron-left"></span></button>
        @else
        <a href="{{ $projects->previousPageUrl() }}" class="page-link"><span class="fas fa-chevron-left"></span></a>
        @endif
        
        <ul class="mb-0 custom-pagination">
            @for ($i = 1; $i <= $projects->lastPage(); $i++)
            <li class="page-item {{ ($projects->currentPage() == $i) ? 'active' : '' }}">
                <a href="{{ $projects->url($i) }}" class="page-link">{{ $i }}</a>
            </li>
            @endfor
        </ul>
        
        @if ($projects->hasMorePages())
        <a href="{{ $projects->nextPageUrl() }}" class="page-link pe-0"><span class="fas fa-chevron-right"></span></a>
        @else
        <button class="page-link pe-0" disabled><span class="fas fa-chevron-right"></span></button>
        @endif
    </div>
</div>

          </div>
          
        </div>
                       
@endsection