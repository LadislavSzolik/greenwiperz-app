<x-guest-layout>
    <x-guest-navigation />
    <main class="relative pt-16">
        @include('welcome.hero1')
        @include('welcome.features')
        @livewire('rating.show-ratings')
        <!-- BEFORE/AFTER -->
        <section>
            @livewire('show-work')
        </section>

    </main>
    <x-footer />
</x-guest-layout>
