@extends('errors::layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('TaskFlow is currently undergoing scheduled maintenance. Please check back shortly.'))