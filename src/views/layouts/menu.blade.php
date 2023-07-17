@if(Auth::user()->id==1)
<!-- ##################################################################### -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item 
      
        
        {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/banking*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/payment*')) ? 'active' : '' }}
        
      
      ">
      @php
        $collapsed = 'collapsed';
        $show = '';        
        if(request()->is('cms/fin/profitloss*') || request()->is('cms/fin/banking*') || request()->is('cms/fin/payment*'))
        {
          $collapsed = '';
          $show = 'show';
        }
      @endphp
        <a class="nav-link {{$collapsed}}" href="#" data-toggle="collapse" data-target="#menu-fin" aria-expanded="false" aria-controls="menu-fin">
          <i class="fas fa-signal"></i>
          <span>REPORT</span>
        </a>
        <div id="menu-fin" class="collapse {{$show}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}" href="{{ route('route_fin_profitloss.index') }}"><i class="far fa-circle"></i> {{ __('Profit Loss') }}</a>

            <a class="collapse-item {{ (request()->is('cms/fin/banking*')) ? 'active' : '' }}" href="{{ route('route_fin_banking.index') }}"><i class="far fa-circle"></i> {{ __('Banking') }}</a>

            <a class="collapse-item {{ (request()->is('cms/fin/payment*')) ? 'active' : '' }}" href="{{ route('route_fin_payment.index') }}"><i class="far fa-circle"></i> {{ __('Payment') }}</a>

          </div>
        </div>
      </li>
      
 <!-- ##################################################################### -->
 <!-- ##################################################################### -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item 
      
        {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/transfer*')) ? 'active' : '' }}
      
      ">
      @php
        $collapsed = 'collapsed';
        $show = '';        
        if(request()->is('cms/fin/transactions*') || request()->is('cms/fin/transfer*'))
        {
          $collapsed = '';
          $show = 'show';
        }
      @endphp
        <a class="nav-link {{$collapsed}}" href="#" data-toggle="collapse" data-target="#menu-tr" aria-expanded="false" aria-controls="menu-tr">
          <i class="fas fa-balance-scale"></i>
          <span>FINANCIAL</span>
        </a>
        <div id="menu-tr" class="collapse {{$show}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}" href="{{ route('route_fin_transactions.index') }}"><i class="far fa-circle"></i> {{ __('Transaction') }}</a>
            
            <a class="collapse-item {{ (request()->is('cms/fin/transfer*')) ? 'active' : '' }}" href="{{ route('route_fin_transfer.index') }}"><i class="far fa-circle"></i> {{ __('Transfer') }}</a>

          </div>
        </div>
      </li>
      
 <!-- ##################################################################### -->
@endif
 