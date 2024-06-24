<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Product details-Daraz Lite')]
class ProductDetailPage extends Component
{
    public $slug;

    public $quantity = 1;
    public function mount($slug){
        $this->slug = $slug;
    }


    public function increaseQty(){
        $this->quantity++;
    }

    public function decreaseQty(){
        if($this->quantity>1)
        $this->quantity--;
    }
    public function render()
    {

        return view('livewire.product-detail-page',[
            'product'=>Product::where('slug',$this->slug)->firstOrFail(),

        ]);
    }
}
