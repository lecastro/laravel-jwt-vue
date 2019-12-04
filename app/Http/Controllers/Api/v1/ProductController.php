<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $product;
    private $totPag = 10;
    private $pathUpload = 'producs';

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = $this->product->getResults($request->all(), $this->totPag);
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = kebab_case($request->name);
            $extension = $request->image->extension();
            $fileName = "{$name}.{$extension}";
            $data['image'] = $fileName;
            $upload = $request->image->storeAs("{$this->pathUpload}", $fileName);
            if (!$upload) {
                return response()->json(['error' => 'fail upload'], 500);
            }
        }

        $product = $this->product->create($data);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->product->with(['category'])->find($id)) {
            return response()->json(['error' => 'Not found'], 404);
        }
        
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ProductRequest $request, $id)
    {

    }

    public function updateProduts(ProductRequest $request, $id)
    {
        if (!$product = $this->product->find($id)) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($product->image) {
                if (Storage::exists("{$this->pathUpload}/{$product->image}")) {
                    Storage::delete("{$this->pathUpload}/{$product->image}");
                }
            }

            $name = kebab_case($request->name);
            $extension = $request->image->extension();

            $fileName = "{$name}.{$extension}";
            $data['image'] = $fileName;

            $upload = $request->image->storeAs("{$this->pathUpload}", $fileName);

            if (!$upload) {
                return response()->json(['error' => 'fail upload'], 500);
            }
        }
        $product->update($data);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }
        if ($product->image) {
            if (Storage::exists("{$this->pathUpload}/{$product->image}")) {
                Storage::delete("{$this->pathUpload}/{$product->image}");
            }
        }
        $product->delete();

        return response()->json(['SUCESS' => true], 204);
    }
}
