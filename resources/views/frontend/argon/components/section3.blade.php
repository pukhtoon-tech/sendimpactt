<section class="space-3">
    <div class="container">
        <div class="w-100 w-lg-75 text-center mx-auto mb-5" id="features">
            <h2 class="font-weight-bold editable is-modified" data-cid="8" tabindex="1">
                {{ argonContent(8) ?? 'Maildoll was built to make your website development fast and easy.' }}</h2>
            <p class="lead mt-2 mb-4 editable is-modified" data-cid="9" tabindex="1">
                {{ argonContent(9) ?? 'Proactively envisioned cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration.' }}
            </p>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4  mb-4" data-aos="fade-up">
                <div class="bg-light px-4 py-4 hover-shadow hover-translate-y">

                    @can('Admin')

                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload2" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload2"></label>
                        </div>
                        <div class="avatar-preview w-338 h-261">
                            <div id="imagePreview2" class="liveImagePreview2" data-img="img2"
                                style="background-image: url({{ argonImagePath(argonContent('img2')) ?? asset('frontend/argon/assets/img/illustration-2.svg') }});">
                            </div>
                        </div>
                    </div>

                    @else
                    <img class="img-fluid m-auto"
                        src="{{ argonContent('img3') != null ? argonImagePath(argonContent('img3')) : asset('frontend/argon/assets/img/illustration-2.svg') }}"
                        alt="Illustartion">

                    @endcan

                    <h4 class="editable is-modified" data-cid="10" tabindex="1">
                        {{ argonContent(10) ?? 'Fully Responsive Fit With Any Device' }}</h4>
                    <p class="lead editable is-modified" data-cid="11" tabindex="1">
                        {{ argonContent(11) ?? 'Efficiently enable enabled sources and cost effective products.' }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4  mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-light px-4 py-4 hover-shadow hover-translate-y">


                    @can('Admin')

                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload3" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload3"></label>
                        </div>
                        <div class="avatar-preview w-338 h-261">
                            <div id="imagePreview3" class="liveImagePreview3" data-img="img3"
                                style="background-image: url({{ argonImagePath(argonContent('img3')) ?? asset('frontend/argon/assets/img/illustration-3.svg') }});">
                            </div>
                        </div>
                    </div>

                    @else
                    <img class="img-fluid m-auto"
                        src="{{ argonContent('img3') != null ? argonImagePath(argonContent('img3')) : asset('frontend/argon/assets/img/illustration-3.svg') }}"
                        alt="Illustartion">
                    @endcan

                    <h4 class="editable is-modified" data-cid="12" tabindex="1">
                        {{ argonContent(12) ?? 'Clean and Organized Code' }}</h4>
                    <p class="lead editable is-modified" data-cid="13" tabindex="1">
                        {{ argonContent(13) ?? 'Efficiently enable enabled sources and cost effective products.' }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4  mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-light px-4 py-4 hover-shadow hover-translate-y">


                    @can('Admin')

                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload4" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload4"></label>
                        </div>
                        <div class="avatar-preview w-338 h-261">
                            <div id="imagePreview4" class="liveImagePreview4" data-img="img4"
                                style="background-image: url({{ argonImagePath(argonContent('img4')) ?? asset('frontend/argon/assets/img/illustration-4.svg') }});">
                            </div>
                        </div>
                    </div>


                    @else
                    <img class="img-fluid m-auto"
                        src="{{ argonContent('img4') != null ? argonImagePath(argonContent('img4')) : asset('frontend/argon/assets/img/illustration-4.svg') }}"
                        alt="Illustartion">

                    @endcan

                    <h4 class="editable is-modified" data-cid="14" tabindex="1">
                        {{ argonContent(14) ?? 'Fast Performance Website' }}</h4>
                    <p class="lead editable is-modified" data-cid="15" tabindex="1">
                        {{ argonContent(15) ?? 'Efficiently enable enabled sources and cost effective products.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
