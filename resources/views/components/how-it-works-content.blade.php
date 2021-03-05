<section class="bg-white" id="how-it-works">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6"
         x-data="{ openTab: 'booking',
                   activeClasses: 'text-white bg-green-600',
                   inactiveClasses: 'text-green-600 bg-white'
                  }" >
        <div class="w-full">
            <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row" role="tablist">
                <li @click="openTab = 'booking'" class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a :class="openTab === 'booking' ? activeClasses : inactiveClasses"
                        class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal"
                       data-toggle="tab" href="#booking" role="tablist"><i class="fas fa-space-shuttle text-base mr-1"></i> Booking</a>
                </li>
                <li @click="openTab = 'cleaning'" class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a :class="openTab === 'cleaning' ? activeClasses : inactiveClasses"
                        class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal"
                        data-toggle="tab" href="#cleaning" role="tablist"><i class="fas fa-cog text-base mr-1"></i> Cleaning</a></li>
            </ul>
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="px-4 py-5 flex-auto">
                    <div class="tab-content tab-space">
                        <div x-show="openTab === 'booking'" id="booking-tab">

                            <div class="mb-8">
                                <h2  class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                                    {{ __('how.howWorksMainTitle') }}
                                </h2>
                            </div>
                            <div class="mb-8 mx-auto flex justify-center text-gray-500 md:w-3/5 md:px-10 text-2xl">
                                {{ __('homepage.howWorksParagrph1') }}
                            </div>


                            <div class="flex flex-wrap">
                                <div class="prose prose-lg text-gray-500 w-full sm:w-2/5">
                                    <ol>
                                        <li><span class="font-extrabold">Register</span><div class="">@lang('how.howRegister')</div></li>
                                        <li><span class="font-extrabold">Order</span><div class="">@lang('how.howOrder')</div></li>
                                        <li><span class="font-extrabold">Pay</span><div class="">@lang('how.howPay')</div></li>
                                        <li><span class="font-extrabold">We get to your car and start to work</span><div class="">@lang('how.howStart')</div></li>
                                        <li><span class="font-extrabold">Confirmation</span><div class="">@lang('how.howConfirm')</div></li>
                                        <li><span class="font-extrabold">Rate US</span><div class="">@lang('how.howRate')</div></li>
                                    </ol>
                                </div>
                                <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-8">
                                    <img class="shadow-2xl h-48 sm:h-80 rounded-lg" src="{{ asset('img/howitworks/how-it-works-biker.jpg') }}" alt="Cleaning" />
                                </div>
                            </div>
                        </div>
                        <div x-show="openTab === 'cleaning'" id="cleaning-tab">

                            <div class="mb-8 max-w-2xl mx-auto">
                                <h2  class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                                    {{ __('homepage.howNanotechMainTitle') }}
                                </h2>
                            </div>
                            <div class="mb-8 mx-auto flex justify-center text-gray-500 sm:w-3/5 sm:px-10 text-2xl">
                                {{ __('homepage.howNanotechTitle2') }}
                            </div>


                            <div class="flex flex-wrap">
                                <div class="flex justify-center w-full sm:w-2/5 px-2 sm:px-0 mt-6 mb-8">
                                    <img class="shadow-2xl h-48 sm:h-64 rounded" src="{{ asset('img/howitworks/how-it-works-nano.jpg') }}"
                                         alt="Cleaning" />
                                </div>
                                <div class="prose prose-lg text-gray-500 text-left w-full sm:w-3/5">
                                    <ul>
                                        <li>{!! __('homepage.howNanotechParagrph1') !!} </li>
                                        <li>{!! __('homepage.howNanotechParagrph2') !!} </li>
                                        <li>{!! __('homepage.howNanotechParagrph3') !!} </li>
                                        <li>{!! __('homepage.howNanotechParagrph4') !!} </li>
                                        <li>{!! __('homepage.howNanotechParagrph5') !!} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- EXCLUDED -->
<section class="bg-white">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6">
        <div class="mb-8 max-w-2xl mx-auto text-center">
            <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none ">
                {{ __('homepage.exclConditionMainTitle') }}
            </h2>
        </div>
        <div class="prose prose-lg text-gray-500 mx-auto text-center">
            {{ __('homepage.exclConditionParagrph1') }}
        </div>
    </div>
</section>
