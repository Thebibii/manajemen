<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: DejaVu Sans, sans-serif;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            background: #ffffff;
        }

        .page-wrapper {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .page-wrapper td {
            vertical-align: middle;
            text-align: center;
            padding: 20px;
        }

        .ticket {
            width: 380px;
            display: inline-block;
            text-align: left;
            background: #ffffff;
            border: 1px solid #e4e7ec;
            border-radius: 20px;
            overflow: hidden;
        }

        .header {
            background: #3641f5;
            color: #ffffff;
            padding: 18px;
        }

        .header-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #dde9ff;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            line-height: 1.4;
            margin-top: 6px;
        }

        .status {
            display: inline-block;
            margin-top: 10px;
            padding: 4px 10px;
            border-radius: 999px;
            background: #d1fadf;
            color: #027a48;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badges {
            margin-top: 10px;
        }

        .badge {
            display: inline-block;
            margin-right: 6px;
            margin-bottom: 4px;
            padding: 5px 10px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .15);
            color: #ffffff;
            font-size: 10px;
        }

        .qr-section {
            text-align: center;
            padding: 18px;
            border-bottom: 1px dashed #e4e7ec;
        }

        .qr-wrap {
            display: inline-block;
            background: #ffffff;
            border: 1px solid #e4e7ec;
            border-radius: 16px;
            padding: 12px;
        }

        .qr-caption {
            margin-top: 10px;
            color: #667085;
            font-size: 10px;
        }

        .details {
            padding: 18px;
        }

        .detail-row {
            width: 100%;
            margin-bottom: 16px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table td {
            width: 50%;
            vertical-align: top;
            text-align: left;
            padding: 0;
        }

        .detail-label {
            font-size: 9px;
            text-transform: uppercase;
            color: #667085;
            letter-spacing: .5px;
        }

        .detail-value {
            margin-top: 4px;
            font-size: 12px;
            font-weight: bold;
            color: #101828;
            line-height: 1.4;
            word-break: break-word;
        }

        .brand {
            color: #3641f5;
        }

        .footer {
            background: #f9fafb;
            border-top: 1px solid #e4e7ec;
            padding: 10px 14px;
            text-align: center;
            font-size: 9px;
            color: #667085;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <table class="page-wrapper">
        <tr>
            <td>

                <div class="ticket">

                    <div class="header">

                        <div class="header-label">
                            Event Kampus
                        </div>

                        <div class="header-title">
                            {{ $registration->event->nama }}
                        </div>



                        <div class="badges">
                            <span class="badge">
                                {{ $registration->event->tanggal->translatedFormat('l, d F Y') }}
                            </span>

                            <span class="badge">
                                {{ $registration->event->tanggal->translatedFormat('H:i') }} WIB
                            </span>
                        </div>

                    </div>

                    <div class="qr-section">

                        <div class="qr-wrap">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($registration->ticket_code) }}"
                                width="150" height="150">
                        </div>

                        <div class="qr-caption">
                            {{ __('messages.Tunjukkan QR Code saat check-in event') }}
                        </div>

                    </div>

                    <div class="details">

                        <div class="detail-row">

                            <table class="detail-table">
                                <tr>

                                    <td>
                                        <div class="detail-label">
                                            {{ __('messages.Nama Peserta') }}
                                        </div>

                                        <div class="detail-value">
                                            {{ $registration->user->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="detail-label">
                                            {{ __('messages.Email') }}
                                        </div>

                                        <div class="detail-value">
                                            {{ $registration->user->email }}
                                        </div>
                                    </td>

                                </tr>
                            </table>

                        </div>

                        <div class="detail-row">

                            <table class="detail-table">
                                <tr>

                                    <td>
                                        <div class="detail-label">
                                            {{ __('messages.Lokasi') }}
                                        </div>

                                        <div class="detail-value">
                                            {{ $registration->event->lokasi }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="detail-label">
                                            {{ __('messages.Kode Tiket') }}
                                        </div>

                                        <div class="detail-value brand">
                                            #{{ $registration->ticket_code }}
                                        </div>
                                    </td>

                                </tr>
                            </table>

                        </div>

                    </div>

                    <div class="footer">
                        {{ __('messages.Harap membawa identitas yang valid saat registrasi dan menunjukkan tiket ini kepada panitia saat check-in.') }}

                    </div>

                </div>

            </td>
        </tr>
    </table>

</body>

</html>
