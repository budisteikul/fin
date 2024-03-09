@if(Auth::user()->id==1)
<!-- ##################################################################### -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item 
      
        {{ (request()->is('cms/fin/report/monthly*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/report/asset*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/tax*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/banking*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}
        {{ (request()->is('cms/fin/neraca*')) ? 'active' : '' }}
      
      ">
      @php
        $collapsed = 'collapsed';
        $show = '';        
        if(request()->is('cms/fin/report/asset*') || request()->is('cms/fin/report/monthly*') || request()->is('cms/fin/profitloss*') || request()->is('cms/fin/tax*') || request()->is('cms/fin/banking*') || request()->is('cms/fin/transactions*') || request()->is('cms/fin/neraca*'))
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
            
            <a class="collapse-item {{ (request()->is('cms/fin/report/monthly*')) ? 'active' : '' }}" href="{{ route('route_fin_report_monthly.index') }}"><i class="far fa-circle"></i> {{ __('Monthly Report') }}</a>

            

            

            

            
            
             <a class="collapse-item {{ (request()->is('cms/fin/transactions*')) ? 'active' : '' }}" href="{{ route('route_fin_transactions.index') }}"><i class="far fa-circle"></i> {{ __('Transaction') }}</a>
            
             @if(env('APP_ENV')=="local")
             <a class="collapse-item {{ (request()->is('cms/fin/report/asset*')) ? 'active' : '' }}" href="{{ route('route_fin_asset.index') }}"><i class="far fa-circle"></i> {{ __('Asset') }}</a>
             
             <a class="collapse-item {{ (request()->is('cms/fin/banking*')) ? 'active' : '' }}" href="{{ route('route_fin_banking.index') }}"><i class="far fa-circle"></i> {{ __('Bank') }}</a>
             
             <a class="collapse-item {{ (request()->is('cms/fin/tax*')) ? 'active' : '' }}" href="{{ route('route_fin_tax.index') }}"><i class="far fa-circle"></i> {{ __('Tax PP23') }}</a>

             <a class="collapse-item {{ (request()->is('cms/fin/profitloss*')) ? 'active' : '' }}" href="{{ route('route_fin_profitloss.index') }}"><i class="far fa-circle"></i> {{ __('Profit Loss') }}</a>

             

             <a class="collapse-item {{ (request()->is('cms/fin/neraca*')) ? 'active' : '' }}" href="{{ route('route_fin_neraca.index') }}"><i class="far fa-circle"></i> {{ __('Balance Sheet') }}</a>

             @endif
          </div>
        </div>
      </li>
      
 <!-- ##################################################################### -->
 
@endif
 