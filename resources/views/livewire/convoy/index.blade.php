<div class="dark:bg-gray-800 p-4 rounded">
    <div class="flex justify-between">
        <div class="flex">
            <select wire:model.change="column" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="name">Nom du convoi</option>
                <option value="start_at">Date du convoi</option>
            </select>
            @if($column == "start_at")
                <input type="date" wire:model.change="search" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @else
                <x-text-input wire:model.live="search" placeholder="Recherche"></x-text-input>
            @endif
        </div>
        <div>
            <x-secondary-button wire:click="createConvoy">Créer un convoi</x-secondary-button>
        </div>
    </div>
    @if($isCreating)
        <div class="flex my-4">
            <div class="grid grid-cols-6 gap-4 col-span-full lg:col-2">
                <div class="col-span-full sm:col-span-3">
                    <x-input-label for="nightNumber">Nombre de Nightshark</x-input-label>
                    <x-text-input id="nightNumber" wire:model.blur="convoyCreateForm.nightNumber" placeholder="0"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3">

                    <x-input-label for="stockNumber">Nombre de Stockade</x-input-label>
                    <x-text-input id="stockNumber" wire:model.blur="convoyCreateForm.stockNumber" placeholder="0"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <x-input-label for="u2rNumber">Nombre d'U.2.R</x-input-label>
                    <x-text-input id="u2rNumber" wire:model.blur="convoyCreateForm.u2rNumber" placeholder="0"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <x-input-label for="name">Nom du convoi</x-input-label>
                    <x-text-input id="name" wire:model.blur="convoyCreateForm.name" placeholder="ALTA DE TES MORTS"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <x-input-label for="date">Date du convoi</x-input-label>
                    <input id="date" wire:model.blur="convoyCreateForm.startsAt" type="datetime-local" placeholder="{{now()}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
                <div class="col-span-full sm:col-span-3">
                    <x-input-label for="amount">Montant du convoi</x-input-label>
                    <x-text-input id="amount" wire:model.blur="convoyCreateForm.amount" placeholder="0"></x-text-input>
                </div>
                <x-secondary-button wire:click="create">Créer le convoi</x-secondary-button>
            </div>
        </div>
    @endif
    <table class="min-w-full">
        <thead class="bg-white dark:bg-gray-800 border-b">
        <tr>
            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                Date du convoi
            </th>
            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                Statut du convoi
            </th>
            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                Nombre d'agents
            </th>
            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($convoys as $c)
            <tr class="bg-white dark:bg-gray-800 border-b transition duration-300 ease-in-out">
                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                    {{date('d/m/Y H:i', strtotime($c->start_at))}}
                </td>
                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                    @if($c->is_finished)
                        Terminé
                    @else
                        {{$c->is_started ? 'En cours' : 'Non débuté'}}
                    @endif
                </td>
                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                    {{$c->users->count()}}
                </td>
                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                    <a href="{{route('convoy.show', ['convoy' => $c])}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$convoys->links()}}
</div>
