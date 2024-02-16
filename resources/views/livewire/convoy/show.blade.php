<div>
    <button {{$convoy->is_finished ? 'disabled' : ''}} wire:click="startStopConvoy({{$convoy->id}})" class="{{$convoy->is_finished ? 'bg-red-400' : 'bg-green-500'}} {{$convoy->is_started && !$convoy->is_finished ?? 'bg-red-500'}} rounded border p-1">{{$convoy->is_started ? 'Mettre fin au convoi' : 'Lancer le convoi'}}</button>
    <button wire:click="addVehicleToConvoy({{$convoy->id}})">Ajouter un véhicule</button>
    <label for="vehicles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Véhicules</label>
        <select id="vehicles" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach($vehicles as $v)
                <option value="{{$v->id}}">{{$v->name}} - {{$v->plate}}</option>
            @endforeach
        </select>

    <table>
        <thead>
            <td>Nom de l'agent</td>
            <td>Présence</td>
        </thead>
        <tbody>
            @foreach($convoy->users as $user)
                <tr>
                    <td>{{$user->global_name}}</td>
                    <td>Ok</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
