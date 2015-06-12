<?php namespace Gaia\Repositories; 

use App\User;
use App\Models\Role;
use App\Models\Permission;
use Hash;

class UserRepository extends DbRepository implements UserRepositoryInterface 
{
	
	protected $limit = 12;
	

	/**
	 * Returns all the user sorted by published_at
	 * @return UsersCollection
	 */
	public function getAll()
	{	
		return User::latest('created_at')->paginate($this->limit);
	}


	/**
	 * Returns one user by id
	 * @param int $id 
	 * @return User
	 */
	public function find($id)
	{
		return User::findOrFail($id);
	}


	/**
	 * Create a user object
	 * @param int UserRequest $request 
	 * @return User
	 */
	public function create($input)
	{
		$input['password'] = Hash::make($input['password']);
		//create user
		$user = User::create($input);
		//create role 
		$role = Role::create(['name' => $input['user_role']."-".$user->id, 'display_name' => $input['user_role']]);
		//attach role
		$user->attachRole($role);
		
		return $user;
	}


	/**
	 * Update a user object
	 * @param int $id 
	 * @param type $input 
	 * @return User
	 */
	public function update($id, $input)
	{
		$user = $this->find($id);
		
		$input['password'] = Hash::make($input['password']);
		$user->update($input); 
		//detach existing role
		$role = $this->getUserRole($user);
		$user->detachRole($role);
		//attach role
		$role = Role::create(['name' => $input['user_role']."-".$user->id, 'display_name' => $input['user_role']]);
		$user->attachRole($role);

		return $user;
	}


	/**
	 * Delete the user object
	 * @param int $id 
	 * @return 
	 */
	public function delete($id)
	{
		$user = $this->find($id);
		$user->delete();
	}


	/**
	 * Return all the roles
	 * @return type
	 */
	public function getAllRoles()
	{
		return Role::all();
	}


	/**
	 * Get the user role
	 * @return type
	 */
	public function getUserRole($user)
	{
		$roles = $user->roles;
		return $roles[0];
	}


	/**
	 * Returns the list of permissions available fpr a certain role
	 * @param type $role 
	 * @return type
	 */
	public function getPermissionsByRole($role)
	{
		
		$rolename = explode("-", $role->name);
		$rolename = strtolower($rolename[0]);

		if($rolename == 'superadmin')
			return null;

		$perms = ['editor', 'administrator'];
		$perms['editor'] = ['create-edit-news', 'list-news', 'create-edit-pages', 'list-pages', 'translate-news', 'translate-pages'];
		$perms['administrator'] = ['create-edit-news', 'delete-news', 'list-news', 'translate-news', 'create-edit-page-templates', 'delete-page-templates', 'list-page-templates', 'create-edit-pages', 'list-pages', 'delete-pages', 'translate-pages', 'manage-categories'];
		
		if($rolename =="editor")
			$permissions = Permission::whereIn('name', $perms['editor'])->get();
		else
			$permissions = Permission::whereIn('name', $perms['administrator'])->get();

		return $permissions;
	}


	/**
	 * Find a Permission
	 * @param type $id 
	 * @return type
	 */
	public function findPermission($id)
	{
		return Permission::findOrFail($id);
	}

}
?>