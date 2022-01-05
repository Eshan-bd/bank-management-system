<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Statement</title>
</head>
<body>
    <div class="container">
    <br/>

        <center>
            <h1 style="color:#263238;">Castle Internet Bank</h1>
            <h2 style="color:#2e4154;">E-Statement</h2>
            <h3 style="color:#000000;">Downloaded: {{date("l jS \of F Y h:i:s A")}} (GMT)</h3> 
            <br>
        </center>
        <b>
            <h3>{{ $user->firstname }} {{ $user->lastname }}</h3> 
        </b>
        <b>
            Email:  
        </b>
        {{ $user->email }}
        <b>
            Phone:  
        </b>
        {{ $user->phone }}
        <br>
        <b>
            Period: From&nbsp;  
        </b>
        {{ $from }}
        <b>
            To&nbsp;
        </b>
        {{ $to }}
        <br>
        <b>
            Account Name:  
        </b>
        {{ $account->accountname }}
        <b>
            Account Type:  
        </b>
        {{ $account->accounttype }}
        <br>
        <b>
            Total Withdrawal(After Period): {{$debit}} Tk 
        </b>
        <br>
        <b>
            Total Deposit(After Period): {{$credit}} Tk
        </b>
        <br>
        <b>
            Available Balance(After Period): {{ $currentbal }} Tk
        </b>
        <br>
        <b>
            Current Account Balance: {{$account->accountbalance}} Tk
        </b>
        <br>
        <br>
        <center>
            <table border='1' id = "table" class="table table-borderless">
                
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Transaction Time</th>

                </tr>
            

                @foreach($history as $history)
                
                <tr>
                    <td>{{$history->historydate}}</td>
                    <td>{{$history->remarks}}</td>
                    <td>{{$history->debit}}/-</td>
                    <td>{{$history->credit}}/-</td>
                    <td>{{$history->created_at}}</td>
                </tr>

                @endforeach

                <tr>
                    <th>Total:</th>
                    <td></td>
                    <td>{{$debit}}/-</td>
                    <td>{{$credit}}/-</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Current Balance:</th>
                    <td>{{ $currentbal }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <b>
                -------------------------------------------End of Statement-------------------------------------------
            </b>
        </center>

    </div>
    <style>
        body{
            color: black;
            background-color:white;
        }

        #table {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 90%;
                margin: auto;
                color: #000000;
                text-align: center;
                font-weight: bold;
                box-shadow: 0px 0px 30px black;
                margin-top: 5vh;
            }

            #table td, #table th {
                padding: 10px;
            }

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: center; 
                background-color:#263238;;
                color: white;
            }
    </style>
</body>
</html>