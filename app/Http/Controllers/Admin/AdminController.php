<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Http\Requests\UserAdminRequest;

use App\Models\Admin;

use Illuminate\Http\Request;



class AdminController extends Controller {

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index() {
        $users = Admin::all();
        return view('admin.users_admin.index', compact('users'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create() {
        return view('admin.users_admin.create');
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(UserAdminRequest $request) {        
         Admin::create($request->all());
        session()->flash('flash.success', 'El usuario se ha creado con éxito');
        return redirect()->route('admins.index');
    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit(Admin $admin) {  

        return view('admin.users_admin.edit', compact('admin'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(UserAdminRequest $request, $id) {
        $admin = Admin::findOrFail($id);       
         if (empty($request->password)) {
            $admin->fill($request->except('password'));
        } else {
            $admin->fill($request->all());
        }
        $admin->save();
        session()->flash('flash.success', 'El usuario se actualizó con éxito');
        return redirect()->route('admins.index');
    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Admin $admin) {

        if ($admin->id == auth('admin')->user()->id) {

            return redirect()->route('admins.index');

        }



        $admin->delete();

        session()->flash('flash.success', 'El usuario se eliminó con éxito');

        return redirect()->route('admins.index');

    }

}

