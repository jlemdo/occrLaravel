@extends('layouts.app')
@section('section')


        <div class="border-bottom mb-7 mx-n3 px-2 mx-lg-n6 px-lg-6">
          <div class="row">
            <div class="col-xl-9">
              <div class="d-sm-flex justify-content-between">
                <h2 class="mb-4">Lead Edit</h2>
                <div class="d-flex mb-3">
              
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-9">
          <form class="row g-3 mb-9" method="post" action="{{route('updatemylead')}}"  enctype="multipart/form-data">
             @csrf          
           
            <h4 class="mb-3">Lead Information </h4>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <select class="form-select" name="assigned_to" id="floatingSelectOwner">
				  @foreach($users as $user)
                    <option value="{{$user->id}}" @if($lead->assigned_to==$user->id) selected @endif > {{$user->first_name}} - {{$user->last_name}}</option>
                   @endforeach   
                  </select>
                  <label for="floatingSelectOwner">Assigned To</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
<input class="form-control" name="first_name" id="floatingInputFirstname" type="text" value="{{old('first_name',$lead->first_name)}}" />
<input name="id" type="hidden" value="{{$lead->id}}" />
<label for="floatingInputFirstname">First name</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="last_name" id="floatingInputLastname" type="text" value="{{old('last_name',$lead->last_name)}}" />
                  <label for="floatingInputLastname">Last name</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="company" id="floatingInputCompany" type="text" value="{{old('company',$lead->company)}}" />
                  <label for="floatingInputCompany">Company</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="title" id="floatingInputTitle" type="text" value="{{old('title',$lead->title)}}" />
                  <label for="floatingInputTitle">Title</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="email" id="floatingInputEmail" type="text" value="{{old('email',$lead->email)}}" />
                  <label for="floatingInputEmail">Email</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="phone" id="floatingInputPhone" type="text" value="{{old('phone',$lead->phone)}}" />
                  <label for="floatingInputPhone">Phone</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="website" id="floatingInputWebsite" type="text" value="{{old('website',$lead->website)}}" />
                  <label for="floatingInputWebsite">Website</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                 <select class="form-select" name="status" id="floatingSelectStatus">
                  @foreach ($lstage as $ls)
                    <option value="{{$ls->name}}" @if($lead->status==$ls->name) selected @endif>{{$ls->name}}</option>
                  @endforeach
                  </select>
                  <label for="floatingSelectStatus">Lead status </label>

                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <select class="form-select" name="source" id="floatingSelectLeadSource">
                    @foreach ($lsource as $ls)
                    <option value="{{$ls->name}}" @if($lead->source==$ls->name) selected @endif>{{$ls->name}}</option>
                  @endforeach
                  </select>
                  <label for="floatingSelectLeadSource">lead source</label>
                </div>
              </div>
              <h4 class="mt-6">Address Information</h4>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="street" id="floatingInputStreet" type="text" value="{{old('street',$lead->street)}}" />
                  <label for="floatingInputStreet">Street</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="city" id="floatingInputStreet" type="text" value="{{old('city',$lead->city)}}" />
                  <label for="floatingSelectCity">City</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="state" id="floatingInputStreet" type="text" value="{{old('state',$lead->state)}}" />
                  <label for="floatingSelectState">State</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-floating">
                  <input class="form-control" name="country" id="floatingInputStreet" type="text" value="{{old('country',$lead->country)}}" />
                  <label for="floatingSelectCountry">Country</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-floating">
                  <input class="form-control" name="zipcode" id="floatingInputZipcode" type="text" value="{{old('zipcode',$lead->zipcode)}}" />
                  <label for="floatingInputZipcode">zip code</label>
                </div>
              </div>
              <h4 class="mt-6">Description</h4>
              <div class="col-12">
                <div class="form-floating">
                  <textarea class="form-control" name="description" id="floatingProjectOverview" placeholder="Leave a comment here" style="height: 128px">
                  {{$lead->description}}"</textarea>
                  <label for="floatingProjectOverview">Lead description</label>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-end mt-6">
              <a href="{{URL::to('viewospprojectnewthree/'.$proj_id)}}" class="btn btn-danger" style="margin-right:5px">Proposal</a>
                <button class="btn btn-primary">Update lead</button>
                
              </div>
            </form>
          </div>
        </div>
        
        @endsection