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
                        <h4 class="text-900 mb-0"> Add New Product</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" method="post" action="{{route('addinverter')}}"  enctype="multipart/form-data">
                                @csrf
                             

									   
									   
         <div class="col-md-4 position-relative">
                    <label class="form-label" for="userinput1"> Category</label>
                    <select class="form-control" name="product_cat" >
                            <option selected="selected" value="">Select Product Category</option>
                           
                           @foreach($mods as $mod)
                            <option value="{{$mod->name}}">{{$mod->name}}</option>
                           @endforeach
                          </select>
            </div>
            
              <div class="col-md-4 position-relative">
                    <label class="form-label" for="userinput1"> Name</label>
                    <input type="text" id="userinput1" class="form-control" required name="title" value="{{old('title')}}" tabindex="1">
            </div>

         <div class="col-md-4 position-relative">
                    <label class="form-label" for="userinput1"> Description</label>
                    <input type="text" id="userinput1" class="form-control"  name="description" value="{{old('description')}}" tabindex="1">
            </div>

         <div class="col-md-4 position-relative">
                    <label class="form-label" for="userinput1"> Price</label>
                    <input type="text" id="userinput1" class="form-control" name="price" value="{{old('price')}}" tabindex="1">
            </div>

         <div class="col-md-4 position-relative">
                    <label class="form-label" for="userinput1"> Discount</label>
                    <input type="text" id="userinput1" class="form-control" name="discount" value="{{old('discount')}}" tabindex="1">
            </div>
										
											<div class="col-md-3 position-relative">
            <label class="form-label" for="file">Upload Image</label>
            <input type="file" class="custom-file-input" id="inputGroupFile01" required name="photo"   >
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