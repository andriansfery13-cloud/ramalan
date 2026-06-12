<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoryManager extends Component
{
    public bool $showModal = false;
    public ?int $categoryId = null;
    public string $name = '';
    public string $slug = '';
    public string $icon = '';
    public string $description = '';
    public bool $isActive = true;

    public function create()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id)
    {
        $this->resetValidation();
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->icon = $category->icon;
        $this->description = $category->description ?? '';
        $this->isActive = $category->is_active;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->categoryId,
            'icon' => 'required|string|max:50',
            'description' => 'nullable|string',
            'isActive' => 'boolean',
        ]);

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'icon' => $this->icon,
                'description' => $this->description,
                'is_active' => $this->isActive,
            ]
        );

        $this->showModal = false;
        $this->dispatch('notify', message: 'Kategori berhasil disimpan!', type: 'success');
    }

    public function toggleActive(int $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);
    }

    public function delete(int $id)
    {
        // Don't delete if it has fortunes or templates associated (for safety, maybe just soft delete or check)
        Category::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Kategori dihapus.', type: 'error');
    }

    private function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->icon = '📁';
        $this->description = '';
        $this->isActive = true;
    }

    // Auto generate slug from name
    public function updatedName($value)
    {
        if (!$this->categoryId) {
            $this->slug = \Illuminate\Support\Str::slug($value);
        }
    }

    public function render()
    {
        $categories = Category::withCount('subCategories')->get();
        return view('livewire.admin.category-manager', [
            'categories' => $categories
        ])->layout('components.layouts.admin', ['title' => 'Manajemen Kategori']);
    }
}
