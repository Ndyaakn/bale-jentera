<table>
    <thead>
        <tr>
            <th>No</th>
            <th colspan="2">Tanggal</th>
            <th colspan="3">Menu</th>
            <th>Jumlah terjual</th>
            <th colspan="2">Harga per item</th>
            <th colspan="2">Nama Customer</th>
            <th colspan="2">Tipe Pembayaran</th>
            <th colspan="2">Harga Menu</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $no = 1;
        @endphp
        @foreach($journal as $item)
            @for($i = 0; $i < $item['rowspan']; $i++)
                <tr>
                    @if($i == 0)
                        <td rowspan="{{ $item['rowspan'] }}">{{ $no++ }}</td>
                        <td rowspan="{{ $item['rowspan'] }}" colspan="2">{{ $item['date'] }}</td>
                    @endif
                    <td colspan="3">
                        {{ $item['menu'][$i] }}
                    </td>
                    <td>
                        {{ $item['jumlah_menu'][$i] }}
                    </td>
                    <td colspan="2">
                        {{ $item['harga_menu'][$i] }}
                    </td>
                    @if($i == 0)
                        <td rowspan="{{ $item['rowspan'] }}" colspan="2">{{ $item['customer'] }}</td>
                        <td rowspan="{{ $item['rowspan'] }}" colspan="2">{{ $item['tipe_pembayaran'] }}</td>
                        <td rowspan="{{ $item['rowspan'] }}" colspan="2">{{ $item['price'] }}</td>
                    @endif
                </tr>
            @endfor
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <b>TOTAL: </b>
            </td>
            <td colspan="9" style="text-align: right;">
                <b>{{ $total }}</b>
            </td>
        </tr>
    </tfoot>
</table>