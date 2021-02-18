<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white">
  <div class="max-w-7xl mx-auto bg-white py-8 sm:py-16 sm:px-6 lg:px-8">

    <!-- lg+ -->
    <div class="hidden lg:block">
      <table class="w-full h-px table-fixed">
        <thead>
          <tr>
            <th class="pb-4 px-6" scope="col"></th>
            <th class="w-1/4 pb-4 px-6 text-lg leading-6 font-medium text-gray-900 text-left" scope="col">{{ __('pricespage.exterior') }}</th>
            <th class="w-1/4 pb-4 px-6 text-lg leading-6 font-medium text-gray-900 text-left" scope="col">{{ __('pricespage.intexteriorBasic') }}</th>
            <th class="w-1/4 pb-4 px-6 text-lg leading-6 font-medium text-gray-900 text-left" scope="col">{{ __('pricespage.intexteriorPremium') }}</th>
          </tr>
        </thead>

        <tbody class="border-t border-gray-200 divide-y divide-gray-200">
          <tr>
            <th class="bg-gray-50 py-3 pl-6 text-sm font-medium text-gray-900 text-left" colspan="4" scope="colgroup">{{ __('pricespage.services') }}</th>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.handwash') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.handPolish') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.nanoWaxSealer') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">

              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">

              <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              <span class="sr-only">Included in Premium</span>
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.cleaningAndCareOfExternalPlasticParts') }}.</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.tankCapCleaning') }}.</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.windowCleaningOutsideIncludingSunroof') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.rimsCleaning') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.tireCare') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <!-- from here only interior features -->

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.internalVacuuming') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.carpetCleaning') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">

              <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              <span class="sr-only">Included in Premium</span>
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.cleaningAndMaintenanceOfAllFittingsIncludingDoorPanels') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.frontAndCenterConsoleCleaning') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.windowCleaningInside') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.thresholdCleaning') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.doorRabbetsAndThresholdCleaning') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

          <tr>
            <th class="py-5 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ __('pricespage.leatherCleaningAndCare') }}</th>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.minus />
            </td>
            <td class="py-5 px-6">
              <x-heroicons.green-tick />
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>