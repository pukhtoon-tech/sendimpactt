<footer class="space-3 pb-4 bg-primary-3 text-white link-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-lg-4">
          <p class="lead text-white editable is-modified" data-cid="59" tabindex="1">{{ argonContent(59) ?? 'Get Findeas updates. No spam and We will never share your email address.' }}</p>
          <form id="newsletter">
            <div class="input-group mb-3">
              <input type="email" 
              name="email" 
              id="email"
              class="form-control" 
              placeholder="Your email" 
              required>
              <input type="hidden" id="subscription_url" value="{{ route('new.subscription') }}">
              <div class="input-group-append align-items-center">
                <button id="newsletterBtnSubmit" 
                        class="btn btn-primary rounded-right"
                        type="submit">Send</button>
                <button id="newsletterBtnSending" 
                        class="btn btn-primary d-none" 
                        type="button" 
                        disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  <span class="sr-only">Loading...</span>
                </button>
              </div>
            </div>
      </div>
      <div class="col-lg-8 col-12 mt-5 mt-lg-0">
        <span class="mailldoll-text-logo">{{ orgName() }}</span>
  </div>
      <div class="row pb-0">
      
              
                <div class="row flex-column flex-lg-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="col-auto">
                        <div class="d-flex flex-column flex-sm-row align-items-center text-small">
                            <div>
                                <small>Copyright &copy; {{ Carbon\Carbon::now()->year }} {{ orgName() }}, <span
                                        class="editable is-modified" data-cid="60" tabindex="1">
                                        {{ argonContent(60) ?? 'All right reserved. Coded and Design with Love.' }}</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto mt-3 mt-lg-0">
                        <ul class="list-unstyled d-flex mb-0 mt-2 link-white">
                            <li class="mx-3">
                                <a href="{{ org('twitter') }}" class="text-decoration-none" aria-label="Twitter">
                                    <i class="ri-twitter-fill ri-lg"></i>
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="{{ org('linkedin') }}" class="text-decoration-none" aria-label="Linkedin">
                                    <i class="ri-linkedin-fill ri-lg"></i>
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="{{ org('skype') }}" class="text-decoration-none" aria-label="Skype">
                                    <i class="ri-skype-fill ri-lg"></i>
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="{{ org('facebook') }}" class="text-decoration-none" aria-label="Facebook">
                                    <i class="ri-facebook-fill ri-lg"></i>
                                </a>
                            </li>

                            <li>
                                <div id="google_translate_element"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
</footer>
