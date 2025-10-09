@extends('layouts.app')
@section('section')
 
		
  <div id="members" data-list='{"valueNames":["customer","email","city","last_active","joined"],"page":10,"pagination":true}'>
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
             <h2 class="text-bold text-1100">Product Stock</h2>
            </div>
            <div class="col-auto">
              <div class="d-flex align-items-center">
               
                <a href="{{URL::to('newstock')}}" class="btn btn-phoenix-primary"><span class="fas fa-plus me-2"></span>Add New</a>
			
              </div>
            </div>
          </div>
          <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
              <table class="table table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort align-middle" scope="col" data-sort="sr">No</th>
                                        <th class="sort align-middle" scope="col" data-sort="customer">Item</th>
										<th class="sort align-middle" scope="col" data-sort="voltage_nominal">QTY</th>
                                        <th class="sort align-middle" scope="col" data-sort="voltage_nominal">Date</th>
										<th class="sort align-middle" scope="col" data-sort="customer">Action</th>
                                    </tr>
                                </thead>
             <tbody class="list" id="members-table-body">
                  @foreach ($projects as $project)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="sr align-middle white-space-nowrap">{{ $i++ }}</td>
                  <td class="customer align-middle white-space-nowrap">{{ $project->product }}</td>
                  <td class="customer align-middle white-space-nowrap">{{ $project->qty }}</td>
                  <td class="customer align-middle white-space-nowrap">{{ $project->created_at }}</td>
                  <td>
                     <div class="font-sans-serif btn-reveal-trigger position-static">
              <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
              <div class="dropdown-menu dropdown-menu-end py-2">
              
@can('Inverter Edit')
              <a class="dropdown-item" href="{{URL::to('stockEdit/'.$project->id)}}">Edit</a>
             @endcan
              @can('Inverter Delete')
              <form id="destroy-data{{ $i }}"
                          action="{{ route('deletestock', $project->id)}}"
                          method="post">
                          @csrf
                          <button class="dropdown-item text-danger" type="submit" >Remove</button>
                      </form>
                  @endcan	
              </div>
            </div>

                     
                  </td>
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
                       
@endsection