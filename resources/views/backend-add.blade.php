<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>

@if($errors->any())
    @foreach($erros->all() as $error)
        ...dww
    @endforeach
@endif

<form method="post">
    @csrf
    <center><a href="{{ route('home') }}">Вернуться на главную</a></center>
    <table width="80%" align="center" border="1">
        <tr>
            <td width="30%">Имя:</td>
            <td><input name="name" style="width: 100%"></td>
        </tr>
        <tr>
            <td>Продолжить ветку на отдельной странице?</td>
            <td><input type="checkbox" name="branch_stop_flag" value="1"></td>
        </tr>
        <tr>
            <td>Создать отдельную страницу?</td>
            <td><input type="checkbox" name="is_page_flag" value="1"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit">
            </td>
        </tr>
    </table>
</form>

</body>
</html>