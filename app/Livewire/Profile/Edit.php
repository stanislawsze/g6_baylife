<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\ProfileForm;
use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public ProfileForm $profile;
    public $id;
    public $user;
    public function mount($id)
    {
        $this->user = User::find($id);
        $this->id = $id;
        $this->profile->setProfile(Employee::firstOrCreate(['user_id' => $id]));
    }
    public function render()
    {
        return view('livewire.profile.edit');
    }

    public function updated($name, $value)
    {
        $this->profile->save($this->id);
        switch($name)
        {
            case 'profile.phone':
                $name = 'Numéro de téléphone';
                break;
            case 'profile.birthday':
                $name = 'Date d\'anniversaire';
                break;
            case 'profile.origines':
                $name = 'Origines';
                break;
            case 'profile.pistolSN':
                $name = 'Numéro de série 9mm';
                break;
            case 'profile.shotgunSN':
                $name = 'Numéro de série Fusil à pompe';
                break;
            case 'profile.torchSN':
                $name = 'Numéro de série Torche';
                break;
            case 'profile.batonSN':
                $name = 'Numéro de série Matraque';
                break;
            case 'profile.tazerSN':
                $name = 'Numéro de série Tazer';
                break;
        }
        $this->dispatch('success', ['message' => 'Vous avez mis à jour : <b>'.$name.'</b> par <b>'.$value.'</b>']);
    }
}
