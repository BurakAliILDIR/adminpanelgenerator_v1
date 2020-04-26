/**
 * İlk olarak, bu projenin Vue ve diğer kütüphaneleri içeren tüm JavaScript bağımlılıklarını yükleyeceğiz. 
 * Vue ve Laravel kullanarak sağlam, güçlü web uygulamaları oluştururken harika bir başlangıç noktasıdır.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Vue bileşenlerinizi otomatik olarak kaydetmek için aşağıdaki kod bloğu kullanılabilir. 
 * Vue bileşenleri için bu dizini özyinelemeli olarak tarar ve bunları otomatik olarak "basename" kaydeder.
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Ardından, yeni bir Vue uygulama örneği oluşturacağız ve sayfaya ekleyeceğiz. 
 * Ardından, bu uygulamaya bileşenler eklemeye başlayabilir veya JavaScript iskelesini 
 * benzersiz gereksinimlerinize uyacak şekilde özelleştirebilirsiniz.
 */

const app = new Vue({
    el: '#app',
});
