@extends('install.app')

@section('content')
    
 <div class="drawer drawer-mobile"><input id="main-menu" type="checkbox" class="drawer-toggle">
        <main class="flex-grow block overflow-x-hidden bg-base-100 text-base-content drawer-content">
            <div id="nav"
                class="inset-x-0 top-0 z-50 w-full transition duration-200 ease-in-out border-b border-base-200 bg-base-100 text-base-content sticky">
                <div class="mx-auto space-x-1 navbar max-w-none">

                    <div class="flex-1"></div>

                    <div class="navbar w-full col-span-1 shadow-lg xl:col-span-3 bg-neutral-focus text-neutral-content rounded-box">
                        <ul class="w-full steps">
                            <li class="step step-primary">Start</li>
                            <li class="step step-primary">Requirements</li>
                            <li class="step">Database</li>
                            <li class="step">Migration</li>
                        </ul>
                    </div>

                    <div title="Codecanyon ↗︎" class="items-center flex-none"><a aria-label="Codecanyon" target="_blank"
                            href="https://codecanyon.net/item/maildoll-email-sms-marketing-application/30467920"
                            rel="noopener" class="normal-case btn btn-ghost drawer-button btn-square">
                            <img src="{{ asset('install/img/codecanyon.png') }}" alt="codecanyon">
                        </a>
                    </div>
                </div>

            </div>

            <div class="p-4 lg:p-10">

                <div class="grid grid-cols-1 gap-6 lg:p-10 xl:grid-cols-3 lg:bg-base-200 rounded-box">

                    <div class="card row-span-3 shadow-lg compact bg-base-100 hidden md:block bg-white">
                        <figure><img src="{{ asset('install/img/permissions.gif') }}" style="height: 850px;"></figure>
                    </div>


                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-2 bg-base-100">
                        <div class="card-body">
                            <h2 class="text-4xl font-bold card-title">Maildoll - Email & SMS Marketing SaaS Application</h2>
                            <p class="my-4 font-bold">Checking files & folder permissions. We ran diagnosis on your
                                server. Review the items that have a red mark on it. If everything is green, you are
                                good to go to the next step.</p>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if (versionOfPhp() >= 8.00)

                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    
                                    <label>PHP version 8.0 +</label>
                                </div>

                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if ($permission['curl_enabled'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>cURL enabled</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if (extension_loaded('zip'))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>zip extension</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if (extension_loaded('mysqli'))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>nd_mysqli/mysqli extension</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if (extension_loaded('pdo_mysql'))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>nd_pdo_mysql/pdo_mysql extension</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if ($permission['db_file_write_perm'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>.env</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if ($permission['storage'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>storage</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if ($permission['bootstrap'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>bootstrap/cache</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if ($permission['public'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>public</label>
                                </div>
                            </div>

                            <div class="alert mb-3">
                                <div class="flex-1">

                                    @if ($permission['htaccess'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2" stroke="#2ecc71"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="#2ecc71">
                                            <path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" />
                                        </g>
                                    </svg>
                                        
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="#ff5722" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                        
                                    @endif

                                    <label>.htaccess</label>
                                </div>
                            </div>

                            <div class="justify-end space-x-2 card-actions">

                                @if ($permission['curl_enabled'] == 1 && 
                                $permission['db_file_write_perm'] == 1 && 
                                $permission['storage'] && 
                                $permission['bootstrap'] && 
                                $permission['public'] && 
                                $permission['htaccess'] && 
                                versionOfPhp() >= 7.40)
                                <a href="{{ route('create') }}" class="btn btn-primary">Go to database setup</a>
                                @else
                                <a href="javascript:;" 
                                class="btn btn-danger">
                                Permissions Error. Please check folder or file permissions
                                </a>
                            @endif

                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

@endsection