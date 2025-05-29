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

        // handle image upload if present
        if (isset($data['image'])) {
            $data['image'] = $this->_saveImage($data['image']);
        }
        // create item
        return $this->model->create($data);
    }

    private function _validate($data)
    {
        $rules = [
            'item_name' => 'required|regex:/^[a-zA-Z0-9\s,&]+$/|max:50|unique:items,item_name',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        ];

        $messages = [
            'item_name.required' => 'The item field is required.',
            'item_name.max' => 'The item may not be greater than 50 characters.',
            'item_name.regex' => 'The item may only contain letters, numbers, spaces, commas, and ampersands.',
            'item_name.unique' => 'The item name has already been taken.',
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

        // handle image upload if present
        if (isset($data['image'])) {
            // delete old image when upload new image
            if ($item->image) {
                $this->_deleteImage($item->image);
            }
            $data['image'] = $this->_saveImage($data['image']);
        }
        // update data
        return $item->update($data);
    }

    public function deleteItem($id)
    {
        $item = $this->getItemById($id);

        // Delete the image in storage if it exists
        if ($item->image) {
            $this->_deleteImage($item->image);
        }

        return $item->delete();
    }

    /**
     * Save the image to storage
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @return string
     */
    private function _saveImage($image)
    {
        $imageName = 'item-' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
        $image->storeAs('items', $imageName, 'public');
        return $imageName;
    }

    /**
     * Delete the image from storage
     *
     * @param string $image
     * @return void
     */

    private function _deleteImage($image)
    {
        if (file_exists(public_path('storage/items/' . $image))) {
            unlink(public_path('storage/items/' . $image));
        }
    }
}
