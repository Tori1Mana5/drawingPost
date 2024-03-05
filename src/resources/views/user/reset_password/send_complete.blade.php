<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセットメール送信完了</title>
</head>
<body>
    <div>
        <h2>パスワードリセットメールを送信しました。</h2>
    </div>
    {{ link_to_route('user.login', $title = "ログイン画面") }}
</body>
</html>