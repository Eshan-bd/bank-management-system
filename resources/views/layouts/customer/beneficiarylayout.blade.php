<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://kit.fontawesome.com/536694ad7b.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<title>
    @yield('title')
</title>

<style>
    .flex-container-ben {
        display: -webkit-flex;
        display: flex;
        margin-left: 256px;
        width: auto;
        height: auto;
        padding-top: 200px;
        margin-bottom: 100px;
        flex-direction: column;
    }

    .flex-item-ben {
        display: -webkit-flex;
        display: flex;
        flex-direction: row;
        margin: auto;
        margin-top: 10px;
        width: auto;
        height: auto;
        background-color: #E0E0E0;
        border-radius: 3px;
        box-shadow: 0px 2px 2px #888888;
    }

    .flex-item-ben-1 {
        flex: 1;
        height: 80px;
        margin: 5px;
        background-color: transparent;
    }

    .flex-item-ben-2 {
        width: 720px;
        height: auto;
        margin: 5px;
        background-color: transparent;
    }

    @media screen and (max-width: 855px) {
        .flex-container-ben, {
            margin-left: auto;
        }

        .flex-item-ben-2 {
            width: 250px;
        }
    }

    @media screen and (max-width: 370px) {
        .flex-container-ben {
            margin-left: auto;
            overflow-x: scroll;
        }
    }

    p[id="info"] {
        text-align: center;
        font-size: 40px;
        color: #212121;
        margin: auto;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 12px 32px;
        font-family: Roboto-Regular;
        border: 2px solid #263238;
        border-radius: 7px;
        background-color: #F5F5F5;
    }

    p[id="id"] {
        text-align: center;
        font-size: 40px;
        color: #212121;
        margin: auto;
        font-family: Roboto-Regular;
    }

    p[id="name"] {
        margin-top: 0px;
        margin-left: 20px;
        font-size: 40px;
        color: #212121;
        font-family: Roboto-Regular;
    }

    p[id="acno"] {
        margin-top: -35px;
        margin-left: 20px;
        font-size: 20px;
        color: #212121;
        font-family: Roboto-Regular;
    }

    p[id="none"] {
        margin: auto;
        font-size: 40px;
        color: #212121;
        font-family: Roboto-Regular;
    }
</style>

<body>
    <div style="position:fixed;width:100%">
        @include('includes.customer.accountnavbartop')
        @include('includes.customer.accountnavbarleft')
    </div>
    
    <div>
        @yield('beneficiarycontent')
    </div>
</body>
</html>
