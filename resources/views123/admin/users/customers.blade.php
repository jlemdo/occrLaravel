@extends('layouts.app')
@section('section')
 
		 <h3 class="text-bold text-1100 mb-5">Orders</h3>
  <div id="members" >
          
            <div class="row g-3 justify-content-between mb-4">
              
                <div class="col-auto">
      <form method="GET" action="{{ route('admin.allcustomers') }}">
  <div class="input-group">
      <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request()->get('from_date') }}">
      <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request()->get('to_date') }}">
      <button class="btn btn-phoenix-primary" type="submit">Filter</button>
      @if(request()->has('search') || request()->has('from_date') || request()->has('to_date') || request()->has('status') || request()->has('status_type'))
          <a href="{{ route('admin.allcustomers') }}" class="btn btn-phoenix-secondary">Reset</a>
      @endif
  </div>
      </form>
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
                                        <th class="sort align-middle" scope="col" data-sort="customer">Customer</th>
                                        <th class="sort align-middle" scope="col" data-sort="type">Order#</th>
										<th class="sort align-middle" scope="col" data-sort="email">Date</th>	<th class="sort align-middle" scope="col" data-sort="email">Products</th>
                                        <th class="sort align-middle" scope="col" data-sort="status">Status</th>
                                       @if(auth()->user()->usertype !='driver')
                                        <th class="sort align-middle" scope="col" data-sort="status">Delivery Man</th>
                                        @endif
                                        <th class="sort align-middle" scope="col" data-sort="phone">Action</th>
                                    </tr>
                                </thead>
             <tbody class="list" id="members-table-body">
                  @foreach ($users as $user)
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="sr align-middle white-space-nowrap">{{ $i++ }}</td>
                      <td class="customer align-middle white-space-nowrap">
                         
                          
                            @php 
$userdd = App\Models\User::where('id', $user->userid)->first();
@endphp
@if($userdd)
 {{ $userdd->first_name }} - {{ $userdd->last_name }}
 @else
 -
 @endif
</td>
                      <td class="type align-middle white-space-nowrap"> {{ $user->id }}</td> 
                      <td class="email align-middle white-space-nowrap">{{ $user->created_at }}</td>  
                       
                      <td class="email align-middle white-space-nowrap">
                          
                          @php 
                          $orderdeta = App\Models\Ordedetail::where('orderno', $user->id)->get();
                          @endphp
                          
                          @foreach ($orderdeta as $ord)
                          
                          {{$ord->item_qty}} {{$ord->item_name}} <br />
                          
                          @endforeach
                          </td>  
                      
                      <td class="email align-middle white-space-nowrap">
                          
                           <select class="update-status" onChange="change_sts(this.value, '<?php echo $user->id;?>')">
                              <option @if($user->status=='Open') selected @endif value="Open">Open</option>
                              <!--<option @if($user->status=='Pending') selected @endif value="Pending">Pending</option>-->
                              <option @if($user->status=='On the Way') selected @endif value="On the Way">On the Way</option>
                              <option @if($user->status=='Delivered') selected @endif value="Delivered">Delivered</option>
                          </select>
                        
                          </td> 
                          @if(auth()->user()->usertype !='driver')
                 <td class="email align-middle white-space-nowrap">
                     <select class="update-status-d" onChange="change_sts_d(this.value, '<?php echo $user->id;?>')">
                        <option value="">Assing Delivery Man</option>
                         @foreach ($all_d as $alld)
                        <option @if($user->dman==$alld->id) selected @endif value="{{$alld->id}}">{{$alld->first_name}} {{$alld->last_name}}</option>
                       @endforeach
                    </select>
                  
                    </td> 
                    @endif
                      <td class="phone align-middle white-space-nowrap">
                      <a class="btn btn-phoenix-success btn-sm" href="{{URL::to('ordershowd/'.$user->id)}}"><span class="fa fa-eye"></span></a>
                      <a class="btn btn-phoenix-success btn-sm"  href="{{ asset('invoices/' . $user->invoice) }}"
   target="_blank"><span class="fa fa-download"></span></a>
                      </td>	
                     
                    

                   
                  </tr>
                  @endforeach

              </tbody>
                            </table>
							
							 </div>
            <div class="row align-items-center justify-content-end py-4 pe-0 fs--1">
            
    <div class="col-auto d-flex">
        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900">
            Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }} Customers
        </p>
    </div>
    <div class="col-auto d-flex">
        @if ($users->onFirstPage())
            <button class="page-link" disabled><span class="fas fa-chevron-left"></span></button>
        @else
            <a href="{{ $users->previousPageUrl() }}" class="page-link"><span class="fas fa-chevron-left"></span></a>
        @endif
        <ul class="mb-0 pagination">
            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $users->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endfor
        </ul>
        @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="page-link pe-0"><span class="fas fa-chevron-right"></span></a>
        @else
            <button class="page-link pe-0" disabled><span class="fas fa-chevron-right"></span></button>
        @endif
    </div>
</div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
           function change_sts(sts, id) {
        var orderId = id;
        var newStatus = sts;
        var token = "{{ csrf_token() }}"; 
       // alert(orderId);
       // alert(newStatus);
       // alert(token);

        $.ajax({
            url: "{{ route('order.updateStatus') }}",
            type: "POST",
            data: {
                _token: token,
                id: orderId,
                status: newStatus
            },
            success: function (response) {
                if (response.success) {
                    alert("Order status updated successfully!");
                } else {
                    alert("Failed to update status.");
                }
            },
            error: function () {
                alert("Something went wrong! Please try again.");
            }
        });
           }
		   function change_sts_d(sts, id) {
        var orderId = id;
        var newStatus = sts;
        var token = "{{ csrf_token() }}"; 
       // alert(orderId);
       // alert(newStatus);
       // alert(token);

        $.ajax({
            url: "{{ route('order.updateStatusd') }}",
            type: "POST",
            data: {
                _token: token,
                id: orderId,
                status: newStatus
            },
            success: function (response) {
                if (response.success) {
                    alert("Delivery man  updated successfully!");
                } else {
                    alert("Failed to update status.");
                }
            },
            error: function () {
                alert("Something went wrong! Please try again.");
            }
        });
           }

        </script>               
@endsection