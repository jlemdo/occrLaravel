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
                        <h4 class="text-900 mb-0"> Edit User</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form class="row g-3" action="{{URL::to('updateuser')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                             

                                     <div class="col-md-4 position-relative">
                                                <label class="form-label" for="userinput1">First name </label>
                                                <input type="text" id="userinput1" class="form-control" required name="first_name" value="{{old('first_name',$user->first_name)}}" tabindex="1">
                                        </div>
										
                                       <div class="col-md-4 position-relative">
                                                <label class="form-label" for="userinput1">Last name</label>
                                                <input type="text" id="userinput1" required class="form-control" name="last_name" value="{{old('last_name',$user->last_name)}}" tabindex="2">
                                       </div>
									   
									   <div class="col-md-4 position-relative">
                                                <label class="form-label" for="userinput1">Email</label>
                                                <input type="email" required id="userinput1" class="form-control" name="email" value="{{old('email',$user->email)}}" tabindex="3">
                                       </div>
									   
									   <div class="col-md-4 position-relative">
                                                <label class="form-label" for="userinput1">Contact Number</label>
                                                <input type="text" required id="userinput1" class="form-control" name="contact_number" value="{{old('contact_number',$user->phone)}}" tabindex="4">
                                       
									  </div>
									  
									
									     <div class="col-md-3 position-relative">
                                                <label class="form-label" for="userinput1">User Type</label>
                                               <select name="usertype" class="form-control" >
                                                <option value="driver" @if($user->usertype='driver') selected @endif>Driver</option>
                                                <option value="customer" @if($user->usertype='customer') selected @endif>Customer</option>
                                               </select>                             
									  </div>
									
                                 
                                     
                                        <div class="col-md-6 position-relative">
                                                <label class="form-label" for="userinput4">Address:
                                                </label>
                                              <input type="hidden" value="{{$user->id}}" class="form-control" name="id">
                                                <textarea class="form-control" id="summernote-simple"
                                                        name="address" tabindex="13">{{old('address',$user->address)}}</textarea>
                                                
                                    </div>
									 <div class="col-md-6 position-relative">
                                                <label class="form-label" for="userinput4">Introduction:
                                                </label>
                                              
                                                <textarea class="form-control" id="summernote-simple"
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