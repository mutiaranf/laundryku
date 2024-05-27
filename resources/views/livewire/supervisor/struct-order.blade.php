<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>

    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
                    <b>LAUNDRYKU</b></br>JL Mardjadiwangsa 1 </span></br>
                <span style='font-size:12pt'>No. : 1, {{ date('F j, Y') }} (Kasir: {{ Auth::user()->name }}),
                    {{ date('H:i:s') }}</span></br>
            </td>
        </table>
        <style>
            hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>
        <table cellspacing='0' cellpadding='0'
            style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr align='center'>
                <td width='10%'>Item</td>
                <td width='13%'>Price</td>
                <td width='4%'>Qty</td>
                <td width='13%'>Total</td>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            </tr>
            @foreach($dataStruct as $key => $value)
            <tr>
                <td style='vertical-align:top; padding-right:20px''>{{ $value['item'] }}</td>
                <td style='vertical-align:top; text-align:right; padding-right:20px'>Rp.{{ number_format($value['price'], 0, ',', '.') }},-</td>
                <td style='vertical-align:top; text-align:right; padding-right:20px'>{{ round($value['qty']) }}</td>
                <td style='text-align:right; vertical-align:top'>Rp.{{ number_format($value['total'], 0, ',', '.') }},-</td>
            </tr>

            @endforeach

            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan = '4'>
                    <div style='text-align:right; margin-right: 10px;'>Total Harga :</div>
                </td>
                <td style='text-align:right; font-size:13pt;'>Rp.{{ number_format($totalPrice, 0, ',', '.') }},-</td>
            </tr>
        </table>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
    </center>

    <script>
        window.print();
    </script>
</body>
</html>
