<?php 
	namespace Gaia\Repositories;

	interface UserRepositoryInterface
	{
		public function getAll();
		public function find($id);
		public function create($input);
		public function update($id, $input);
		public function delete($id);

		public function getAllRoles();
		public function findPermission($id);
	}
?>