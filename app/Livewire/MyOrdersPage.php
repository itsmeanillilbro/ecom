<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
#[Title('Orders - DarazLite')]
class MyOrdersPage extends Component
{
    use WithPagination;
    public function render()
    {
        $orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(6);
        return view('livewire.my-orders-page',['orders'=>$orders]);
    }
}
