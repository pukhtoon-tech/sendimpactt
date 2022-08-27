@extends('../layout/main')

@section('head')
@yield('subhead')
@endsection

@section('content')
@include('../layout/components/mobile-menu')
<div class="flex">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
        <a href="{{ route('dashboard') }}" class="intro-x flex mt-3 items-center text-gray-50"
            style="justify-content: center; font-size: 36px;">
            <h2 class="text-xl">{{ orgName() }}</h2>
        </a>
        <div class="side-nav__devider my-6"></div>

        {{-- My Custom nav --}}

        <ul>
            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="side-menu {{ request()->routeIs('dashboard') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('dashboard') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="home"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Dashboard)
                        </div>
                    </div>
                </a>
            </li>

            



            <li style="display: none;">
                <a href="{{ route('profile.index') }}"
                    class="side-menu {{ request()->routeIs('profile.index') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('profile.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="user"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(My Profile)
                        </div>
                    </div>
                </a>
            </li>

            {{-- Organization Setup --}}
            @can('Admin')
            <li>
                <a href="{{ route('org.index') }}"
                    class="side-menu {{ request()->routeIs('org.index') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('org.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="tool"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Organization Setup)
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('system.smtp.configure') }}"
                    class="side-menu {{ request()->routeIs('system.smtp.configure') ? 'side-menu--active' : '' }}">
                    <div
                        class="{{ request()->routeIs('system.smtp.configure') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="wind"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Application SMTP)
                        </div>
                    </div>
                </a>
            </li>

            

            {{-- Frontend Settings --}}

            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('frontend.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('frontend.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="sun"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Frontend)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('frontend.setup') ? 'side-menu__sub-open' : ''
                    }}">
                    @if (theme() != 'argon')
                    <li>
                        <a href="{{ route('frontend.setup') }}" target="_blank"
                            class="side-menu {{ request()->routeIs('frontend.setup') ? 'side-menu--active' : '' }}">
                            <div
                                class="{{ request()->routeIs('frontend.setup') ? 'mldl-active-menu' : 'flex items-center' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="side-menu__title">
                                    @translate(Neon Setup)
                                </div>
                            </div>
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('frontend.index') }}" target="_blank"
                            class="side-menu {{ request()->routeIs('frontend.index') ? 'side-menu--active' : '' }}">
                            <div
                                class="{{ request()->routeIs('frontend.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="align-left"></i>
                                </div>
                                <div class="side-menu__title">
                                    @translate(Argon Setup)
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif

                </ul>
            </li>

            {{-- Language Settings --}}

            <li class="hidden">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('language.index*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('language.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="type"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Language Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('language.index*') || request()->routeIs('language.translate') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('language.index') }}"
                            class="side-menu {{ request()->routeIs('language.index') ? 'side-menu--active' : '' }}">

                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Setup Language)
                            </div>

                        </a>
                    </li>
                </ul>
            </li>

            {{-- Currency Settings --}}

            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('currencies.index*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div
                        class="{{ request()->routeIs('currencies.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="dollar-sign"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Currency Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('currencies.index*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('currencies.index') }}"
                            class="side-menu {{ request()->routeIs('currencies.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Setup Currency)
                            </div>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan

            {{-- SMTP Management --}}

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('smtp.index*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('smtp.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="mail"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Mail Servers)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('smtp.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('smtp.index') }}"
                            class="side-menu {{ request()->routeIs('smtp.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Configure Server)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- SMS Management --}}

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('sms.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('sms.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="smartphone"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(SMS Settings)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('sms.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('sms.index') }}"
                            class="side-menu {{ request()->routeIs('sms.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Configure SMS)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            @if (env('VOICE_ACTIVE') == "YES")

            {{-- Voice server --}}

            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('twilio.voice.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('twilio.voice.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="phone-call"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Voice Servers)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('twilio.voice.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('twilio.voice.index') }}"
                            class="side-menu {{ request()->routeIs('twilio.voice.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Configure Servers)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>
                
            @endif

            {{-- Template builder --}}

            
            <li>
                <a href="{{ route('template_builder') }}"
                    class="side-menu {{ request()->routeIs('template_builder') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('template_builder') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="git-pull-request"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Template Builder New)
                        </div>
                    </div>
                </a>
            </li>


            <li style="display: none;">

                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('templates.*') || request()->routeIs('template.builder.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('templates.*') ? 'mldl-active-menu' : 'flex items-center' }}">

                        <div class="side-menu__icon">
                            <i data-feather="git-pull-request"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Template Builder)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>

                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('templates.*') || request()->routeIs('template.builder.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>

                        <a href="{{ route('template.builder.originate') }}"
                            class="side-menu {{ request()->routeIs('template.builder.originate') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Create Template)
                            </div>
                        </a>

                        <a href="{{ route('templates.index') }}"
                            class="side-menu {{ request()->routeIs('templates.index') || request()->routeIs('template.builder.edit.thumbnail') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="book"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Template List)
                            </div>
                        </a>

                    </li>
                </ul>
            </li>

            {{-- Sms builder --}}

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('builder.sms.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('builder.sms.*') ? 'mldl-active-menu' : 'flex items-center' }}">

                        <div class="side-menu__icon">
                            <i data-feather="git-merge"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(SMS Builder)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('builder.sms.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('builder.sms.create') }}"
                            class="side-menu {{ request()->routeIs('builder.sms.create') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Create Body)
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('builder.sms.templates') }}"
                            class="side-menu {{ request()->routeIs('builder.sms.templates') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(SMS Templates)
                            </div>
                        </a>

                    </li>

                </ul>
            </li>

            {{-- Contacts --}}

            <li>
                <a href="{{ route('email_contacts.contacts') }}"
                    class="side-menu {{ request()->routeIs('email_contacts.contacts') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('email_contacts.contacts') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="send"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Contacts New)
                        </div>
                    </div>
                </a>
            </li>


            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('email.contacts*') || request()->routeIs('email.contacts.list') || request()->routeIs('phone.contacts.list') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('email.contacts*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="send"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Contacts)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('email.contacts*') || request()->routeIs('email.contact.show') || request()->routeIs('email.contacts.list') || request()->routeIs('phone.contacts.list') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('email.contacts.index') }}"
                            class="side-menu {{ request()->routeIs('email.contacts.index') || request()->routeIs('email.contact.show') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Contact List)
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('email.contacts.list') }}"
                            class="side-menu {{ request()->routeIs('email.contacts.list') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Email List)
                            </div>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('phone.contacts.list') }}"
                            class="side-menu {{ request()->routeIs('phone.contacts.list') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Phone List)
                            </div>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('email.contacts.bulk.csv') }}"
                            class="side-menu {{ request()->routeIs('email.contacts.bulk.csv') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Bulk Import Export)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Groups --}}

            <li>
                <a href="{{ route('group.group_two') }}"
                    class="side-menu {{ request()->routeIs('group.group_two') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('group.group_two') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="users"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Groups New)
                        </div>
                    </div>
                </a>
            </li>

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('group.*') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('group.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="users"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Groups)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('group.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('group.index') }}"
                            class="side-menu {{ request()->routeIs('group.index') || request()->routeIs('group.show') || request()->routeIs('group.edit') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Group List)
                            </div>
                        </a>
                        <a href="{{ route('group.create') }}"
                            class="side-menu {{ request()->routeIs('group.create') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Create Group)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            

            {{-- Campaign --}}

            <li>
                <a href="{{ route('campaign.email-campaign') }}"
                    class="side-menu {{ request()->routeIs('campaign.email-campaign') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('campaign.email-campaign') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="align-left"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Email Campaign)
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('campaign.sms-campaign') }}"
                    class="side-menu {{ request()->routeIs('campaign.sms-campaign') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('campaign.sms-campaign') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="git-merge"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(SMS Campaign)
                        </div>
                    </div>
                </a>
            </li>

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('campaign.*') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('campaign.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="columns"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Campaigns)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>

                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('campaign.*') || request()->routeIs('tracker.*') ? 'side-menu__sub-open' : ''
                    }}">
                    <li>
                        <a href="{{ route('campaign.type', 'email') }}"
                            class="side-menu {{ request()->is('campaign/type/email') || request()->routeIs('campaign.emails.edit') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Email Campaign)
                            </div>
                        </a>
                        <a href="{{ route('campaign.type', 'sms') }}"
                            class="side-menu {{ request()->is('campaign/type/sms') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(SMS Campaign)
                            </div>
                        </a>

                        <a href="{{ route('campaign.index') }}"
                            class="side-menu {{ request()->routeIs('campaign.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Campaign List)
                            </div>
                        </a>

                        <a href="{{ route('campaign.create') }}" class="side-menu {{ request()->routeIs('campaign.create') 
                            || request()->routeIs('campaign.create.type') 
                            || request()->routeIs('campaign.store.step1') 
                            || request()->routeIs('campaign.store.step2')
                            || request()->routeIs('campaign.store.store2')
                            || request()->routeIs('campaign.store.step3') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Create Campaign)
                            </div>
                        </a>

                        {{-- Version 2.0 --}}

                        <a href="{{ route('campaign.schedule.emails') }}"
                            class="side-menu {{ request()->routeIs('campaign.schedule.emails') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Email Schedules)
                            </div>
                        </a>

                        {{-- Version 2.0 --}}

                        {{-- Version 4.1 --}}

                        <a href="{{ route('tracker.emails.index') }}"
                            class="side-menu {{ request()->routeIs('tracker.*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Campaign Tracker)
                            </div>
                        </a>

                        {{-- Version 4.1 --}}

                    </li>

                </ul>
            </li>

            {{-- Autoresponder --}}
            <li>
                <a href="{{ route('autoresponder.index') }}"
                    class="side-menu {{ request()->routeIs('autoresponder.*') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('autoresponder.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="share-2"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Autoresponder)
                        </div>
                    </div>
                </a>
            </li>


            {{-- Mail Activity --}}

            @can('Admin')

            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('mail.activity.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('mail.activity.*') ? 'mldl-active-menu' : 'flex items-center' }}">

                        <div class="side-menu__icon">
                            <i data-feather="list"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Mail Details)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>

                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('mail.activity.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('mail.activity.index') }}"
                            class="side-menu {{ request()->routeIs('mail.activity.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Detail List)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>
            @endcan

            {{-- Sms Log --}}

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('log.sms') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('log.sms') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="message-square"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(SMS Logs)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('log.sms') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('log.sms') }}"
                            class="side-menu {{ request()->routeIs('log.sms') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Log List)
                            </div>
                        </a>
                    </li>

                    <li class="hidden">
                        <a href="{{ route('log.sms.infobip') }}"
                            class="side-menu {{ request()->routeIs('log.sms.infobip') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(InfoBip Log List)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Campaign Log --}}

            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('logs.campaign.*') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('logs.campaign.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="activity"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Campaign Logs)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('logs.campaign.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('logs.campaign.index') }}"
                            class="side-menu {{ request()->routeIs('logs.campaign.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Log List)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Task Manager --}}


            @if (!saas())


            {{-- Subscription --}}

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('subscription.*') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('subscription.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="grid"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Subscription Plans)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>

                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('subscription.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('subscription.index') }}"
                            class="side-menu {{ request()->routeIs('subscription.index') || request()->routeIs('subscription.edit') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Plans)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Subscription --}}


            @can('Customer')
            <li>
                <a href="{{ route('purchased.plan') }}"
                    class="side-menu {{ request()->routeIs('purchased.plan') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('purchased.plan') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="shopping-bag"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Purchased Plans)
                        </div>
                    </div>
                </a>
            </li>
            @endcan

            @endif


            {{-- Limit Manager --}}
            @can('Admin')

            @if (!saas())
            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('limit.*') ? 'side-menu--active side-menu--open' : ''
                    }}">

                    <div class="{{ request()->routeIs('limit.*') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="bar-chart-2"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Limit Manager)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>

                    </div>
                </a>

                <ul class="d-none {{
                        request()->routeIs('limit.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('limit.index') }}"
                            class="side-menu {{ request()->routeIs('limit.index') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Users Limit)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            @endif

            {{-- Notes --}}

            <li>
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('notes.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('notes.*') ? 'mldl-active-menu' : 'flex items-center' }}">

                        <div class="side-menu__icon">
                            <i data-feather="book"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Important Notes)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('notes.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('notes.index') }}"
                            class="side-menu {{ request()->routeIs('notes.index') || request()->routeIs('notes.show') || request()->routeIs('notes.edit') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Note Lists)
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('notes.create') }}"
                            class="side-menu {{ request()->routeIs('notes.create') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Create Note)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Payment Setup --}}

            <li class="d_none">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('payment.setup.*') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('payment.setup.*') ? 'mldl-active-menu' : 'flex items-center' }}">

                        <div class="side-menu__icon">
                            <i data-feather="credit-card"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Payment Setup)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('payment.setup.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('payment.setup.paypal') }}"
                            class="side-menu {{ request()->routeIs('payment.setup.paypal') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Paypal)
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('payment.setup.stripe') }}"
                            class="side-menu {{ request()->routeIs('payment.setup.stripe') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Stripe)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            @endcan

            {{-- Bounced Email --}}

            <li style="display: none;">
                <a href="javascript:;" class="side-menu {{
                        request()->routeIs('bounce.emails') ? 'side-menu--active side-menu--open' : ''
                    }}">
                    <div class="{{ request()->routeIs('bounce.emails') ? 'mldl-active-menu' : 'flex items-center' }}">

                        <div class="side-menu__icon">
                            <i data-feather="alert-circle"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Bounce Checker)
                            <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                        </div>
                    </div>

                </a>

                <ul class="d-none {{
                        request()->routeIs('bounce.*') ? 'side-menu__sub-open' : ''
                    }}">

                    <li>
                        <a href="{{ route('bounce.emails') }}"
                            class="side-menu {{ request()->routeIs('bounce.emails') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Email Lists)
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('bounce.check') }}"
                            class="side-menu {{ request()->routeIs('bounce.check') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon">
                                <i data-feather="align-left"></i>
                            </div>
                            <div class="side-menu__title">
                                @translate(Check Bounce)
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="{{ route('testing') }}"
                    class="side-menu {{ request()->routeIs('testing') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('testing') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="settings"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Settings)
                        </div>
                    </div>
                </a>
            </li>

            {{-- Task Manager --}}

            @can('Admin')

            {{-- SEO Setup --}}
            <li>
                <a href="{{ route('seo.index') }}"
                    class="side-menu {{ request()->routeIs('seo.index') ? 'side-menu--active' : '' }}">
                    <div class="{{ request()->routeIs('seo.index') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="bar-chart"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(SEO)
                        </div>
                    </div>
                </a>
            </li>

            @if (devtool())


            {{-- CHAT PROVIDER --}}

            <li>
                <a href="{{ route('chat.provider') }}" class="side-menu 
                    {{ request()->routeIs('chat.provider') || 
                    request()->routeIs('chat.edit') ? 'side-menu--active' : '' }}">

                    <div class="{{ request()->routeIs('chat.provider') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="message-square"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Chat Provider)
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('server.status') }}"
                    class="side-menu {{ request()->routeIs('server.status') ? 'side-menu--active' : '' }}">

                    <div class="{{ request()->routeIs('server.status') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="server"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Server Status)
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('help') }}"
                    class="side-menu {{ request()->routeIs('help') ? 'side-menu--active' : '' }}">

                    <div class="{{ request()->routeIs('help') ? 'mldl-active-menu' : 'flex items-center' }}">
                        <div class="side-menu__icon">
                            <i data-feather="help-circle"></i>
                        </div>
                        <div class="side-menu__title">
                            @translate(Help)
                        </div>
                    </div>
                </a>
            </li>

            {{-- CHAT PROVIDER::END --}}

            @endif

            @endcan


            <li>
                <div id="google_translate_element"></div>
            </li>

        </ul>

    </nav>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
        @include('../layout/components/top-bar')

        @if ($errors->any())

        @foreach ($errors->all() as $error)

        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 mt-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ $error }}</p>
        </div>

        @endforeach

        @endif


        @yield('subcontent')


    </div>
    <!-- END: Content -->
</div>




@endsection
