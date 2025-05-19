<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\NewUserPassword;

class AddUserModal extends Component
{
    use WithFileUploads;

    public $user_id;
    public $name;
    public $email;
    public $role;
    public $password; // utilisé uniquement en édition si tu veux

    public $edit_mode = false;
    public $avatar;
    public $saved_avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|string|max:50',
        'avatar' => 'nullable|image|max:1024',
    ];

    protected $listeners = [
        'delete_user' => 'deleteUser',
        'update_user' => 'updateUser',
        'new_user' => 'hydrate',
    ];

    public function render()
    {
        return view('livewire.user.add-user-modal');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'email_verified_at' => now(), // email validé automatiquement
            ];

            if ($this->avatar) {
                $data['profile_photo_path'] = $this->avatar->store('avatars', 'public');
            }

            if (!$this->edit_mode) {
                $randomPassword = Str::random(10);
                $data['password'] = Hash::make($randomPassword);
            }

            $user = User::updateOrCreate(['id' => $this->user_id], $data);

            if (!$this->edit_mode) {
                Mail::to($this->email)->send(new NewUserPassword($user, $randomPassword));
                $this->dispatch('success', "Nouvel utilisateur ajouté, mot de passe envoyé par email.");
            } else {
                $this->dispatch('success', "Utilisateur modifié avec succès.");
            }
        });

        $this->reset();
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        $this->dispatch('success', 'Utilisateur supprimé.');
    }

    public function updateUser($id)
    {
        $this->edit_mode = true;

        $user = User::findOrFail($id);

        $this->user_id = $user->id;
        $this->saved_avatar = $user->profile_photo_url ?? null;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
