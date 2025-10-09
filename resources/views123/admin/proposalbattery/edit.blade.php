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
                        <h4 class="text-900 mb-0"> Edit Promotion</h4>
                      </div>
                      <div class="col col-md-auto">
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" action="{{URL::to('updateproposalbattery')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                             

                                    
										
<div class="col-md-4 position-relative">
<label class="form-label" for="userinput1">Promotion Name</label>
<input type="hidden" value="{{$proposals->id}}" class="form-control" name="id">
<input type="text" required id="userinput1" class="form-control" name="name" value="{{old('capacity',$proposals->name)}}" tabindex="1">
</div>


  
            
            
<div class="col-md-3 position-relative">
<label class="form-label" for="userinput1">From</label>
<input type="date" required id="userinput1" class="form-control" name="from" value="{{old('from',$proposals->from)}}" tabindex="2">
</div>

<div class="col-md-3 position-relative">
<label class="form-label" for="userinput1">To</label>
<input type="date" required id="userinput1" class="form-control" name="to" value="{{old('to',$proposals->to)}}" tabindex="3">
</div>

<div class="col-md-2 position-relative">
<label class="form-label" for="userinput1">Discount</label>
<input type="text" required id="userinput1" class="form-control" name="discount" value="{{old('discount',$proposals->discount)}}" tabindex="4">
</div>

            
                              <div class="col-md-2 position-relative">
                                  <br />
                                    <button type="submit" class="btn btn-phoenix-primary">Update</button>
									

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