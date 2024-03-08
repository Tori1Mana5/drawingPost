<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定完了</title>
</head>
<body>
    <div>
        <h2>パスワードリセットが完了しました</h2>
        {{ link_to_route('user.login', $title = 'TOPへ') }}
    </div>
</body>
</html>