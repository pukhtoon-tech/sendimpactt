
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ orgName() }}</title>

        <!-- favicon -->
        <link
            rel="icon"
            href="{{ logo() }}"
            sizes="16x16"
            type="image/png"
        />

        <!-- Stylesheet Link -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/invoice/style.css') }}" media="all"/>
     
<style>

        </style>

    </head>
    <body class="t-bg-white">
        <div class="fk-print t-pt-30 t-pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       
                        <span class="d-block fk-print-text fk-print-text--bold text-uppercase fk-print__title text-center">
                            {{ orgName() }}
                        </span>

                  
                        <p class="mb-0 xsm-text fk-print-text text-center text-capitalize">
                            {{ orgAddress() }}
                        </p>

                        <p class="mb-0 xsm-text fk-print-text text-center text-capitalize">
                            call: {{ orgPhone() }}
                        </p>

                        <hr>

                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            @translate(invoice no): #{{ $details->invoice }}
                        </p>

                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            @translate(date): {{ $details->date }}
                        </p>

                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            client name: {{ getUser($details->user_id)->name ?? null }}
                        </p>

                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            @translate(client email): {{ getUser($details->user_id)->email ?? null }}
                        </p>

                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            @translate(client address): {{ getUser($details->user_id)->personal->address ?? null }}
                        </p>


                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr>
                                  <th scope="col" class="fk-print-text fk-print-text--bold sm-text text-capitalize">@translate(plan)</th>
                                  <th scope="col" class="fk-print-text fk-print-text--bold sm-text text-capitalize text-center">@translate(qty)</th>
                                  <th scope="col" class="fk-print-text fk-print-text--bold sm-text text-capitalize text-right">@translate(price)</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                                <tr>
                                  <th class="fk-print-text xsm-text text-capitalize">
                                      <span class="d-block">
                                          {{ Str::upper(planDetails($details->plan_id)->name) }} @translate(plan)
                                      </span>
                                  </th>
                                  <td class="fk-print-text xsm-text text-capitalize text-center">@translate(1)</td>
                                  <td class="fk-print-text xsm-text text-capitalize text-right">{{ $details->price }}</td>
                                </tr>
                            
                            </tbody>
                        </table>



                        <hr class="m-0">
                        <table class="table mb-0 table-borderless">
                            <tbody>
                                <tr>
                                  <th class="fk-print-text xsm-text text-capitalize">
                                      <span class="d-block">
                                          @translate(total)
                                      </span>
                                  </th>
                                  <td class="fk-print-text xsm-text text-capitalize text-right">{{ $details->price }}</td>
                                </tr>
                            </tbody>
                        </table>
                   
                      
                  
                        <hr class="mt-0">
                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            prepared by: {{ orgName() }}
                        </p>
                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            payment method: {{ Str::upper($details->gateway) }}
                        </p>
                        <p class="mb-0 xsm-text fk-print-text text-capitalize">
                            staus: {{ $details->status == 1 ? 'PAID' : 'NOT PAID' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>


    


</html>


