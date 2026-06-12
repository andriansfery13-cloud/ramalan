<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TiktokSettings extends Component
{
    public $tiktok_username = '';
    public $is_auto_mode = false;
    public $isConnected = false;
    public $statusMessage = '';

    public function mount()
    {
        $this->tiktok_username = AppSetting::getValue('tiktok_target_username', '');
        $this->is_auto_mode = AppSetting::getValue('tiktok_auto_mode', 'false') === 'true';
        $this->checkConnectionStatus();
    }

    public function checkConnectionStatus()
    {
        try {
            $response = Http::timeout(2)->get('http://localhost:3000/api/status');
            if ($response->successful()) {
                $this->isConnected = $response->json('connected');
                $connectedUser = $response->json('username');
                
                if ($this->isConnected) {
                    $this->statusMessage = "Terhubung dengan Live: @" . $connectedUser;
                } else {
                    $this->statusMessage = "Server Node.js berjalan, tapi belum terhubung ke Live siapapun.";
                }
            } else {
                $this->isConnected = false;
                $this->statusMessage = "Gagal menghubungi server Node.js. Pastikan Anda sudah menjalankan 'npm start' di folder tiktok-connector.";
            }
        } catch (\Exception $e) {
            $this->isConnected = false;
            $this->statusMessage = "Server Node.js Mati (Offline). Jalankan 'npm start' di folder tiktok-connector.";
        }
    }

    public function saveSettings()
    {
        AppSetting::setValue('tiktok_target_username', $this->tiktok_username);
        AppSetting::setValue('tiktok_auto_mode', $this->is_auto_mode ? 'true' : 'false');
        session()->flash('message', 'Pengaturan berhasil disimpan.');
    }

    public function connectTiktok()
    {
        $this->validate(['tiktok_username' => 'required']);
        $this->saveSettings();

        try {
            $response = Http::timeout(5)->post('http://localhost:3000/api/connect', [
                'username' => $this->tiktok_username
            ]);

            if ($response->successful() && $response->json('success')) {
                $this->isConnected = true;
                $this->statusMessage = "Berhasil terhubung ke Live: @" . $this->tiktok_username;
            } else {
                $this->statusMessage = "Gagal terhubung: " . $response->json('error', 'Unknown error');
            }
        } catch (\Exception $e) {
            $this->statusMessage = "Error: Pastikan Node.js server berjalan.";
        }
    }

    public function disconnectTiktok()
    {
        try {
            $response = Http::timeout(5)->post('http://localhost:3000/api/disconnect');
            $this->isConnected = false;
            $this->statusMessage = "Koneksi terputus.";
        } catch (\Exception $e) {
            $this->isConnected = false;
            $this->statusMessage = "Error: Pastikan Node.js server berjalan.";
        }
    }

    public function render()
    {
        return view('livewire.admin.tiktok-settings')->layout('components.layouts.admin');
    }
}
