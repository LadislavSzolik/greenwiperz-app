@extends('errors::minimal')

@section('title', __('Bad request'))
@section('code', '400')
@if($exception->getMessage())
    @section('message', $exception->getMessage())
@else
@section('message', 'Bad request...')
@endif  
