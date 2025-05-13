<?php

namespace App\Repositories\Item;

use App\Models\Category;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Item;
use App\Repositories\Item\ItemRepository;

class ItemRepositoryImplement extends Eloquent implements ItemRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Item $model;
    protected Category $categoryModel;

    public function __construct(Item $model, Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
        $this->model = $model;
    }

    public function getAllItems($perPage)
    {
        return $this->model->with('category')->paginate($perPage);
    }

    public function getAllCategories()
    {
        return $this->categoryModel->orderBy('name', 'asc')->get();
    }

    public function searchItem($search, $perPage)
    {
        return $this->model->with('category')
            ->where('item_name', 'like', '%' . $search . '%')
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function createItem(array $data)
    {
        // Validate the data
        $this->_validate($data);

        return $this->model->create($data);
    }

    private function _validate($data)
    {
        $rules = [
            'item_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        ];

        $messages = [
            'item_name.required' => 'The item field is required.',
            'item_name.max' => 'The item may not be greater than 50 characters.',
            'item_name.regex' => 'The item may only contain letters, numbers, and spaces.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 512 kilobytes.',
        ];

        return validator($data, $rules, $messages)->validate();
    }

    public function getItemById($id)
    {
        return $this->model->with('category')->findOrFail($id);
    }

    public function updateItem($id, array $data)
    {
        // Validate the data
        $this->_validate($data);

        $item = $this->getItemById($id);
        $item->update($data);

        return $item;
    }

    public function deleteItem($id)
    {
        $item = $this->getItemById($id);
        $item->delete();

        return $item;
    }
}
