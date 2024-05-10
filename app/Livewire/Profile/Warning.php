<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Warning as Averto;
use Livewire\Component;

class Warning extends Component
{
    public $id;
    public $user;
    public $warnings = [];
    public $editId;
    public $isCreating = false;
    public $warning_content = null;

    protected $rules = [
        'warnings.*.warning_content' => 'required',
        'warning_content' => 'required',
    ];

    protected $messages = [
        'warnings.*.warning_content.required' => 'Raison obligatoire',
        'warning_content.required' => 'Raison obligatoire',
    ];
    public function mount($id)
    {
        $this->id = $id;
        $this->user = User::find($id);
        $this->warnings = Averto::with('giver')->where('user_id', $id)->get()->toArray();
    }
    public function render()
    {
        return view('livewire.profile.warning');
    }

    public function create()
    {
        $this->isCreating = !$this->isCreating;
    }

    public function save()
    {
        $this->validateOnly('warning_content');
        Averto::create([
            'user_id' => $this->id,
            'warning_content' => $this->warning_content,
            'giver_id' => auth()->user()->id
        ]);
        $this->dispatch('success', ['message' => 'Avertissement ajouté avec succès']);
        $this->mount($this->id);
        $this->isCreating = false;
        $this->warning_content = null;
    }
    public function delete($id)
    {
        $warning = Averto::find($id);
        $warning->delete();
        $this->dispatch('success', ['message' => 'Avertissement retiré avec succès']);
        $this->mount($this->id);
    }

    public function edit($id)
    {
        $this->editId = $id;
    }

    public function updateWarn($id)
    {
        $this->validateOnly('warnings.'.$id.'.warning_content');
        $warning = $this->warnings[$id] ?? NULL;
        if(!is_null($warning))
        {
            $editedWarning = Averto::find($warning['id']);
            $editedWarning->update($warning);
            $this->dispatch('success', ['message' => 'Avertissement mis à jour']);
            $this->mount($this->id);
            $this->editId = null;
        }
    }
}
