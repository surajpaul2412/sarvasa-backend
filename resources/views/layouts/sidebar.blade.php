<div class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="">
            <img src="{{ asset('assets/img/Logo.svg') }}" width="100%">
        </a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <ul class="nav nav-sidebar">
                @if(auth()->user()->isAdmin())
				<li class="nav-item">
                    <a href="{{ route('goldRate.index') }}" class="nav-link {{ Request::is('admin/gold-rates*') ? 'active' : '' }}"><i class="ri-money-cny-circle-line"></i> <span>Gold Rate</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('enquiries.index') }}" class="nav-link {{ Request::is('admin/enquiries*') ? 'active' : '' }}"><i class="ri-chat-poll-line"></i> <span>Enquiries</span></a>
                </li>
                @else
                    @php
                      $user_roles =  auth()->user()->roles;
                      $roles_names = [];
                      foreach($user_roles as $role)
                      {
                        $roles_names[] = strtolower($role->name);
                      }
                      $roleCount = count($roles_names);
                    @endphp

                    @if($roleCount == 1)
                      @if(auth()->user()->isTrader())
                      {{--
					  <li class="nav-item">
                          <a href="{{ route('trader.dashboard') }}" class="nav-link {{ Request::is('trader/dashboard*') ? 'active' : '' }}"><i class="ri-home-5-line"></i> <span>Dashboard</span></a>
                      </li>
					  --}}
                      @endif
                    @endif
                    <!-- for Multiple ROLES :: STARTS -->

                      @php
                      if($roleCount > 1)
                      {
                         // FIND USER ROLES attached to URL
                         $url = str_replace(URL('/'), '', URL::current());
                         $url = trim(rtrim(ltrim(trim($url),'/'),'/'));
                         $parts = explode('/', $url);

                         // SELECTED ROLE
                         $current_role = isset($parts[0]) ? $parts[0] : '';

                         // CHECK USER's ROLE is one of them
                         if( $current_role !='' && in_array($current_role, $roles_names) )
                         {
                      @endphp
						  {{--
                          <li class="nav-item MULTI-ROLED-USER">
                            <a href="{{ route( $current_role . '.dashboard') }}"
                            class="nav-link {{ Request::is( $current_role . '/dashboard*') ? 'active' : '' }}">
                             <i class="ri-home-5-line"></i> <span>Dashboard</span></a>
                          </li>
                          --}}
                      @php
                         }
                      }
                      @endphp
                      <!-- for Multiple ROLES :: ENDS -->
                @endif
            </ul>
        </div><!-- nav-group -->
    </div><!-- sidebar-body -->
    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
            <div class="sidebar-footer-thumb">
                <img src="{{ asset('assets/img/avatar.png') }}" alt="">
            </div><!-- sidebar-footer-thumb -->
            <div class="sidebar-footer-body">
                <p>
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin() && Request::is('admin/*'))
                            Admin
                        @elseif(Auth::user()->isTrader() && Request::is('trader/*'))
                            Trader
                        @endif
                    @endif
                </p>
                <h6><a class="text-capitalize" href="">{{Auth::user()->name}}</a></h6>

            </div><!-- sidebar-footer-body -->
            <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
        </div><!-- sidebar-footer-top -->
        <div class="sidebar-footer-menu">
            <nav class="nav">
                <a href=""></a>
                <a href=""></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-r-line"></i> Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div><!-- sidebar-footer-menu -->
    </div><!-- sidebar-footer -->
</div><!-- sidebar -->
