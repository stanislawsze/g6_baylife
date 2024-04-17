<div>
    <div class="my-5 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-3xl p-5">
        <div class="my-5 flex justify-between">
            <div class="">
                <h2>Liste des webhooks</h2>
            </div>
            <div class="">
                <x-secondary-button wire:click="create">Créer un webhook</x-secondary-button>
            </div>
        </div>
        @if($inCreation)
            <div class="flex my-4">
                <div class="grid grid-cols-6 gap-4 col-span-full lg:grid-cols-4">
                    <div class="col-span-full sm:col-span-1">
                        <x-input-label for="name">Nom du Webhook</x-input-label>
                        <x-text-input id="name" wire:model.blur="name" placeholder="La maman de plokplok"></x-text-input>
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <x-input-label for="discord_webhook">Lien du webhook</x-input-label>
                        <x-text-input id="discord_webhook" wire:model.blur="discord_webhook" placeholder="https://discord.com"></x-text-input>
                        <x-input-error :messages="$errors->get('discord_webhook')" />
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <x-input-label for="discord_channel_id">ID Channel Discord</x-input-label>
                        <x-text-input id="discord_channel_id" wire:model.blur="discord_channel_id" placeholder="123456789"></x-text-input>
                        <x-input-error :messages="$errors->get('discord_channel_id')" />
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <x-input-label for="discord_category_id">Date du convoi</x-input-label>
                        <x-text-input id="discord_category_id" wire:model.blur="discord_category_id" placeholder="123456789"></x-text-input>
                        <x-input-error :messages="$errors->get('discord_category_id')" />
                    </div>
                    <x-secondary-button wire:click="save">Créer le webhook</x-secondary-button>
                </div>
            </div>
        @endif
        <hr />
        <table class="min-w-full">
            <thead class="bg-white dark:bg-gray-800 border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Nom du webhook
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    Lien du webhook
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                   ID Catégorie du webhook
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                    ID Channel du webhook
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($webhooks as $k => $wb)
                <tr class="bg-white dark:bg-gray-800 border-b transition duration-300 ease-in-out">
                    @if($editId === $k)

                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <x-text-input wire:model.blur="webhooks.{{$k}}.name"></x-text-input>
                            <x-input-error :messages="$errors->get('webhooks.'.$k.'.name')" />
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <x-text-input wire:model.blur="webhooks.{{$k}}.discord_webhook"></x-text-input>
                            <x-input-error :messages="$errors->get('webhooks.'.$k.'.discord_webhook')" />
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <x-text-input wire:model.blur="webhooks.{{$k}}.discord_category_id"></x-text-input>
                            <x-input-error :messages="$errors->get('webhooks.'.$k.'.discord_category_id')" />
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <x-text-input wire:model.blur="webhooks.{{$k}}.discord_channel_id"></x-text-input>
                            <x-input-error :messages="$errors->get('webhooks.'.$k.'.discord_channel_id')" />
                        </td>
                        <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                            <button wire:click.prevent="updateWebhook({{$k}})" class="w-1/2 text-sm bg-green-500 text-white justify-end px-1 py-0.5 rounded-md mx-2">Sauvegarder</button>
                            <button wire:click="delete({{$wb['id']}})" class="w-1/2 text-sm bg-red-600 text-white justify-end px-1 py-0.5 rounded-md mx-2">Supprimer</button>
                        </td>
                    @else
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$wb['name']}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$wb['discord_webhook'] ?? 'Pas d\'url'}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$wb['discord_category_id'] ?? 'Pas d\'ID Catégorie'}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$wb['discord_category_id'] ?? 'Pas d\'ID Channel'}}
                    </td>
                    <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        <button wire:click="edit({{$k}})" class="w-1/2 text-sm bg-blue-500 text-white justify-end px-1 py-0.5 rounded-md mx-2">Editer</button>
                        <button wire:click="delete({{$wb['id']}})" class="w-1/2 text-sm bg-red-600 text-white justify-end px-1 py-0.5 rounded-md mx-2">Supprimer</button>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
