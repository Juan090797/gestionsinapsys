<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ComponenteBase extends Component
{
    use WithPagination;

    protected $pagination = 12;
    protected $paginationTheme = 'bootstrap';
}
