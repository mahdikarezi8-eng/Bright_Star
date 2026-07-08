<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        .watermark {
            position: absolute;
            top: 300px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 120px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.05);
            letter-spacing: 8px;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            background: white;
        }

        .certificate {
            width: 1100px;
            height: 780px;
            margin: 0 auto;
            position: relative;
            border: 12px solid #d4af37;
            box-sizing: border-box;
            overflow: hidden;
        }

        .inner-border {
            position: absolute;
            top: 18px;
            left: 18px;
            right: 18px;
            bottom: 18px;
            border: 2px solid #111;
        }

        /* ✅ FIXED WATERMARK (CENTER EXACT) */
        .watermark {

            top: 50%;
            left: 50%;
            width: 100%;
            text-align: center;
            transform: translateY(-50%);
            font-size: 120px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.05);
            letter-spacing: 6px;
            position: absolute;
            top: 300px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 120px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.05);
            letter-spacing: 8px;
        }

        .content {
            position: relative;
            padding: 70px;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 50px;
            margin: 0;
        }

        .name {
            text-align: center;
            font-size: 38px;
            color: #b8860b;
            margin-top: 40px;
            font-weight: bold;
        }

        .text {
            text-align: center;
            width: 80%;
            margin: 25px auto;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #f3f4f6;
        }

        /* ✅ FIXED SIGNATURES (NO BORDER, CLEAN) */
        .signatures {
            position: absolute;
            bottom: 80px;
            width: 100%;
            text-align: center;
        }

        .sign-table {
            width: 100%;
        }

        .sign-table td {
            width: 33%;
            text-align: center;
            vertical-align: bottom;
            border: none;
            /* 🔥 removed border */
        }

        .line {
            border-top: 2px solid black;
            width: 150px;
            margin: 0 auto 6px auto;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body>

    <div class="certificate">

        <div class="inner-border"></div>

        <!-- WATERMARK FIXED CENTER -->
        <div class="watermark">CERTIFICATE</div>

        <div class="content">

            <div class="header">
                <h1>CERTIFICATE</h1>
                <p>OF ACHIEVEMENT</p>
            </div>

            <div class="name">
                {{ $student->first_name }} {{ $student->last_name }}
            </div>

            <div class="text">
                This certificate is awarded for successful completion of academic requirements.
            </div>
        </div>

        <!-- SIGNATURES CLEAN -->
        <div class="signatures mt-n4">

            <table class="sign-table">

                <tr>
                    <td>
                        <div class="line"></div>
                        Director
                    </td>

                    <td>
                        <div class="line"></div>
                        Dean
                    </td>

                    <td>
                        <div class="line"></div>
                        Chairman
                    </td>
                </tr>

            </table>

        </div>

        <div class="footer">
            Certificate ID: CERT-{{ $student->id }}-{{ date('Y') }}
        </div>

    </div>

</body>

</html>
