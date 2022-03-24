@extends('layouts.default')

@section('pageLayoutTitle', 'Пользователи')
@section('pageLayoutHeader', 'Пользователи')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('admin.user.index'))

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary" role="button">Добавить</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.user.edit', $user->id) }}">Редактировать</a>
                            <a class="btn btn-danger btn-sm" href="#"
                               onclick="document.getElementById('formId{{ $user->id }}').submit(); return false;">Удалить</a>
                        </div>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="post"
                              id="formId{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">Всего записей: {{ $users->total() }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
    {{ $users->links() }}
@endsection
