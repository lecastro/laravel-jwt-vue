<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRequest;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $totPag = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $this->category->getResults($request->name);
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRequest $request)
    {
        $category = $this->category->create($request->all());
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json(['error' => 'Not found'], 404);
        } else {
            $category->update($request->all());
            return response()->json($category);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json(['error' => 'Not found'], 404);
        } else {
            $category->delete();
            return response()->json(['sucess' => true], 204);
        }
    }

    public function produts($id)
    {
        if (!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $products = $category->products()->paginate($this->totPag);

        return response()->json([
            'category' => $category,
            'products' => $products,
        ]);
    }
}
