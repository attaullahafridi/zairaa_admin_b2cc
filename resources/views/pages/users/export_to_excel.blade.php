<table>
    <thead>
    <tr>
        <th>First Name</th>             
        <th>Last Name</th>              
        <th>Contact #</th>              
        <th>Email</th>
        <th>User Type</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users_detail as $detail)
        <tr>
            <td>{{ $detail->users_detail->fname }}</td>             
            <td>{{ $detail->users_detail->lname }}</td>             
            <td>{{ $detail->users_detail->phone }}</td>             
            <td>{{ $detail->email }}</td>
            <td>
                @if($detail->type == 0) Member @elseif($detail->type == 2) Guest @endif
            </td>         
        </tr>
    @endforeach
    </tbody>
</table>