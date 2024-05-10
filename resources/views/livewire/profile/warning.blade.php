<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
           {{$user->warnings()->count()}} avertissement(s)
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Voici la liste des vos avertissements
            @can('manage', \App\Models\DiscordRole::class)
            <x-secondary-button wire:click="create">Ajouter un avertissement</x-secondary-button>
            @endcan
        </p>
    </header>

    <div class="my-5 bg-gray-800 text-gray-200 rounded-3xl p-5">
        @if($isCreating)
            <div class="flex my-4">
                <div class="grid grid-cols-6 gap-4 col-span-full lg:grid-cols-4">
                    <div class="col-span-full sm:col-span-1">
                        <x-input-label for="warning_content">Raison de l'avertissement</x-input-label>
                        <x-text-input id="warning_content" wire:model.blur="warning_content" placeholder="La maman de plokplok"></x-text-input>
                        <x-input-error :messages="$errors->get('warning_content')" />
                    </div>
                    <x-secondary-button wire:click="save">Ajouter l'avertissement</x-secondary-button>
                </div>
            </div>
        @endif
        <hr />
        <table class="min-w-full">
            <thead class="bg-gray-800 border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Date de l'avertissement
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Motif de l'avertissement
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Donné par
                </th>
                @can('manage', \App\Models\DiscordRole::class)
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Actions
                </th>
                @endcan
            </tr>
            </thead>
            <tbody>
                @foreach($warnings as $k => $warning)
                    <tr class="bg-gray-800 border-b transition duration-300 ease-in-out">
                        <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{date('d/m/Y', strtotime($warning['created_at']))}}
                        </td>
                        <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            @if($editId === $k)
                                <x-text-input wire:model.blur="warnings.{{$k}}.warning_content" />
                                <x-input-error :messages="$errors->get('warnings.'.$k.'.warning_content')" />
                            @else
                            {{$warning['warning_content']}}
                            @endif
                        </td>
                        <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            {{$warning['giver']['global_name']}}
                        </td>
                        @can('manage', \App\Models\DiscordRole::class)
                        <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <button class="text-red-500" wire:click="delete({{$warning['id']}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                            @if($editId === $k)
                                <button class="text-green-500" wire:click.prevent="updateWarn({{$k}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                            @else
                            <button class="text-blue-500" wire:click="edit({{$k}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>
                            @endif
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

