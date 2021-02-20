<!-- lg+ -->
<div class="py-8 sm:py-16">
  <div class="pb-8">
    <h2 class="text-3xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-4xl sm:leading-none text-center">
      Service details</h2>
  </div>

  <div class="max-w-2xl mx-auto lg:hidden">

    <div class="px-4">
      <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('pricespage.exterior') }}</h3>
    </div>
    <table class="mt-4 w-full">
      <caption class="bg-gray-50 border-t border-gray-200 py-3 px-4 text-sm font-medium text-gray-900 text-left">
        {{ __('pricespage.services') }}
      </caption>
      <tbody class="divide-y divide-gray-200">
        <x-prices.tr-sm-service :name="__('pricespage.handwash')" />
        <x-prices.tr-sm-service :name="__('pricespage.handPolish')" />
        <x-prices.tr-sm-service :name="__('pricespage.nanoWaxSealer')" />
        <x-prices.tr-sm-service :name="__('pricespage.cleaningAndCareOfExternalPlasticParts')" />
        <x-prices.tr-sm-service :name="__('pricespage.tankCapCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.windowCleaningOutsideIncludingSunroof')" />
        <x-prices.tr-sm-service :name="__('pricespage.rimsCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.tireCare')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.internalVacuuming')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.carpetCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.cleaningAndMaintenanceOfAllFittingsIncludingDoorPanels')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.frontAndCenterConsoleCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.windowCleaningInside')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.thresholdCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.doorRabbetsAndThresholdCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.leatherCleaningAndCare')" />
      </tbody>
    </table>

    <div class="px-4 mt-16">
      <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('pricespage.intexteriorBasic') }}</h3>
    </div>
    <table class="mt-4 w-full">
      <caption class="bg-gray-50 border-t border-gray-200 py-3 px-4 text-sm font-medium text-gray-900 text-left">
        {{ __('pricespage.services') }}
      </caption>
      <tbody class="divide-y divide-gray-200">
        <x-prices.tr-sm-service :name="__('pricespage.handwash')" />
        <x-prices.tr-sm-service :name="__('pricespage.handPolish')" />
        <x-prices.tr-sm-service :name="__('pricespage.nanoWaxSealer')" />
        <x-prices.tr-sm-service :name="__('pricespage.cleaningAndCareOfExternalPlasticParts')" />
        <x-prices.tr-sm-service :name="__('pricespage.tankCapCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.windowCleaningOutsideIncludingSunroof')" />
        <x-prices.tr-sm-service :name="__('pricespage.rimsCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.tireCare')" />
        <x-prices.tr-sm-service :name="__('pricespage.internalVacuuming')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.carpetCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.cleaningAndMaintenanceOfAllFittingsIncludingDoorPanels')" />
        <x-prices.tr-sm-service :name="__('pricespage.frontAndCenterConsoleCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.windowCleaningInside')" />
        <x-prices.tr-sm-service :name="__('pricespage.thresholdCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.doorRabbetsAndThresholdCleaning')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.leatherCleaningAndCare')" />
      </tbody>
    </table>

    <div class="px-4 mt-16">
      <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('pricespage.intexteriorPremium') }}</h3>
    </div>
    <table class="mt-4 w-full">
      <caption class="bg-gray-50 border-t border-gray-200 py-3 px-4 text-sm font-medium text-gray-900 text-left">
        {{ __('pricespage.services') }}
      </caption>
      <tbody class="divide-y divide-gray-200">
        <x-prices.tr-sm-service :name="__('pricespage.handwash')" />
        <x-prices.tr-sm-service :name="__('pricespage.handPolish')" />
        <x-prices.tr-sm-service :name="__('pricespage.nanoWaxSealer')" />
        <x-prices.tr-sm-service :name="__('pricespage.cleaningAndCareOfExternalPlasticParts')" />
        <x-prices.tr-sm-service :name="__('pricespage.tankCapCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.windowCleaningOutsideIncludingSunroof')" />
        <x-prices.tr-sm-service :name="__('pricespage.rimsCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.tireCare')" />
        <x-prices.tr-sm-service :name="__('pricespage.internalVacuuming')" />
        <x-prices.tr-sm-service :name="__('pricespage.carpetCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.cleaningAndMaintenanceOfAllFittingsIncludingDoorPanels')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.frontAndCenterConsoleCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.windowCleaningInside')" />
        <x-prices.tr-sm-service :included="false" :name="__('pricespage.thresholdCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.doorRabbetsAndThresholdCleaning')" />
        <x-prices.tr-sm-service :name="__('pricespage.leatherCleaningAndCare')" />
      </tbody>
    </table>

  </div>

  <div class="hidden md:block">
    <table class="w-full h-px table-fixed divide-y divide-green-400">
      <thead>
        <tr>
          <th class="w-2/5 pb-4 px-6 text-xs leading-4 font-medium text-green-700 uppercase tracking-wider text-left" scope="col">{{ __('pricespage.services') }}</th>
          <th class="w-1/5 pb-4 px-6 text-xs leading-4 font-medium text-green-700 uppercase tracking-wider text-left" scope="col">{{ __('pricespage.exterior') }}</th>
          <th class="w-1/5 pb-4 px-6 text-xs leading-4 font-medium text-green-700 uppercase tracking-wider text-left" scope="col">{{ __('pricespage.intexteriorBasic') }}</th>
          <th class="w-1/5 pb-4 px-6 text-xs leading-4 font-medium text-green-700 uppercase tracking-wider text-left" scope="col">{{ __('pricespage.intexteriorPremium') }}</th>
        </tr>
      </thead>

      <tbody class="border-t border-gray-200 divide-y divide-gray-200">
        <!-- By default all features are included -->
        <x-prices.tr-lg-service :name="__('pricespage.handwash')" />
        <x-prices.tr-lg-service :name="__('pricespage.handPolish')" />
        <x-prices.tr-lg-service :name="__('pricespage.nanoWaxSealer')" />
        <x-prices.tr-lg-service :name="__('pricespage.cleaningAndCareOfExternalPlasticParts')" />
        <x-prices.tr-lg-service :name="__('pricespage.tankCapCleaning')" />
        <x-prices.tr-lg-service :name="__('pricespage.windowCleaningOutsideIncludingSunroof')" />
        <x-prices.tr-lg-service :name="__('pricespage.rimsCleaning')" />
        <x-prices.tr-lg-service :name="__('pricespage.tireCare')" />
        <!-- from here only interior features -->
        <x-prices.tr-lg-service :col1Included="false" :name="__('pricespage.internalVacuuming')" />
        <x-prices.tr-lg-service :col1Included="false" :col2Included="false" :name="__('pricespage.carpetCleaning')" />
        <x-prices.tr-lg-service :col1Included="false" :col2Included="false" :name="__('pricespage.cleaningAndMaintenanceOfAllFittingsIncludingDoorPanels')" />
        <x-prices.tr-lg-service :col1Included="false" :col3Included="false" :name="__('pricespage.frontAndCenterConsoleCleaning')" />
        <x-prices.tr-lg-service :col1Included="false" :name="__('pricespage.windowCleaningInside')" />
        <x-prices.tr-lg-service :col1Included="false" :col3Included="false" :name="__('pricespage.thresholdCleaning')" />
        <x-prices.tr-lg-service :col1Included="false" :col2Included="false" :name="__('pricespage.doorRabbetsAndThresholdCleaning')" />
        <x-prices.tr-lg-service :col1Included="false" :col2Included="false" :name="__('pricespage.leatherCleaningAndCare')" />
      </tbody>
    </table>
  </div>
</div>