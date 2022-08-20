<section class="space-5">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-7" data-aos="fade-left">


                @can('Admin')

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload1" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload1"></label>
                    </div>
                    <div class="avatar-preview h-537 w-716">
                        <div id="imagePreview1" class="liveImagePreview1" data-img="img1"
                            style="background-image: url({{ argonImagePath(argonContent('img1')) ?? asset('frontend/argon/assets/img/illustration-1.svg') }});">
                        </div>
                    </div>
                </div>

                @else
                <img class="img-fluid m-auto"
                    src="{{ argonContent('img1') != null ? argonImagePath(argonContent('img1')) : asset('frontend/argon/assets/img/illustration-1.svg') }}"
                    alt="Illustartion">
                @endcan

            </div>
            <div class="col-lg-5" data-aos="fade-right">
                <div class="position-relative">

                    <h1 class="font-weight-bold mt-3 editable is-modified" data-aos="fade-up" data-aos-delay="100"
                        data-cid="1" tabindex="1" data-content="{{ argonContent(1) ?? 'Grow up your business with Maildoll Landing Page.' }}">
                        {{ argonContent(1) ?? 'Grow up your business with Maildoll Landing Page.' }}
                    </h1>

                    <p class="lead editable is-modified mt-3 mb-3" data-aos="fade-up" data-aos-delay="200"
                        data-aos="fade-up" data-aos-delay="100" data-cid="2" tabindex="1" data-content="{{ argonContent(2) ?? 'The simplest and fastest way to build website for saas, software & startup.' }}">
                        {{ argonContent(2) ?? 'The simplest and fastest way to build website for saas, software & startup.' }}
                    </p>
                
                    <!-- Button trigger modal -->
                    @auth
                        
                    @can('Admin')

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
                        {{ argonContent(3) ?? 'Get started' }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade h-auto" id="exampleModal3" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                
                                <div class="mb-3">
                                    <p class="editable is-modified border p-2"
                                        data-cid="3"
                                        tabindex="1">
                                        {{ argonContent(3) ?? 'Get started' }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p class="editable is-modified border p-2"
                                        data-cid="1003"
                                        tabindex="1">
                                        {{ argonContent(1003) ?? '#pricing' }}
                                    </p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-sm btn-primary" data-dismiss="modal">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                        
                    @endcan

                    @else

                    <a  href="{{ argonContent(1003) ?? '#pricing' }}" 
                        class="btn btn-primary" 
                        data-aos="fade-up"
                        data-aos-delay="300" 
                        data-cid="3"
                        tabindex="1">
                        {{ argonContent(3) ?? 'Get started' }}
                    </a>

                    @endauth

                </div>
            </div>
        </div>
    </div>
</section>
