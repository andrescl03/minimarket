<?php

namespace App\Http\Livewire;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $rols;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $rol;
    public $search = '';
    public $selected_id;
    public $delete_id;
    public $mode_modal; //create - Registrar  - edit Editar
    public $title_modal;

    protected $listeners = ['deletedConfirmed' => 'destroy'];


    public function show_modal_user($mode_modal, $id_user = 0)
    {
        $this->mode_modal = $mode_modal;
        $this->selected_id = $id_user;
        $this->resetInput();

        $this->dispatchBrowserEvent('show-modal-user');

        if ($mode_modal == 'created') {
            $this->title_modal = 'Registrar usuario';
        }
        if ($mode_modal == 'edit') {
            $this->title_modal = 'Editar usuario';

            $record = User::findOrFail($id_user);
            $this->selected_id = $id_user;
            $this->name = $record->name;
            $this->lastname = $record->lastname;
            $this->email = $record->email;
            $this->rol = $record->rol_id;
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->lastname = null;
        $this->rol = null;
        $this->password = null;
        $this->selected_id = null;
    }

    public function render()
    {
        $this->rols = Rol::get();
        $keyWord = '%' . $this->search . '%';
        return view('livewire.user-list', [
            'users' => User::latest()
                ->where('email', 'LIKE', $keyWord)
                ->orWhere(DB::raw('CONCAT(name , " " , lastname)'), 'LIKE', $keyWord)
                ->paginate(5)
        ]);
    }

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'min:2', 'string', 'max:255'],
            'lastname' => ['required', 'min:2',  'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->selected_id],
            'password' => ['required', 'string', 'min:8'],
            'rol' => ['required'],
        ]);

        if ($this->mode_modal == 'created') {

            $user = User::create(
                [
                    'name' => $this->name,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'rol_id' => $this->rol
                ]
            );
            $message = 'Se registró con éxito al usuario: ' .  $user->name;
        }
        if ($this->mode_modal == 'edit') {

            if ($this->selected_id) {

                $record = User::find($this->selected_id);
                $record->update([
                    'name' => $this->name,
                    'email' => $this->email
                ]);

                $message = 'Se actualizó con éxito el usuario';
            }
        }
        $this->resetInput();

        $this->dispatchBrowserEvent('show-notification', [
            'title' => $message
        ]);
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        if ($this->delete_id) {
            $record = User::where('id', $this->delete_id);
            $record->delete();

            $this->dispatchBrowserEvent('show-notification-destroy', [
                'title' => 'Se eliminó correctamente al usuario: ' . ' ' . $this->name,
                'timer' => 3000,
                'icon' => 'success',
                'toast' => true,
                'position' => 'top-right'
            ]);
        }
    }
}
