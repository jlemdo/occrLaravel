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
                        <h4 class="text-900 mb-0"> Stage Checklist</h4>
                      </div>
                      <div class="col col-md-auto">
                       
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                  
                    <div class="p-4 code-to-copy">
                            <form action="{{ route('haji.save_answers') }}" method="POST">
    @csrf
    <input type="hidden" name="lead_id" value="{{$proposals->id}}">
    <input type="hidden" name="lead" value="{{$leadId}}">

    
    @foreach ($questions as $question)
    <div class="form-group">
        <label>{{ $question->label }}</label>

        <!-- Hidden inputs for label and type -->
        <input type="hidden" name="questions[{{ $loop->index }}][label]" value="{{ $question->label }}">
        <input type="hidden" name="questions[{{ $loop->index }}][type]" value="{{ $question->type }}">

        @if ($question->type === 'text')
            <input type="text" name="questions[{{ $loop->index }}][answer]" class="form-control">
        @elseif ($question->type === 'radio')
            @foreach (json_decode($question->options) as $option)
                <div class="form-check">
                    <input type="radio" name="questions[{{ $loop->parent->index }}][answer]" value="{{ $option }}" class="form-check-input">
                    <label class="form-check-label">{{ $option }}</label>
                </div>
            @endforeach
        @elseif ($question->type === 'checkbox')
            @foreach (json_decode($question->options) as $option)
                <div class="form-check">
                    <input type="checkbox" name="questions[{{ $loop->parent->index }}][answer][]" value="{{ $option }}" class="form-check-input">
                    <label class="form-check-label">{{ $option }}</label>
                </div>
            @endforeach
        @elseif ($question->type === 'select')
            <select name="questions[{{ $loop->index }}][answer]" class="form-control">
                @foreach (json_decode($question->options) as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        @elseif ($question->type === 'date')
            <input type="date" name="questions[{{ $loop->index }}][answer]" class="form-control">
        @endif
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Save Answers</button>
</form>
                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                              
                           

        </div>
        
                  </div>
                </div>  
               

<hr />




			  </div>
            </div>
          </div>
        </div>                
      
    @push('scripts') 
	 
    
    
    
	
    
  @endpush
@endsection