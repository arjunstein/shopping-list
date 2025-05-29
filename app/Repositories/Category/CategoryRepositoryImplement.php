<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Category;

class CategoryRepositoryImplement extends Eloquent implements CategoryRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    private function _validate(array $data)
    {
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9\s,&]+$/|max:50|unique:categories,name',
            'description' => 'nullable|regex:/^[a-zA-Z0-9\s,&]+$/|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        ];

        // create custom validation messages
        $messages = [
            'name.required' => 'The category field is required.',
            'name.max' => 'The category may not be greater than 50 characters.',
            'name.regex' => 'The category may only contain letters, numbers, spaces, commas, and ampersands.',
            'name.unique' => 'The category has already been taken.',
            'description.regex' => 'The description may only contain letters, numbers, spaces, commas, and ampersands.',
            'description.max' => 'The description may not be greater than 100 characters.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 512 kilobytes.',
        ];

        return validator($data, $rules, $messages)->validate();
    }

    public function getAllCategories($perPage)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function createCategory(array $data)
    {
        // Validate the data
        $this->_validate($data);

        // Handle image upload if present
        if (isset($data['image'])) {
            $data['image'] = $this->_saveImage($data['image']);
        }
        // Create the category
        return $this->model->create($data);
    }

    public function getCategoryById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateCategory($id, array $data)
    {
        // Validate the data
        $this->_validate($data);

        $category = $this->getCategoryById($id);

        // Handle image upload if present
        if (isset($data['image'])) {
            // delete old image when upload new image
            if ($category->image) {
                $this->_deleteImage($category->image);
            }
            $data['image'] = $this->_saveImage($data['image']);
        }

        return $category->update($data);
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);

        // Delete the image in storage if it exists
        if ($category->image) {
            $this->_deleteImage($category->image);
        }
        return $category->delete();
    }

    public function searchCategories($search, $perPage)
    {
        return $this->model->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Save the image to storage
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @return string
     */
    private function _saveImage($image)
    {
        $imageName = 'category-' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
        $image->storeAs('categories', $imageName, 'public');
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
        if (file_exists(public_path('storage/categories/' . $image))) {
            unlink(public_path('storage/categories/' . $image));
        }
    }
}
