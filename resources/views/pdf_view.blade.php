<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            font-weight: 400;
            src: url(/fonts/Poppins-Regular.ttf);
            font-display: swap;
        }

        @font-face {
            font-family: 'Poppins';
            font-weight: 500;
            src: url(/fonts/Poppins-Medium.ttf);
            font-display: swap;
        }

        @font-face {
            font-family: 'Poppins';
            font-weight: 600;
            src: url(/fonts/Poppins-SemiBold.ttf);
            font-display: swap;
        }

        @font-face {
            font-family: 'Poppins';
            font-weight: 700;
            src: url(/fonts/Poppins-Bold.ttf);
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            padding: 0 0.5rem;
        }

        h3 {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        .invoice-header {
            margin-top: 1rem;
            display: flex;
        }

        .invoice-header h1 {
            margin-bottom: 0.5rem;
            text-align: center;
            font-weight: 700;
            font-size: 1.875rem;
            line-height: 2.25rem;
            text-transform: uppercase;
        }

        .invoice-body {
            margin-top: 1rem;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .column {
            float: left;
            width: 50%;
            padding: 5px;
        }

        .colon {
            position: relative;
        }

        .colon::after {
            content: ":";
            position: absolute;
            right: 0.25rem;
            top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table tr th {
            font-size: 0.875rem;
            font-weight: normal;
            text-align: left;
        }

        table tr td {
            font-size: 0.75rem;
        }

        .bordered {
            border: 1px solid black;
        }

        .bordered thead tr td,
        .bordered tbody tr td {
            border: 1px solid black;

            padding: 0.5rem
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }
    </style>
</head>

<body>
    <section class="invoice-header">
        <h1>Kumbah</h1>
        <div class="row">
            <h3>Order Info</h3>
            <div class="column">
                <table>
                    <tbody>
                        <tr>
                            <th class="colon">Order ID</th>
                            <td>{{ $data->order_id }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Order Date</th>
                            <td>{{ $data->order_date }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Finished Date</th>
                            <td>{{ $data->finished_date }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Member ID</th>
                            <td>{{ $data->member_id === null ? '-' : $data->member_id }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Customer Name</th>
                            <td>{{ $data->customer_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <table>
                    <tbody>
                        <tr>
                            <th class="colon">Service</th>
                            <td>{{ $data->service_name }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Quantity</th>
                            <td>{{ $data->service_quantity }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Subtotal</th>
                            <td class="subtotal">{{ $data->subtotal }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Discount</th>
                            <td class="discount">{{ $data->discount }}</td>
                        </tr>
                        <tr>
                            <th class="colon">Total</th>
                            <td class="total">{{ $data->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="invoice-body">
        <h3>Cloth list</h3>
        <div>
            <table class="bordered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Cloth Name</td>
                        <td>Quantity (Pcs)</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($data->clothes) as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->cloth }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
