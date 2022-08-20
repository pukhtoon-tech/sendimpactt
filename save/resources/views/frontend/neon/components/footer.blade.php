<footer id="footer" class="iq-footer dark-bg">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="footer-top text-center">
								<div class="row">
									<div class="col-lg-12 col-md-12 iq-rmb-50">
										<div class="logo w-25 m-auto">
											<a href="{{ route('frontend.index') }}" class=""><img class="img-fluid w-60 m-auto" alt="{{ orgName() }}" src="{{ footerLogo() }}" alt="{{ orgName() }}"></a>
											<div class="iq-font-black mb-4 mt-4">
												@translate(Copyright) © {{ date('Y') }} {{ orgName() }}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				
				<!-- back-to-top -->
				<div id="back-to-top">
					<a class="top" id="top" href="#top"> <i class="ion-ios-upload-outline"></i> </a>
				</div>
				<!-- back-to-top End -->
			</footer>