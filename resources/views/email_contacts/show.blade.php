@extends('layout.' .  layout())

@section('subhead')
    <title>{{ $email->name ?? $email->email }}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ Str::upper($email->name ?? $email->email ?? '+' . $email->country_code . $email->phone) }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="{{ $email->name }}" class="rounded-full"
                             src="{{ emailAvatar($email->name ?? $email->email ?? $email->phone) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ Str::upper($email->name ?? $email->email) }}</div>
                    </div>

                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <p>@translate(Edit email contacts with valid user informations. Must provide exist email address and
                        verified phone number with country code. For example +8801825731327)</p>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center mt-5" href="{{ route('email.contacts.index') }}">
                        <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> @translate(Go Back)
                    </a>
                </div>

            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">@translate(Information)</h2>
                </div>
                <div class="p-5">

                    <form action="{{ route('email.contact.update', $email->id) }}" method="POST"
                          data-parsley-validate="">
                        @csrf

                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                    <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="{{ $email->name ?? null }}"
                                             src="{{ emailAvatar($email->email ?? 'MD') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-8">
                                <div class="mt-3">
                                    <div class="input-form"><label class="flex flex-col sm:flex-row">
                                            <label>@translate(First Name)
                                                <small>@translate(Empty username field will make name from
                                                    email.)</small>
                                            </label>
                                        </label>
                                        <input type="text" name="fname" value="{{ $email->first_name ?? null }}"
                                               class="input w-full border mt-2" placeholder="@translate(first Name)">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="input-form"><label class="flex flex-col sm:flex-row">
                                            <label>@translate(last Name)
                                            </label>
                                            <input type="text" name="lname" value="{{ $email->last_name ?? null }}"
                                                   class="input w-full border mt-2" placeholder="@translate(last Name)">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="input-form"><label class="flex flex-col sm:flex-row">
                                            <label>@translate(last Name)
                                            </label>
                                        </label>
                                        <input type="text" name="cname" value="{{ $email->company_name ?? null }}"
                                               class="input w-full border mt-2" placeholder="@translate(last Name)">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="input-form">
                                        <label class="flex flex-col sm:flex-row"><label> @translate(Email Address)
                                                <small>@translate(Empty email field will not count as an email
                                                    contact.)</small>
                                            </label>
                                        </label>
                                        <input type="email" name="email" value="{{ $email->email }}"
                                               class="input w-full border mt-2"
                                               placeholder="@translate(Enter Email)" data-parsley-type="email">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="input-form">
                                        <label class="flex flex-col sm:flex-row"><label> @translate(Phone Number)
                                                <small>@translate(Empty phone field will not count as a sms
                                                    contact.)</small>
                                            </label>
                                        </label>

                                        <div class="flex">

                                            <div class="w-2/5">

                                                <select data-search="true" class="tail-select w-full"
                                                        name="country_code">

                                                    @forelse (country_codes() as $country_code)
                                                        <option data-countryCode="{{ $country_code->iso3 }}"
                                                                value="{{ $country_code->phonecode }}" {{ $country_code->phonecode == $email->country_code ? 'selected' : null }}>{{ $country_code->nicename }}
                                                            (+{{ $country_code->phonecode }})
                                                        </option>
                                                    @empty
                                                        <option data-countryCode="" value="">No country found
                                                        </option>
                                                    @endforelse

                                                </select>

                                            </div>

                                            <input type="text" name="phone" class="input w-full border"
                                                   value="{{ $email->phone }}" placeholder="@translate(User Phone)"
                                                   minlength="2">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <!-- END: Display Information -->



            <div class="intro-y inbox box mt-5">
                <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
                    <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                        <input class="input border border-gray-500 checkAll" id="check_all" type="checkbox">
                            <i data-feather="activity" class="w-4 h-4 mr-2"></i> @translate(Select All)
                    </div>
                    <div class="flex items-center sm:ml-auto">
                        <div class="dark:text-gray-300 ml-5">@translate(Total) {{ number_format(allEmailGroupCount()) }} @translate(Group)</div>
                    </div>
                </div>
            <div class="overflow-x-auto sm:overflow-x-visible myTable">
                @forelse (allEmailGroups() as $group)
                    <div class="intro-y">
                        <div class="cursor-pointer inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1">
                            <div class="flex px-5 py-3">
                                <div class="w-56 flex-none flex items-center mr-10">
                                    <input class="input flex-none border border-gray-500 checking"
                                           {{ selectedUserEmailGroups($email->id, $group->id) ? 'checked' : '' }}
                                           data-id="{{ $group->id }}"  data-email="{{ $group->email }}" value="{{ $group->id }}" name="groups[]" type="checkbox">

                                    <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                        <img alt="{{ $email->email }}" class="rounded-full" src="{{ emailAvatar($email->email) }}">
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 w-full gap-4">

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight">{{ $group->name }}</span>
                                    </div>

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight">{{ $group->type }}</span>
                                    </div>

                                    <div class="w-64 sm:w-auto truncate mr-10">
                                        <span class="inbox__item--highlight">{{ ($group->status == 1) ? 'Active' : 'Disabled' }}</span>
                                    </div>
                                </div>


                                <div class="inbox__item--time whitespace-no-wrap ml-auto pl-10">{{ $group->created_at->format('Y-m-d H:i a') }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">@translate(No Email Found)</div>
                @endforelse

            </div>
            <div class="p-5 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
                <div class="dark:text-gray-300">@translate(Total) {{ number_format(emailCount()) }} @translate(email)</div>
            </div>
        </div>
            <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">@translate(Save)
            </button>
        </div>




        </div>

    </div>
@endsection

@section('script')
    <script src="{{ filePath('assets/js/jquery.js') }}"></script>
    <script src="{{ filePath('assets/js/parsley.js') }}"></script>
    <script src="{{ filePath('assets/js/validation.js') }}"></script>

    <script>
        $(document).ready(function(){

            "use strict"

            $('#check_all').on('click', function(e) {
                if($(this).is(':checked',true))
                {
                    $(".checking").prop('checked', true);
                } else {
                    $(".checking").prop('checked',false);
                }
            });

            $('.checking').on('click',function(){
                if($('.checking:checked').length == $('.checking').length){
                    $('#check_all').prop('checked',true);
                }else{
                    $('#check_all').prop('checked',false);
                }
            });

            // group-email

        });

    </script>
@endsection