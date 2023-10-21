<div class="rounded-lg bg-white shadow px-4 py-3">

    <h2 class="text-slate-700 font-semibold text-sm">{{ $conference['header'] }}</h2>

    @if(isset($conference['divisions']))

        @foreach ($conference['divisions'] as $div)

            <h3 class="text-slate-700 font-light uppercase text-xs mt-4">{{ $div['header'] }}</h3>

            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                  <tr class="text-xs font-semibold text-gray-800">
                    <th scope="col" class="text-left py-2.5">TEAM</th>
                    <th scope="col" class="text-right py-2.5">CONF</th>
                    <th scope="col" class="text-right py-2.5">OVRL</th>
                  </tr>
                </thead>
                <tbody class="bg-white">

                    @foreach ($div['standings']['entries'] as $team)

                        <tr class="even:bg-gray-100 text-xs {{ in_array($team['id'], $teams) ? 'font-semibold text-gray-700' : 'font-normal text-gray-500' }}">
                            <td class="whitespace-nowrap py-1.5">
                                <a href="/teams/{{ $team['id'] }}" class="text-blue-700 hover:underline">{{$team['team'] }}</a>
                            </td>
                            <td class="whitespace-nowrap py-1.5 text-right">
                                {{ $team['stats'][1]['displayValue'] }}
                            </td>
                            <td class="whitespace-nowrap py-1.5 text-right">
                                {{ $team['stats'][1]['displayValue'] }}
                            </td>
                        </tr>
        
                    @endforeach
    
                </tbody>
            </table>
            
        @endforeach

    @else

      <table class="min-w-full divide-y divide-gray-300 mt-3">
        <thead>
          <tr class="text-xs font-semibold text-gray-800">
            <th scope="col" class="text-left py-2.5">TEAM</th>
            <th scope="col" class="text-right py-2.5">CONF</th>
            <th scope="col" class="text-right py-2.5">OVRL</th>
          </tr>
        </thead>
        <tbody class="bg-white">

            @foreach ($conference['standings']['entries'] as $team)

                <tr class="even:bg-gray-100 text-xs {{ in_array($team['id'], $teams) ? 'font-semibold text-gray-700' : 'font-normal text-gray-500' }}">
                    <td class="whitespace-nowrap py-1.5">
                        <a href="/teams/{{ $team['id'] }}" class="text-blue-700 hover:underline">{{$team['team'] }}</a>
                    </td>
                    <td class="whitespace-nowrap py-1.5 text-right">
                        {{ $team['stats'][1]['displayValue'] }}
                    </td>
                    <td class="whitespace-nowrap py-1.5 text-right">
                        {{ $team['stats'][1]['displayValue'] }}
                    </td>
                </tr>

            @endforeach

        </tbody>
      </table>

    @endif

</div>