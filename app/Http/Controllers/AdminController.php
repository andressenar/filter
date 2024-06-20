<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Table;

class AdminController extends Controller
{
    // Mostrar el panel de administración
    public function showAdminPanel()
    {
        $categories = Category::all();
        $menuItems = MenuItem::with('category')->get();
        $tables = Table::all();
        
        return view('admin.panel', compact('categories', 'menuItems', 'tables'));
    }
    
    // CRUD para categorías
    
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'color' => 'required|string',
        ]);
        
        Category::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        
        return redirect()->back()->with('success', 'Categoría creada exitosamente.');
    }
    
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'color' => 'required|string',
        ]);
        
        $category->update([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        
        return redirect()->back()->with('success', 'Categoría actualizada exitosamente.');
    }
    
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect()->back()->with('success', 'Categoría eliminada exitosamente.');
    }
    
    // CRUD para platos (MenuItem)
    
    public function createMenuItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
        ]);
        
        MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);
        
        return redirect()->back()->with('success', 'Plato creado exitosamente.');
    }
    
    public function updateMenuItem(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
        ]);
        
        $menuItem->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);
        
        return redirect()->back()->with('success', 'Plato actualizado exitosamente.');
    }
    
    public function deleteMenuItem($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();
        
        return redirect()->back()->with('success', 'Plato eliminado exitosamente.');
    }
    
    // CRUD para mesas
    
    public function createTable(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
            'capacity' => 'required|integer',
        ]);
        
        Table::create([
            'number' => $request->number,
            'capacity' => $request->capacity,
        ]);
        
        return redirect()->back()->with('success', 'Mesa creada exitosamente.');
    }
    
    public function updateTable(Request $request, $id)
    {
        $table = Table::findOrFail($id);
        
        $request->validate([
            'number' => 'required|string',
            'capacity' => 'required|integer',
        ]);
        
        $table->update([
            'number' => $request->number,
            'capacity' => $request->capacity,
        ]);
        
        return redirect()->back()->with('success', 'Mesa actualizada exitosamente.');
    }
    
    public function deleteTable($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();
        
        return redirect()->back()->with('success', 'Mesa eliminada exitosamente.');
    }
}
