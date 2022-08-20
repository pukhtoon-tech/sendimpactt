<div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-auto">@translate(Important Notes)</h2>
                        <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2">
                            <i data-feather="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600">
                            <i data-feather="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="mt-5 intro-x">
                        <div class="box zoom-in">
                            <div class="tiny-slider" id="important-notes">

                                @forelse (notes() as $note)

                                <div class="p-5">
                                    <div class="text-base font-medium truncate">{{ $note->title }}</div>
                                    <div class="text-gray-500 mt-1">{{ $note->created_at->diffForhumans() }}</div>
                                    <div class="text-gray-600 text-justify mt-1">{{ Str::limit(strip_tags($note->note), 200) }}</div>
                                    <div class="font-medium flex mt-5">
                                        <a href="{{ route('notes.show', $note->id) }}" target="_blank" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">@translate(View Note)</a>
                                    </div>
                                </div>
                                    
                                @empty
                                    
                                @endforelse
                                
                                
                            </div>
                        </div>
                    </div>
                </div>