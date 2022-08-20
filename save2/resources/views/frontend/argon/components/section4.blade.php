<section class="space-3" id="about">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <h2 class="display-4 font-weight-bold text-primary counter editable is-modified" data-aos="fade-up"
                    data-cid="18" tabindex="1">{{ argonContent(18) ?? '52,147' }}</h2>
                <h2 class="font-weight-bold editable is-modified" data-aos="fade-up" data-aos-delay="100" data-cid="54"
                    tabindex="1">{{ argonContent(54) ?? 'Companies grow up and success by using our services.' }}</h2>
                <p class="lead mt-2 mb-4 editable is-modified" data-aos="fade-up" data-aos-delay="200" data-cid="19"
                    tabindex="1">
                    {{ argonContent(19) ?? 'Quickly aggregate B2B users and worldwide potentialities. Progressively plagiarize resource-leveling e-commerce through resource-leveling core competencies. Dramatically mesh low-risk high-yield alignments before transparent e-tailers.' }}
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">


                @can('Admin')

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload5" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload5"></label>
                    </div>
                    <div class="avatar-preview w-601 h-451">
                        <div id="imagePreview5" class="liveImagePreview5" data-img="img5"
                            style="background-image: url({{ argonImagePath(argonContent('img5')) ?? asset('frontend/argon/assets/img/illustration-6.svg') }});">
                        </div>
                    </div>
                </div>

                @else
                <img class="img-fluid m-auto"
                    src="{{ argonContent('img5') != null ? argonImagePath(argonContent('img5')) : asset('frontend/argon/assets/img/illustration-6.svg') }}"
                    alt="Illustartion">

                @endcan


            </div>
        </div>

        <div class="row justify-content-around align-items-center space-5 pb-0">
            <div class="col-lg-6" data-aos="flip-right">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div
                            class="card card-body bg-primary-2 text-white hover-shadow-lg hover-translate-y py-4 px-4 mb-4">
                            <h2 class="h1 pt-5 mb-0"><span class="counter editable is-modified" data-cid="20"
                                    tabindex="1">{{ argonContent(20) ?? '5200' }}</span>+</h2>
                            <p class="lead pb-5 mb-0 editable is-modified" data-cid="21" tabindex="1">
                                {{ argonContent(21) ?? 'Companies Engaged' }}</p>
                        </div>
                        <div class="card card-body hover-shadow-lg hover-translate-y py-4 px-4">
                            <h2 class="h1 pt-5 mb-0"><span class="counter editable is-modified" data-cid="22"
                                    tabindex="1">{{ argonContent(22) ?? '95' }}</span>%</h2>
                            <p class="lead pb-5 mb-0 editable is-modified" data-cid="23" tabindex="1">
                                {{ argonContent(23) ?? 'Happy Customers' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-body hover-shadow-lg hover-translate-y py-4 px-4 mt-4 mb-4">
                            <h2 class="h1 pt-5 mb-0"><span class="counter editable is-modified" data-cid="24"
                                    tabindex="1">{{ argonContent(24) ?? '99' }}</span>%</h2>
                            <p class="lead pb-5 mb-0 editable is-modified" data-cid="25" tabindex="1">
                                {{ argonContent(25) ?? 'Project Success' }}</p>
                        </div>
                        <div class="card card-body hover-shadow-lg hover-translate-y py-4 px-4">
                            <h2 class="h1 pt-5 mb-0"><span class="counter editable is-modified" data-cid="26"
                                    tabindex="1">{{ argonContent(26) ?? '6100' }}</span>+</h2>
                            <p class="lead pb-5 mb-0 editable is-modified" data-cid="27" tabindex="1">
                                {{ argonContent(27) ?? 'Projects Complete' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-4 mt-md-0" data-aos="fade-right">
                <h2 class="display-4 font-weight-bold text-primary counter editable is-modified" data-cid="28"
                    tabindex="1">{{ argonContent(28) ?? '25' }}</h2>
                <h2 class="font-weight-bold editable is-modified" data-cid="29" tabindex="1">
                    {{ argonContent(29) ?? 'Years experience.' }}</h2>
                <p class="lead mt-2 mb-4 editable is-modified" data-cid="30" tabindex="1">
                    {{ argonContent(30) ?? 'Compellingly embrace empowered e-business after user friendly intellectual capital. Interactively actualize front-end processes with effective convergence.' }}
                </p>
            </div>
        </div>
    </div>
</section>
