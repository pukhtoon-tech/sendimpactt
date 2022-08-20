<section class="space-3 bg-primary-3">
    <div class="container rounded-lg">
        <div class="w-100 w-lg-75 text-center mx-auto mb-5 text-white">
            <h2 class="font-weight-bold text-center editable is-modified" data-cid="31" tabindex="1">
                {{ argonContent(31) ?? 'Choose the plan type that works best for you.' }}</h2>
            <p class="lead mb-0 editable is-modified" data-cid="32" tabindex="1">
                {{ argonContent(32) ?? 'Choose the plan type that works best for you. No matter how you collect data, Maildoll pricing is simple, transparent and adapts to the size of your company.' }}
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7" id="pricing">

                @can('Admin')

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload6" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload6"></label>
                    </div>
                    <div class="avatar-preview w-706 h-530">
                        <div id="imagePreview6" class="liveImagePreview6" data-img="img6"
                            style="background-image: url({{ argonImagePath(argonContent('img6')) ?? asset('frontend/argon/assets/img/illustration-5.svg') }});">
                        </div>
                    </div>
                </div>

                @else
                <img class="img-fluid m-auto"
                    src="{{ argonContent('img6') != null ? argonImagePath(argonContent('img6')) : asset('frontend/argon/assets/img/illustration-5.svg') }}"
                    alt="Illustartion">

                @endcan


            </div>
        </div>
        <div class="row">

            @forelse (displaySubscriptions() as $plans)
            <div class="col-lg-4 mb-4 mb-lg-0 text-white mt-3">
                <div class="card card-body bg-white px-4 py-4 hover-translate-y hover-shadow">
                    <h2 class="font-weight-bold">{{ Str::upper($plans->name) }}</h2>
                    <p class="lead">{{ strip_tags($plans->description) }}</p>
                    <div class="d-flex align-items-center my-3">
                        <h4 class="h2">{{ formatPrice($plans->price) }}</h4>
                        <p class="mt-2 ml-2">{{ Str::upper($plans->name) }}</p>
                    </div>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-3">
                            <i class="ri-check-fill ri-xl text-white mr-2"></i>
                            <span>{{ $plans->duration }} @translate(Months)</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ri-check-fill ri-xl text-white mr-2"></i>
                            <span>{{ $plans->emails }} @translate(Emails)</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ri-check-fill ri-xl text-white mr-2"></i>
                            <span>{{ $plans->sms }} @translate(SMS)</span>
                        </li>
                    </ul>
                    <a href="{{ route('frontend.payment', [$plans->id, Str::slug($plans->name)]) }}"
                        class="btn btn-primary editable is-modified" data-cid="33"
                        tabindex="1">{{ argonContent(33) ?? 'Select' }}</a>
                </div>
            </div>
            @empty
            {{-- TODO --}}
            @endforelse

        </div>
    </div>
</section>
