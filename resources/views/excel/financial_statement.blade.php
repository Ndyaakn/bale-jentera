<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th colspan="2">Jumlah pemasukan</th>
            <th colspan="2">Jumlah dine in</th>
            <th colspan="2">Jumlah grabfood</th>
            <th colspan="2">Jumlah gofood</th>
            <th colspan="2">Jumlah take away</th>
            <th colspan="2">Jumlah pengeluaran</th>
            <th colspan="2">Jumlah saldo</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $total_dine_in = 0;
            $total_grabfood = 0;
            $total_gofood = 0;
            $total_personal = 0;
        @endphp
        @foreach($financial_statement as $item)
            @php
                $dine_in = 0;
                $grabfood = 0;
                $gofood = 0;
                $personal = 0;
                foreach($item->financial_statement_descriptions as $financial_description)
                {
                    if($financial_description->order == true)
                    {
                        if($financial_description->order->order_category == 'dine in')
                        {
                            $dine_in += $financial_description->debit;
                        }
                        if($financial_description->order->order_category == 'grabfood')
                        {
                            $grabfood += $financial_description->debit;
                        }
                        if($financial_description->order->order_category == 'gofood')
                        {
                            $gofood += $financial_description->debit;
                        }
                        if($financial_description->order->order_category == 'personal')
                        {
                            $personal += $financial_description->debit;
                        }
                    }
                }
                $total_dine_in += $dine_in;
                $total_grabfood += $grabfood;
                $total_gofood += $gofood;
                $total_personal += $personal;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->date }}</td>
                <td colspan="2">{{ $item->total_debit }}</td>
                <td colspan="2">{{ $dine_in }}</td>
                <td colspan="2">{{ $grabfood }}</td>
                <td colspan="2">{{ $gofood }}</td>
                <td colspan="2">{{ $personal }}</td>
                <td colspan="2">{{ $item->total_credit }}</td>
                <td colspan="2">{{ $item->total_saldo }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><b>TOTAL:</b></td>
            <td colspan="2"><b>{{ $total_debit }}</b></td>
            <td colspan="2"><b>{{ $total_dine_in }}</b></td>
            <td colspan="2"><b>{{ $total_grabfood }}</b></td>
            <td colspan="2"><b>{{ $total_gofood }}</b></td>
            <td colspan="2"><b>{{ $total_personal }}</b></td>
            <td colspan="2"><b>{{ $total_credit }}</b></td>
            <td colspan="2"><b>{{ $total_saldo }}</b></td>
        </tr>
    </tfoot>
</table>