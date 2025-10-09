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
                        <h4 class="text-900 mb-0"> Edit Stock</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" action="{{URL::to('updatestock')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                             

                                    
										
                                        <div class="col-md-4 position-relative">
                    <label class="form-label" for="userinput1"> Product</label>
                    <select class="form-control" name="product" >
                            <option selected="selected" value="">Select Product Product</option>
                           
                           @foreach($mods as $mod)
                            <option value="{{$mod->name}}" @if($proposals->product ==$mod->name) selected @endif>{{$mod->name}}</option>
                           @endforeach
                          </select>
            </div>
            
<div class="col-md-4 position-relative">
                        <label class="form-label" for="userinput1">QTY</label>
                        <input type="hidden" value="{{$proposals->id}}" class="form-control" name="id">
                        <input type="text" required id="userinput1" class="form-control" name="qty" value="{{old('qty',$proposals->qty)}}" tabindex="1">
               </div>
									 
                                     	
                                    

                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                               <div class="col-12" align="center">
                                  
                                    <button type="submit" class="btn btn-phoenix-primary">Save</button>
									

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