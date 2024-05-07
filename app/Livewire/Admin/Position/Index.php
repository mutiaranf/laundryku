<?php

namespace App\Livewire\Admin\Position;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $perPage = 5;
    public function render()
    {
        $positions = \App\Models\Position::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.admin.position.index',compact('positions'));
    }

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $description;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        \App\Models\Position::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

       $this->reset();

        $this->dispatch('success',[
            'message' => 'User Created Successfully.'
        ]);
    }

    public $edit_mode;
    public $id;
    public  function edit($id)
    {
        $position = \App\Models\Position::find($id);
        $this->name = $position->name;
        $this->id = $position->id;
        $this->description = $position->description;
        $this->edit_mode = true;
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $position = \App\Models\Position::find($id);
        $position->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->reset();

        $this->dispatch('success',[
            'message' => 'User Updated Successfully.'
        ]);
    }

    public function delete($id)
    {
        $position = \App\Models\Position::find($id);
        $position->delete();
        $this->dispatch('success',[
            'message' => 'User Deleted Successfully.'
        ]);
    }

}
