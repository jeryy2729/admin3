@extends('layouts.app')
    <h1>Verify Your Email Address</h1>

    <p>Before proceeding, please check your email for a verification link.</p>

    @if (session('message'))
        <p style="color: green">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>