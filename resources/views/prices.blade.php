<x-guest-layout>
    <div class="max-w-7xl mx-auto py-16 sm:px-6 lg:px-8">

        <x-guest-navigation/>

        <div class="pb-6 bg-white rounded">
            <div class="mt-8 max-w-screen-xl mx-auto py-6  px-4 sm:px-16 lg:px-20">

                <h3 class="font-black text-2xl text-gray-800 leading-tight m-4">{{ __('Our prices') }}</h3>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class=" overflow-hidden border-b border-gray-200 ">
                                <table class="min-w-full divide-y divide-green-400">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                            Car categories
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                            Exterior only
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                            Interior & Exterior
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 text-2xl font-bold">
                                                        S
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            Small cars
                                                        </div>
                                                        <div class="text-sm leading-5 text-gray-500">
                                                            e.g. Smart, Mini, Fiat500
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <span class="font-black">CHF 60.00</span> / 40 min*
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap ">
                                                <span class="font-black">CHF 110.00</span> / 80 min*
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 text-2xl font-bold">
                                                        M
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            Medium cars
                                                        </div>
                                                        <div class="text-sm leading-5 text-gray-500">
                                                            e.g. VW Golf, Ford Focus (most cars belong to this category)
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <span class="font-black">CHF 70.00</span> / 45 min*
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap ">
                                                <span class="font-black">CHF 130.00</span> / 90 min*
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 text-2xl font-bold">
                                                        L
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            Big cars
                                                        </div>
                                                        <div class="text-sm leading-5 text-gray-500">
                                                            e.g. SUV, VW Passat
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <span class="font-black">CHF 80.00</span> / 50 min*
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap ">
                                                <span class="font-black">CHF 150.00</span> / 100 min*
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 text-2xl font-bold">
                                                        XL
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            Extra-large cars
                                                        </div>
                                                        <div class="text-sm leading-5 text-gray-500">
                                                            e.g. transporter, minibus, minivan
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <span class="font-black">CHF 90.00</span> / 70 min*
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap ">
                                                <span class="font-black">CHF 165.00</span> / 120 min*
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="mt-2 text-sm text-gray-600">
                                *The durations above serve as an approximate estimation based on our experience.
                            </div>

                            <!-- TODO: use the global button instead of a -->
                            <div class="mt-5 flex items-center justify-end sm:px-6 ">
                                <a href="{{ route('bookings.create') }}"
                                   class="text-white px-4 py-2 bg-green-500 rounded-md ">Book
                                    a car cleaning</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
