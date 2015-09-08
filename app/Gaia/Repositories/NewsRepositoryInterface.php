<?php 
	namespace Gaia\Repositories;
	use App\Http\Requests\Admin\NewsRequest;

	interface NewsRepositoryInterface
	{
		public function getAll($limit);
		public function getOnlyWithContent($limit);
		public function find($id);
		public function create($input);
		public function update($id, $input);
		public function delete($id);
		public function getByCategory($category_id, $limit);
		public function getByIsFeatured($limit);

	}
?>
