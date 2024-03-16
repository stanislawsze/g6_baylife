<?php

namespace App\Livewire\Convoy;

use App\Livewire\Forms\ConvoyCreateForm;
use App\Models\Convoy;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public ConvoyCreateForm $convoyCreateForm;
    #[Url]
    public string $search = '';
    public string $column = 'name';
    public $isCreating = false;
    /**
     * @return View
     */
    public function render(): View
    {
        $convoys = Convoy::search($this->search, $this->column)->paginate(15);
        return view('livewire.convoy.index', ['convoys' => $convoys]);
    }

    public function createConvoy()
    {
        $this->isCreating = !$this->isCreating;
    }

    public function create()
    {
        $this->convoyCreateForm->save();
    }
}
