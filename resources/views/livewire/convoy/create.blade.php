<div class="grid grid-cols-6 gap-4 col-span-full lg:col-2">
    <div class="col-span-full sm:col-span-3">
        <label for="nightNumber" class="text-sm">Nombre de Nightshark</label>
        <input id="nightNumber" wire:model.blur="nightNumber" type="number" placeholder="2" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
    </div>
    <div class="col-span-full sm:col-span-3">
        <label for="stockNumber" class="text-sm">Nombre de Stockade</label>
        <input id="stockNumber" wire:model.blur="stockNumber" type="number" placeholder="2" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
    </div>
    <div class="col-span-full sm:col-span-3">
        <label for="u2rNumber" class="text-sm">Nombre d'U.2.R</label>
        <input id="u2rNumber" wire:model.blur="u2rNumber" type="number" placeholder="2" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
    </div>
    <div class="col-span-full sm:col-span-3">
        <label for="name" class="text-sm">Nom du convoi</label>
        <input id="name" wire:model.blur="name" type="text" placeholder="ALTA DE TES MORTS" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
    </div>
    <div class="col-span-full sm:col-span-3">
        <label for="date" class="text-sm">Date du convoi</label>
        <input id="date" wire:model.blur="startsAt" type="datetime-local" placeholder="{{now()}}" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
    </div>
    <div class="col-span-full sm:col-span-3">
        <label for="amount" class="text-sm">Montant du convoi</label>
        <input id="amount" wire:model.blur="amount" type="number" placeholder="2" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
    </div>
    <button wire:click="create" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
        Créer le convoi
    </button>
</div>
