<div class="mx-auto lg:grid lg:grid-cols-12 lg:gap-4">
  <div class="hidden lg:block lg:col-span-3">

      <!-- Previews -->
      <h3 class="text-sm font-semibold text-gray-600 mb-1">Matchup Previews</h3>

      @foreach ($previews as $preview)

          <div class="flex flex-col rounded-lg shadow-xl overflow-hidden mb-4">
              <div class="flex-shrink-0">
                  <img class="w-full h-16 object-cover object-center" src="{{ $preview->image }}" alt="">
              </div>
              <div class="flex-1 bg-white p-2 text-xs text-gray-700 flex flex-col justify-between">
                  <a href="{{ $preview->link }}" target="_blank" class="hover:font-semibold hover:text-gray-900">
                      {{ $preview->headline }}
                  </a>
              </div>
          </div>

      @endforeach

  </div>

  <!-- Stories -->
  <div class="lg:col-span-6">


      {{-- <div class="text-lg font-bold text-gray-600 mb-1">Headlines</div> --}}

      @foreach ($stories as $story)

          <div class="flex flex-col rounded-lg shadow-xl overflow-hidden mb-4">
              <div class="flex-shrink-0">
                  <img class="w-full object-cover object-top h-60" src="{{ $story->image }}" alt="">
              </div>
              <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                  <div class="flex-1">
                      <a href="{{ $story->link }}" target="_blank" class="block mt-2">
                          <p class="text-xl font-semibold text-gray-900">
                              {{ $story->headline }}
                          </p>
                          <p class="mt-3 text-base text-gray-500">
                              {{ $story->description }}s
                          </p>
                      </a>
                  </div>
                  <div class="mt-6 flex items-center">

                      <div class="ml-3">
                          <div class="flex space-x-1 text-sm text-gray-500">
                                {{ $story->published->diffForHumans() }}
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      @endforeach

  </div>

  <div class="hidden lg:block lg:col-span-3">

    <a href="http://promo.espn.com/collegegameday" target="_blank" class="flex flex-col mb-4 rounded-lg bg-slate-700 hover:bg-slate-900 text-white font-light tracking-wider px-4 py-2">
        <div class="flex flex-row items-center space-x-3">
            <img src="{{ secure_asset('img/cgd.png') }}" class="h-14 w-14"/>
            <div class="flex flex-col">
                <div class="flex flex-row items-center space-x-2">
                    <p class="text-lg font-semibold">College Gameday</p>
                    <x-heroicon-s-arrow-top-right-on-square class="h-4 w-4"/>
                </div>
                <p class="text-xs">Where will ESPN's College Gameday be this week?</p>
            </div>
        </div>
    </a>

        <!-- Headlines -->
        <div class="rounded-lg bg-white shadow-xl overflow-hidden mb-4">

        <h3 class="text-sm font-bold text-gray-600 mx-2 py-2 border-b border-gray-200">Top Headlines</h3>

            @foreach ($headlines as $headline)

                <div class="text-gray-700 px-3 py-2">
                    <a href="{{ $headline->link }}" target="_blank" class="flex text-xs font-light hover:font-semibold hover:text-blue-700">
                        {{ $headline->headline }}
                    </a>
                </div>

            @endforeach

        </div>

  </div>

</div>