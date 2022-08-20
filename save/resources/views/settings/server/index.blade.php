@extends('../layout/' . layout())

@section('subhead')
    <title>@translate(Server Status)</title>
@endsection

@section('subcontent')

<div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">@translate(Server Status)</h2>
                   
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                    <i data-feather="airplay" class="report-box__icon text-theme-10"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_memory_get_usage() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Memory Usage)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="columns" class="report-box__icon text-theme-11"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_max_execution_time() }}s</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Max Execution Time)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="users" class="report-box__icon text-theme-12"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_memory_limit() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Memory Limit)</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="file" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_upload_max_filesize() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Upload Max Filesize)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="file" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_max_file_uploads() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Max File Uploads)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="pocket" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_default_socket_timeout(3600) }}s</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Default Socket Timeout)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="clock" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_max_input_time() }}s</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Max Input Time)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="coffee" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">v{{ application_version() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(Application Version)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="flag" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_db_port() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(DB PORT)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="flag" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_remote_port() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(REMOTE PORT)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="clock" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_request_time() }}s</div>
                                <div class="text-base text-gray-600 mt-1">@translate(REQUEST TIME)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="check" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">v{{ phpversion() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(PHP VERSION)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="upload" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_post_max_size() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(POST MAX SIZE)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="archive" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_realpath_cache_size() }}</div>
                                <div class="text-base text-gray-600 mt-1">@translate(CACHE SIZE)</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="database" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ server_MariaDB() }}</div>
                                <div class="text-base text-gray-600 mt-1">MySQL</div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="globe" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ software_version() }}</div>
                                <div class="text-base text-gray-600 mt-1">{{ env('APP_NAME') }} VERSION</div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>

            </div>

<div class="col-span-12 mt-8">

                <div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y">


                            <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Loaded Extensions</h2>
    </div>
    <!-- BEGIN: Icon List -->
    <div class="intro-y grid grid-cols-12 sm:gap-6 row-gap-6 box px-5 py-8 mt-5">

        @foreach (get_loaded_extensions() as $item)

        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
            <div class="text-center text-base button w-32 rounded-full mr-1 mb-2 bg-theme-14 text-theme-10 mt-2">{{ $item }}</div>
        </div>
            
        @endforeach

        
        
    </div>
    <!-- END: Icon List -->
                                
                    </div>
                    </div>

   
@endsection

@section('script')

@endsection