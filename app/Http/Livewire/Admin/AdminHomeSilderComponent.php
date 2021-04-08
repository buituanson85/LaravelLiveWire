<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSilderComponent extends Component
{
    public function deleteSlider($id){
        $slider = HomeSlider::find($id);
        $slider->delete();
        session()->flash('message', 'Product has been deleted successfully!');
    }

    public function render()
    {
        $sliders = HomeSlider::all();
        return view('livewire.admin.admin-home-silder-component', ['sliders'=> $sliders])->layout('layouts.base');
    }
}
