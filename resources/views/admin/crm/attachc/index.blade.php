@extends('layouts.app')
@section('section')
 
		
  <div id="members" data-list='{"valueNames":["customer","email","mobile_number","city","last_active","joined"],"page":10,"pagination":true}'>
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
              <h2 class="text-bold text-1100"> Attachment Categories</h2>
            </div>
            <div class="col-auto">
              <div class="d-flex align-items-center">
              
                <a href="{{URL::to('newattachc')}}" class="btn btn-phoenix-primary"><span class="fas fa-plus me-2"></span>Add New</a>
				
              </div>
            </div>
          </div> 
          <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1">
            
            <div class="table-responsive scrollbar ms-n1 ps-1">
           
              <table class="table table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                      
                                        <th class="sort align-middle" scope="col">Name</th>
                                        <th class="sort align-middle" scope="col">Action</th>
                                    </tr>
                                </thead>
     <tbody class="list" id="members-table-body">
          @foreach ($timeline as $time)
         <tr class="hover-actions-trigger btn-reveal-trigger position-static" draggable="true">
             
              <td class="customer align-middle white-space-nowrap">{{ $time->name }}</td>
              
          
              <td>
                 <div class="font-sans-serif btn-reveal-trigger position-static">
          <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
          <div class="dropdown-menu dropdown-menu-end py-2">
          

          <a class="dropdown-item" href="{{URL::to('attachcEdit/'.$time->id)}}">Edit</a>
        
          <form id="destroy-data{{ $i }}"
                      action="{{ route('deleteattachc', $time->id)}}"
                      method="post">
                      @csrf
                      <button class="dropdown-item text-danger" type="submit" >Remove</button>
                  </form>
                
          </div>
        </div>

                 
              </td>
          </tr>
          @endforeach

      </tbody>
                            </table>
				
                			 </div>
           
          </div>
         
        </div>
                  
@endsection