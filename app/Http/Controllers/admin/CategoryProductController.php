<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Product};
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $repository, $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
        $this->middleware(['can:products']);
    }



    public function categories($idProduct)
    {

        $product = $this->product->find($idProduct);

        if (!$product) {
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }

    public function products($idCategory)
    {
        $category = $this->category->find($idCategory);

        if (!$category) {
            return redirect()->back();
        }
        $products = $category->products()->paginate();

        return view('admin.pages.category.products.products', compact('products', 'category'));
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {

        $product = $this->product->find($idProduct);

        if (!$product) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }

    public function attachCategoriesProduct(Request $request, $idProduct)
    {
        $product = $this->product->find($idProduct);

        if (!$product) {
            return redirect()->back();
        }

        if (!$request->categories || count($request->categories) == 0) {
            return redirect()->back()->with('messageWarning', 'Precisa escolher pelo menos uma permissão');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id)->with('messageSuccess', 'Vinculado com sucesso');
    }

    public function detachCategoriesProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category) {
            return redirect()->back()->with('messageDanger', 'Não encontrado');
        }

        $product->categories()->detach($category);
        return redirect()->route('products.categories', $product->id)->with('messageSuccess', 'Desvinculado com sucesso');
    }
}
