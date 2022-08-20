<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('dashboard') }}" class="flex mr-auto">
             @if (checkDBConnection() == true && Schema::hasTable('organization_setups'))

                        @if (Schema::hasColumn('organization_setups', 'company_name') && Schema::hasColumn('organization_setups', 'logo'))
                            <img 
                            alt="{{ orgName() }}" 
                            class="m-auto w-40" 
                            src="{{ logo() }}"
                            
                            >
                        @else
                            <img alt="#maildoll" class="m-auto w-40" src="{{ logo() }}">
                        @endif

                @else
                    <img 
                    alt="{{ maildoll() }}" 
                    class="m-auto w-40"
                    src="#maildoll"
                     >
                @endif
        </a>
        <a href="javascript:;" id="maildoll_mobile_menu_toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
</div>
<!-- END: Mobile Menu -->
