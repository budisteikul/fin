<!-- ##################################################################### -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item 
      
        {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/banking*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/currency*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/payment*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/recipient*')) ? 'active' : '' }}
      
      ">
      @php
        $collapsed = 'collapsed';
        $show = '';        
        if(request()->is('cms/fin/transactions*') || request()->is('cms/fin/profitloss*') || request()->is('cms/fin/banking*') || request()->is('cms/fin/currency*') || request()->is('cms/fin/payment*') || request()->is('cms/fin/recipient*'))
        {
          $collapsed = '';
          $show = 'show';
        }
      @endphp
        <a class="nav-link {{$collapsed}}" href="#" data-toggle="collapse" data-target="#menu-fin" aria-expanded="false" aria-controls="menu-fin">
          <i class="fas fa-balance-scale"></i>
          <span>FINANCIAL</span>
        </a>
        <div id="menu-fin" class="collapse {{$show}}" aria-labelledby="heading1" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}" href="{{ route('route_fin_transactions.index') }}"><i class="far fa-circle"></i> {{ __('Transaction') }}</a>
            
            <a class="collapse-item {{ (request()->is('cms/fin/banking*')) ? 'active' : '' }}" href="{{ route('route_fin_banking.index') }}"><i class="far fa-circle"></i> {{ __('Banking') }}</a>

            <a class="collapse-item {{ (request()->is('cms/fin/currency*')) ? 'active' : '' }}" href="{{ route('route_fin_currency.index') }}"><i class="far fa-circle"></i> {{ __('Currency Converter') }}</a>

            <a class="collapse-item {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}" href="{{ route('route_fin_profitloss.index') }}"><i class="far fa-circle"></i> {{ __('Profit Loss') }}</a>

            <a class="collapse-item {{ (request()->is('cms/fin/payment*')) ? 'active' : '' }}" href="{{ route('route_fin_payment.index') }}"><i class="far fa-circle"></i> {{ __('Payment') }}</a>

            <a class="collapse-item {{ (request()->is('cms/fin/recipient*')) ? 'active' : '' }}" href="{{ route('route_fin_recipient.index') }}"><i class="far fa-circle"></i> {{ __('Recipient') }}</a>
            
           
          </div>
        </div>
      </li>
      
 <!-- ##################################################################### -->

 