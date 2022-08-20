@extends('layout.' .  layout())

@section('subhead')
    <title>@translate(Queue Failed)</title>
@endsection

@section('subcontent')
  <h2 class="intro-y text-lg font-medium mt-10">@translate(Queue Failed)</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">@translate(QUEUE ID)</th>
                        <th class="text-center whitespace-no-wrap">@translate(NAME)</th>
                        <th class="text-center whitespace-no-wrap">@translate(STARTED AT)</th>
                        <th class="text-center whitespace-no-wrap">@translate(TIME ELAPSED)(s)</th>
                        <th class="text-center whitespace-no-wrap">@translate(ATTEMPT)</th>
                        <th class="text-center whitespace-no-wrap">@translate(EXCEPTION)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fails as $fail)
                        <tr class="intro-x">
                            <td class="text-center">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="#{{ $fail->job_id }}" class="tooltip rounded-full" src="{{ commonAvatar($fail->job_id) }}" title="{{ $fail->job_id }}">
                                </div>
                            </td>
                            <td class="text-center tooltip" title="@translate(Queue Name)">{{ Str::after($fail->name, 'App\Mail') }}</td>
                            <td class="text-center tooltip" title="@translate(Queue Started At)">{{ $fail->started_at }}</td>
                            <td class="text-center tooltip" title="@translate(Queue Time Elapsed)">{{ $fail->time_elapsed }}</td>
                            <td class="text-center tooltip" title="@translate(Queue Attempt)">{{ $fail->attempt }}</td>
                            <td class="text-center tooltip" title="@translate(Queue Progress)">{{ Str::limit($fail->exception, 110) ?? '-' }}</td>
                        </tr>
                    @empty
                    <td colspan="7">
                            <div class="text-center">
                                <img src="{{ notFound('queue.png') }}" class="w-2/5 m-auto no-shadow" alt="#queue-not-found">
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 text-center">
            <div class="md:block mx-auto text-gray-600">Showing {{ $fails->firstItem() ?? '0' }} to {{ $fails->lastItem() ?? '0' }} of {{ $fails->total() }} entries</div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
         {{ $fails->links('vendor.pagination.custom') }}
        <!-- END: Pagination -->
    </div>
@endsection

@section('script')
  
@endsection