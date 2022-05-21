<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categorie::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'nom' => 'required',
           

        ]);
       
        
        $nom = $request->nom;
   
        $categorie =  new Categorie();
        $categorie->nom = $nom;
     
        $categorie->save();
        return response()->json("la catégorie est bien enregistrer");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return response()->json('done');
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([

            'nom' => 'required',
           

        ]);
        $id = $request->id;

        $categorie = Categorie::find($id);
        $categorie->update($request->all());
        return $categorie;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
       
        $categorie->delete();
        return response()->json("la catégorie est supprimer");

        

    }

    public function getIndex(){
        $Categorie = Categorie::with('sousCategorie')->get();
        return  response()->json($Categorie);
    }

    public function getCategorieByuId($id){
        $categorie = Categorie::find($id);
        if(is_null($categorie)){
            return response()->json(['message' => 'Categorie introuvable'],404);
        }
        return response()->json(Categorie::find($id),200);
    }

}
