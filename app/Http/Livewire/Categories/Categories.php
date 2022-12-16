<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Categories extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $search;
    public $title_modal;
    public $image;
    public $delete_id;
    public $description;
    public $mode_modal;
    public $imageupdate = 0;

    protected $listeners = ['deletedConfirmed' => 'destroy'];
    protected $paginationTheme = 'bootstrap';

    private function resetInput()
    {
        $this->name = null;
        $this->description = null;
        $this->image = null;
        $this->imageupdate = 0;
    }

    public function destroy()
    {
        if ($this->delete_id) {
            $record = Category::where('id', $this->delete_id);
            $record->delete();

            $this->dispatchBrowserEvent('show-notification-destroy', [
                'title' => 'Se eliminó correctamente la categoríaa'
            ]);
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => ['image', 'max:2048', 'mimes:jpg,png,jpeg']
        ]);
        $this->imageupdate = 1;
    }

    public function render()
    {

        $KeyWord = '%' . $this->search . '%';
        return view('livewire.categories.categories', [
            'categories' => Category::latest()->where('name', 'LIKE', $KeyWord)->orWhere('description', 'LIKE', $KeyWord)->paginate(5)
        ]);
    }

    public function show_modal($mode_modal, $id = 0)
    {
        $this->mode_modal = $mode_modal;
        $this->selected_id = $id;
        $this->resetInput();

        if ($mode_modal == 'created') {
            $this->title_modal = 'Registrar nueva categoría';
        }
        if ($mode_modal == 'edit') {
            $this->title_modal = 'Editar categoría';

            $category = Category::findOrFail($id);
            $this->selected_id = $id;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->image = $category->files->last() ? $category->files->last()->url : '';

            $this->dispatchBrowserEvent('show-modal');
        }
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function submit()
    {

        $this->validate([
            'name' => ['required', 'min:2', 'string', 'max:255'],
            'description' => ['required', 'min:2',  'string', 'max:500'],
        ]);

        if ($this->mode_modal == 'created') {

            $category = Category::create(
                [
                    'name' => $this->name,
                    'description' => $this->description,
                ]
            );

            if ($this->imageupdate) {

                $path_url = $this->image->store('photos');
                $file = File::create(
                    [
                        'name' => $this->image->getClientOriginalName(),
                        'url' =>  $path_url,
                        'format' => $this->image->getMimeType(),
                        'size' => $this->image->getSize(),
                        'weight' => $this->image->getSize()
                    ]
                );
                $category->files()->attach($file->id);
            }
            $message = 'Se registró con éxito la categoría';
        }

        if ($this->mode_modal == 'edit') {

            if ($this->selected_id) {

                $category = Category::find($this->selected_id);
                $category->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);

                if ($this->imageupdate) {
                    $path_url = $this->image->store('photos');

                    $file = File::create(
                        [
                            'name' => $this->image->getClientOriginalName(),
                            'url' =>  $path_url,
                            'format' => $this->image->getMimeType(),
                            'size' => $this->image->getSize(),
                            'weight' => $this->image->getSize()
                        ]
                    );

                    $category->files()->attach($file->id);
                }

                $message = 'Se actualizó con éxito la categoría';
            }
        }
        $this->resetInput();
        $this->dispatchBrowserEvent('show-notification', [
            'title' => $message
        ]);
    }
}
