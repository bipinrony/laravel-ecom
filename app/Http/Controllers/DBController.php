<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DBController extends Controller
{
    public function index()
    {
        // $users = DB::select('select * from users');
        // $users = DB::select('select * from users where role = ?', [1]);
        // $users = DB::table('users')->get();
        $users = DB::table('users')->where('role', 1)->pluck('name')->toJson();
        // $users = User::where('role', 1)->pluck('name')->toJson();




        // $users = DB::insert('insert into categories (name, slug) values (?, ?)', ['test name', 'test-name']);
        // $users = DB::update(
        //     'update categories set description = "test" where slug = ?',
        //     ['test-name']
        // );

        // $users = DB::delete('delete from categories where slug = ?', ['test-name']);
        // $users = DB::statement('truncate table testing');
        // $users = DB::statement('drop table testing');

        // DB::transaction(function () {
        //     DB::delete(
        //         'delete from testing where id = ?',
        //         [2]
        //     );

        //     DB::update(
        //         'update testing set1 name = "testing" where name = ?',
        //         ['test']
        //     );
        // });

        // DB::beginTransaction();
        // try {
        //     DB::delete(
        //         'delete from testing where id = ?',
        //         [2]
        //     );

        //     DB::update(
        //         'update testing set1 name = "testing" where name = ?',
        //         ['test']
        //     );
        // } catch (Exception $e) {
        //     DB::rollBack();
        // }

        // DB::commit();

        // $id = DB::table('testing')->insert(
        //     ['name' => 'john']
        // );
        // dump($id);

        // $id = DB::table('testing')->insertGetId(
        //     ['name' => 'doe']
        // );
        // dump($id);

        // DB::table('testing')
        //     ->where('id', 1)
        //     ->update(['name' => 'test_updated']);

        $users =  DB::table('users')
            ->join('testing', 'users.id', '=', 'testing.user_id')
            ->where('users.id', 1)
            ->select('users.*', 'testing.contact_number')
            ->get();

        dd($users);
    }
}
