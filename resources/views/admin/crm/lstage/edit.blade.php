@extends('layouts.app')
@section('section')
@push('styles')
<style>


</style>
  
@endpush
 <div class="mt-4">
          <div class="row g-4">
            <div class="col-12 col-xl-12 order-1 order-xl-0">
              <div class="mb-2">
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
                            <form class="row g-3" action="{{URL::to('updatelead_stage')}}" method="POST" >
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
                                       </form>
                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                              
                           

        </div>
        <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-900 mb-0">Checklist</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="p-4 code-to-copy">
                           
                             <div class="row" style="display:flex; height:auto !important">
    <div class="col-md-3">
     
  

<div id="left-panel">
  <h4>Items</h4>
  <ul id="question-types" style="list-style-type: none;">
    <li draggable="true" data-type="text">Text Input</li>
    <li draggable="true" data-type="radio">Radio Buttons</li>
    <li draggable="true" data-type="checkbox">Checkbox</li>
    <li draggable="true" data-type="select">Dropdown</li>
    <li draggable="true" data-type="date">Date Picker</li>
  </ul>
</div>

    </div>

    <!-- Content Area -->
    <div class="col-md-9">
      
            <div class="col-md-12 dropzone" id="right-zone" style="display: flex; align-items: stretch;  height: auto;">

           <div id="right-panel" class="dropzone">
  <h4>Lead Questions</h4>
  <form id="questions-form" action="{{ route('haji.save_questions') }}" method="POST">
    @csrf
    <input type="hidden" name="lead_id" value="{{ $proposals->id }}">
    <div id="dynamic-questions"><span style="color:transparent !Important">55555</span></div>
    <button type="submit" class="btn btn-phoenix-primary mt-3">Save Questions</button>
  </form>
</div>
      </div>
    </div>
  </div>
  
  
  
                           <hr />
                                   <h3>Saved Checklist</h3>
                @foreach ($questions as $question)
  <div class="form-group">
    <label>{{ $question->label }}</label>

    @if ($question->type === 'text')
      <input type="text" class="form-control">
    @elseif ($question->type === 'radio')
      @foreach (json_decode($question->options) as $option)
        <div class="form-check">
          <input type="radio" name="radio_{{ $question->id }}" class="form-check-input">
          <label class="form-check-label">{{ $option }}</label>
        </div>
      @endforeach
    @elseif ($question->type === 'checkbox')
      @foreach (json_decode($question->options) as $option)
        <div class="form-check">
          <input type="checkbox" name="checkbox_{{ $question->id }}[]" class="form-check-input">
          <label class="form-check-label">{{ $option }}</label>
        </div>
      @endforeach
    @elseif ($question->type === 'select')
      <select class="form-control">
        @foreach (json_decode($question->options) as $option)
          <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
      </select>
    @elseif ($question->type === 'date')
      <input type="date" class="form-control">
    @endif
   
    <form id="destroy-data{{ $question->id }}"
                                                action="{{ route('deletestageq', $question->id)}}"
                                                method="post">
                                                @csrf
                                              
												 <button class="dropdown-item text-danger" type="submit" ><span class="fa fa-trash"></span></button>
                                            </form>
  </div>
@endforeach                       
                            </div>
                

                        </div>
                    
        			</div>
                  </div>
                </div>  
             




			  </div>
            </div>
          </div>
        </div>                
      
    @push('scripts') 
	 
    
    <script>document.addEventListener("DOMContentLoaded", () => {
  const questionTypes = document.querySelectorAll("#question-types li");
  const dropzone = document.getElementById("dynamic-questions");

  questionTypes.forEach((type) => {
    type.addEventListener("dragstart", (e) => {
      e.dataTransfer.setData("type", e.target.dataset.type);
    });
  });

  dropzone.addEventListener("dragover", (e) => e.preventDefault());

  dropzone.addEventListener("drop", (e) => {
    e.preventDefault();

    const type = e.dataTransfer.getData("type");
    addQuestion(type);
  });

  function addQuestion(type) {
  const div = document.createElement("div");
  div.className = "form-group mb-3";

  // Combine label and type fields in the same array index
  div.innerHTML = `
    <label>Question Label:</label>
    <input type="text" name="questions[${document.querySelectorAll('.form-group').length}][label]" 
           class="form-control mb-2" placeholder="Enter question label" required>
    <input type="hidden" name="questions[${document.querySelectorAll('.form-group').length}][type]" value="${type}">
  `;

  // Add options for applicable types
  if (type === "radio" || type === "checkbox" || type === "select") {
    div.innerHTML += `
      <label>Options (comma-separated):</label>
      <input type="text" name="questions[${document.querySelectorAll('.form-group').length}][options]" 
             class="form-control" placeholder="Enter options">
    `;
  }

  document.getElementById("dynamic-questions").appendChild(div);
}

});
</script>
    
	
    
  @endpush
@endsection