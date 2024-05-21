<?php

namespace App\Livewire\Admin\Service;

use App\Models\ServicePackage;
use App\Models\ServiceType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $searchST;
    public $searchSP;
    public $perPageSP = 5;
    public $perPageST = 5;
    public function render()
    {
        $serviceTypes = ServiceType::query()
            ->where('name', 'like', '%' . $this->searchST . '%')
            ->latest()
            ->paginate($this->perPageST);

        $serviceTypesAll = ServiceType::all();

        $servicePackages = ServicePackage::query()
            ->with('serviceType')
            ->where('name', 'like', '%' . $this->searchSP . '%')
            ->latest()
            ->paginate($this->perPageSP);
        return view('livewire.admin.service.index', compact('serviceTypes', 'serviceTypesAll', 'servicePackages'));
    }

    // ST = Service Type
    public $edit_modeST;
    public $idST;
    public $nameST;
    public $priceST;
    public $estimated_timeST;
    public $descriptionST;
    public $iconST;

    public $unitST;

    public $oldIconST;

    public function  storeST(): void
    {
        $this->validate([
            'nameST' => 'required',
            'priceST' => 'required',
            'estimated_timeST' => 'required',
            'descriptionST' => 'required',
            'iconST' => 'max:2024',
            'unitST' => 'required',
        ]);

        if ($this->iconST) {
            $this->iconST = $this->iconST->store('service-icons', 'public');
        }


        ServiceType::create([
            'name' => $this->nameST,
            'price' => $this->priceST,
            'estimated_time' => $this->estimated_timeST,
            'description' => $this->descriptionST,
            'icon' => $this->iconST,
            'unit' => $this->unitST,
        ]);

        $this->dispatch('success', [
            'message' => 'Service Type created successfully.'
        ]);

        $this->reset(['nameST', 'priceST', 'estimated_timeST', 'descriptionST', 'iconST']);
    }

    public function editST($id): void
    {
        $serviceType = ServiceType::find($id);
        $this->idST = $serviceType->id;
        $this->nameST = $serviceType->name;
        $this->priceST = $serviceType->price;
        $this->estimated_timeST = $serviceType->estimated_time;
        $this->descriptionST = $serviceType->description;
        $this->oldIconST = $serviceType->icon;
        $this->edit_modeST = true;
    }

    public function updateST($id): void
    {
        $this->validate([
            'nameST' => 'required',
            'priceST' => 'required',
            'estimated_timeST' => 'required',
            'descriptionST' => 'required',
            'iconST' => 'max:2024',
        ]);

        $serviceType = ServiceType::find($id);

        if ($this->iconST) {
            if ($serviceType->icon) {
                unlink('storage/' . $serviceType->icon);
            }
            $this->iconST = $this->iconST->store('service-icons', 'public');
        } else {
            $this->iconST = $this->oldIconST;
        }

        $serviceType = ServiceType::find($id);
        $serviceType->name = $this->nameST;
        $serviceType->price = $this->priceST;
        $serviceType->estimated_time = $this->estimated_timeST;
        $serviceType->description = $this->descriptionST;
        $serviceType->icon = $this->iconST;
        $serviceType->save();


        $this->dispatch('success', [
            'message' => 'Service Type updated successfully.'
        ]);

        $this->reset(['nameST', 'priceST', 'estimated_timeST', 'descriptionST', 'iconST', 'edit_modeST']);
    }

    public function deleteST($id): void
    {

        try {
            $serviceType = ServiceType::find($id);
            if ($serviceType->delete()) {
                if ($serviceType->icon) {
                    unlink('storage/' . $serviceType->icon);
                }
                $this->dispatch('success', [
                    'message' => 'Service Type deleted successfully.'
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('error', [
                'message' => 'Tidak bisa dihapus karena sudah digunakan di service package.'
            ]);
        }
    }

    public function resetFormST(): void
    {
        $this->reset(['nameST', 'priceST', 'estimated_timeST', 'descriptionST', 'iconST', 'edit_modeST']);
    }

    public function resetFilterST(): void
    {
        $this->reset(['searchST']);
    }

    public $nameSP;
    public $priceSP;
    public $estimated_timeSP;
    public $descriptionSP;
    public $photoSP;
    public $service_types_id;

    public $oldPhotoSP;

    public $edit_modeSP;

    public $show_formSP;
    public $idSP;

    public function  showFormSP(): void
    {
        $this->show_formSP = true;
    }

    public function storeSP(): void
    {

        $this->validate([
            'nameSP' => 'required',
            'priceSP' => 'required',
            'estimated_timeSP' => 'required',
            'descriptionSP' => 'required',
            'photoSP' => 'max:2024',
            'service_types_id' => 'required',
        ]);

        if ($this->photoSP) {
            $this->photoSP = $this->photoSP->store('service-photos', 'public');
        }

        ServicePackage::create([
            'name' => $this->nameSP,
            'price' => $this->priceSP,
            'estimated_time' => $this->estimated_timeSP,
            'description' => $this->descriptionSP,
            'photo' => $this->photoSP,
            'service_types_id' => $this->service_types_id,
        ]);

        $this->dispatch('success', [
            'message' => 'Service created successfully.'
        ]);

        $this->show_formSP = false;

        $this->reset(['nameSP', 'priceSP', 'estimated_timeSP', 'descriptionSP', 'photoSP', 'service_types_id']);
    }

    public function editSP($id): void
    {
        $servicePackage = ServicePackage::find($id);
        $this->idSP = $servicePackage->id;
        $this->nameSP = $servicePackage->name;
        $this->priceSP = $servicePackage->price;
        $this->estimated_timeSP = $servicePackage->estimated_time;
        $this->descriptionSP = $servicePackage->description;
        $this->oldPhotoSP = $servicePackage->photo;
        $this->service_types_id = $servicePackage->service_types_id;
        $this->edit_modeSP = true;
        $this->show_formSP = true;
    }

    public function updateSP($id): void
    {
        $this->validate([
            'nameSP' => 'required',
            'priceSP' => 'required',
            'estimated_timeSP' => 'required',
            'descriptionSP' => 'required',
            'photoSP' => 'max:2024',
            'service_types_id' => 'required',
        ]);

        $servicePackage = ServicePackage::find($id);

        if ($this->photoSP) {
            if ($servicePackage->photo) {
                unlink('storage/' . $servicePackage->photo);
            }
            $this->photoSP = $this->photoSP->store('service-photos', 'public');
        } else {
            $this->photoSP = $this->oldPhotoSP;
        }

        $servicePackage = ServicePackage::find($id);
        $servicePackage->name = $this->nameSP;
        $servicePackage->price = $this->priceSP;
        $servicePackage->estimated_time = $this->estimated_timeSP;
        $servicePackage->description = $this->descriptionSP;
        $servicePackage->photo = $this->photoSP;
        $servicePackage->service_types_id = $this->service_types_id;
        $servicePackage->save();

        $this->dispatch('success', [
            'message' => 'Service updated successfully.'
        ]);

        $this->show_formSP = false;

        $this->reset(['nameSP', 'priceSP', 'estimated_timeSP', 'descriptionSP', 'photoSP', 'service_types_id', 'edit_modeSP']);
    }

    public function deleteSP($id): void
    {
        $servicePackage = ServicePackage::find($id);
        if ($servicePackage->photo) {
            unlink('storage/' . $servicePackage->photo);
        }
        $servicePackage->delete();
        $this->dispatch('success', [
            'message' => 'Service deleted successfully.'
        ]);
    }

    public function closeFormSP(): void
    {
        $this->show_formSP = false;
        $this->reset(['nameSP', 'priceSP', 'estimated_timeSP', 'descriptionSP', 'photoSP', 'service_types_id']);
    }

    public function resetFilterSP(): void
    {
        $this->reset(['searchSP']);
    }
}
