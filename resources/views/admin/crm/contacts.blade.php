@extends('layouts.app')
@section('section')


        <div class="border-bottom mb-7 mx-n3 px-2 mx-lg-n6 px-lg-6">
          <div class="row">
            <div class="col-xl-9">
              <div class="d-sm-flex justify-content-between">
                <h2 class="mb-4">New Lead</h2>
                <div class="d-flex mb-3">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-9">
          <form class="row g-3 mb-9" method="post" action="{{route('createlead')}}"  enctype="multipart/form-data">
             @csrf          
           
          
           
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <select class="form-select" name="assigned_to" id="floatingSelectOwner">
				  @foreach($users as $user)
                    <option value="{{$user->id}}"> {{$user->first_name}} - {{$user->last_name}}</option>
                   @endforeach   
                  </select>
                  <label for="floatingSelectOwner">Assigned To</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="first_name" id="floatingInputFirstname" type="text" placeholder="First name" />
                  <label for="floatingInputFirstname">First name</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="last_name" id="floatingInputLastname" type="text" placeholder="Last name" />
                  <label for="floatingInputLastname">Last name</label>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="title" id="floatingInputTitle" type="text" placeholder="title" />
                  <label for="floatingInputTitle">Title</label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="email" id="floatingInputEmail" type="text" placeholder="email" />
                  <label for="floatingInputEmail">Email</label>
                </div>
              </div>
            
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <input class="form-control" name="phone" id="floatingInputPhone" type="text" placeholder="phone" />
                  <label for="floatingInputPhone">Phone</label>
                </div>
              </div>
              
            
            
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <select class="form-select" name="status" id="floatingSelectStatus">
                  @foreach ($lstage as $ls)
                    <option value="{{$ls->name}}">{{$ls->name}}</option>
                  @endforeach
                  </select>
                  <label for="floatingSelectStatus">Lead status </label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-floating">
                  <select class="form-select" name="source" id="floatingSelectLeadSource">
                  @foreach ($lsource as $ls)
                    <option value="{{$ls->name}}">{{$ls->name}}</option>
                   @endforeach
                  </select>
                  <label for="floatingSelectLeadSource">lead source</label>
                </div>
              </div>
             
             
             
                  <input type="hidden" name="street" id="street"  />
                  <input type="hidden" name="lat" id="lat" />
                  <input type="hidden" name="long" id="long" />
                  <input type="hidden" name="country_iso" id="country_iso" />
                  <input type="hidden" name="city" id="city" />
                  <input type="hidden" name="state" id="state" />
                  <input type="hidden" name="country" id="country" />
                  <input type="hidden" name="zipcode" id="zipcode" />
                  <input type="hidden" name="company" id="floatingInputCompany" />
                  <input type="hidden" name="website" id="floatingInputWebsite" />
               
               <div class="col-sm-12">
                <div class="form-floating">
                  <input class="form-control" name="address" id="address" type="text" placeholder="Address" />
                  <label for="address">Address</label>
                </div>
              </div>
            
              <div class="col-12">
                <div class="form-floating">
                  <textarea class="form-control" name="description" id="floatingProjectOverview" placeholder="Leave a comment here" style="height: 128px"></textarea>
                  <label for="floatingProjectOverview">Lead description</label>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-primary">Create lead</button>
              </div>
            </form>
          </div>
        </div>
          @push('scripts') 
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz5z8de2mOowIGRREyHc3gT1GgmJ3whDg&libraries=places"></script>

<script>
  function initializeAutocomplete() {
    const addressInput = document.getElementById('address');

    // Initialize the autocomplete object
    const autocomplete = new google.maps.places.Autocomplete(addressInput, {
      types: ['geocode'],
      componentRestrictions: { country: 'us' }, // Restrict to specific country if needed
    });

    // Listen for the place_changed event
    autocomplete.addListener('place_changed', () => {
      const place = autocomplete.getPlace();

      // Initialize variables for address components
      let street = '', city = '', state = '', country = '', zip = '';
      let lat = '', long = ''; let countryIso='';

      // Extract latitude and longitude
      if (place.geometry && place.geometry.location) {
        lat = place.geometry.location.lat();
        long = place.geometry.location.lng();
      }

      // Loop through address components
      place.address_components.forEach((component) => {
        const types = component.types;

        if (types.includes('street_number')) {
          street = component.long_name + ' ' + street;
        } else if (types.includes('route')) {
          street += component.long_name;
        } else if (types.includes('locality')) {
          city = component.long_name;
        } else if (types.includes('administrative_area_level_1')) {
          state = component.short_name;
        } else if (types.includes('country')) {
          country = component.long_name;
		  countryIso = component.short_name;
        } else if (types.includes('postal_code')) {
          zip = component.long_name;
        }
      });

      // Populate the form fields
      document.getElementById('street').value = street;
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('country').value = country;
      document.getElementById('zipcode').value = zip;
      document.getElementById('lat').value = lat;
      document.getElementById('long').value = long;
	  document.getElementById('country_iso').value = countryIso;

    });
  }

  // Initialize autocomplete on window load
  window.onload = initializeAutocomplete;
</script>


    
  @endpush
        @endsection