@extends('errors::layout')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment or active subscription is required to access this feature.'))