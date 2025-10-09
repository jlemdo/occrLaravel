@extends('layouts.app')
@section('section')

 <div class="mt-4">
          <div class="row g-4">
            <div class="col-12 col-xl-12 order-1 order-xl-0">
              <div class="mb-9">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-900 mb-0"> Add New Promotion</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
<form class="row g-3" method="post" action="{{route('addproposalbatteryaction')}}"  enctype="multipart/form-data">
    @csrf
 

           
           
     <div class="col-md-4 position-relative">
                <label class="form-label" for="userinput1">Promotion Name</label>
                <input type="text" id="userinput1" class="form-control" required name="name" value="{{old('name')}}" tabindex="1">
        </div>
            
            
             
<div class="col-md-3 position-relative">
        <label class="form-label" for="userinput1">Start From</label>
        <input type="date" id="userinput1" class="form-control" required name="from" value="{{old('from')}}"  tabindex="2">
</div>

<div class="col-md-3 position-relative">
        <label class="form-label" for="userinput1">End </label>
        <input type="date" id="userinput1" class="form-control" required name="to" value="{{old('to')}}"   tabindex="3">
</div>

<div class="col-md-2 position-relative">
        <label class="form-label" for="userinput1">Discount%</label>
        <input type="number" id="userinput1" class="form-control" required name="discount" value="{{old('discount')}}"  tabindex="4">
</div>




            
            
             <div class="col-md-2 position-relative" >
                                  <br />
                                    <button type="submit" class="btn btn-phoenix-primary">Save</button>
									

                                </div>
         
        </div>
        
                                 
                                    
                                  

                                   

                                </div>

                              
								<br />
                            </form>

        </div>
                  </div>
                </div>  

</div>
            </div>
            
          </div>
        </div>                

@endsection