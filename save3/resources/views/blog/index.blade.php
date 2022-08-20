@extends('../layout/' .  layout())

@section('subhead')
    <title>@translate(Blogs)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Blogs)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('dashboard.blog.create') }}" class="button text-white bg-theme-1 shadow-md mr-2 w-4/12 tooltip" title="@translate(Add new Blog)">@translate(Add New Blog)</a>
            
            <div class="w-full sm:w-auto ml-2 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="text-right relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-full md:w-56  mt-4 md:mt-0 box pr-10 placeholder-theme-13" placeholder="Search..." id="noteIndex">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>

        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto ">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(ICON)</th>
                        <th class="whitespace-no-wrap">@translate(TITLE)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STATUS)</th>
                        <th class="text-center whitespace-no-wrap">@translate(CREATED BY)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ACTIONS)</th>
                    </tr>
                </thead>
                <tbody class="noteName">
                    @forelse ($blogs as $blog)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="{{ $blog->title }}" class="tooltip rounded-full" src="{{ namevatar($blog->title) }}" title="{{ $blog->title }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium tooltip inline-block" title="{{ $blog->title  }}">{{$blog->title }}</a>
                            </td>

                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $blog->status == 1 ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $blog->status == 1 ? 'Active' : 'Inactive' }}
                                </div>
                            </td>

                            <td class="text-center">{{ $blog->created_at->diffForHumans() }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 tooltip" title="@translate(View)" target="_blank" href="{{ route('frontend.blog.show', [$blog->id, Str::slug($blog->title)]) }}">
                                        <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center mr-3 tooltip" href="{{ route('dashboard.blog.show', [$blog->id, Str::slug($blog->title)]) }}" title="@translate(Edit)">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" href="{{ route('dashboard.blog.destroy', [$blog->id, Str::slug($blog->title)]) }}" title="@translate(Delete)">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                    <td colspan="6">
                            <div class="text-center">
                                <img src="{{ notFound('note.png') }}" class="w-2/5 m-auto no-shadow" alt="#note-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">{{ __('Showing') }} {{ $blogs->firstItem() ?? '0' }} {{ __('to') }} {{ $blogs->lastItem() ?? '0' }} {{ __('of') }} {{ $blogs->total() }} {{ __('entries') }}</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $blogs->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>

@endsection

@section('script')
<script src="{{ filePath('bladejs/notes/index.js') }}"></script>
@endsection