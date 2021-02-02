<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{

    public $urlslug;
    public $title;
    public $content;

    public function mount($urlslug = null)
    {
        $this->retreiveContent($urlslug);
    }

    public function retreiveContent($urlslug)
    {
        if(empty($urlslug)){
            $data = Page::where('is_default_home', true)->first();
        }else{
            $data = Page::where('slug', $urlslug)->first();

            if(!$data){
                $data = Page::where('is_default_not_found', true)->first();
            }
        }

       
        $this->title=$data->title;
        $this->content=$data->content;
    }

    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
