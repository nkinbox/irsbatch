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
    @if(session('step'))
    @switch(session('step'))
    @case(1)
    <h2>All Transactions</h2>
    <p>Point Only Two Fields: Beneficiary_AccNo, Amount</p>
    @break
    @case(2)
    <h2>Returned Transactions</h2>
    <p>Point Only Two Fields: Beneficiary_AccNo, Amount</p>
    @break
    @case(3)
    <h2>Rejected Transactions</h2>
    <p>Point Only Two Fields: Beneficiary_AccNo, Amount</p>
    @break
    @endswitch
    @else
    <h2>All Transactions</h2>
    @endif
    @if(session('message'))
    <div class="errors">{{session('message')}}</div>
    @endif
    <form action="{{route('Process_ECS_put')}}" method="post" onsubmit="return confirm('Have You Marked the pointers?');">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" id="btn">Proceed</button>
        <div class="errors">
            @foreach($result[1] as $rowno)
            <div>{{$rowno}}</div>
            @endforeach
        </div>
        @if(count($result[0])>0)
        <table>
            <thead>
            <tr>
                @for($i = 0; $i < count($result[0][0]); $i++)
                <th>
                    <select name="fields[{{$i}}]">
                        <option value="SNO">----</option>
                        <option>Beneficiary_AccNo</option>
                        <option>Amount</option>
                    </select>
                </th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @foreach($result[0] as $row)
            <tr>
                @foreach($row as $col)
                <td>{{$col}}</td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
        This File Was Not Uploaded
        @endif
    </form>
<form action="{{route('Process_ECS_delete')}}" method="post" style="padding-top:20px" onsubmit="return confirm('Do you really want to ReUpload Files?');">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" id="btn">Click To Upload Files Again</button>
</form>
</body>
</html>