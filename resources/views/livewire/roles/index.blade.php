<div class="flex">
    <div class="w-full justify-between">
        <button wire:click="getDiscordRoles" wire:loading.class="opacity-50" class="px-2 rounded-2xl border border-blue-300 hover:bg-blue-300 hover:text-white">Récupèrer les rôles discord</button>
    </div>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">
                    Rôle
                </th>
                <th>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $r)
                <tr>
                    <td>
                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium text-black border bg-white"><span class="border border-1 p-1 rounded-full mr-2"  style="background: #{{dechex($r->role_color)}}"></span>{{$r->role_name}}</span>
                    </td>
                    <td class="flex">
                        <button wire:click="edit({{$r->id}})" class="w-1/2 text-sm bg-blue-500 text-white justify-end px-1 py-0.5 rounded-md mx-2">Editer</button>
                        <button wire:click="delete({{$r->id}})" class="w-1/2 text-sm bg-red-600 text-white justify-end px-1 py-0.5 rounded-md mx-2">Supprimer le rôle</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
