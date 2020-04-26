window._ = require('lodash');

/**
 * JQuery ve modüller ve sekmeler gibi JavaScript tabanlı Bootstrap özellikleri için destek sağlayan 
 * Bootstrap jQuery eklentisini yükleyeceğiz. 
 * Bu kod, uygulamanızın özel ihtiyaçlarına uyacak şekilde değiştirilebilir.
 */

try {
  window.Popper = require('popper.js').default;
  window.$ = window.jQuery = require('jquery');

  require('bootstrap');
} catch (e) {
}

/**
 * Laravel arka ucumuza kolayca istek göndermemizi sağlayan axios HTTP kütüphanesini yükleyeceğiz.
 * Bu kütüphane, "XSRF" simge çerezinin değerine göre CSRF jetonunu başlık olarak otomatik olarak gönderir.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo, kanallara abone olmak ve Laravel tarafından yayınlanan etkinlikleri dinlemek için etkileyici bir API sunar.
 * Yankı ve etkinlik yayını ekibinizin kolayca sağlam gerçek zamanlı web uygulamaları geliştirmesine olanak tanır.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'myKey',
  wsHost: window.location.hostname,
  wsPort: 6001,
  wssPort: 6001,
  disableStats: true,
  encrypted: true
});
