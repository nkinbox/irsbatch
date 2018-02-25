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
            table {
                width: 100%;
            }
        </style>
    </head>
<body>
    <h2>All Transactions</h2>

    <form action="{{route('Process_ECS_put')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" id="btn">Proceed</button>
        @if(count($result)>0)
        <table>
            <thead>
            <tr><?php $fields = array('SNO', 'UMRN', 'BankCode', 'Beneficiary_AccNo', 'Beneficiary_Name', 'Settlement_Date', 'Amount', 'Start_Date', 'End_Date', 'Frequency', 'Status'); ?>
                    @foreach($fields as $val)
                    <th>
                    {{$val}}
                    </th>
                    @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($result as $row)
            <tr>
                @foreach($fields as $col)
                <td>{{$row[$col]}}</td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
        This File Was Not Uploaded
        @endif
    </form>
<form action="{{route('Process_ECS_delete')}}" method="post" style="padding-top:20px">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" id="btn">Click To Upload Files Again</button>
</form>
</body>
</html>