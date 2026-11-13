@extends('errors::layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __('You do not have the required permissions to access this workspace or resource.'))