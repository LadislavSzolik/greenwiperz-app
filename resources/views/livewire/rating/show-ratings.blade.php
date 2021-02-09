<div>
    @if(count($ratings) > 0)
    <section class="my-24 bg-green-500">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="py-8 max-w-3xl mx-auto text-center">
                <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-white sm:text-5xl sm:leading-none text-center">
                    {{ __('What people tell about us?') }}
                </h2>
            </div>

            <div class="py-12 px-4 sm:px-6 md:grid md:grid-cols-3 md:py-10">
                @foreach($ratings as $rating)
                <blockquote class="mt-6 md:pr-16 md:flex-grow ">
                    <div class="relative text-lg font-medium text-white md:flex-grow">
                        <svg class="absolute top-0 left-0 transform -translate-x-3 -translate-y-2 h-8 w-8 text-green-400" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                        <p class="relative">
                            {{$rating->comment }}
                        </p>
                    </div>
                    <footer class="mt-4 sm:mt-8">
                        <div class="text-base font-medium text-white">{{ $rating->name_for_public }}</div>
                    </footer>
                </blockquote>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>