@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Group Information)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">@translate(Group Information)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->

  <div class="intro-y box py-10 sm:py-20 mt-5">
      <div class="flex items-center ml-8">
          <a href="{{ route('group.index') }}" class=""><x-feathericon-arrow-left /></a>
      </div>
        <div class="wizard flex lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">1</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">@translate(Group Information)</div>
            </div>

            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">@translate(Update Audiance)</div>
            </div>

            <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('group.update', $group->id) }}" method="POST">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Group Name)</label>
                        <input type="text" class="input w-full border mt-2" name="name" value="{{ $group->name }}" placeholder="@translate(Group Name)">
                    </div>


                    <div class="mt-3">
                        <label>@translate(Description)</label>
                        <div class="mt-2">
                            <textarea placeholder="Description here..."
                                      data-simple-toolbar="true" rows="3" maxlength="100"
                                      class="input w-full border mt-2"
                                      name="description" data-parsley-required>{{ trim(strip_tags($group->description)) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" class="input input--switch border" name="status" {{ $group->status == 1 ? 'checked': '' }}>
                        </div>
                    </div>


            <!-- BEGIN: Form Layout -->

                    {{-- Audiance --}}
                    <!-- BEGIN: Inbox Content -->
              <div class="intro-y inbox box mt-5">
                  <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
                      <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                          <input class="input border border-gray-500 checkAll" id="check_all" type="checkbox">

                         <button type="submit" class="button w-50 ml-5 mr-2 mb-2 flex items-center justify-end bg-theme-1 text-white group-email">
                             <i data-feather="activity" class="w-4 h-4 mr-2"></i> @translate(Update Group) </button>

                      </div>
                      <div class="flex items-center sm:ml-auto">
                          <div class="dark:text-gray-300 ml-5">@translate(Total) {{ number_format(emailCount()) }} @translate(email)</div>
                      </div>
                  </div>
                  <div class="overflow-x-auto sm:overflow-x-visible myTable">
                      @if($group->type == 'email')
                      {{ $typee = 'email' }};
                      @else
                      {{ $typee = 'phone' }}
                      @endif
                      @forelse (App\Models\EmailContact::Active()->where($typee, '!=', null)->where('owner_id', Auth::user()->id)->latest()->get() as $email)
                          <div class="intro-y">
                              <div class="cursor-pointer inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1">
                                  <div class="flex px-5 py-3">
                                      <div class="w-56 flex-none flex items-center mr-10">
                                          <input class="input flex-none border border-gray-500 checking"
                                          @foreach ($group->email_groups as $email_group)
                                            {{ $email_group->email_id == $email->id ? 'checked' : '' }}
                                          @endforeach
                                          data-id="{{ $email->id }}"  data-email="{{ $email->email }}" value="{{ $email->id }}" name="email_id[]" type="checkbox">
                                          <a href="javascript:;" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500">
                                              <x-feathericon-star class="{{ $email->favourites == 1 ? 'text-blue-300' : null }}"/>
                                          </a>

                                          <div class="w-6 h-6 flex-none image-fit relative ml-5 email">
                                              <img alt="{{ $email->email }}" class="rounded-full" src="{{ emailAvatar($email->email) }}">
                                          </div>
                                      </div>

                                      <div class="grid grid-cols-3 w-full gap-4">
                                          <div class="w-64 sm:w-auto truncate mr-10">
                                          <span class="inbox__item--highlight">{{ $email->email }}</span>
                                      </div>

                                      <div class="w-64 sm:w-auto truncate mr-10">
                                          <span class="inbox__item--highlight">{{ $email->name }}</span>
                                      </div>

                                      <div class="w-64 sm:w-auto truncate mr-10">
                                          <span class="inbox__item--highlight">{{ $email->country_code != null ? '+' : '' }}{{ $email->country_code }}{{ $email->phone }}</span>
                                      </div>
                                      </div>


                                      <div class="inbox__item--time whitespace-no-wrap ml-auto pl-10">{{ $email->created_at->format('H:i a') }}</div>
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
              <!-- END: Inbox Content -->
                    {{-- Audiance:END --}}

            <!-- END: Form Layout -->
        </div>


                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Update</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

@endsection

@section('script')
  <script src="{{ filePath('bladejs/group/edit.js') }}"></script>
@endsection
