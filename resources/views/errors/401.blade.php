@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('You must be authenticated to access this resource.'))