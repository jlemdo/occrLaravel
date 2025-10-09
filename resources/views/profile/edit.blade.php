@extends('layouts.app')
@section('section')
 <h2 class="mb-2 lh-sm"> Account Settings</h2>

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
                      <form class="row g-3 needs-validation" novalidate="" method="post" action="{{ route('profile.update',$user->id) }}">
                         @csrf
                         @method('PUT')
								<div class="col-md-4">

                          <label class="form-label" for="validationCustom01">First name</label>

                          <input class="form-control" name="first_name" id="validationCustom01" type="text" value="{{old('first_name', $user->first_name)}}" required />
                          <div class="valid-feedback">Looks good!</div>
						  <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="col-md-4">

                          <label class="form-label" for="validationCustom02">Last name</label>

                          <input class="form-control" id="validationCustom02" type="text" value="{{old('last_name', $user->last_name)}}" required name="last_name" />
                          <div class="valid-feedback">Looks good!</div>
						  <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="col-md-4">

                          <label class="form-label" for="validationCustomUsername">email</label>

                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>

                            <input class="form-control" type="email" name="email" value="{{old('email', $user->email)}}" required id="validationCustomUsername"  aria-describedby="inputGroupPrepend" />
                         
							<x-input-error class="invalid-feedback" :messages="$errors->get('email')" />
                          </div>
                        </div>
                       
                       
                        <div class="col-12">

                          <button class="btn btn-phoenix-primary" type="submit">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-900 mb-0" data-anchor="data-anchor">{{ __('Update Password') }}</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="collapse code-collapse" id="tooltips-code">
                     
                    </div>
                    <div class="p-4 code-to-copy">
                      <form class="row g-3 needs-validation" method="post" action="{{ route('password.update') }}">
					   @csrf
                       @method('put')
					   
                        <div class="col-md-4 position-relative">

                          <label class="form-label" for="validationTooltip01">Current Password</label>

                          <input class="form-control" id="validationTooltip01" type="password" name="current_password" required />
                          <div class="valid-tooltip">Looks good!</div>
                        </div>
                        <div class="col-md-4 position-relative">

                          <label class="form-label" for="validationTooltip02">New Password</label>

                          <input class="form-control" id="validationTooltip02" type="password" name="password" required />
                          <div class="valid-tooltip">Looks good!</div>
                        </div>
                        <div class="col-md-4 position-relative">

                          <label class="form-label" for="validationTooltipUsername">Confirm New Password</label>

                          <div class="input-group">
                            

                            <input class="form-control" id="" type="password" required name="password_confirmation" />
                            <div class="invalid-tooltip">Confirm New Password.</div>
                          </div>
                        </div>
                       
                      
                     
                        <div class="col-12">

                          <button class="btn btn-phoenix-primary" type="submit">Update Now</button>
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