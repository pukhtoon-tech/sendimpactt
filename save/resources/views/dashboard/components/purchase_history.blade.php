<div class="col-span-12 xl:col-span-8 mt-6">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Purchase History)</h2>
                </div>
                <div class="mt-5">
                    @forelse (purchased(4) as $purchases)
                        <div class="intro-y">
                            <div class="box px-4 py-4 mb-3 flex items-center">
                                <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                    <img alt="#{{ $purchases->id }}" src="{{ commonAvatar($purchases->id) }}" title="{{ $purchases->id }}">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium tooltip" title="#{{ $purchases->invoice }}">#{{ $purchases->invoice }}</div>
                                    <div class="font-medium tooltip" title="{{ Str::upper($purchases->plan_name) }}">{{ Str::upper($purchases->plan_name) }}</div>
                                    <div class="text-gray-600 text-xs tooltip" title="{{ $purchases->created_at->diffForHumans() }}">{{ $purchases->created_at }}</div>
                                </div>
                                <div class="py-1 px-2 rounded-full text-xs cursor-pointer font-medium tooltip {{ $purchases->status === 1 ? 'text-theme-9' : 'text-theme-6' }}" title="{{ $purchases->status == 1 ? 'PAID' : 'NOT PAID' }}">
                                {{ $purchases->status == 1 ? 'PAID' : 'NOT PAID' }}</div>
                            </div>
                        </div>
                    @empty

                    <div class="intro-y">
                            <div class="box px-4 py-4 mb-3 flex items-center">
                               
                                <img src="{{ notFound('purchase-not-found.png') }}" class="m-auto no-shadow" alt="#campaign-not-found">
                                
                            </div>
                        </div>

                    @endforelse
                    <a href="{{ route('purchased.plan') }}" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">@translate(View More)</a>
                </div>
            </div>