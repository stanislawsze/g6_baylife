<?php

namespace App\Livewire\Convoy;

use App\Models\Convoy;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    #[Url]
    public string $search = '';
    public string $column = 'name';

    /**
     * @return View
     */
    public function render(): View
    {
        $convoys = Convoy::search($this->search, $this->column)->paginate(15);
        return view('livewire.convoy.index', ['convoys' => $convoys]);
    }
}
