<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   

    <title>Transaction Report</title>
</head>
<body>

<div class="container">
<br/>

    <center>
        <h1 style="color:#2e4154;"> Transaction Report</h1>
            {{date("l jS \of F Y h:i:s A")}} 
            <hr>
            <br>

        <b>
            Total Dedit: {{$debit}} Tk 
        </b>
        <br>

        <b>
            Total Credit: {{$credit}} Tk
        </b>
        <br>

        <b>
             Current Balance: {{$balance}} Tk
        </b>
        <br>
        <br>
        
      
    </center>
    
    <center>
                <table border='1' id = "table" class="table table-striped table-hover table-bordered border-dark">
                    
                    <tr>
                        
                        <th>History Id</th>
                        <th>History Date</th>
                        <th>Transction Id</th>
                        <th>Remarks</th>
                        <th>Debit</th>
                        <th>Credits</th>
                        <th>Transaction Time</th>

                    </tr>
                

                    @foreach($history as $history)
                    
                    <tr>
                        <td>{{$history->id}}</td>
                        <td>{{$history->historydate}}</td>
                        <td>{{$history->account_id}}</td>
                        <td>{{$history->remarks}}</td>
                        <td>{{$history->debit}}</td>
                        <td>{{$history->credit}}</td>
                        
                        <td>{{$history->created_at}}</td>
                    </tr>

                    @endforeach

                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$debit}}</td>
                        <td>{{$credit}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <th>Current Balance</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$balance}}</td>
                        <td></td>
                    </tr>
                </table>	
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
            width: 70%;
            margin: auto;
            color: #34495e;
            text-align: center;
            font-weight: bold;
            box-shadow: 0px 0px 30px black;
            margin-top: 5vh;
            }

            #table td, #table th {
            padding: 10px;
            }

            

            #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center; 
            background-color:#373b8b;;
            color: white;
            }

        



    </style>
</body>
</html>