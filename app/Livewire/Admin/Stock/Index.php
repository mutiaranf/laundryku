<?php

namespace App\Livewire\Admin\Stock;

use App\Models\Outlet;
use App\Models\Stock;
use App\Models\StockCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{

    use WithFileUploads;

    public $searchSC;
    public $perPageSC = 5;

    public $searchS;
    public $perPageS = 5;

    public $outlet_filter;

    public function render()
    {
        $stockCategories = StockCategory::query()
            ->where('name', 'like', '%' . $this->searchSC . '%')
            ->latest()
            ->paginate($this->perPageSC);
        $outlets = Outlet::all();
        $stock_categories = StockCategory::all();
        $stocks = Stock::query()
            ->with('category', 'outlet')
            ->where('name', 'like', '%' . $this->searchS . '%')
            ->when($this->outlet_filter, function ($query) {
                $query->where('outlet_id', $this->outlet_filter);
            })
            ->latest()
            ->paginate($this->perPageS);
        return view('livewire.admin.stock.index', compact('stockCategories', 'outlets', 'stock_categories', 'stocks'));
    }

    public $nameSC;
    public $unit;
    public $descriptionSC;
    public $edit_modeSC;

    public function storeSC()
    {
        $this->validate([
            'nameSC' => 'required',
            'unit' => 'required',
            'descriptionSC' => 'required',
        ]);

        StockCategory::create([
            'name' => $this->nameSC,
            'unit' => $this->unit,
            'description' => $this->descriptionSC,
        ]);

        $this->dispatch('success', [
            'message' => 'Stock Category Created Successfully.'
        ]);

        $this->reset();

    }

    public function resetFormSC()
    {
        $this->reset();
    }

    public $stockCategoryId;
    public function editSC($id)
    {
        $stockCategory = StockCategory::find($id);
        $this->stockCategoryId = $stockCategory->id;
        $this->nameSC = $stockCategory->name;
        $this->unit = $stockCategory->unit;
        $this->descriptionSC = $stockCategory->description;
        $this->edit_modeSC = true;
    }

    public function updateSC($id)
    {
        $this->validate([
            'nameSC' => 'required',
            'unit' => 'required',
            'descriptionSC' => 'required',
        ]);

        $stockCategory = StockCategory::find($id);
        $stockCategory->update([
            'name' => $this->nameSC,
            'unit' => $this->unit,
            'description' => $this->descriptionSC,
        ]);

        $this->dispatch('success', [
            'message' => 'Stock Category Updated Successfully.'
        ]);

        $this->reset();
    }

    public function deleteSC($id)
    {

        try {

            $stockCategory = StockCategory::find($id);
            $stockCategory->delete();
            $this->dispatch('success', [
                'message' => 'Stock Category Deleted Successfully.'
            ]);
        } catch (\Exception $th) {
            $this->dispatch('error', [
                'message' => 'Masih Terikat dengan data lain.'
            ]);
        }
    }

    public $nameS;
    public $initial_quantity;
    public $current_quantity;
    public $price;
    public $total_price;
    public $minimum_quantity;
    public $photo;
    public $old_photo;
    public $edit_modeS;
    public $outlet_id;
    public $category_id;


    public function storeS()
    {

        $this->validate([
            'nameS' => 'required',
            'initial_quantity' => 'required',
            'price' => 'required',
            'minimum_quantity' => 'required',
            'photo' => 'max:2024',
            'outlet_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($this->photo) {
            $this->photo = $this->photo->store('stock-photos', 'public');
        }
        $total_price = $this->initial_quantity * $this->price;
        $stock = new Stock();
        $stock->name = $this->nameS;
        $stock->outlet_id = $this->outlet_id;
        $stock->stock_categories_id = $this->category_id;
        $stock->initial_quantity = $this->initial_quantity;
        $stock->current_quantity = $this->initial_quantity;
        $stock->price = $this->price;
        $stock->minimum_quantity = $this->minimum_quantity;
        $stock->photo = $this->photo;
        $stock->total_price = $total_price;
        $stock->save();


        $this->dispatch('success', [
            'message' => 'Stock Created Successfully.'
        ]);

        $this->reset();
    }


    public function resetFormS()
    {
        $this->reset();
    }

    public $stockId;
    public function stock_id($id){
        return $this->stockId = $id;
    }
    public $stock_number;

    public function addStock($id)
    {
        $this->validate([
            'stock_number' => 'numeric'
        ]);

        if ($this->stock_number <= 0) {
            $this->dispatch('error', [
                'message' => 'Stock Number Must Be Greater Than 0.'
            ]);
            return;
        }

        if ($this->stock_number > 1000) {
            $this->dispatch('error', [
                'message' => 'Stock Number Must Be Less Than 1000.'
            ]);
            return;
        }

        $stock = Stock::find($id);
        $stock->current_quantity += $this->stock_number;
        $stock->save();

        $this->dispatch('success', [
            'message' => $this->stock_number . ' ' . $stock->name . ' Added Successfully.'
        ]);

        $this->reset();
    }

//    function untuk mengurangi stock
    public function reduceStock($id)
    {
        $this->validate([
            'stock_number' => 'numeric'
        ]);


        $stock = Stock::find($id);
        if ($this->stock_number <= 0 ) {
            $this->dispatch('error', [
                'message' => 'Stock Number Must Be Greater Than 0.'
            ]);
            return;
        }elseif ( $this->stock_number > $stock->current_quantity) {
            $this->dispatch('error', [
                'message' => 'Stock Number Must Be Less Than Current Quantity.'
            ]);
            return;
        }
        else {
            $stock->current_quantity -= $this->stock_number;
            $stock->save();
            $this->reset();
        }

        $this->dispatch('success', [
            'message' => $this->stock_number . ' ' . $stock->name . ' Reduced Successfully.'
        ]);
    }
    public $stockIdS;
    public function editS($id)
    {
        $stock = Stock::find($id);
        $this->stockIdS = $stock->id;
        $this->nameS = $stock->name;
        $this->initial_quantity = $stock->initial_quantity;
        $this->price = $stock->price;
        $this->minimum_quantity = $stock->minimum_quantity;
        $this->old_photo = $stock->photo;
        $this->outlet_id = $stock->outlet_id;
        $this->category_id = $stock->stock_categories_id;
        $this->edit_modeS = true;
    }

    public function updateS($id)
    {
        $this->validate([
            'nameS' => 'required',
            'initial_quantity' => 'required',
            'price' => 'required',
            'minimum_quantity' => 'required',
            'photo' => 'max:2024',
            'outlet_id' => 'required',
            'category_id' => 'required',
        ]);

        $stock = Stock::find($id);
        if ($this->photo) {
            if($this->old_photo){
                unlink('storage/'.$this->old_photo);
            }
          $this->photo->store('stock-photos', 'public');
        } else {
            $this->photo = $this->old_photo;
        }
        $total_price = $this->initial_quantity * $this->price;
        $stock->update([
            'name' => $this->nameS,
            'initial_quantity' => $this->initial_quantity,
            'current_quantity' => $this->initial_quantity,
            'price' => $this->price,
            'minimum_quantity' => $this->minimum_quantity,
            'photo' => $this->photo,
            'total_price' => $total_price,
            'outlet_id' => $this->outlet_id,
            'stock_categories_id' => $this->category_id,
        ]);

        $this->dispatch('success', [
            'message' => 'Stock Updated Successfully.'
        ]);

    }

     public function deleteS($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        $this->dispatch('success', [
            'message' => 'Stock Category Deleted Successfully.'
        ]);
    }


}
