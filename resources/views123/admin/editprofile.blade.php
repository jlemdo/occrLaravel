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
                        <h4 class="text-900 mb-0"> {{ __('Profile Information') }}</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3 needs-validation" method="post" action="{{route('users.updateprofile')}}"
                                enctype="multipart/form-data">
                                @csrf
                             
                                  
                                 
                                     <div class="col-md-4 position-relative">
                                                <label class="form-label" for="userinput1">Contact Number: </label>
                                                <input type="text" id="userinput1" class="form-control" name="contact_number" value="{{old('contact_number', $user->phone)}}"  tabindex="1">
                                                <input type="hidden" id="userinput1" class="form-control" name="id" value="{{$user->id}}"  tabindex="1">
                                        </div>
                                    
                                
                                     
                                        <div class="col-md-12 position-relative">
                                                <label class="form-label" for="userinput4">Address:
                                                </label>
                                              
                                                <textarea class="form-control" id="summernote-simple"
                                                        name="address" tabindex="13">{{old('address',$user->address)}}</textarea>
                                                
                                    </div>
									
                                    <div class="col-md-12 position-relative">
                                                <label class="form-label" for="userinput4">Description:
                                                </label>
                                               
                                                
                                                <textarea class="form-control border-primary" id="summernote-simple"
                                                        name="intro" tabindex="13">{{old('intro',$user->intro)}}</textarea>
                                               
                                    </div>
                                   
                                      
                                       
                                        <div class="col-md-4 position-relative">
                                                <label class="form-label" for="file">Upload Profile Photo</label>
                                           
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile_photo"   >
                                                  
                                                
                                        </div>
                                        <div class="col-lg-3">
                                             <img id="imageProfilePreview" src="@if($user->image) {{asset('profile/'.$user->image)}}  @else {{asset('profile/avatar.png')}} @endif" width="200" alt="image preview">
                                        </div>
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                               <div class="col-12" align="center">
                                  
                                    <button type="submit" class="btn btn-primary" value="Save">
                                    <i class="fa fa-check-square-o"></i>Save</button>
									

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