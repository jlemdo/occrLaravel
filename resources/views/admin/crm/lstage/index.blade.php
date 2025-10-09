@extends('layouts.app')
@section('section')
 
		 
  <div id="members" data-list='{"valueNames":["customer","email","city","last_active","joined"],"page":10,"pagination":true}'>
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
              <h2 class="text-bold text-1100">Lead Stages</h2>
            </div>
            <div class="col-auto">
              <div class="d-flex align-items-center">
               
                <a href="{{URL::to('newlead_stage')}}" class="btn btn-phoenix-primary"><span class="fas fa-plus me-2"></span>Add New</a>
				
              </div>
            </div>
          </div>
          <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
              <table class="table table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort align-middle" scope="col" data-sort="sr">No</th>
                                        <th class="sort align-middle" scope="col" data-sort="customer">Name</th>
                                        <th class="sort align-middle" scope="col" data-sort="customer">Order#</th>
										<th class="sort align-middle" scope="col" data-sort="customer">Action</th>
                                    </tr>
                                </thead>
<tbody class="list" id="members-table-body">
@foreach ($projects as $project)
<tr class="hover-actions-trigger btn-reveal-trigger position-static">
<td class="sr align-middle white-space-nowrap">{{ $i++ }}</td>
<td class="customer align-middle white-space-nowrap">{{ $project->name }}</td>
<td class="customer align-middle white-space-nowrap">{{ $project->orderno }}</td>

<td style="display:flex">


<a class="btn btn-phoenix-success btn-sm" href="{{URL::to('lead_stageEdit/'.$project->id)}}"><span class="fa fa-edit"></span></a>


<form id="destroy-data{{ $i }}" action="{{ route('deletelead_stage', $project->id)}}" method="post">
                                                @csrf
                   <button class="btn btn-phoenix-danger btn-sm" type="submit" ><span class="fa fa-trash"></span></button>
                                            </form>
											
                                
                                           
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
							
							 </div>
            
          </div>
        </div>
                       
@endsection