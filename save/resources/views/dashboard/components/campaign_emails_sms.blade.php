<div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
            <div class="report-box">
                <div class="box p-5">
                    <div class="flex">
                       
                        @translate(Total Emails) - {{ totalSentMail() }}
                        <br>
                        @translate(Left Emails) - {{ emailLeftCount() }}

                        <div class="ml-auto">

                            <div>
                                <div id="chart-emails2"></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="text-base text-gray-600 mt-1">@translate(Campaign Email Usage)</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
            <div class="report-box">
                <div class="box p-5">
                    <div class="flex">
                        
                        @translate(Total SMS) - {{ totalSMSSent() }}
                        <br>
                        @translate(Left SMS) - {{ smsLeftCount() }}

                        <div class="ml-auto">

                            <div>
                                <div id="chart-sms2"></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="text-base text-gray-600 mt-1">@translate(Campaign SMS Usage)</div>
                </div>
            </div>
        </div>
    </div>