<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CategoryMenu;
use App\Menu;

class ListMenuController extends Controller
{
    public function index()
    {
        $list_menu['list_menu'] = Menu::orderBy('index', 'asc')->paginate(10);
        $list_menu['menu'] = Menu::orderBy('index', 'asc')->get();
        if (isset($_GET['category_menu_id'])) {
            if ($_GET['category_menu_id'] != null && $_GET['category_menu_id'] != '') {
                $category_menu_id = $_GET['category_menu_id'];
            } else {
                $category_menu_id = 0;
            }
        } else {
            $category_menu_id = 0;
        }
        
        if (isset($_GET['name'])) {
            if ($_GET['name'] != null && $_GET['name'] != '') {
                $name = $_GET['name'];
            } else {
                $name = 0;
            }
        } else {
            $name = 0;
        }
        
        $list_menu['category_menu_id'] = $category_menu_id;
        if (isset($_GET['category_menu_id'])) {
            if($_GET['category_menu_id'] != 0){
                $list_menu['list_menu'] = Menu::where('category_menu_id', $category_menu_id)->orderBy('index', 'asc')->paginate(10)->appends(['category_menu_id' => $category_menu_id]);
            }
        }
        
        $list_menu['name'] = $name;
        if (isset($_GET['name'])) {
            if($_GET['name'] != null){
                $list_menu['list_menu'] = Menu::where('name', 'like', '%' . $name . '%')->orderBy('index', 'asc')->paginate(10)->appends(['name' => $name]);
            }
        }
        
        $list_menu['category_menu'] = CategoryMenu::orderBy('index', 'asc')->get();
        
        return view('list-menu.index', $list_menu);
    }
    
    public function show($id)
    {
        $list_menu['list_menu'] = Menu::findOrFail($id);
        $list_menu['menu'] = Menu::where([['category_menu_id',  $list_menu['list_menu']->category_menu_id], ['id', '!=', $id]])->get();
        
        return view('list-menu.show', $list_menu);
    }
    
    public function edit($id)
    {
        $list_menu = Menu::findOrFail($id);
        
        return $list_menu;
    }
}
