<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchBar extends Component
{
    public $query = '';

    public function render()
    {
        $currentUser = Auth::user();
        $users = User::where('id', '!=', $currentUser->id)
            ->where('name', 'like', '%' . $this->query . '%') // filter by search
            ->orderBy('name')->get();
        // fetch friend ids directly from the pivot table to avoid ambiguous `id` column and undefined relationship issues
        $friendsIds = DB::table('friends')->where('user_id', $currentUser->id)->pluck('friend_id')->toArray();
        return view('livewire.search-bar', [
            'users' => $users,
            'friendsIds' => $friendsIds
        ]);
    }

    public function addFriend($friendId)
    {
        $user = Auth::user();

        if (!$user->friends()->where('friend_id', $friendId)->exists()) {
            $user->friends()->attach($friendId);
        }

        // Optionally emit an event to update frontend
        $this->dispatch('friendAdded', friendId: $friendId);
    }
}
