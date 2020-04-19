<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels (Yayın Kanalları)
|--------------------------------------------------------------------------
|
| Burada uygulamanızın desteklediği tüm olay yayın kanallarını kaydedebilirsiniz. 
| Verilen kanal yetkilendirme geri çağrıları, kimliği doğrulanmış bir kullanıcının kanalı dinleyip
| dinlemediğini kontrol etmek için kullanılır.
| 
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
  return (int)$user->id === (int)$id;
});
