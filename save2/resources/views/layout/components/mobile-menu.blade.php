<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('dashboard') }}" class="flex mr-auto">
             @if (checkDBConnection() == true && Schema::hasTable('organization_setups'))

                        @if (Schema::hasColumn('organization_setups', 'company_name') && Schema::hasColumn('organization_setups', 'logo'))
                            <img alt="{{ orgName() }}" class="m-auto w-40" src="{{ logo() }}">
                        @else
                            <img alt="#maildoll" class="m-auto w-40" src="{{ logo() }}">
                        @endif

                @else
                    <img alt="{{ maildoll() }}" class="m-auto w-40" src="#maildoll">
                @endif
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">


         {{-- Dashboard --}}
                <li>
                    <a href="{{ route('dashboard') }}" class=" {{ request()->routeIs('dashboard') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="home"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Dashboard)
                        </div>
                    </a>
                </li>


                 <li>
                    <a href="{{ route('profile.index') }}" class=" {{ request()->routeIs('profile.index') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="user"></i>
                        </div>
                        <div class="menu__title">
                            @translate(My Profile)
                        </div>
                    </a>
                </li>

                {{-- Organization Setup --}}
                @can('Admin')
                    <li>
                    <a href="{{ route('org.index') }}" class=" {{ request()->routeIs('org.index') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="tool"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Organization Setup)
                        </div>
                    </a>
                </li>


                {{-- Organization Setup --}}
                 <li>
                    <a href="{{ route('seo.index') }}" class=" {{ request()->routeIs('seo.index') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="bar-chart"></i>
                        </div>
                        <div class="menu__title">
                            @translate(SEO)
                        </div>
                    </a>
                </li>

                {{-- Frontend Settings --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('frontend.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="sun"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Frontend)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('frontend.setup') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('frontend.setup') }}" class=" {{ request()->routeIs('frontend.setup') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Setup)
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Language Settings --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('language.index*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="type"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Language Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('language.index*') || request()->routeIs('language.translate') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('language.index') }}" class=" {{ request()->routeIs('language.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Setup Language)
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Currency Settings --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('currencies.index*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="dollar-sign"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Currency Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('currencies.index*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('currencies.index') }}" class=" {{ request()->routeIs('currencies.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Setup Currency)
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- SMTP Management --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('smtp.index*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="mail"></i>
                        </div>
                        <div class="menu__title">
                            @translate(SMTP Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('smtp.*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('smtp.index') }}" class=" {{ request()->routeIs('smtp.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Configure Email)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- SMS Management --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('sms.index*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="smartphone"></i>
                        </div>
                        <div class="menu__title">
                            @translate(SMS Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('sms.index*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('sms.index') }}" class=" {{ request()->routeIs('sms.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Configure SMS)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                @endcan

                {{-- Email Contacts --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('email.contacts*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="send"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Email Contacts)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('email.contacts*') || request()->routeIs('email.contact.show') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('email.contacts.index') }}" class=" {{ request()->routeIs('email.contacts.index') || request()->routeIs('email.contact.show') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Email List)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Groups --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('group.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="users"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Groups)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('group.*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('group.index') }}" class=" {{ request()->routeIs('group.index') || request()->routeIs('group.show') || request()->routeIs('group.edit') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Group List)
                                </div>
                            </a>
                            <a href="{{ route('group.create') }}" class=" {{ request()->routeIs('group.create') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Create Group)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- Campaign --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('campaign.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="columns"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Campaigns)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('campaign.*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('campaign.type', 'email') }}" class=" {{ request()->routeIs('campaign.type', 'email') || request()->routeIs('campaign.emails.edit') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Email Campaign)
                                </div>
                            </a>
                            <a href="{{ route('campaign.type', 'sms') }}" class=" {{ request()->routeIs('campaign.type', 'sms') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(SMS Campaign)
                                </div>
                            </a>

                            <a href="{{ route('campaign.index') }}" class=" {{ request()->routeIs('campaign.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Campaign List)
                                </div>
                            </a>

                            <a href="{{ route('campaign.create') }}" class=" {{ request()->routeIs('campaign.create') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Create Campaign)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Template builder --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('templates.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="git-pull-request"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Template Builder)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('templates.*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>

                            <a href="{{ route('template.builder.originate') }}" class=" {{ request()->routeIs('template.builder.originate') ? 'menu menu--active' : 'menu' }}" target="_blank">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Create Template)
                                </div>
                            </a>

                            <a href="{{ route('templates.index') }}" class=" {{ request()->routeIs('templates.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="book"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Template List)
                                </div>
                            </a>

                        </li>
                    </ul>
                </li>

                {{-- Sms builder --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('builder.sms.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="git-merge"></i>
                        </div>
                        <div class="menu__title">
                            @translate(SMS Builder)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('builder.sms.*') ? 'side-menu__sub-open' : ''
                    }}">
                        <li>
                            <a href="{{ route('builder.sms.create') }}" class=" {{ request()->routeIs('builder.sms.create') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Create Body)
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('builder.sms.templates') }}" class=" {{ request()->routeIs('builder.sms.templates') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(SMS Templates)
                                </div>
                            </a>

                        </li>

                    </ul>
                </li>


                @can('Admin')
                {{-- Mail Activity --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('mail.activity.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="list"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Mail Details)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('mail.activity.*') ? 'side-menu__sub-open' : ''
                    }}">

                         <li>
                            <a href="{{ route('mail.activity.index') }}" class=" {{ request()->routeIs('mail.activity.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Detail List)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan

                {{-- Mail Log --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('mail.log.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="list"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Mail Logs)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('mail.log.*') ? 'side-menu__sub-open' : ''
                    }}">

                         <li>
                            <a href="{{ route('mail.log.index') }}" class=" {{ request()->routeIs('mail.log.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Log List)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Sms Log --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('log.sms') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="message-square"></i>
                        </div>
                        <div class="menu__title">
                            @translate(SMS Logs)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('log.sms') ? 'side-menu__sub-open' : ''
                    }}">

                         <li>
                            <a href="{{ route('log.sms') }}" class=" {{ request()->routeIs('log.sms') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Log List)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Campaign Log --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('logs.campaign.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="activity"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Campaign Logs)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('logs.campaign.*') ? 'side-menu__sub-open' : ''
                    }}">

                         <li>
                            <a href="{{ route('logs.campaign.index') }}" class=" {{ request()->routeIs('logs.campaign.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Log List)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- Subscription --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('subscription.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="grid"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Subscription Plans)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('subscription.*') ? 'side-menu__sub-open' : ''
                    }}">

                         <li>
                            <a href="{{ route('subscription.index') }}" class=" {{ request()->routeIs('subscription.index') || request()->routeIs('subscription.edit') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Plans)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Subscription --}}

                @can('Customer')
                <li>
                    <a href="{{ route('purchased.plan') }}" class=" {{ request()->routeIs('purchased.plan') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="shopping-bag"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Purchased Plans)
                        </div>
                    </a>
                </li>
                @endcan

                {{-- Subscription --}}

                {{-- Limit Manager --}}
                @can('Admin')

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('limit.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="bar-chart-2"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Limit Manager)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('limit.*') ? 'side-menu__sub-open' : ''
                    }}">

                        <li>
                            <a href="{{ route('limit.index') }}" class=" {{ request()->routeIs('limit.index') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Users Limit)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Notes --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('notes.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="book"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Important Notes)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('notes.*') ? 'side-menu__sub-open' : ''
                    }}">

                        <li>
                            <a href="{{ route('notes.index') }}" class=" {{ request()->routeIs('notes.index') || request()->routeIs('notes.show') || request()->routeIs('notes.edit') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Note Lists)
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('notes.create') }}" class=" {{ request()->routeIs('notes.create') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Create Note)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Payment Setup --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('payment.setup.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="credit-card"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Payment Setup)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('payment.setup.*') ? 'side-menu__sub-open' : ''
                    }}">

                        <li>
                            <a href="{{ route('payment.setup.paypal') }}" class=" {{ request()->routeIs('payment.setup.paypal') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Paypal)
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('payment.setup.stripe') }}" class=" {{ request()->routeIs('payment.setup.stripe') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Stripe)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                @endcan

                {{-- Bounced Email --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('bounce.emails') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="alert-circle"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Bounce Checker)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('bounce.*') ? 'side-menu__sub-open' : ''
                    }}">

                        <li>
                            <a href="{{ route('bounce.emails') }}" class=" {{ request()->routeIs('bounce.emails') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Email Lists)
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bounce.check') }}" class=" {{ request()->routeIs('bounce.check') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Check Bounce)
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

            

                @can('Admin')

                @if (devtool())


                
                {{-- Queue Tracker --}}

                <li>
                    <a href="javascript:;"
                    class=" {{
                        request()->routeIs('queue.*') ? 'menu menu--active' : 'menu'
                    }}">
                        <div class="menu__icon">
                            <i data-feather="truck"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Queue Tracker)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="d-none {{
                        request()->routeIs('queue.*') ? 'side-menu__sub-open' : ''
                    }}">

                         <li>
                            <a href="{{ route('queue.proccessed') }}" class=" {{ request()->routeIs('queue.proccessed') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Queue Proccessed)
                                </div>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('queue.failed') }}" class=" {{ request()->routeIs('queue.failed') ? 'menu menu--active' : 'menu' }}">
                                <div class="menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="menu__title">
                                    @translate(Queue Failed)
                                </div>
                            </a>
                        </li>


                    </ul>
                </li>
       

                {{-- Terminal CLI --}}

                <li class="hidden">
                    <a href="{{ url('/terminal') }}" class=" {{ request()->is('/terminal') ? 'menu menu--active' : 'menu' }}" target="_blank">
                        <div class="menu__icon">
                            <i data-feather="terminal"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Terminal CLI)
                        </div>
                    </a>
                </li>

                {{-- Artisan GUI --}}

                <li>
                    <a href="{{ url('/~artisan') }}" class=" {{ request()->is('/~artisan') ? 'menu menu--active' : 'menu' }}" target="_blank">
                        <div class="menu__icon">
                            <i data-feather="git-branch"></i>
                        </div>
                        <div class="menu__title">
                            @translate(Artisan GUI)
                        </div>
                    </a>
                </li>

                @endif

                @endcan

                {{-- <li>
                    <div id="google_translate_element"></div>
                </li> --}}


    </ul>
</div>
<!-- END: Mobile Menu -->
