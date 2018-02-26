<!DOCTYPE html>
<html>
    <head>
        <style>
            .errors {
                color: #800;
                padding: 20px 5px;
            }
            td {
                padding: 5px 8px;
            }
            #btn {
                float: right;
                padding: 8px;
                background: #ade7f5;
            }
        </style>
    </head>
<body>
    <h2>All Transactions</h2>
    <div>Check Transactions in <span style="color:red; background-color:black">RED Color and Black Background</span> (if Any)</div>
    <div>Check Amounts at the bottom; If any Error Try Uploading Files Again.</div>
    <form action="{{route('InsertECSFile')}}" method="post" onsubmit="return confirm('This will Insert the File Data in Database');">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" id="btn">Finalize ECS and Insert in Database</button>
        <hr style="clear:both">
        @if(count($result)>0)
        <table>
            <thead>
            <tr><?php 
                $amount = 0.0;
                $rejected = 0.0;
                $returned = 0.0;
                $total = 0.0;
                $fields = array('SNO', 'UMRN', 'BankCode', 'Beneficiary_AccNo', 'Beneficiary_Name', 'Settlement_Date', 'Amount', 'Start_Date', 'End_Date', 'Frequency', 'Status');
                ?>
                    @foreach($fields as $val)
                    <th>
                    {{$val}}
                    </th>
                    @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($result as $row)
            <?php
            $amount += $row['Amount'];
            if($row['Status'] == "Rejected")
            $rejected += $row['Amount'];
            if($row['Status'] == "Returned")
            $returned += $row['Amount'];
            ?>
            <tr style="background-color:{{($row['surety'] == 1)?' black':''}}; color:{{($row['Status'] == "Successful")?' green':' red'}}">
                @foreach($fields as $col)
                <td>{{$row[$col]}}</td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                <th>#</th>
                <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total</td>
                    <td>{{$amount}}</td>
                </tr>
                <tr>
                    <td>Rejected</td>
                    <td>{{$rejected}}</td>
                </tr>
                <tr>
                    <td>Returned</td>
                    <td>{{$returned}}</td>
                </tr>
                <tr>
                    <td>Total Received</td>
                    <td>{{$amount - $rejected - $returned}}</td>
                </tr>
            </tbody>
        </table>
        @else
        This File Was Not Uploaded
        @endif
    </form>
<form action="{{route('Process_ECS_delete')}}" method="post" style="padding-top:20px" onsubmit="return confirm('Do you really ReUpload Files?');">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" id="btn">Click To Upload Files Again</button>
</form>
</body>
</html>