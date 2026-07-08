<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body {
            margin: 0;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
        }

        /* BUTTONS */
        .top-buttons {
            width: 1100px;
            margin: 20px auto;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        .download {
            background: #2563eb;
        }

        .print {
            background: #16a34a;
            border: none;
            cursor: pointer;
        }

        /* CERTIFICATE */
        .certificate {
            width: 1100px;
            height: 780px;
            margin: auto;
            background: white;
            position: relative;
            padding: 70px;
            box-sizing: border-box;
            border: 12px solid #d4af37;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .certificate::before {
            content: "";
            position: absolute;
            top: 18px;
            left: 18px;
            right: 18px;
            bottom: 18px;
            border: 2px solid #111827;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120px;
            color: rgba(0, 0, 0, 0.04);
            font-weight: bold;
        }

        .header {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .header h1 {
            font-size: 54px;
            margin: 0;
            letter-spacing: 4px;
        }

        .header p {
            font-size: 18px;
            margin-top: 10px;
        }

        .name {
            text-align: center;
            font-size: 42px;
            color: #b8860b;
            margin-top: 45px;
            font-weight: bold;
        }

        .text {
            width: 80%;
            margin: 35px auto;
            text-align: center;
            line-height: 34px;
            font-size: 17px;
        }

        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }

        .score-table th {
            background: #f3f4f6;
        }

        .score-table th,
        .score-table td {
            border: 1px solid #444;
            padding: 12px;
            text-align: center;
        }

        .signatures {
            position: absolute;
            bottom: 80px;
            width: 85%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: space-between;
        }

        .line {
            border-top: 2px solid black;
            width: 160px;
            margin-bottom: 8px;
        }

        .footer {
            position: absolute;
            bottom: 25px;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        @media print {

            .top-buttons {
                display: none;
            }

            body {
                background: white;
            }

            .certificate {
                box-shadow: none;
            }
        }
    </style>

</head>

<body>

    <!-- BUTTONS -->
    <div class="top-buttons">

        <a href="{{ route('download', $student->id) }}" class="btn download">
            ⬇ Download PDF
        </a>

        <button onclick="window.print()" class="btn print">
            🖨 Print
        </button>

    </div>

    <!-- CERTIFICATE -->
    <div class="certificate">

        <div class="watermark">CERTIFICATE</div>

        <div class="header">
            <h1>CERTIFICATE</h1>
            <p>OF ACHIEVEMENT</p>
        </div>

        <div class="name">
            {{ $student->first_name }} {{ $student->last_name }}
        </div>

        <div class="text">
            This certificate is proudly awarded for successfully completing
            all academic requirements with dedication and excellent performance.
        </div>



        <div class="signatures mt-n5">

            <div>
                <div class="line"></div>
                Director
            </div>

            <div>
                <div class="line"></div>
                Dean
            </div>

            <div>
                <div class="line"></div>
                Chairman
            </div>

        </div>

        <div class="footer">
            Certificate ID :
            CERT-{{ $student->id }}-{{ date('Y') }}
        </div>

    </div>

</body>

</html>
