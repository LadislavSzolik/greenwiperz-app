<footer class="footer bg-white relative pt-1 border-b-2">
    <div class="container mx-auto px-6">

        <div class="sm:flex sm:mt-8">
            <div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                <div class="flex flex-col">
                    <span class="font-bold text-gray-400 uppercase mb-2">{{ __('homepage.openingHours')}}</span>
                    <div class="table w-full">
                        <div class="table-row-group">
                            <div class="table-row">
                                <div class="table-cell text-gray-400 px-4 py-2 text-sm">{{ __('homepage.monday')}} - {{ __('homepage.friday')}}</div>
                                <div class="table-cell text-gray-400 px-4 py-2 text-sm">09:00 - 17:00</div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell text-gray-400 px-4 py-2 text-sm">{{ __('homepage.saturday')}}</div>
                                <div class="table-cell text-gray-400 px-4 py-2 text-sm">09:00 - 12:00</div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell text-gray-400 px-4 py-2 text-sm">{{ __('homepage.sunday')}}</div>
                                <div class="table-cell text-gray-400 px-4 py-2 text-sm">{{ __('homepage.closed')}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <span class="font-bold text-gray-400 uppercase mt-4 md:mt-0 mb-2">Contact</span>
                    <div class="text-sm text-gray-400 font-bold mb-2 mt-8">Tel.:{{ config('greenwiperz.company.telefon') }}</div>
                </div>

                <div class="flex flex-col">
                    <span class="font-bold text-gray-400 uppercase mt-4 md:mt-0 mb-2">Social connect</span>
                    <div class="mt-8 flex justify-center space-x-6">


                    <a href="https://www.facebook.com/Greenwiperz/" target="_blank" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                  d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                  clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/greenwiperz/" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                  d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                  clip-rule="evenodd" />
                        </svg>
                    </a>

                    <!--
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Youtube</span>

                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z" />
                        </svg>
                    </a>
        -->
                    <a href="https://www.linkedin.com/company/greenwiperz/" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">LinkedIn</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" id="Icons" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 100 100"
                             xml:space="preserve">
                    <path
                        d="M87.877 5.608H11.174c-3.673 0-6.65 2.886-6.65 6.448v77.101c0 3.562 2.978 6.451 6.65 6.451h76.703c3.673 0 6.646-2.89 6.646-6.451V12.056c0-3.561-2.973-6.448-6.646-6.448zM31.809 80.944H18.211V40.31h13.598v40.634zm-6.798-46.185h-.091c-4.56 0-7.516-3.119-7.516-7.023 0-3.983 3.043-7.017 7.693-7.017 4.651 0 7.512 3.033 7.602 7.017 0 3.905-2.95 7.023-7.688 7.023zm55.816 46.185H67.233v-21.74c0-5.464-1.97-9.191-6.886-9.191-3.761 0-5.993 2.515-6.973 4.942-.364.868-.453 2.08-.453 3.292v22.696H39.329s.178-36.823 0-40.634h13.593v5.761c1.805-2.768 5.029-6.717 12.249-6.717 8.947 0 15.656 5.804 15.656 18.291v23.3zM52.834 46.199c.024-.038.056-.084.088-.128v.128h-.088z" />
                </svg>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-6">
        <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
            <div class="sm:w-2/3 text-center py-6">
                <p class="text-sm text-gray-400 font-bold mb-2">
                    © 2021 by Greenwiperz - All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
