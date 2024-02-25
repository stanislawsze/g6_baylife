<div>
    <div class="bg-white dark:bg-gray-800 rounded-3xl p-5 grid grid-rows-3 grid-flow-col gap-4">
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Début de service : {{ $startTime ?? 'Non démarré' }}
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Fin de service : {{ $endTime ?? 'En cours' }}
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Durée : <span id="timer">{{$duration ?? '00:00:00'}}</span>
        </div>
        <div>
            <label for="Toggle4" class="inline-flex items-center p-1 cursor-pointer dark:bg-gray-300 dark:text-gray-800">
                <input id="Toggle4" type="checkbox" class="hidden peer" wire:model="serviceType">
                <span class="px-4 py-2 dark:bg-gray-600 peer-checked:dark:bg-gray-300">Patrouille</span>
                <span class="px-4 py-2 dark:bg-gray-300 peer-checked:dark:bg-violet-400">Mission de sécurité</span>
            </label>
        </div>
        <div class="col-span-full sm:col-span-3">
            <label for="mission" class="text-sm">Mission</label>
            <input id="mission" wire:model="mission" type="text" placeholder="Nom de la mission" class="w-1/2 rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
        </div>
        <div>
            <button wire:click="startStopTimer" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                {{ $isRunning ? 'Arrêter' : 'Démarrer' }}
            </button>
        </div>

    </div>
    <div class="my-5 bg-white dark:bg-gray-800 rounded-3xl p-5" wire:poll.visible>
        @if($otherDuties->count() == 0)
            Pas d'agent en service
        @else
            <table class="min-w-full">
                <thead class="bg-white dark:bg-gray-800 border-b">
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Nom de l'agent en service
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Véhicule
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Type de service
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Mission
                </th>
                </thead>
                <tbody>
                @foreach($otherDuties as $od)
                    <tr class="bg-white dark:bg-gray-800 border-b transition duration-300 ease-in-out">
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{$od->user->global_name}}
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            To be defined
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{$od->service_type == 1 ? 'Mission de sécurité' : 'Patrouille'}}
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{$od->mission}}
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <button class="bg-blue-400 p-4" wire:click="joinDuty({{$od->id}})">Rejoindre la {{$od->service_type == 1 ? 'Mission de sécurité' : 'Patrouille'}}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="my-5 bg-white dark:bg-gray-800 rounded-3xl p-5">
        <h2 class="my-5">Mes prises de service</h2>
        <hr />

        <table class="min-w-full">
            <thead class="bg-white dark:bg-gray-800 border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Date du début de service
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Date de fin de service
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Temps de service
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Type de service
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Mission
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Prime
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($duties as $d)
                <tr class="bg-white dark:bg-gray-800 border-b transition duration-300 ease-in-out">
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{date('d/m/Y h:i', strtotime($d->starts_at))}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$d->stops_at ? date('d/m/Y h:i', strtotime($d->stops_at)) : 'En cours'}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$d->stops_at ? gmdate('H:i:s', $d->stops_at->diffInSeconds($d->starts_at)) : 'Service en cours' }}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$d->service_type == 1 ? 'Mission de sécurité' : 'Patrouille'}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$d->mission}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        1000$
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', function () {
            var timerInterval
            Livewire.on('startTimerInterval', function () {
                timerInterval = setInterval(function () {
                    Livewire.dispatch('refreshTimer');
                }, 1000);
            });

            Livewire.on('stopTimerInterval', function () {
                clearInterval(timerInterval);
            });

            Livewire.on('timerUpdated', function (duration) {
                var timerElement = document.getElementById('timer');
                if (timerElement) {
                    timerElement.textContent = duration;
                }
            });
        });
    </script>
@endpush
