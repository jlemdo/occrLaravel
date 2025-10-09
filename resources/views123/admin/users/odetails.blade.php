@extends('layouts.app')
@section('section')
 
		 <h3 class="text-bold text-1100 mb-5">Orders# {{$id}}</h3>
  <div id="members" >
          
            <div class="row g-3 justify-content-between mb-4">
              
                <div class="col-auto">
     
  </div>

              <div class="col col-auto">
        <div class="search-box">
   
    </div></div>
    </div>
          <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
              <table class="table table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort align-middle" scope="col" data-sort="sr">No</th>
                                        <th class="sort align-middle" scope="col" data-sort="customer">Item</th>
                                        <th class="sort align-middle" scope="col" data-sort="type">Price</th>
										<th class="sort align-middle" scope="col" data-sort="email">QTY</th>
                                        <th class="sort align-middle" scope="col" data-sort="phone">Image</th>
                                    </tr>
                                </thead>
             <tbody class="list" id="members-table-body">
                  @foreach ($detail as $details)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="sr align-middle white-space-nowrap">{{ $i++ }}</td>
                      <td class="customer align-middle white-space-nowrap"> {{ $details->item_name }}</td>
                      <td class="type align-middle white-space-nowrap"> {{ $details->item_price }}</td> 
                      <td class="email align-middle white-space-nowrap">{{ $details->item_qty }}</td> 
                      <td class="email align-middle white-space-nowrap"><img src="{{ $details->item_image }}" width="50px" /></td> 
                  </tr>
                  @endforeach

              </tbody>
                            </table>
							
							 </div>
        
          </div>
        </div>
                       
@endsection