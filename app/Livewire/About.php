<?php

namespace App\Livewire;

use App\Models\Teams;
use Livewire\Component;
use Livewire\Attributes\Title;
 #[Title('About - ARB Advisors')]

class About extends Component
{

    public function render()
    {
        return view('livewire.about',[
            'about'=>\App\Models\About::where('status','published')->first(),

        ]);
    }
}
