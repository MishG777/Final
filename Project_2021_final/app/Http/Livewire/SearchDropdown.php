<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search='';
    public function render()
    {
        $searchResults= Post::where('name','like', '%'.$this->search.'%')->get();
        return view('livewire.search-dropdown', [
            'searchResults'=>collect($searchResults)->take(7),
        ]);
    }
}
