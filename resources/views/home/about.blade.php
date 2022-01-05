@extends('layouts.home.homelayout')

@section('title')
    Contact Us
@endsection

<style>
    #aboutus{
        background-color: #2c6966;
        border-bottom: thick solid #18FFFF;
    }

    body, html {
        height: 100%;
        background: url("{{ asset('sysimages/bank_about.jpg') }}") no-repeat center center fixed;
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

    .flex-container-heading {
        display: -webkit-flex;
        display: flex;
        width: auto;
        height: auto;
        background: linear-gradient(rgba(15, 83, 92, 0.6), rgba(0, 0, 0, 0));
    }

    .flex-container {
        display: -webkit-flex;
        display: flex;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
        width: auto;
        height: auto;
        margin-left: 10px;
        margin-right: 10px;
        background: rgba(0, 49, 51, 0.712);
        border: 2px solid #f1f1f1;
    }

    .flex-item {
        width: 500px;
        height: 200px;
        margin: 10px;
        margin-left: auto;
        margin-right: auto;
    }

    @media screen and (max-width: 500px) {
        .flex-item {
            width: auto;
            height: auto;
        }
    }

    h1[id="contact"] {
        line-height: normal;
        font-family: Roboto-Thin;
        font-size: 50px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        color: white;
    }

    h1[id="sub-contact"] {
        margin-top: 0px;
        margin-left: 10px;
        font-size: 30px;
        font-family: Roboto-Regular;
        color: white;
        line-height: normal;
    }

    p[id="sub-contact"] {
        margin-top: -10px;
        margin-left: 10px;
        font-size: 24px;
        font-family: Roboto-Regular;
        color: white;
        line-height: normal;
    }

    @media screen and (max-width: 1000px) {
        h1[id="sub-contact"] {
            text-align: center;
        }

        p[id="sub-contact"] {
            text-align: center;
        }
    }

</style>

@section('content')
<div class="flex-container-background">
    <div class="flex-container-heading">
        <h1 id="contact">About Us</h1>
    </div>

    <div class="flex-container" style="border-bottom: 0;
                                       padding-bottom: 40px;
                                       border-top-left-radius: 10px;
                                       border-top-right-radius: 10px;">
        <div class="flex-item">
            <h1 id="sub-contact">Message From Chairman</h1>
            <p id="sub-contact">
                Dear Customers, <br>
                We are working for your conveniance to operate banking sevices seemlessly. Customer's conveniance is the first priority for us. We are working hard for you. Please stay with Castle Bank. 
            </p>
        </div>
        <div class="flex-item">
            <h1 id="sub-contact">Message From Director</h1>
            <p id="sub-contact">
                Hello Customers, <br>
                We are designing every services to be a less hastle to you. Our staffs are also very much friendly and active 24/7 
                only for you. Our promises is to provide the best service through internet. Our customers can seemlessly use their account 
                credentials without being worried about security.
            </p>
        </div>
    </div>

    <div class="flex-container" style="border-top: 0;
                                       border-bottom-left-radius: 10px;
                                       border-bottom-right-radius: 10px;">
        <div class="flex-item">
            <h1 id="sub-contact">We are now</h1>
            <p id="sub-contact">
                2014686+ Customers <br>
                300+ Employees <br>
                Secured Online Banking Ever Introduced...
            </p>
        </div>
        <div class="flex-item">
            <h1 id="sub-contact">Mobile Apps</h1>
            <p id="sub-contact">
                Download our app and live chat<br>
                with our customer care !<br>
                App available on Google Play<br>
                and iPhone-AppStore.
            </p>
        </div>
    </div>
</div>
@endsection
