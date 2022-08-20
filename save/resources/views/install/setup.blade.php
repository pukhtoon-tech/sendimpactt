@extends('install.app')

@section('content')

    <div class="drawer drawer-mobile"><input id="main-menu" type="checkbox" class="drawer-toggle">
        <main class="flex-grow block overflow-x-hidden bg-base-100 text-base-content drawer-content">
            <div id="nav"
                class="inset-x-0 top-0 z-50 w-full transition duration-200 ease-in-out border-b border-base-200 bg-base-100 text-base-content sticky">
                <div class="mx-auto space-x-1 navbar max-w-none">

                    <div class="flex-1"></div>
                    <!---->

                    <div
                        class="navbar w-full col-span-1 shadow-lg xl:col-span-3 bg-neutral-focus text-neutral-content rounded-box">
                        <ul class="w-full steps">
                            <li class="step step-primary">Start</li>
                            <li class="step step-primary">Requirements</li>
                            <li class="step step-primary">Database</li>
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
                        <figure><img src="{{ asset('install/img/db_setup.gif') }}"></figure>
                    </div>


                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-2 bg-base-100">
                        <div class="card-body">
                            <h2 class="text-4xl font-bold card-title">Maildoll - Email & SMS Marketing SaaS Application</h2>

                            <form action="{{route('db.setup')}}" method="GET">
                                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                    Database Information
                                </h6>
                                <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <div class="p-10 card bg-base-200">
                                            <div class="form-control">
                                                <label class="label">
                                                <span class="label-text">Database Host</span>
                                                </label> 
                                                <input type="hidden" name="types[]" value="DB_HOST">
                                                <input type="text" placeholder="Database Host" name="DB_HOST" class="input" value="localhost" required>
                                            </div>
                                        </div>
                                  </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <div class="p-10 card bg-base-200">
                                            <div class="form-control">
                                                <label class="label">
                                                <span class="label-text">Database Port</span>
                                                </label> 
                                                <input type="hidden" name="types[]" value="DB_PORT">
                                                <input type="text" name="DB_PORT" placeholder="Database Port" value="3306" required class="input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <div class="p-10 card bg-base-200">
                                            <div class="form-control">
                                                <label class="label">
                                                <span class="label-text">Database Name</span>
                                                </label> 
                                                <input type="hidden" name="types[]" value="DB_DATABASE">
                                                <input type="text" name="DB_DATABASE" placeholder="Database Name" value="{{ old('DB_DATABASE') }}" required class="input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <div class="p-10 card bg-base-200">
                                            <div class="form-control">
                                                <label class="label">
                                                <span class="label-text">Database Username</span>
                                                </label> 
                                                <input type="hidden" name="types[]" value="DB_USERNAME">
                                                <input type="text" name="DB_USERNAME" placeholder="Database Username" value="{{ old('DB_USERNAME') }}" required class="input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <div class="p-10 card bg-base-200">
                                            <div class="form-control">
                                                <label class="label">
                                                <span class="label-text">Database Password</span>
                                                </label>
                                                <input type="hidden" name="types[]" value="DB_PASSWORD">
                                                <input type="text" name="DB_PASSWORD" placeholder="Database Password" class="input" value="{{ old('DB_PASSWORD') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (saas())
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <div class="p-10 card bg-base-200">
                                                <div class="form-control">
                                                    <label class="label">
                                                    <span class="label-text">Database Prefix</span>
                                                    </label> 
                                                    <input type="hidden" name="types[]" value="DB_PREFIX">
                                                    <input type="text" name="DB_PREFIX" placeholder="Database Prefix" value="{{ old('DB_PREFIX') }}" required class="input" required>
                                                    <small>Ex: maildollsaas_</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <div class="p-10 card bg-base-200">
                                                <div class="form-control">
                                                    <label class="label">
                                                    <span class="label-text">You Domain</span>
                                                    </label> 
                                                    <input type="hidden" name="types[]" value="YOUR_DOMAIN">
                                                    <input type="text" name="YOUR_DOMAIN" placeholder="Your Domain" value="{{ old('YOUR_DOMAIN') }}" required class="input" required>
                                                    <small>Ex: maildollsaas.com</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                
                            
                            </div>
                    

                            <div class="justify-end space-x-2 card-actions">
                                <button type="submit" class="btn btn-primary">Go to migration</a>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection
