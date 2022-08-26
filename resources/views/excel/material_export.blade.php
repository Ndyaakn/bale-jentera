<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Bahan</th>
            <th>Stok</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($material as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->material }}</td>
                <td>
                    @if($item->stock != '999999')
                        {{ $item->stock }}
                    @else
                        Tidak terbatas
                    @endif
                </td>
                <td>{{ $item->satuan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>