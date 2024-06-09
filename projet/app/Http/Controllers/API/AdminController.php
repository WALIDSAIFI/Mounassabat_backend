<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function blockUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->Etat = 1;
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Compte utilisateur bloqué avec succès.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }
    }



    public function userCreationsLastSixDays()
    {
        $creations = DB::table('users')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $data = [];
        foreach ($creations as $creation) {
            $data[$creation->date] = $creation->count;
        }

        return response()->json($data);
    }

    public function countBlockedAndUnblockedUsers()
    {
        $blockedCount = User::where('Etat', 1)->count();
        $unblockedCount = User::where('Etat', 0)->count();

        return response()->json([
            'blocked_users' => $blockedCount,
            'unblocked_users' => $unblockedCount,
        ]);
    }
    public function unblockUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->Etat = 0;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Compte utilisateur débloqué avec succès.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }
    }
    public function nombreBolker(){
         $nombre = User::where('Etat',1)->count();

         return response()->json([
              'nombre des utilisateur boker' => $nombre,
         ]);
    }
    public function nombreNomBloker(){
        $nombrNomBoloker = User::where('Etat',0)->count();
        return response()->json([
            'nombre des utilisteur nom bloker' => $nombrNomBoloker,
        ]);
    }
    public  function utilisateurBloker(){
        $userBoloker = User::where('Etat',0)->get();
        return response()->json([
               $userBoloker,
        ]);
    }
    public  function utilisateurBloker(){
        $userBoloker = User::where('Etat',0)->get();
        return response()->json([
            $userBoloker,
        ]);
    }


}
