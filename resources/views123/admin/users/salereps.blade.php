@extends('layouts.app')
@section('section')
 
		 
  <div id="members" data-list='{"valueNames":["customer","email","mobile_number","city","last_active","joined"],"page":10,"pagination":true}'>
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
             <h2 class="text-bold text-1100">Users</h2>
            </div>
            <div class="col-auto">
              <div class="d-flex align-items-center">
               @can('User Add')
                <a href="{{URL::to('addnewuser/sale reps')}}" class="btn btn-phoenix-primary"><span class="fas fa-plus me-2"></span>Add New</a>
				@endcan
              </div>
            </div>
          </div>
          <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
              <table class="table table-sm fs--1 mb-0">
        <thead>
            <tr>
                <th class="sort align-middle" scope="col" data-sort="sr">No</th>
                <th class="sort align-middle" scope="col" data-sort="customer">Name</th>
                <th class="sort align-middle" scope="col" data-sort="type">Usertype</th>
                <th class="sort align-middle" scope="col" data-sort="email">Email</th>
                <th class="sort align-middle" scope="col" data-sort="phone">Phone</th>
                <th class="sort align-middle" scope="col" data-sort="phone">Password</th>
                <th class="sort align-middle" scope="col" data-sort="state">Status</th>
                <th class="sort align-middle" scope="col" data-sort="customer">Action</th>
            </tr>
        </thead>
                               <tbody class="list" id="members-table-body">
                                    @foreach ($users as $user)
<tr class="hover-actions-trigger btn-reveal-trigger position-static">
  <td class="sr align-middle white-space-nowrap">{{ $i++ }}</td>
  <td class="customer align-middle white-space-nowrap">{{ $user->first_name.' '.$user->last_name }}</td>
  <td class="type align-middle white-space-nowrap">{{ $user->usertype }}</td> 
  <td class="email align-middle white-space-nowrap">{{ $user->email }}</td> 
  <td class="phone align-middle white-space-nowrap">{{ $user->phone}}</td>	
  <td class="email align-middle white-space-nowrap">{{ $user->show_password }}</td> 
  <td class="state align-middle white-space-nowrap">{{ strtoupper($user->is_active)}}</td>


  <td>
     <div class="font-sans-serif btn-reveal-trigger position-static">
<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
<div class="dropdown-menu dropdown-menu-end py-2">

<a class="dropdown-item" href="{{URL::to('userEdit/'.$user->id)}}">Edit</a>
@if($user->usertype !='admin')
<a class="dropdown-item" href="{{URL::to('usersts/'.$user->id.'/'.$user->is_active)}}">
Change Status
</a>

<form id="destroy-data{{ $i }}"
          action="{{ route('deleteuser', $user->id)}}"
          method="post">
          @csrf
        
           <button class="dropdown-item text-danger" type="submit" >Remove</button>
      </form>
      @endif
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