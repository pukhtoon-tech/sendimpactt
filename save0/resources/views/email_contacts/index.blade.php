@extends('layout.' .  layout())

@section('subhead')
    <title>{{ orgname() }} - @translate(Contacts)</title>
@endsection

@section('subcontent')
  <div class="grid grid-cols-12 gap-6 mt-8">

        @include('email_contacts.components.side-menu')

        <div class="loader_card animate-pulse col-span-12 lg:col-span-9 xxl:col-span-10 mt-5">
            @for ($i = 1; $i < 51; $i++)
            <div class="flex">
                <div class="rounded-full mt-2 h-8 w-10 bg-gray-400"></div>
                <div class="w-full mr-4 ml-4 h-8 mt-2 rounded-full bg-gray-400"></div>
                <div class="w-20 h-8 mt-2 rounded-full bg-gray-400"></div>
            </div>
            @endfor
        </div>

        <div class="col-span-12 lg:col-span-9 xxl:col-span-10" id="loadPage"></div>
    </div>

@include('email_contacts.components.modal')

<input type="hidden" id="emails_url" value="{{ route('email.contacts.emails') }}">
<input type="hidden" id="favourite_url" value="{{ route('email.contacts.favourite') }}">
<input type="hidden" id="trashed_url" value="{{ route('email.contacts.trashed') }}">
<input type="hidden" id="blocked_url" value="{{ route('email.contacts.blocked') }}">
<input type="hidden" id="delete_url" value="{{ route('email.contacts.destroy.all') }}">
<input type="hidden" id="blacklist_url" value="{{ route('email.contacts.blacklist.all') }}">
<input type="hidden" id="fav_url" value="{{ route('email.contacts.favourite.all') }}">
<input type="hidden" id="permanent_delete_url" value="{{ route('email.contacts.permanent.destroy.all') }}">
<input type="hidden" id="restore_url" value="{{ route('email.contacts.restore.all') }}">
<input type="hidden" id="unblock_url" value="{{ route('email.contacts.unblock.all') }}">
<input type="hidden" id="dislike_url" value="{{ route('email.contacts.dislike.all') }}">
<input type="hidden" id="email_search_url" value="{{ route('email.contacts.search') }}">
<input type="hidden" id="send_email_url" value="{{ route('email.contacts.send.email') }}">
<input type="hidden" id="mark_as_read_url" value="{{ route('email.contacts.mark.as.read') }}">
<input type="hidden" id="email_fetch_data" value="{{ route('email.contacts.fetch_data') }}">

@endsection

@section('script')
   <script src="{{ filePath('assets/js/email_contacts.js') }}"></script>
@endsection