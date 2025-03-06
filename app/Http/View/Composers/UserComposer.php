<?php 

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        // Fetch all users with the role 'User'
        $users = User::where('role', 'User')->get();

        // Share the users with all views
        $view->with('users', $users);
    }
}
