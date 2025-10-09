@extends('layouts.app')
@section('section')
@push('styles')
    <link href="{{asset('vendors/dropzone/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

        
        <div class="pb-6">
          <div class="row align-items-center justify-content-between g-3 mb-6">
            <div class="col-12 col-md-auto">
              <h2 class="mb-0">Analytics</h2>
            </div>
            <div class="col-12 col-md-auto">
              
            </div>
          </div>
          <div class="px-3 mb-6">
            <div class="row justify-content-between">
          <div class="row">
    <!-- Total Leads -->
    <div class="col-4 text-center">
        <h5>Total Leads</h5>
        <h2>{{ $totalLeads }}</h2>
    </div>

    <!-- Converted Leads -->
    <div class="col-4 text-center">
        <h5>Converted Leads</h5>
        <h2>{{ $convertedLeads }}</h2>
    </div>

    <!-- Conversion Rate -->
    <div class="col-4 text-center">
        <h5>Conversion Rate</h5>
        <h2>{{ number_format($conversionRate, 2) }}%</h2>
    </div>
</div>
</div></div>

<hr />
          <div class="px-3 mb-6">
            <div class="row justify-content-between">
               @foreach ($statusCounts as $status => $count)
        <div class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0">
            <span class="uil fs-3 lh-1 uil-bullseye  text-primary"></span>
            <h1 class="fs-3 pt-3">{{ number_format($count) }}</h1>
            <p class="fs--1 mb-0">{{ ucfirst($status) }}</p>
        </div>
    @endforeach
              
            </div>
          </div>
          <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white pt-6 pb-3 border-y border-300">
            <div class="row gx-6">
              <div class="col-12 col-md-6 col-lg-12 col-xl-6 mb-5 mb-md-3 mb-lg-5 mb-xl-2 mb-xxl-3">
                <div class="scrollbar">
                  <h3>Lead Stage Wise</h3>
                 
        <canvas id="leadsPieChart" width="400" height="400"></canvas>
   
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-12 col-xl-6 mb-1 mb-sm-0">
                <div class="row align-itms-center mb-5 mb-sm-2 mb-md-4">
                  <div class="col-sm-8 col-md-12 col-lg-8 col-xl-12 col-xxl-8 mb-xl-2 mb-xxl-0">
                    <h3> Deals Stage Wise</h3>
                    
                  </div>
                  
                </div>
                <div class="row g-3 align-items-center">
                  <div class="col-sm-8 col-md-12 col-lg-8 col-xl-12 col-xxl-8">
                    <canvas id="dealsPieChart" width="400" height="400"></canvas>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-6 gy-7 gx-6">
            <div class="col-12 col-md-6">
              <div class="row justify-content-between mb-4">
                <div class="col-12">
                  <h3>Leads Assigned To</h3>
                 
                </div>
                
              </div>
            
              <canvas id="assignedToBarChart" width="400" height="400"></canvas>
            </div>
            <div class="col-12 col-md-6">
              <div class="row justify-content-between mb-4">
                <div class="col-auto">
                  <h3>Customer</h3>
                 
                </div>
                
              </div>
              <canvas id="customerPieChart" width="400" height="400"></canvas>
            </div>
          </div>
        </div>
        <script>
        // Extract data passed from the controller
        const leadStatuses = @json($statusCounts->keys());
        const leadCounts = @json($statusCounts->values());

        // Create the pie chart
        const ctx = document.getElementById('leadsPieChart').getContext('2d');
        const leadsPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: leadStatuses, // Status names
                datasets: [{
                    label: 'Leads by Status',
                    data: leadCounts, // Status counts
                    backgroundColor: [
                        '#FF6384', // Red
                        '#36A2EB', // Blue
                        '#FFCE56', // Yellow
                        '#4BC0C0', // Green
                        '#9966FF', // Purple
                        '#FF9F40'  // Orange
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
		 const dealStages = @json($dealStagesCounts->keys());
        const dealCounts = @json($dealStagesCounts->values());

        // Create the pie chart for deals
        const dealsCtx = document.getElementById('dealsPieChart').getContext('2d');
        const dealsPieChart = new Chart(dealsCtx, {
            type: 'pie',
            data: {
                labels: dealStages, // Deal stages
                datasets: [{
                    label: 'Deals by Stage',
                    data: dealCounts, // Deal counts
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56',
                        '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
		
		const userNames = @json($userNames);
        const assignedCounts = @json($assignedToCounts->values());

        // Create the bar chart for leads assigned to users
        const assignedToCtx = document.getElementById('assignedToBarChart').getContext('2d');
        const assignedToBarChart = new Chart(assignedToCtx, {
            type: 'bar',
            data: {
                labels: userNames, // User names as labels
                datasets: [{
                    label: 'Leads Assigned to Users',
                    data: assignedCounts, // Lead counts assigned to each user
                    backgroundColor: '#4BC0C0',
                    borderColor: '#36A2EB',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
		 const customers = @json($customerCounts->keys());
        const customerLeadCounts = @json($customerCounts->values());

        // Create the pie chart for leads by customer
        const customerCtx = document.getElementById('customerPieChart').getContext('2d');
        const customerPieChart = new Chart(customerCtx, {
            type: 'pie',
            data: {
                labels: customers, // Customer names
                datasets: [{
                    label: 'Leads by Customer',
                    data: customerLeadCounts, // Customer lead counts
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56',
                        '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
    
    @push('scripts') 
    <script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('vendors/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/js/crm-analytics.js')}}"></script> 
    @endpush
        @endsection