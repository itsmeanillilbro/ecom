<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $categories_select = [];


    #[Url]
    public $brands_select = [];
    public function render()
    {
        $products = Product::where('is_active', 1)->paginate(6);

        if (!empty($this->categories_select)) {
            $products->whereIn('category_id', $this->categories_select);
        }

        if (!empty($this->brands_select)) {
            $products->whereIn('brand_id', $this->brands_select);
        }

        return view('livewire.products-page', [
            'products' => $products,
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
        ]);
    }
}
