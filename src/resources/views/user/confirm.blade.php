<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>確認画面</title>
    <p>この内容でアカウント登録していいですか？</p>
        ユーザID: {{ old('body.0') }}
		<br>
		ニックネーム: {{ old('body.1') }}
		<br>
        メールアドレス: {{ old('body.2') }}
        <br>
		パスワード: セキュリティの面で表示しません
		<br>
    {{ link_to_route('user.regist', $title = "修正する") }}
</head>
<body>
    
</body>
</html>