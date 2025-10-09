@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush

   
        
	
        <div class="pb-6">
          <h2 class="mb-4">Contracts</h2>
          <div id="lealsTable" data-list='{"valueNames":["name","email","phone","contact","company","date"],"page":10,"pagination":true}'>
            <div class="row g-3 justify-content-between mb-4">
              <div class="col-auto">
                <div class="d-md-flex justify-content-between">
                  <div>    
                  </div>
                </div>
              </div>
                <div class="col-auto">
      <form method="GET" action="{{ route('crm.contract') }}">
          <div class="input-group">
              <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
              <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
              <button class="btn btn-primary" type="submit">Filter</button>
              @if(request()->has('search') || request()->has('from_date') || request()->has('to_date'))
                  <a href="{{ route('crm.contract') }}" class="btn btn-secondary">Reset</a>
              @endif
          </div>
      </form>
  </div>

              <div class="col col-auto">
        <div class="search-box">
    <form class="position-relative" style="display:flex" data-bs-toggle="search" data-bs-display="static" method="GET" action="{{ route('crm.contract') }}">
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
        </select>
        </div>
    </form>
    </div></div>
    
            </div>
            <div class="table-responsive scrollbar mx-n1 px-1 border-top">
              <table class="table fs--1 mb-0 leads-table" id="myTable">
                <thead>
                  <tr>
                   
                    <th class="sort white-space-nowrap align-middle text-uppercase ps-0" scope="col" data-sort="name" style="width:25%;">Name</th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="email" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-success-100 rounded me-2"><span class="text-success-600 dark__text-success-300" data-feather="mail"></span></div><span>Email</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="phone" style="width:15%; min-width: 180px;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-primary-100 rounded me-2"><span class="text-primary-600 dark__text-primary-300" data-feather="phone"></span></div><span>Phone</span>
                      </div>
                    </th>
                    <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="contact" style="width:15%;">
                      <div class="d-inline-flex flex-center">
                        <div class="d-flex align-items-center px-1 py-1 bg-info-100 rounded me-2"><span class="text-info-600 dark__text-info-300" data-feather="user"></span></div><span>Contact Person</span>
                      </div>
                    </th>
                   
                    <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Create date</th>
                    <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list" id="leal-tables-body">
                @foreach ($leads as $lead)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                   
                    <td class="name align-middle white-space-nowrap ps-0">
                      <div class="d-flex align-items-center">
                        <div><a class="fs-0 fw-bold" href="#!">{{$lead->name}}</a>
                          <div class="d-flex align-items-center">
                           <span class="badge badge-phoenix badge-phoenix-primary">{{$lead->status}}</span>
                          </div>
                        </div>
                      </div>
                    </td>
<td class="email align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="mailto:{{$lead->email}}">{{$lead->email}}</a></td>
<td class="phone align-middle white-space-nowrap fw-semi-bold ps-4 border-end"><a class="text-1000" href="tel:{{$lead->phone}}">{{$lead->phone}}</a></td>
<td class="contact align-middle white-space-nowrap ps-4 border-end fw-semi-bold text-1000">{{$lead->contact_name}}</td>
<td class="company align-middle white-space-nowrap text-600 ps-4 border-end fw-semi-bold text-1000">{{$lead->created_at}}</td>
<td class="align-middle white-space-nowrap text-end pe-0 ps-4">
<div class="font-sans-serif btn-reveal-trigger position-static">
<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
<div class="dropdown-menu dropdown-menu-end py-2">
<a class="dropdown-item" href="{{URL::to('invoicesshow/'.$lead->id)}}">Invoice</a>


</div>
</div>
</td>
                  </tr>
                  @endforeach 
                </tbody>
              </table>
            </div>
           
          


        
          </div><div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
    <div class="col-auto d-flex">
        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900">
            Showing {{ $leads->firstItem() }} - {{ $leads->lastItem() }} of {{ $leads->total() }} deals
        </p>
    </div>
    <div class="col-auto d-flex">
        @if ($leads->onFirstPage())
            <button class="page-link" disabled><span class="fas fa-chevron-left"></span></button>
        @else
            <a href="{{ $leads->previousPageUrl() }}" class="page-link"><span class="fas fa-chevron-left"></span></a>
        @endif
        <ul class="mb-0 pagination">
            @for ($i = 1; $i <= $leads->lastPage(); $i++)
                <li class="page-item {{ ($leads->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $leads->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endfor
        </ul>
        @if ($leads->hasMorePages())
            <a href="{{ $leads->nextPageUrl() }}" class="page-link pe-0"><span class="fas fa-chevron-right"></span></a>
        @else
            <button class="page-link pe-0" disabled><span class="fas fa-chevron-right"></span></button>
        @endif
    </div>
</div>
        </div>



    
  

    @push('scripts') 
    <script src="{{asset('vendors/choices/choices.min.js')}}"></script>
    <script src="{{asset('vendors/sortablejs/sortable.min.js')}}"></script>
    
  
  @endpush
        @endsection
		
		