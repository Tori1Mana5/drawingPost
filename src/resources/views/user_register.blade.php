<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>アカウントの新規登録</title>
</head>
<body>
	<h2>アカウント新規登録</h2>
	<form action="/account/register/confirm" method="post">
		{{ csrf_field() }}
		<div>
			アカウント名: <input type="text" name="account_name"><br>
			ニックネーム: <input type="text" name="nickname"><br>
			パスワード: <input type="password" name="password"><br>
			メールアドレス: <input type="email" name="mail_address"><br>
		</div>
		<div>
				<input type="submit" value="登録">
		</div>
	</form>

</body>
</html>