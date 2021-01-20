<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Blog\BaseController;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.category.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();
        $category_list = BlogCategory::all();

        return view('blog.admin.category.edit', compact('item', 'category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }
        $item = new BlogCategory($data);
        $item->save();
        if($item) {
            return redirect()->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }
        else
        {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {

        $item = BlogCategory::findOrFail($id);
        $category_list = BlogCategory::all();

        return view('blog.admin.category.edit', compact('item', 'category_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {

        $item =  BlogCategory::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=> "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        $result = $item->fill($data)->save();

        if($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }
        else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }


    }


}
