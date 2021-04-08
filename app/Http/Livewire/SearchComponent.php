<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount(){
        $this->sorting = "delault";
        $this->pagesize = 12;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
    }
    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        //xắp xếp
        if ($this->sorting== 'date'){
            $products = Product::where('name', 'like', '%'.$this->search.'%')->where('category_id', 'like', '%'.$this->product_cat_id.'%')->orderBy('created_at', 'desc')->paginate($this->pagesize);
        }elseif ($this->sorting== 'price'){
            $products = Product::where('name', 'like', '%'.$this->search.'%')->where('category_id', 'like', '%'.$this->product_cat_id.'%')->orderBy('regular_price', 'asc')->paginate($this->pagesize);
        }
        elseif ($this->sorting== 'price-desc'){
            $products = Product::where('name', 'like', '%'.$this->search.'%')->where('category_id', 'like', '%'.$this->product_cat_id.'%')->orderBy('regular_price', 'desc')->paginate($this->pagesize);
        }else{
            $products = Product::where('name', 'like', '%'.$this->search.'%')->where('category_id', 'like', '%'.$this->product_cat_id.'%')->paginate($this->pagesize);
        }
        //end xắp xếp
        //sản phẩm theo danh mục

        $categories = Category::all();

        //$products = Product::paginate(12);
        return view('livewire.search-component', [
            'products'=>$products,
            'categories'=>$categories
        ])->layout("layouts.base");
    }
}

