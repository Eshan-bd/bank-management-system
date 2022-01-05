@extends('layouts.home.homelayout')
@section('title')
    Login
@endsection

<style>
    #home{
        background-color: #2c6966;
        border-bottom: thick solid #18FFFF;
    }

    body, html {
        height: 100%;
        background: url("{{ asset('sysimages/bank_home.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .flex-container-background {
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        flex-direction: column;
        overflow: auto;
        width: auto;
    }

    .flex-container {
        display: -webkit-flex;
        display: flex;
    }

    .flex-item {
        margin: auto;
        margin-top: 0px;
        background: transparent;
    }

    .flex-item-0 {
        margin: auto;
        width: 100%;
        background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, 0));
    }

    .flex-item-1 {
        margin: auto;
        margin-top: 10px;
        margin-bottom: 30px;
        background: rgba(0, 0, 0, .5);
        width: 5000px;
        border-radius: 10px;
    }

    @media screen and (max-width: 540px) {
        .flex-item-1 {
            margin-top: 0px;
            width: 300px;
        }
    }

    @media screen and (max-width: 340px) {
        .flex-item-1 {
            margin-top: 0px;
            width: auto;
        }
    }

    h1[id="form_header"] {
        line-height: 60px;
        margin-left: 20px;
        font-family: Roboto-Thin;
        font-size: 50px;
        text-align: center;
        color: white;
    }

    /* Bordered form */
    .form {
        align-content: center;
        border: 2px solid #f1f1f1;
        border-radius: 10px;
    }

    h2 {
        font-family: OpenSans-Light;
        color: white;
        font-size: 40px;
        margin-left: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    h3 {
        font-family: OpenSans-Light;
        color: white;
        font-size: 30px;
        margin-left: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    h4 {
        font-family: OpenSans-Light;
        color: white;
        font-size: 20px;
        margin-left: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .flex-item table{
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        border: 1px solid white;
        border-radius: 5px;
    }

    .flex-item-login {
        margin: auto;
        margin-top: 0px;
        margin-bottom: 5px;
        background-color: transparent;
        border-bottom: thick solid white
    }
</style>

@section('content')
    <div class="flex-container-background">
        <div class="flex-container">
            <div class="flex-item-0">
                <h1 id="form_header">Castle Internet Banking</h1>
            </div>
        </div>

        <div class="flex-container">
            <div class="flex-item-1">
                <div class="form form-control">
                    <div class="flex-item-login">
                        <h2>Welcome to Online Banking</h2>
                    </div>

                    <div class="flex-item">
                        <h4>
                            We are offering a easier solution for banking. Our services are now more simplified with just simple clicks! <br>
                            We are offering:
                            <li>Account Services</li>
                            <li>Loan Services</li>
                            You can browse seemlessly with our simplified banking!
                        </h4>
                    </div>

                    <div class="flex-item-login">
                        <h2>Interest Rates</h2>
                    </div>

                    <div class="flex-item">
                        <h4>
                            Interst rates for different accounts:
                            <table>
                                <tr>
                                    <th><h4>Account Types</h4></th>
                                    <th><h4>Rate</h4></th>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Savings Account</h4>
                                    </td>
                                    <td>
                                        <h4>7.5%</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Business Account</h4>
                                    </td>
                                    <td>
                                        <h4>5%</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Student Account</h4>
                                    </td>
                                    <td>
                                        <h4>10.5%</h4>
                                    </td>
                                </tr>
                            </table>
                        </h4>
                    </div>

                    <div class="flex-item-login">
                        <h2>Loans</h2>
                    </div>

                    <div class="flex-item">
                        <h4>
                            Loans are now even easier to maintain with our internet banking. Loans available:
                            <table>
                                <tr>
                                    <th>
                                        <h4>Types Of Loan</h4>
                                    </th>
                                    <th>
                                        <h4>Rate of Interests</h4>
                                    </th>
                                </tr>
                                @foreach ($loantypes as $loan)
                                <tr>
                                    <td>
                                        <h4>{{ $loan->type }}</h4>
                                    </td>
                                    <td>
                                        <h4>{{ $loan->rate }}%</h4>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

