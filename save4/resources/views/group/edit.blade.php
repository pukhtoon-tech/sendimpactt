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
           
                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Group Name)</label>
                        <input type="text" class="input w-full border mt-2" id="group_name" name="name" value="{{ $group->name }}" placeholder="@translate(Group Name)">
                    </div>


                    <div class="mt-3">
                        <label>@translate(Description)</label>
                        <div class="mt-2">
                            <textarea data-simple-toolbar="true" class="editor" id="group_desc" name="description">
                                {{ strip_tags($group->description) }}
                            </textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" id="group_status" class="input input--switch border" name="status" {{ $group->status == 1 ? 'checked': '' }}>
                        </div>
                    </div>


            <!-- BEGIN: Form Layout -->

                    {{-- Audiance --}}
                    <!-- BEGIN: Inbox Content -->
              <div class="intro-y inbox box mt-5">

                    {{-- Audiance --}}
                        @include('group.components.emails_edit')
                    {{-- Audiance:END --}}
                
              </div>
              <!-- END: Inbox Content -->
                    {{-- Audiance:END --}}

            <!-- END: Form Layout -->
        </div>

                </div>
          
            <!-- END: Form Layout -->
        </div>
    </div>
    <!-- END: Wizard Layout -->

    <input type="hidden" id="group_emails_edit_url" value="{{ route('group.update', $group->id) }}">
    <input type="hidden" value="{{ route('group.index') }}" id="group_list_url">
    <input type="hidden" id="campaign_emails_url" value="{{ route('campaign.contacts.emails') }}">
    <input type="hidden" id="campaign_email_fetch_data" value="{{ route('campaign.contacts.fetch_data') }}">

@endsection

@section('script')
<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('bladejs/group/edit.js') }}"></script>
<script>
    $(document).ready(function(){
        localStorage.removeItem('idsArr');
        var a = null;
        // Parse the serialized data back into an aray of objects
        a = JSON.parse(localStorage.getItem('idsArr')) || [];
        // Push the new data (whether it be an object or anything else) onto the array
        a.push(
            <?php echo GroupEmailArrayToString($group->id) ?>
        );
        // Alert the array value
        // Re-serialize the array back into a string and store it in localStorage
        localStorage.setItem('idsArr', JSON.stringify(a));
});
</script>
@endsection
