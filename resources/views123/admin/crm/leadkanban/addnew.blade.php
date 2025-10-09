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
                        <h4 class="text-900 mb-0"> Add New Task</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" method="post" action="{{route('addtasks')}}"  enctype="multipart/form-data">
                                @csrf
                             

									   
									   
                                     <div class="col-md-4 position-relative">
                                                <label class="form-label" for="userinput1">Task Title</label>
                                                <input type="text" id="userinput1" class="form-control" required name="title" value="{{old('title')}}" tabindex="1">
                                        </div>
										
                                  
                                     
                                        <div class="col-md-12 position-relative">
                                                <label class="form-label" for="userinput4">Description:
                                                </label>
                                              
                                                <textarea class="form-control" id="summernote-simple" name="description" tabindex="13">{{old('description')}}</textarea>
                                                
                                    </div>
                                  
                                      
                                       
                                      
                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                               <div class="col-12" align="center">
                                  
                                    <button type="submit" class="btn btn-primary">Save</button>
									

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