<?php

namespace App\Livewire;

use App\Models\Category;
use App\Services\FortuneService;
use Livewire\Component;

class FortuneGenerator extends Component
{
    public string $name = '';
    public string $selectedCategory = 'umum';
    public string $selectedSubCategory = '';
    public ?array $result = null;
    public bool $isGenerating = false;

    protected $rules = [
        'name' => 'required|min:2|max:50',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'name.min' => 'Nama minimal 2 karakter.',
    ];

    public function generate()
    {
        $this->validate();
        $this->isGenerating = true;

        $service = app(FortuneService::class);
        $this->result = $service->generate(
            $this->name,
            $this->selectedCategory,
            $this->selectedSubCategory ?: null,
            auth()->id()
        );

        $this->isGenerating = false;
        $this->dispatch('fortune-generated', result: $this->result);
    }

    public function resetResult()
    {
        $this->result = null;
        $this->name = '';
    }

    public function render()
    {
        $categories = Category::with('subCategories')->active()->orderBy('sort_order')->get();

        return view('livewire.fortune-generator', [
            'categories' => $categories,
        ]);
    }
}
