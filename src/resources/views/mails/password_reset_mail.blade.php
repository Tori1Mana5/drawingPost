※このメールはパスワードの再設定をご希望された方にお送りしております。
<br>
<br>
<p>{{ $user->username }} 様</p>
<br>
<br>
いつも{{ config('app.name') }}をご利用いただき、誠にありがとうございます。
<br>
パスワード再設定用のURLをお送りします。
<br>
{{ link_to($url, $title = null, $attributes = [], $secure = null) }}
<br>
<br>
URLの有効期限は{{ $time }}です。
<br>
※※※※※本メールは送信専用のメールアドレスから送信しております。ご返信できませんのでご了承ください。※※※※※