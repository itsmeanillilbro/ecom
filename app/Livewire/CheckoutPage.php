<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

class CheckoutPage extends Component
{
    #[Title('Checkout - Daraz Lite')]

    public $first_name, $last_name, $phone, $address, $city, $state, $zip_code, $payment_method;


    public function placeOrder(){
        $this->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'state'=> 'required',
            'zip_code'=> 'required',
            'payment_method'=> 'required',
        ]);
    }
    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::grandTotal($cart_items);

        return view('livewire.checkout-page',[
            'cart_items'=>$cart_items,
            'grand_total'=>$grand_total
        ]);
    }
}
