<div >
    <div class="rounded-3xl p-4 bg-white dark:bg-gray-800 my-2">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <li>Nom du client : {{$convoy->name}}</li>
            </div>
            <div>
                <li>Montant à convoyer : ${{number_format($convoy->convoy_amount, 2, ',', ' ')}}</li>
            </div>
            <div>
                <li>Prime par agent : @if($convoy->users->count() > 0) ${{number_format(($convoy->convoy_amount/2)/$convoy->users->count(), 2, ',', ' ')}} @else $0 @endif</li>
            </div>
            <div>
                <button wire:click="getAgentOnConvoy" class="bg-g6 text-white p-1 rounded">Mettre à jour la liste des agents</button>
                <button {{$convoy->is_finished ? 'disabled' : ''}} wire:click="startStopConvoy({{$convoy->id}})" class="{{$convoy->is_finished ? 'bg-red-400' : 'bg-green-500'}} {{$convoy->is_started && !$convoy->is_finished ?? 'bg-red-500'}} rounded border p-1">{{$convoy->is_started ? 'Mettre fin au convoi' : 'Lancer le convoi'}}</button>
            </div>
            <div>
                @if(auth()->user()->hasEntryInConvoyTable($convoy->id))
                <x-secondary-button disabled wire:click="joinConvoy({{$convoy->id}})">
                    Rejoindre le convoi
                </x-secondary-button>
                @else
                    <x-secondary-button wire:click="joinConvoy({{$convoy->id}})">
                        Rejoindre le convoi
                    </x-secondary-button>
                @endif
            </div>
        </div>
    </div>
    <div class="flex gap-4">
        <div class="w-2/3">
            <div class="rounded-3xl p-4 bg-white dark:bg-gray-800 my-2">
                <div class="grid grid-cols-6 gap-4" wire:sortable="updatePosition" wire:sortable.options="{ animation: 100 }">
                    @foreach($convoy->config as $c)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg" wire:sortable.item="{{$c->id}}" wire:key="config-{{$c->id}}" wire:sortable.handle>
                            <img class="w-full" src="{{asset($c->vehicle->image)}}" alt="{{$c->vehicle->name}}">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{$c->vehicle->plate}}</div>
                                    @foreach($c->getUserFromVehicle as $u)
                                    <div class="rounded overflow-hidden shadow-lg bg-white dark:bg-gray-500">
                                        <div class="text-sm text-center" style="background:#{{dechex($u->user->getRole->first()->roles->role_color)}}">
                                            {{$u->user->getRole->first()->roles->role_name}}
                                        </div>
                                        <div>
                                            {{$u->user->global_name}}
                                        </div>
                                        <button wire:click="deleteFromVeh({{$u->id}})" class="w-full text-sm bg-red-600 text-white justify-end">Retirer du véhicule</button>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="my-2 rounded-3xl p-4 bg-white dark:bg-gray-800">
                <table class="min-w-full">
                    <thead class="bg-white dark:bg-gray-800 border-b">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                            Nom de l'agent
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                            Présence
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                            Véhicule
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                            Montant prime
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($convoy->users as $user)
                        <tr class="bg-white dark:bg-gray-800 border-b transition duration-300 ease-in-out">
                            <td>
                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1
                                text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mr-2"
                                ><span class="border border-1 p-1 rounded-full mr-1"  style="background: #{{dechex($user->getRole->first()->roles->role_color)}}"></span>{{$user->getRole->first()->roles->role_name}}</span>{{$user->global_name}}</td>
                            <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                @if($user->getCurrentConvoyCancellation($convoy->id))
                                    Indisponible / Raison : {{$user->getCurrentConvoyCancellation($convoy->id)->cancellation_reason}}
                                @else
                                    Présent
                                @endif
                            </td>
                            <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                @if($convoy->userVehicle($user->id))
                                    <select disabled id="vehicles" class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @foreach($vehicles as $v)
                                            <option value="{{$v->id}}"
                                                    @if($convoy->userVehicle($user->id)->vehicle_id == $v->id)
                                                        selected
                                                    @endif>
                                                {{$v->name}} - {{$v->plate}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                <select wire:change="updateUserVehicle('{{$user->id}}')" wire:model.change="vehicleId" id="vehicles" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($vehicles as $v)
                                        <option value="{{$v->id}}">{{$v->name}} - {{$v->plate}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </td>
                            <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                <x-text-input wire:model.blur="userSalary['{{$user->id}}']"></x-text-input>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-1/3">
            <div class="rounded-3xl p-4 bg-white dark:bg-gray-800 my-2 fixed">
                <div class="col-span-full sm:col-span-3 my-2">
                    <x-input-label for="nightNumber">Nombre de Nightshark</x-input-label>
                    <x-text-input id="nightNumber" wire:model.blur="nbreNightshark" placeholder="0"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3 my-2">
                    <x-input-label for="stockNumber">Nombre de Stockade</x-input-label>
                    <x-text-input id="stockNumber" wire:model.blur="nbreStockade" type="number" placeholder="0"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3 my-2">
                    <x-input-label for="u2rNumber">Nombre d'U.2.R</x-input-label>
                    <x-text-input  id="u2rNumber" wire:model.blur="nbreU2R" placeholder="0"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3 my-2">
                    <x-input-label for="name">Nom du convoi</x-input-label>
                    <x-text-input  id="name" wire:model.blur="convoyName" placeholder="ALTA DE TES MORTS"></x-text-input>
                </div>
                <div class="col-span-full sm:col-span-3 my-2">
                    <x-input-label for="date">Date du convoi</x-input-label>
                    <input id="date" wire:model.blur="startAt" type="datetime-local" placeholder="{{now()}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
                <div class="col-span-full sm:col-span-3 my-2">
                    <x-input-label for="amount">Montant du convoi</x-input-label>
                    <x-text-input id="amount" wire:model.blur="convoyAmount" placeholder="0"></x-text-input>
                </div>
                <x-secondary-button wire:click="update({{$convoy->id}})">Mettre à jour le convoi</x-secondary-button>
            </div>
        </div>
    </div>

</div>
