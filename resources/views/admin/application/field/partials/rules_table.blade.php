<table class="table">
	<tr>
		<td>required</td>
		<td>Alanı veri girilmesini zorunlu kılar.</td>
	</tr>
	<tr>
		<td>accepted</td>
		<td>CheckBox'ın işaretmesini zorunlu kılar.</td>
	</tr>
	<tr>
		<td>alpha</td>
		<td>Sadece alfabetik metin girilmesini zorunlu kılar.</td>
	</tr>
	<tr>
		<td>alpha_num</td>
		<td>Alfabetik ve numeric değerler haricinde değer girilemez.</td>
	</tr>
	<tr>
		<td>array</td>
		<td>Çoklu seçim yapılması istendiğinde kullabilir.</td>
	</tr>
	<tr>
		<td>boolean</td>
		<td>True ya da False değerleri olmasını zorunlu kılar.</td>
	</tr>
	<tr>
		<td>mimes:jpeg,jpg,png</td>
		<td>Resim dosyası olmasını zorunlu kılar.</td>
	</tr>
	<tr>
		<td>email</td>
		<td>Email formatında olmasını zorunlu kılar.</td>
	</tr>
	<tr>
		<td>nullable</td>
		<td>Bu alan zorunlu değil.</td>
	</tr>
	<tr>
		<td>file</td>
		<td>Dosya gönderimini zorunlu kılar.</td>
	</tr>
	<tr>
		<td>string</td>
		<td>Birden fazla karakter içermesini zorunlu kılar.</td>
	</tr>
	<tr>
		<td>integer</td>
		<td>Tam sayı olmalıdır.</td>
	</tr>
	<tr>
		<td>numeric</td>
		<td>Tam veya ondalıklı sayı olabilir.</td>
	</tr>
	<tr>
		<td>date</td>
		<td>Tarih biçimi veri göndermeyi zorunlu kılar.</td>
	</tr>
	<tr>
		<td>url</td>
		<td>URL formatında olmalıdır.</td>
	</tr>
	<tr>
		<td>phone:TR,AUTO</td>
		<td>Telefon numarası formatını zorunlu kılar. İsteğe bağlı olarak sadece TR kalabilir veya TR,EN
			yapılabilir.
		</td>
	</tr>
	<tr>
		<td>unique</td>
		<td>Girilen verinin o tabloda benzersiz olmasını zorunlu kılar.</td>
	</tr>
	<tr>
		<td>Daha fazlası için</td>
		<td><a href="https://laravel.com/docs/7.x/validation#available-validation-rules">Tıklayınız.</a></td>
	</tr>
	<tr>
		<td>Örnek kullanım</td>
		<td>required|url|phone:TR,EN|max:3|min:1|unique|numeric|mimes:jpeg,jpg,png</td>
	</tr>
</table>
