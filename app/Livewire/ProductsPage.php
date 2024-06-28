<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Header;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - Prakriti Store')]
class ProductsPage extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Url]
    public $categories_select = [];


    #[Url]
    public $brands_select = [];

    #[Url]
    public $is_featured = [];

    #[Url]
    public $sort = 'latest';
    public $pricee = 300000;

    //   public function isProductInCart($product_id)
    // {
    //     $cart_items = CartManagement::getCartItemsFromCookie();
    //     foreach ($cart_items as $item) {
    //         if ($item['product_id'] == $product_id) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    public function addToCart($product_id) {
        // if ($this->isProductInCart($product_id)) {

        //   $this->alert('info', 'Product already in your cart!', [
        //     'position' => 'top-end',
        //     'toast' => true,
        //     'timer' => 3000
        //   ]);
        // } else {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

          $total_count = CartManagement::addItemsToCart($product_id);
          $this->dispatch('update-cart-count', total_count:$total_count)->to(Header::class);
          $this->alert('success', 'Product added successfully', [
            'position' => 'top-start',
            'toast' => true,
            'timerProgressBar' => true,
            'timer' => 3000,
          ]);
        // }
      }


       public function render()
    {
        $products = Product::query()->where('is_active', 1);

        if (!empty($this->categories_select)) {
            $products->whereIn('category_id', $this->categories_select);
        }

        if (!empty($this->brands_select)) {
            $products->whereIn('brand_id', $this->brands_select);
        }

        if (!empty($this->is_featured)) {
            $products->where('is_featured', 1);
        }

        if (!empty($this->pricee)) {
            $products->whereBetween('price', [0, $this->pricee]);
        }

        if ($this->sort == 'latest') {
            $products->latest();
        }

        if ($this->sort == 'price') {
            $products->orderBy('price');
        }

        return view('livewire.products-page', [
            'products' => $products->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
        ]);
    }
}
