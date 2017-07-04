@extends('admin.master')

@section('content')
    <div class="col-sm-6">
        @if (Session::has('errors'))
            <div class="alert alert-danger">
                {{ Session::get('errors') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <h2>{{ trans('admin.reset-view')}}</h2>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <td>{{ trans('home.week') }}</td>
                    <td>
                        {!! Form::open([
                            'method' => 'POST',
                            'action' => ['Admin\ViewController@resetWeekView'],
                            'class' => 'form-horizontal comfirm-reset',
                        ]) !!}
                        {!! Form::button(trans('admin.reset'), [
                            'class' => 'btn btn-primary',
                            'type' => 'submit',
                        ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                <tr>
                    <td>{{ trans('home.month') }}</td>
                    <td>
                        {!! Form::open([
                            'method' => 'POST',
                            'action' => ['Admin\ViewController@resetMonthView'],
                            'class' => 'form-horizontal comfirm-reset',
                        ]) !!}
                        {!! Form::button(trans('admin.reset'), [
                            'class' => 'btn btn-primary',
                            'type' => 'submit',
                        ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
