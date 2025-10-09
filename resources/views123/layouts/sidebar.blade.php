<nav class="navbar navbar-vertical navbar-expand-lg">
        <script>
          var navbarStyle = window.config.config.phoenixNavbarStyle;
          if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
          }
        </script>
        <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
          <!-- scrollbar removed-->
          <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
              <li class="nav-item">
                <!-- parent pages-->
                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="{{route('dashboard')}}">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"></div><span class="nav-link-icon"><span data-feather="home"></span></span><span class="nav-link-text">Home</span>
                    </div>
                  </a>
                  
                </div>
              </li>
              
              
              <li class="nav-item">
               
                <hr class="navbar-vertical-line" />
              
                
                <!-- parent pages-->
               
                <!-- parent pages-->
             @if(auth()->user()->usertype !='driver')
                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-umgt" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-tables">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text">User Management</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
<ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-umgt">

<li class="nav-item"><a class="nav-link" href="{{route('admin.allsalereps')}}" data-bs-toggle="" aria-expanded="false">
  <div class="d-flex align-items-center"><span class="nav-link-text">Users</span> </div> </a>
</li>
<li class="nav-item"><a class="nav-link" href="{{route('admin.act_log')}}">
          <div class="d-flex align-items-center"><span class="nav-link-text">Activity Log</span>
          </div>
                              </a>
                            </li>

</ul>
                  </div>
                </div>
            @endif
                <!-- parent pages-->
             
               <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{route('admin.allcustomers')}}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Orders</span></span>
                    </div>
                  </a>
                </div>
               

 @if(auth()->user()->usertype !='driver')
             <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-board" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-board">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="settings"></span></span><span class="nav-link-text">Settings</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-board">
                    
      
           <li class="nav-item"><a class="nav-link" href="{{route('admin.delivery')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">Delivery Charges</span>
        </div>
        </a>
      </li>
   
        
							
                            
   <li class="nav-item"><a class="nav-link" href="{{route('promotion')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">Promotions</span>
        </div>
      </a>
    </li>
   
                    </ul>
                  </div>
                </div>
        
              
               <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-temp" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-temp">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="inbox"></span></span><span class="nav-link-text">Catalogue</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-temp">

       
      
       
          <li class="nav-item"><a class="nav-link" href="{{route('admin.modules')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">Product Categories</span>
        </div>
      </a>
    </li>
    
                    
          <li class="nav-item"><a class="nav-link" href="{{route('admin.product')}}" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center"><span class="nav-link-text">Product Items</span>
              </div>
            </a>
          </li>
          
            <li class="nav-item"><a class="nav-link" href="{{route('admin.stock')}}" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center"><span class="nav-link-text">Stock Purchase</span>
              </div>
            </a>
          </li>
          
          
             <li class="nav-item"><a class="nav-link" href="{{route('admin.inventory')}}" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center"><span class="nav-link-text">Stock Inventory</span>
              </div>
            </a>
          </li>
          
         
                          </ul>
                    </ul>
                  </div>
                </div>
             
               
           @endif    
             
               
      
               
              </li>
              
            </ul>
          </div>
        </div>
        <div class="navbar-vertical-footer">
          <button class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
        </div>
      </nav>
      