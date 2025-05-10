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
        return validator($data, [
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'description' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        ])->validate();

        // create custom validation messages
        return [
            'name.required' => 'The category field is required.',
            'name.max' => 'The category may not be greater than 50 characters.',
            'description.max' => 'The description may not be greater than 100 characters.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 512 kilobytes.',
        ];
    }

    public function getAllCategories($perPage)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function createCategory(array $data)
    {
        // Validate the data
        $this->_validate($data);

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
        $category->update($data);

        return $category;
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);
        return $category->delete();
    }
}
