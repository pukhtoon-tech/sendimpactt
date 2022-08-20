<div class="col-span-12 mt-6">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Weekly Top Senders)</h2>
                   
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                    <table class="table table-report sm:mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-no-wrap">@translate(IMAGES)</th>
                                <th class="whitespace-no-wrap">@translate(USER NAME)</th>
                                <th class="text-center whitespace-no-wrap">@translate(RECORD)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (weeklyTopSenders() as $sender)
                                <tr class="intro-x">
                                    <td class="w-40">
                                        <div class="flex">
                                            <div class="w-10 h-10 image-fit zoom-in">
                                                <img alt="{{ $sender->user->name }}" class="tooltip rounded-full" src="{{ avatar($sender->user->photo) }}" title="{{ $sender->user->name }}">
                                            </div>
                                           
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-medium whitespace-no-wrap tooltip" title="{{ $sender->user->name }}">{{ $sender->user->name }}</span>
                                    </td>
                                    <td class="text-center tooltip" title="{{ weeklyTopSendersRecord($sender->owner_id) }}">{{ weeklyTopSendersRecord($sender->owner_id) }}</td>
                              
                                </tr>

                                @empty

                                <td colspan="3">
                                    <div class="text-center">
                                        <img src="{{ notFound('no-data-found.png') }}" class="m-auto no-shadow" alt="#no-data-found">
                                    </div>
                                </td>

                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>