<?php

return [
  
  'models' => [
	
	  /*
		 * Bu paketten "HasPermissions" özelliğini kullanırken, 
		 * izinlerinizi almak için hangi Eloquent modelinin kullanılması gerektiğini bilmemiz gerekir. 
		 * Tabii ki, genellikle sadece "Permission" modelidir, ancak istediğinizi kullanabilirsiniz.
		 *
		 * İzin modeli olarak kullanmak istediğiniz modelin,
		 * `Spatie\Permission\Contracts\Permission` contract.
		 */
	
	  'permission' => Spatie\Permission\Models\Permission::class,
	
	  /*
		 * Bu paketten "HasRoles" özelliğini kullanırken, rollerinizi almak için hangi 
		 * Eloquent modelinin kullanılması gerektiğini bilmemiz gerekir. 
		 * Tabii ki, genellikle sadece "Role" modelidir, ancak istediğinizi kullanabilirsiniz.
		 *
		 * Role modeli olarak kullanmak istediğiniz modelin,
		 * `Spatie\Permission\Contracts\Role` contract.
		 */
	
	  'role' => Spatie\Permission\Models\Role::class,

  ],
  
  'table_names' => [
	
	  /*
		 * Bu paketten "HasRoles" özelliğini kullanırken, 
		 * rollerinizi almak için hangi tablonun kullanılması gerektiğini bilmemiz gerekir. 
		 * Temel bir varsayılan değer seçtik, ancak bunu istediğiniz herhangi bir tabloyla kolayca değiştirebilirsiniz.
		 */
	
	  'roles' => 'roles',
	
	  /*
		 * Bu paketteki "HasPermissions" özelliğini kullanırken, 
		 * izinlerinizi almak için hangi tablonun kullanılması gerektiğini bilmemiz gerekir. 
		 * Temel bir varsayılan değer seçtik, ancak bunu istediğiniz herhangi bir tabloyla kolayca değiştirebilirsiniz.
		 */
	
	  'permissions' => 'permissions',
	
	  /*
		 * Bu paketteki "HasPermissions" özelliğini kullanırken, 
		 * model izinlerinizi almak için hangi tablonun kullanılması gerektiğini bilmemiz gerekir. 
		 * Temel bir varsayılan değer seçtik, ancak bunu istediğiniz herhangi bir tabloyla kolayca değiştirebilirsiniz.
		 */
	
	  'model_has_permissions' => 'model_has_permissions',
	
	  /*
		 * Bu paketten "HasRoles" özelliğini kullanırken, 
		 * model rollerinizi almak için hangi tablonun kullanılması gerektiğini bilmemiz gerekir. 
		 * Temel bir varsayılan değer seçtik, ancak bunu istediğiniz herhangi bir tabloyla kolayca değiştirebilirsiniz.
		 */
	
	  'model_has_roles' => 'model_has_roles',
	
	  /*
		 * Bu paketten "HasRoles" özelliğini kullanırken, 
		 * rol izinlerinizi almak için hangi tablonun kullanılması gerektiğini bilmemiz gerekir. 
		 * Temel bir varsayılan değer seçtik, ancak bunu istediğiniz herhangi bir tabloyla kolayca değiştirebilirsiniz.
		 */
	
	  'role_has_permissions' => 'role_has_permissions',
  ],
  
  'column_names' => [
	
	  /*
		 * Aşağıdaki ilgili model birincil anahtarını adlandırmak istiyorsanız bunu değiştirin
		 * `model_id`.
		 *
		 * Örneğin, birincil anahtarlarınızın tümü UUID ise bu iyi olur. 
		 * Bu durumda, buna bir ad verin `model_uuid`.
		 */
	
	  'model_morph_key' => 'model_id',
  ],
	
	/*
	 * True değerine ayarlandığında, istisna iletisine gerekli permission/role adları eklenir. 
	 * Bu, bazı bağlamlarda bir bilgi sızıntısı olarak kabul edilebilir, 
	 * bu nedenle burada en iyi güvenlik için varsayılan ayar yanlıştır.
	 */
	
	'display_permission_in_exception' => false,
	
	/*
	 * Varsayılan olarak joker karakter izni aramaları devre dışıdır.
	 */
	
	'enable_wildcard_permission' => false,
	
	'cache' => [
		
		/*
		 * Performansı hızlandırmak için varsayılan olarak tüm izinler 24 saat boyunca önbelleğe alınır.
		 * İzinler veya roller güncellendiğinde önbellek otomatik olarak temizlenir.
		 */
		
		'expiration_time' => DateInterval::createFromDateString('24 hours'),
		
		/*
		 * Tüm izinleri depolamak için kullanılan önbellek anahtarı.
		 */
		
		'key' => config('cache.prefix') . '.permission.cache',
		
		/*
		 * Bir izin örneğini denetime geçirerek bir modele yönelik izin denetlerken, 
		 * bu anahtar Permissions modelinde önbelleğe almak için hangi özniteliğin kullanılacağını belirler.
		 *
		 * İdeal olarak, bu, izinleri kontrol etmek için tercih ettiğiniz yolla eşleşmelidir, örneğin:
		 * `$user->can('view-posts')` would be 'name'.
		 */
		
		'model_key' => 'name',
		
		/*
		 * İsteğe bağlı olarak, cache.php config dosyasında listelenen "store" 
		 * sürücülerinden birini kullanarak izin ve rol önbelleğe almak için 
		 * kullanılacak belirli bir önbellek sürücüsünü belirtebilirsiniz. 
		 * Burada 'default' kullanmak, cache.php içinde ayarlanan `default 'ı kullanmak anlamına gelir.
		 */
    
    'store' => 'default',
  ],
];
