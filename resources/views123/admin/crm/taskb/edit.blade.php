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
                        <h4 class="text-900 mb-0"> Edit Tasks</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" action="{{URL::to('updatemytaskb')}}" method="POST">
                                @csrf
                             

                                    
										
                                        <div class="col-md-3 position-relative">
                                                <label class="form-label" for="userinput1">Title</label>
												<input type="hidden" value="{{$proposals->id}}" class="form-control" name="id">
                                                <input type="text" required id="userinput1" class="form-control" name="heading" value="{{old('heading',$proposals->title)}}" tabindex="1">
                                       </div>
									   
									     <div class="col-md-3 position-relative">
                                                <label class="form-label" for="userinput1">Description</label>
												<input type="text" required id="userinput1" class="form-control" name="text" value="{{old('text',$proposals->description)}}" tabindex="1">
                                       </div>
									   
									    
									   
  <div class="col-md-3 position-relative">
        <label class="form-label" for="userinput1">Days</label>
        <input type="text" required id="userinput1" class="form-control" name="days" value="{{old('days',$proposals->days)}}" tabindex="1">
</div>

									
									  
									   <div class="col-md-3 position-relative">
    <label class="form-label" for="visibility_option">Active</label>
    <div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" id="cash_only" name="visibility_option" value="Yes" required tabindex="5" 
                {{ old('visibility_option', $proposals->active) == 'Yes' ? 'checked' : '' }}>
            <label class="form-check-label" for="cash_only">Yes</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" id="cash_finance" name="visibility_option" value="No" required tabindex="5" 
                {{ old('visibility_option', $proposals->active) == 'No' ? 'checked' : '' }}>
            <label class="form-check-label" for="cash_finance">No</label>
        </div>
    </div>
</div>

                                  
                                      
                                       
                                      
                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                               <div class="col-12" align="center">
                                  
                                    <button type="submit" class="btn btn-phoenix-primary">Update</button>
									

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