  <textarea id="log" class="form-control d-none"></textarea>

  <!-- Modal HTML -->
    <div class="modal fade" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body">

                <div class="mb-3">
                    <label for="prince-text">- Text</label>
                    <p class="editable is-modified border p-2" id="prince-text" data-cid="" tabindex="1"> 
                        {{-- Value --}}
                    </p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-primary" data-dismiss="modal">Save changes</button>
            </div>
            </div>
        </div>
    </div>

  <script src="{{ asset('frontend/argon/assets/js/jquery.min.js') }}"></script>
  <!-- Popper -->
  <script src="{{ asset('frontend/argon/assets/js/popper.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('frontend/argon/assets/js/bootstrap.min.js') }}"></script>
  <!-- SVG Inject -->
  <script src="{{ asset('frontend/argon/assets/js/svg-inject.min.js') }}"></script>
  <!-- AOS (Animate On Scroll) -->
  <script src="{{ asset('frontend/argon/assets/js/aos.min.js') }}"></script>
  <!-- Medium Zoom -->
  <script src="{{ asset('frontend/argon/assets/js/medium-zoom.min.js') }}"></script>
  <!-- Plyr - HTML5, YouTube and Vimeo media player -->
  <script src="{{ asset('frontend/argon/assets/js/plyr.min.js') }}"></script>
  <!-- Swiper - Touch Slider -->
  <script src="{{ asset('frontend/argon/assets/js/swiper.min.js') }}"></script>
  <!-- Waypoints -->
  <script src="{{ asset('frontend/argon/assets/js/jquery.waypoints.min.js') }}"></script>
  <!-- Counterup -->
  <script src="{{ asset('frontend/argon/assets/js/counterup.min.js') }}"></script>
  <!-- Notify -->
  <script src="{{ asset('frontend/argon/assets/js/jquery.toast.min.js') }}"></script>
  <!-- Maildoll -->
  <script src="{{ asset('frontend/argon/assets/js/findeas.js') }}"></script>

  <script src="{{ asset('frontend/argon/assets/js/main.js') }}"></script>

  <script src="{{ filePath('bladejs/google-translate.js') }}"></script>

{{-- //version 4.3.0 --}}

<script>
    $('.prince').on('click', function() {
    var cid = $(this).attr('data-cid');
    var value = $(this).attr('data-content');

    $('#prince-text').attr('data-cid', cid);
    $('#prince-text').text(value);

    $("#myModal").modal('show');


    });
</script>

@auth
      
    @can('Admin')
        
        <script type="text/javascript">
    
            // Editable
            function Editable(sel, options) {
                if (!(this instanceof Editable)) return new Editable(...arguments);

                const attr = (EL, obj) => Object.entries(obj).forEach(([prop, val]) => EL.setAttribute(prop, val));

                Object.assign(this, {
                    onStart() {},
                    onInput() {},
                    onEnd() {},
                    classEditing: "is-editing", // added onStart
                    classModified: "is-modified", // added onEnd if content changed
                }, options || {}, {
                    elements: document.querySelectorAll(sel),
                    element: null, // the latest edited Element
                    isModified: false, // true if onEnd the HTML content has changed
                });

                const start = (ev) => {
                    this.isModified = false;
                    this.element = ev.currentTarget;
                    this.element.classList.add(this.classEditing);
                    this.text_before = ev.currentTarget.textContent;
                    this.html_before = ev.currentTarget.innerHTML;
                    this.onStart.call(this.element, ev, this);
                };

                const input = (ev) => {
                    this.text = this.element.textContent;
                    this.html = this.element.innerHTML;
                    this.isModified = this.html !== this.html_before;
                    this.element.classList.toggle(this.classModified, this.isModified);
                    this.onInput.call(this.element, ev, this);
                }

                const end = (ev) => {
                    this.element.classList.remove(this.classEditing);
                    this.onEnd.call(this.element, ev, this);
                }

                this.elements.forEach(el => {
                    attr(el, {
                        tabindex: 1,
                        contenteditable: true
                    });
                    el.addEventListener("focusin", start);
                    el.addEventListener("input", input);
                    el.addEventListener("focusout", end);
                });

                return this;
            }

            // Use like:
            Editable(".editable", {
                onEnd(ev, UI) { // ev=Event UI=Editable this=HTMLElement
                    if (!UI.isModified) return; // No change in content. Abort here.
                    const data = {
                        cid: this.dataset.cid,
                        text: this.textContent, // or you can also use UI.text
                    }

                    var obj = {
                    cid: data.cid,
                    text: data.text,
                    };

                    $.ajax({
                        type: "GET",
                        url: "{{ route('frontend.json.editor') }}",
                        data: obj,
                        success: function(res) {
                            $.toast({
                                heading: 'Success',
                                text: 'Successfully updated',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'top-right',
                            });
                        }
                    });
                }
            });

        </script>

        <script>
            
            for (let index = 1; index < 8; index++) {
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#imagePreview' + index).css('background-image', 'url('+ e.target.result +')');
                            $('#imagePreview' + index).hide();
                            $('#imagePreview' + index).fadeIn(650);
                            var dataImg = $('.liveImagePreview' + index).attr('data-img');

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                            type: 'POST',
                            url: '{{ route("frontend.json.upload") }}',
                            data: {
                                cid: dataImg,
                                text: e.target.result
                            },
                            success: function(data) {
                                $.toast({
                                    heading: 'Success',
                                    text: 'Successfully uploaded',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    position: 'top-right',
                                });
                            }
                            });

                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#imageUpload" + index).change(function() {
                    readURL(this);
                });
            }
            
        </script>

    @endcan
  
@endauth

  {{-- //version 4.3.0::ENDS --}}

