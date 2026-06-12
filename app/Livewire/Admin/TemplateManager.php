<?php

namespace App\Livewire\Admin;

use App\Models\FortuneTemplate;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class TemplateManager extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterType = '';
    public ?int $filterSubCategory = null;

    // Modal Form States
    public bool $showModal = false;
    public ?int $templateId = null;
    public ?int $subCategoryId = null;
    public string $type = 'general';
    public string $title = '';
    public string $content = '';
    public string $emoji = '';
    public int $luckLevel = 50;
    public bool $isActive = true;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterSubCategory' => ['except' => null],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id)
    {
        $this->resetValidation();
        $template = FortuneTemplate::findOrFail($id);
        $this->templateId = $template->id;
        $this->subCategoryId = $template->sub_category_id;
        $this->type = $template->type;
        $this->title = $template->title;
        $this->content = $template->content;
        $this->emoji = $template->emoji;
        $this->luckLevel = $template->luck_level;
        $this->isActive = $template->is_active;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'subCategoryId' => 'nullable|exists:sub_categories,id',
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'emoji' => 'required|string|max:10',
            'luckLevel' => 'required|integer|min:0|max:100',
            'isActive' => 'boolean',
        ]);

        FortuneTemplate::updateOrCreate(
            ['id' => $this->templateId],
            [
                'sub_category_id' => $this->subCategoryId,
                'type' => $this->type,
                'title' => $this->title,
                'content' => $this->content,
                'emoji' => $this->emoji,
                'luck_level' => $this->luckLevel,
                'is_active' => $this->isActive,
            ]
        );

        $this->showModal = false;
        $this->dispatch('notify', message: 'Template berhasil disimpan!', type: 'success');
    }

    public function delete(int $id)
    {
        FortuneTemplate::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Template dihapus.', type: 'error');
    }

    public function toggleActive(int $id)
    {
        $template = FortuneTemplate::findOrFail($id);
        $template->update(['is_active' => !$template->is_active]);
    }

    private function resetForm()
    {
        $this->templateId = null;
        $this->subCategoryId = null;
        $this->type = 'general';
        $this->title = '';
        $this->content = '';
        $this->emoji = '🔮';
        $this->luckLevel = 50;
        $this->isActive = true;
    }

    public function render()
    {
        $query = FortuneTemplate::with('subCategory');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterSubCategory) {
            $query->where('sub_category_id', $this->filterSubCategory);
        }

        $templates = $query->latest()->paginate(50);
        $subCategories = SubCategory::all();

        // Get distinct types
        $types = FortuneTemplate::select('type')->distinct()->pluck('type');

        return view('livewire.admin.template-manager', [
            'templates' => $templates,
            'subCategories' => $subCategories,
            'types' => $types,
        ])->layout('components.layouts.admin', ['title' => 'Template Manager']);
    }
}
