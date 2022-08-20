<section class="space-1 mb-5">
    <div class="container bg-primary-3 text-white px-5 py-5 rounded-lg">
        <div class="text-center w-lg-75 mx-auto py-5">
            <h2 class="editable is-modified" data-cid="47" tabindex="1">
                {{ argonContent(47) ?? 'Ready to launch? Buy Maildoll now.' }}</h2>
            <p class="lead mt-4 editable is-modified" data-cid="48" tabindex="1">
                {{ argonContent(48) ?? 'Ideal for Sass, Software & Startup Landing Page. Save your development time with Maildoll Landing Page Template.' }}
            </p>
            

            @auth
                
            @can('Admin')

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal49">
                        {{ argonContent(49) ?? 'Buy Package Now' }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal49" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                
                                <div class="mb-3">
                                    <p class="editable is-modified border p-2 text-dark text-left"
                                        data-cid="49"
                                        tabindex="1">
                                        {{ argonContent(49) ?? 'Buy Package Now' }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p class="editable is-modified border p-2 text-dark text-left"
                                        data-cid="10049"
                                        tabindex="1">
                                        {{ argonContent(10049) ?? '#pricing' }}
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

                    <a href="{{ argonContent(10049) ?? '#pricing' }}" class="d-inline-flex align-items-center btn btn-primary mt-4"
                        data-cid="49" tabindex="1">
                        {{ argonContent(49) ?? 'Buy Package Now' }}
                        <i class="ri-arrow-right-line ri-lg ml-2"></i>
                    </a>

                    @endauth


        </div>
    </div>
</section>
