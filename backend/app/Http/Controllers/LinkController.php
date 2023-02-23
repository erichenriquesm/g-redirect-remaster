<?php

namespace App\Http\Controllers;
use App\Models\BaseLink;
use App\Models\ChildLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{


    public function list (){
        return  BaseLink::where('user_id', Auth::id())->with(['Childs'])->paginate(10);
    }

    public function create (Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'link' => 'required|string',
        ]);

        try{
            if(BaseLink::where(['name' => $request->input('name'), 'user_id' => Auth::id()])->first()){
                return response()->json(['messege' => 'Já existe um link de entrada com o mesmo nome!'], 422);
            }
    
            $link = BaseLink::create([
                'name' => $request->input('name'),
                'link' => $request->input('link'),
                'user_id' => Auth::id(),
            ]);
    
            $max_clicks = 0;
            $childs = $request->input('childs');
            foreach ($childs as $key => $child){
                $max_clicks +=  $child['max_clicks'];
                ChildLink::create([
                    'link' => $child['link'],
                    'max_clicks' => $child['max_clicks'],
                    'base_id' => $link->id
                ]);
            }
    
            $link->update([
                'max_clicks' => $max_clicks
            ]);
    
    
            $q = BaseLink::where('id', $link->id)->with(['Childs'])->get();
    
            return response()->json([
                'message' => 'Link de entrada e de saídas criados',
                'link' => $q
            ]);
        }catch(\Exception $e){
            return response()->json(['messege' => 'Erro ao criar link de entrada', 'error' => $e], 422);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'string',
            'link' => 'string',
        ]);

        BaseLink::where(['id' => $id, 'user_id' => Auth::id()])->update($request->except(['childs']));
        $max_clicks = 0;
        $childs = $request->input('childs');
        foreach ($childs as $key => $child){
            ChildLink::updateOrcreate(
                [
                    'link' => $child['link'], 
                ],
                [
                'link' => $child['link'],
                'max_clicks' => $child['max_clicks'],
                'base_id' => $id
            ]);
        }

        $current = BaseLink::where(['id' => $id, 'user_id' => Auth::id()])->with(['Childs'])->first();

        foreach ($current->Childs as $key => $value) {
            if( $value['max_clicks'] >= 0){
                $max_clicks += $value['max_clicks'];
            }
        }

        BaseLink::where(['id' => $id, 'user_id' => Auth::id()])->update([
            'max_clicks' => $max_clicks
        ]);
        
        $q = BaseLink::where(['id' => $id, 'user_id' => Auth::id()])->with(['Childs'])->get();

        return response()->json([
            'message' => 'Link de entrada atualizado',
            'link' => $q
        ]);
    }

    public function delete($id){
        try{
            BaseLink::where(['id' => $id, 'user_id' => Auth::id()])->delete();
            return response()->json(['message' => 'Link de entrada deletado com sucesso!']);
        }catch(\Exception $e){
            return response()->json(['messege' => 'Erro ao deletar link de entrada', 'error' => $e], 422);
        }
    }

    public function deleteChild($idChild, $idBase){
        try{
            $child = ChildLink::where(['id' => $idChild, 'base_id' => $idBase])->first();
            $base = BaseLink::where(['id' => $idBase, 'user_id' => Auth::id()])->first();
            $base->update([
                "max_clicks" => $base->max_clicks - $child->max_clicks
            ]);
            $child->delete();
            $q = BaseLink::where(['id' => $idBase, 'user_id' => Auth::id()])->with(['Childs'])->get();
            return response()->json(['message' => 'Link de saída deletado com sucesso!', 'link de entrada: ' => $q]);
        }catch(\Exception $e){
            return response()->json(['messege' => 'Erro ao deletar link de saída', 'error' => $e], 422);
        }
    }

    public function updateChild(Request $request, $idChild, $idBase){
        try{
            $child = ChildLink::where(['id' => $idChild, 'base_id' => $idBase])->first();
            $child->update($request->all());
            $max_clicks = 0;
            $current = BaseLink::where(['id' => $idBase, 'user_id' => Auth::id()])->with(['Childs'])->first();
            foreach ($current->Childs as $key => $value) {
                if( $value['max_clicks'] >= 0){
                    $max_clicks += $value['max_clicks'];
                }
            }
    
            BaseLink::where(['id' => $idBase, 'user_id' => Auth::id()])->update([
                'max_clicks' => $max_clicks
            ]);

            $q = BaseLink::where(['id' => $idBase, 'user_id' => Auth::id()])->with(['Childs'])->first();
            return response()->json(['message' => 'Link de saída atualizado com sucesso!', 'link de entrada: ' => $q]);
        }catch(\Exception $e){
            return response()->json(['messege' => 'Erro ao atualizar link de saída', 'error' => $e], 422);
        }
    }

    public function acess($idChild, $idBase){
        try{
            $child = ChildLink::where(['id' => $idChild, 'base_id' => $idBase])->first();
            if($child-> clicks < $child->max_clicks){
                $child->increment('clicks', 1);
                BaseLink::where(['id' => $idBase , 'user_id' => Auth::id()])->with(['Childs'])->increment('clicks', 1);
                return response()->json(['message' => '+1 acesso!']);
            } 
            return response()->json(['message' => 'Redirect já chegou ao limite!']);
        }catch(\Exception $e){
            return response()->json(['messege' => 'Erro ao incrementar', 'error' => $e], 422);
        }
    }
}
