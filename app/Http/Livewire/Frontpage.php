<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class Frontpage extends Component
{

    public $urlslug;
    public $title;
    public $content;
    // public $sideBarLinks;

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


        
    /**
     * sideBarLinks
     *
     * @return void
     */
    public function sideBarLinks()
    {
        return DB::table('navigation_menus')
        ->where("type","=","SidebarNav")
        ->orderBy('sequence','asc')
        ->orderBy('created_at','asc'
        )->get();
    }
        
    /**
     * TopNavLinks
     *
     * @return void
     */
    public function TopNavLinks()
    {
        return DB::table('navigation_menus')
        ->where("type","=","TopNav")
        ->orderBy('sequence','asc')
        ->orderBy('created_at','asc'
        )->get();
    }
    
        
    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.frontpage',[
            'sideBarLinks'=>$this->sideBarLinks(),
            'TopNavLinks'=>$this->TopNavLinks(),
            ])
        ->layout('layouts.frontpage');
    }
}
