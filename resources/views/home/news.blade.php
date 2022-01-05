@extends('layouts.home.homelayout')

@section('title')
    News
@endsection

<style>
    #news{
        background-color: #2c6966;
        border-bottom: thick solid #18FFFF;
    }

    body, html {
        height: 100%;
        background: url("../images/news.jpg") no-repeat center center fixed;
        background-size: cover;
    }

    .flex-container {
        display: -webkit-flex;
        display: flex;
        width: auto;
        height: auto;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .flex-item {
        -webkit-flex-direction: column;
        flex-direction: column;
        flex: 1 1 100%;
        background-color: #EEEEEE;
        width: auto;
        height: auto;
        max-height: 100vh;
        margin: 10px;
        margin-left: 50px;
        margin-right: 50px;
        overflow-y: auto;
        box-shadow: 2px 3px 8px #888888;
        border-radius: 4px;
    }

    .flex-container-title {
        display: -webkit-flex;
        display: flex;
        width: auto;
        height: auto;
        background-color: #2E7D32;
    }

    .flex-container-body {
        display: -webkit-flex;
        display: flex;
        background-color: #EEEEEE;
    }

    h1[id="title"] {
        margin-left: 20px;
        font-family: Roboto-Thin;
        color: #FAFAFA;
    }

    p[id="date"] {
        font-size: 20px;
        color: #FAFAFA;
        margin-left: 20px;
        font-family: Roboto-Regular;
    }

    p[id="news_body"] {
        font-size: 24px;
        margin-left: 20px;
        font-family: Roboto-Regular;
    }

    img[id="news_body_img"] {
        width: 650px;
        margin: auto;
        margin-top: 10px;
        margin-bottom: 10px;
        border: 2px solid black;
        border-radius: 10px;
    }

</style>

@section('content')
    <div class="flex-container">
        {{-- @foreach ($news as $n)
        <div class="flex-item">
            <div class="flex-container-title">
                <h1 id="title">{{ $n->newstitle }}<br></h1>
            </div>
            <div class="flex-container-title">
                <p id="date">{{ $n->updated_at }}</p>
            </div>
            <div class="flex-container-body">
                <img src="/newsimg/{{ $n->newspicture }}" id="news_body_img">
            </div>
            <div class="flex-container-body">
                <p id="news_body">{{ $n->newsbody }}</p>
            </div>
        </div>
        @endforeach --}}
        @forelse ($news as $n)
        <div class="flex-item">
            <div class="flex-container-title">
                <h1 id="title">{{ $n->newstitle }}<br></h1>
            </div>
            <div class="flex-container-title">
                <p id="date">{{ $n->updated_at }}</p>
            </div>
            @if ($n->newspicture!=null)
                <div class="flex-container-body">
                    <img src="/storage/newsimg/{{ $n->newspicture }}" id="news_body_img">
                </div>
            @endif
            <div class="flex-container-body">
                <p id="news_body">{{ $n->newsbody }}</p>
            </div>
        </div>
        @empty
        <div class="flex-item">
            <div class="flex-container-title">
                <h1 id="title">No News<br></h1>
            </div>
            <div class="flex-container-title">
                <p id="date">00-00-0000</p>
            </div>
            <div class="flex-container-body">
                <p id="news_body">No News!</p>
            </div>
        </div>
        @endforelse
    </div>
@endsection