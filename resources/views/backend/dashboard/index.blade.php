@extends('layouts.backend')

@section('content')
<div class="page-wrapper">
    <div class="page-content">


        <div class="card radius-10">
            <div class="card-content">
                <div class="row row-group row-cols-1 row-cols-xl-4">
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">Total Packages</p>
                                    <h4 class="mb-0 text-primary">{{ $packages }}</h4>
                                </div>
                                <div class="ms-auto"><i class="bx bx-cart font-35 text-primary"></i>
                                </div>
                            </div>
                            <div class="progress radius-10 my-2" style="height:4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                            </div>
                            {{-- <p class="mb-0 font-13">+2.5% from last week</p> --}}
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">Total Revenue</p>
                                    <h4 class="mb-0 text-danger">AED {{ $total }}</h4>
                                </div>
                                <div class="ms-auto"><i class="bx bx-wallet font-35 text-danger"></i>
                                </div>
                            </div>
                            <div class="progress radius-10 my-2" style="height:4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 65%"></div>
                            </div>
                            {{-- <p class="mb-0 font-13">+5.4% from last week</p> --}}
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">Total Packages</p>
                                    <h4 class="mb-0 text-success"> {{$packages}}</h4>
                                </div>
                                <div class="ms-auto"><i class="bx bx-line-chart-down font-35 text-success"></i>
                                </div>
                            </div>
                            <div class="progress radius-10 my-2" style="height:4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                            </div>
                            {{-- <p class="mb-0 font-13">-4.5% from last week</p> --}}
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">Total Customers</p>
                                    <h4 class="mb-0 text-warning">{{ $users -1}}</h4>
                                </div>
                                <div class="ms-auto"><i class="bx bx-group font-35 text-warning"></i>
                                </div>
                            </div>
                            <div class="progress radius-10 my-2" style="height:4px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"></div>
                            </div>
                            {{-- <p class="mb-0 font-13">+8.4% from last week</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row">
           <div class="col-12 col-lg-12">
              <div class="card radius-10">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Sales Overview</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-info"></i>Downloads</span>
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-danger"></i>Earnings</span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart5"></canvas>
                      </div>
                  </div>
                  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-0 row-group text-center border-top">
                    <div class="col">
                      <div class="p-3">
                        <h4 class="mb-0">$168</h4>
                        <small class="mb-0">Today's Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
                      </div>
                    </div>
                    <div class="col">
                      <div class="p-3">
                        <h4 class="mb-0">$856</h4>
                        <small class="mb-0">This Week Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
                      </div>
                    </div>
                    <div class="col">
                      <div class="p-3">
                        <h4 class="mb-0">$2400</h4>
                        <small class="mb-0">This Month Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
                      </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                          <h4 class="mb-0">$4,562</h4>
                          <small class="mb-0">This Year Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.62%</span></small>
                        </div>
                      </div>
                  </div>
              </div>
           </div>
        </div> --}}

      
        

           
                     @if (count($bookings) > 1)

                     @else
                         
                   

            <div class="row">
                

                <div class="col-12 col-lg-5 col-xl-6 d-flex">
                    <div class="card w-100 radius-10">
                     <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Today Bookings</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush align-middle">
                                 <thead>
                                  <tr>
                                    <th>Slot Time</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Package</th>
                                  </tr>
                                  </thead>

                                  @foreach ($bookings as $data)
                                  <tr>
                                    <td> {{$data->slot_time}}</td>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{$data->location->name}}</td>
                                    <td>{{$data->package->name}}</td>
                                  </tr>
                                  @endforeach
                                
                                 
                              
                               
                              
                              
                               
                                </table>
                             </div>

                        </div>
                    </div>

                </div>
             </div><!--end row-->

             @endif

    </div>
</div>
@endsection
