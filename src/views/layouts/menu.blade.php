@if(Auth::user()->id==1)
<!-- ##################################################################### -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item 
      
        {{ (request()->is('cms/fin/report/monthly*')) ? 'active' : '' }}
      
      ">
      @php
        $collapsed = 'collapsed';
        $show = '';        
        if(request()->is('cms/fin/report/monthly*'))
        {
          $collapsed = '';
          $show = 'show';
        }
      @endphp
        <a class="nav-link {{$collapsed}}" href="#" data-toggle="collapse" data-target="#menu-fin" aria-expanded="false" aria-controls="menu-fin">
          <i class="fas fa-chart-line"></i>
          <span>REPORT</span>
        </a>
        <div id="menu-fin" class="collapse {{$show}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item {{ (request()->is('cms/fin/report/monthly*')) ? 'active' : '' }}" href="{{ route('route_fin_report_monthly.index') }}"><i class="far fa-circle"></i> {{ __('Monthly Report') }}</a>

             
          </div>
        </div>
      </li>
      
 <!-- ##################################################################### -->
 <!-- ##################################################################### -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item 
      
        
        
        {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/tax*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/neraca*')) ? 'active' : '' }}
      
      ">
      @php
        $collapsed = 'collapsed';
        $show = '';        
        if(request()->is('cms/fin/profitloss*') || request()->is('cms/fin/tax*') || request()->is('cms/fin/transactions*') || request()->is('cms/fin/neraca*'))
        {
          $collapsed = '';
          $show = 'show';
        }
      @endphp
        <a class="nav-link {{$collapsed}}" href="#" data-toggle="collapse" data-target="#menu-fin1" aria-expanded="false" aria-controls="menu-fin1">
          <i class="fas fa-balance-scale"></i>
          <span>ACCOUNTING</span>
        </a>
        <div id="menu-fin1" class="collapse {{$show}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            

             <a class="collapse-item {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}" href="{{ route('route_fin_transactions.index') }}"><i class="far fa-circle"></i> {{ __('Transaction') }}</a>
            
             
             
             
             <a class="collapse-item {{ (request()->is('cms/fin/tax*')) ? 'active' : '' }}" href="{{ route('route_fin_tax.index') }}"><i class="far fa-circle"></i> {{ __('Tax') }}</a>

             <a class="collapse-item {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}" href="{{ route('route_fin_profitloss.index') }}"><i class="far fa-circle"></i> {{ __('Profit Loss') }}</a>

             

             <a class="collapse-item {{ (request()->is('cms/fin/neraca*')) ? 'active' : '' }}" href="{{ route('route_fin_neraca.index') }}"><i class="far fa-circle"></i> {{ __('Balance Sheet') }}</a>

            
          </div>
        </div>
      </li>
      
 <!-- ##################################################################### -->
 
@endif
 