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
                        <h4 class="text-900 mb-0"> Edit Stage</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" action="{{URL::to('updatedeal_stage')}}" method="POST" >
                                @csrf
                             

                                    
										
<div class="col-md-4 position-relative">
    <label class="form-label" for="userinput1">Stage Name</label>
    <input type="hidden" value="{{$proposals->id}}" class="form-control" name="id">
    <input type="text" required id="userinput1" class="form-control" name="title" value="{{old('title',$proposals->name)}}" tabindex="1">
</div>
									 
  <div class="col-md-2 position-relative">
                                                <label class="form-label" for="userinput1">Order#</label>
												<input type="text" required id="userinput1" class="form-control" name="orderno" value="{{old('orderno',$proposals->orderno)}}" tabindex="1">
                                       </div>
									 
                                          
      <div class="col-md-4 position-relative">
                <label style="color:transparent"> Stage Name</label><br />
                <button type="submit" class="btn btn-phoenix-primary">Update</button>
        </div>
                                      
                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                              
                            </form>

        </div>
                  </div>
                </div>  

</div>
            </div>
            
          </div>
        </div>                

@endsection