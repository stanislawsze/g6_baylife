<div>
    <div class="bg-white dark:bg-gray-800 rounded-3xl p-5 grid grid-cols-3 gap-4">
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Début de service : {{ $startTime ?? 'Non démarré' }}
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Fin de service : @if($startTime) {{ $endTime ?? 'En cours' }} @else Non démarré @endif
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Durée : <span id="timer">{{$duration ?? '00:00:00'}}</span>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-3xl p-5 my-4 dark:text-gray-200">
        <div class="grid grid-cols-3 gap-4 my-4">
            <div>
                Type de mission
                <label for="Toggle4" class="rounded-3xl inline-flex items-center p-1 cursor-pointer bg-g6-3 text-gray-800 dark:text-gray-200">
                    <input id="Toggle4" type="checkbox" class="hidden peer" wire:model="serviceType">
                    <span class="px-4 py-2 bg-g6-2 peer-checked:bg-g6-3 rounded-3xl text-white">Patrouille</span>
                    <span class="px-4 py-2 bg-g6-3 peer-checked:bg-g6-2 rounded-3xl text-white">Mission de sécurité</span>
                </label>
                <x-input-error :messages="$errors->get('serviceType')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="mission">Mission</x-input-label>
                <x-text-input id="mission" wire:model="mission" placeholder="Nom de la mission"></x-text-input>
                <x-input-error :messages="$errors->get('mission')" class="mt-2" />
            </div>
            <div>
                <label for="vehicles">Choix du véhicule</label>
                <select id="vehicles" wire:model.change="vehicleTaken" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option value="">Sélectionner un véhicule</option>
                    @foreach($vehicles as $v)
                        <option value="{{$v->id}}">{{$v->name}} ({{$v->plate}})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('vehicleTaken')" class="mt-2" />
            </div>
        </div>
        <div class="w-full flex justify-center">
            <button wire:click="startStopTimer" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                {{ $isRunning ? 'Arrêter' : 'Démarrer' }}
            </button>
        </div>
    </div>
    <div class="my-5 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-3xl p-5" wire:poll.visible>
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
                            {{$od->vehicle->name}} ({{$od->vehicle->plate}})
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{$od->service_type == 1 ? 'Mission de sécurité' : 'Patrouille'}}
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{$od->mission}}
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            @if($isRunning)
                                <button class="bg-blue-400 p-4">Tu es déjà en service !</button>
                            @else
                                <button class="bg-blue-400 p-4" wire:click="joinDuty({{$od->id}})">Rejoindre la {{$od->service_type == 1 ? 'Mission de sécurité' : 'Patrouille'}}</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="my-5 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-3xl p-5">
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
                        {{$d->salary}} $
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
