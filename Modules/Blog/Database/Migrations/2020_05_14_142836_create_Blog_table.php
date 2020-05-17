<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
	use \App\Traits\MigrationTraits\BelongsToManyTableSettings;
	
	private $fields = null;
	
	public function __construct()
	{
		$model = 'Modules\\Blog\\Models\\Blog';
		$this->fields = (new $model())->getSettings('fields');
	}
	
	public function up()
	{
		Schema::create('Blog', function (Blueprint $table) {
			$table->uuid('id')->index()->unique()->primary();
			$table->string('slug')->unique()->index();
			$table->timestamps();
			$table->softDeletes();
			foreach ($this->fields as $key => $field) {
				switch ($type = $field['type']) {
					case 'radio':
					case 'email':
					case 'text':
					case 'password':
						$table->string($key)->nullable()->index();
						break;
					case 'hidden':
						if ($key !== 'id') $table->string($key)->nullable();
						break;
					case 'checkbox':
						$table->boolean($key)->default(0);
						break;
					case 'number':
						if (@$field['decimal']) $table->decimal($key)->nullable()->index();
						else $table->integer($key)->nullable()->index();
						break;
					case 'select':
						if (@($rel = $field['relationship']) && !($rel['type'] === 'belongsToMany') && !($rel['type'] === 'belongsTo')) {
							$table->uuid($key)->nullable()->index();
						} else if ( !$field['relationship']) {
							$table->string($key)->nullable()->index();
						}
						break;
					case 'textarea':
						$rows = @$field['attributes']['rows'] ?? 5;
						if ($rows < 5) $table->text($key)->nullable();
						else if ($rows === 5) $table->mediumText($key)->nullable();
						else $table->longText($key)->nullable();
						break;
					case 'date':
						$table->date($key)->nullable()->index();
						break;
					case 'datetime':
						if ($key !== 'created_at' && $key !== 'updated_at')
							$table->dateTime($key)->nullable()->index();
						break;
					case 'auth':
						$table->uuid($key)->index();
						break;
				}
			}
		});
		$this->belongsToManyCreate();
	}
	
	public function down()
	{
		$this->belongsToManyDown();
		Schema::dropIfExists('Blog');
	}
}
