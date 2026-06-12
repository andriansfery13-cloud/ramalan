<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showModal = false;

    // Form
    public ?int $userId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $isAdmin = false;

    public function updatingSearch()
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
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = ''; // Don't fill password
        $this->isAdmin = $user->is_admin;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'isAdmin' => 'boolean',
        ];

        if (!$this->userId || $this->password) {
            $rules['password'] = 'required|min:8';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'is_admin' => $this->isAdmin,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        $this->showModal = false;
        $this->dispatch('notify', message: 'User berhasil disimpan!', type: 'success');
    }

    public function delete(int $id)
    {
        if ($id === auth()->id()) {
            $this->dispatch('notify', message: 'Anda tidak bisa menghapus akun Anda sendiri!', type: 'error');
            return;
        }

        User::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'User dihapus.', type: 'error');
    }

    private function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->isAdmin = false;
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('is_admin', 'desc')
            ->latest()
            ->paginate(20);

        return view('livewire.admin.user-manager', [
            'users' => $users
        ])->layout('components.layouts.admin', ['title' => 'Manajemen Pengguna']);
    }
}
