<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Jumlah terjual</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($menu as $item)
            @if($item->amount != 0)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->amount }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>