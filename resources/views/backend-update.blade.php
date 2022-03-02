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
    <center><a href="{{ route('tech', ['id'=>$model->id]) }}">Вернуться к элементу</a></center>
    <table width="80%" align="center" border="1">
        <tr>
            <td width="30%">Имя:</td>
            <td><input name="name" style="width: 100%" value="{{ $model->name }}"></td>
        </tr>
        <tr>
            <td width="30%">Сотрировка:</td>
            <td><input name="sorting" style="width: 100%" value="{{ $model->sorting }}"></td>
        </tr>
        <tr>
            <td>Описание:</td>
            <td><textarea name="description" style="width: 100%; height: 500px;">{{ $model->description }}</textarea></td>
        </tr>
        <tr>
            <td>Продолжить ветку на отдельной странице?</td>
            <td><input type="checkbox" name="branch_stop_flag" value="1"
                    {{ $model->branch_stop_flag == 1 ? 'checked=checked' : '' }}></td>
        </tr>
        <tr>
            <td>Создать отдельную страницу?</td>
            <td><input type="checkbox" name="is_page_flag" value="1"
                    {{ $model->is_page_flag == 1 ? 'checked=checked' : '' }}></td>
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
