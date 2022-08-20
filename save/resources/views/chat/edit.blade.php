@extends('layout.' .  layout())

@section('subhead')
    <title>{{ $chat->name }}-@translate(Chat Provider)</title>
@endsection

@section('subcontent')
  <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">{{ $chat->name }} - @translate(Chat Provider)</h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box mt-5">
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('chat.update', $chat->id) }}" method="POST">
                @csrf

                <div class="intro-y box p-5">
                    <div>
                        <label>@translate(Chat Provider Name)</label>
                        <input type="text" class="input w-full border mt-2" name="name" placeholder="Chat Provider Name" value="{{ $chat->name }}" data-parsley-required>
                    </div>

                    
                    <div class="mt-3">
                        <label>@translate(Chat Provider Script)</label>
                        <div class="mt-2">
                            <textarea rows="8" class="resize-none border rounded-md w-full" name="body" data-parsley-required>
                            <?php echo htmlspecialchars($chat->body)  ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" value="1" class="input input--switch border" name="status" {{ $chat->status == 1 ? 'checked' : null }} >
                        </div>
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
   <script src="{{ filePath('assets/js/jquery.js') }}"></script>
   <script src="{{ filePath('assets/js/parsley.js') }}"></script>
   <script src="{{ filePath('assets/js/validation.js') }}"></script>
@endsection