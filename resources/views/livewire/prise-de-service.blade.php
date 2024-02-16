<!-- resources/views/livewire/timer.blade.php -->

<div>
    <div class="inline-flex">
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Début de service : {{ $startTime ?? 'Non démarré' }}
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Fin de service : {{ $endTime ?? 'En cours' }}
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-200 p-1">
            Durée : <span id="timer">{{$duration ?? '00:00:00'}}</span>
        </div>
        <label>
            <input type="radio" wire:model="serviceType" value="0"> Patrouille
        </label>
        <label>
            <input type="radio" wire:model="serviceType" value="1"> Mission de sécurité
        </label>
        <button wire:click="startStopTimer" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            {{ $isRunning ? 'Arrêter' : 'Démarrer' }}
        </button>
    </div>

    <div class="my-5">
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
