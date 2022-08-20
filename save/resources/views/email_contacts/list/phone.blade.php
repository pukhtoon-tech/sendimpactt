@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Phone Number List)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Phone Number List)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">

        <a href="javascript:;"
            data-toggle="modal"
            data-target="#superlarge-modal-size-preview"
            class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip"
            title="@translate(Add New Phone Contact)">
            @translate(Add New Phone Contact)
        </a>

            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." id="emailList">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(SL.)</th>
                        <th class="text-center whitespace-no-wrap">@translate(Name)</th>
                        <th class="text-center whitespace-no-wrap">@translate(PHONE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(DATE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTION)</th>
                    </tr>
                </thead>
                <tbody class="emailName">
                    @forelse (phoneList() as $phone)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{$loop->iteration}}" class="tooltip rounded-full" src="{{ commonAvatar($loop->iteration) }}" title="{{ $loop->iteration }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(Recipient Email)">

                                    {{ $phone->name ?? 'No name' }}

                            </td>
                            <td class="text-center tooltip" title="@translate(Campaign Name)">+{{ $phone->country_code }}{{ $phone->phone }}</td>
                            <td class="text-center tooltip" title="@translate(Mail Date)">{{ $phone->created_at }}</td>
                            <td class="text-center">

                                <div class="flex justify-center">

                                    <a href="{{ route('email.contact.show', $phone->id) }}" class="tooltip text-theme-1" title="@translate(Edit)">
                                        <x-feathericon-edit />
                                    </a>

                                    <a href="{{ route('email.contact.destroy', $phone->id) }}" class="tooltip text-theme-6" title="@translate(Delete)">
                                        <x-feathericon-trash />
                                    </a>
                                </div>


                            </td>
                        </tr>
                    @empty
                     <td colspan="6">
                            <div class="text-center">
                                <img src="{{ notFound('log.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ phoneList()->firstItem() ?? '0' }} to {{ phoneList()->lastItem() ?? '0' }} of {{ phoneList()->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ phoneList()->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>


    {{-- MODAL --}}

    <div class="modal" id="superlarge-modal-size-preview">
     <div class="modal__content modal__content--xl p-10">
        <div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">@translate(Add New Contact)</h2>
</div>
<div class="grid grid-cols-12 gap-12 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <form class="" id="contactsForm"
        enctype="multipart/form-data"
        action="{{ route('email.contact.store') }}"
        onsubmit="return validateform()"
        name="myform"
        method="POST">
        @csrf

            <div class="mt-3">
            <div class="input-form">
                <label class="flex flex-col sm:flex-row"> @translate(Name)*</label>
                <input type="text" name="name" class="input w-full border mt-2" placeholder="Ex: John Doe" required>
            </div>
            </div>

            <div class="mt-6">
            <div class="input-form mt-2">


                <label class="flex flex-col sm:flex-row"> @translate(Contact Number)*</label>

                <div class="flex">

                    <div class="w-2/5">

                        <select data-search="false" class="form-select w-full" name="country_code" required>

                            @forelse (country_codes() as $country_code)
                                <option data-countryCode="{{ $country_code->iso3 }}" value="{{ $country_code->phonecode }}">{{ $country_code->nicename }} (+{{ $country_code->phonecode }})</option>
                            @empty
                                <option data-countryCode="dasdDZ" value="2dasfdfddas13">No country found</option>
                            @endforelse

                        </select>

                    </div>



                <input type="number" name="phone" class="input w-full border" placeholder="Ex: 1825731327">

                </div>


                 </div>
            </div>

       <button type="submit"
                class="button bg-theme-1 text-white mt-5">@translate(Save)</button>
        </form>
        <!-- END: Form Layout -->

</div>
</div>
     </div>
 </div>



    {{-- MODAL::END --}}
@endsection

@section('script')
<script src="{{ filePath('bladejs/email_contacts/components/modal.js') }}"></script>
<script src="{{ filePath('bladejs/email_contacts/list/phone.js') }}"></script>
@endsection