<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Header;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product details - Prakriti Store')]
class ProductDetailPage extends Component
{
    public $name;
    use LivewireAlert;
    public $quantity = 1;
    public function mount($name)
    {
        $this->name = $name;
    }


    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1)
            $this->quantity--;
    }
    public function render()
    {

        return view('livewire.product-detail-page', [
            'product' => Product::where('name', $this->name)->firstOrFail(),

        ]);
    }

    public function isProductInCart($product_id)
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        foreach ($cart_items as $item) {
            if ($item['product_id'] == $product_id) {
                return true;
            }
        }
        return false;
    }

    public function addToCart($product_id)
    {
        // if ($this->isProductInCart($product_id)) {

        //     $this->alert('info', 'Product already in your cart!', [
        //         'position' => 'top-end',
        //         'toast' => true,
        //         'timerProgressBar' => true,
        //         'timer' => 3000,
        //     ]);
        // } else {

            $total_count = CartManagement::addItemsToCartWithQuantity($product_id, $this->quantity);
            $this->dispatch('update-cart-count', total_count: $total_count)->to(Header::class);
            $this->alert('success', 'Product added successfully', [
                'position' => 'top-start',
                'toast' => true,
                'timerProgressBar' => true,
                'timer' => 3000,
            ]);
        // }
    }

}
