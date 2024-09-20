<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('page.title') }}</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            box-sizing: border-box;
        }

        #template td.logo {
            width: 90px;
            height: 90px;
        }

        .logo-image {
            width: 100%;
        }

        .logo-left {
            display: flex;
            justify-content: start;
        }

        .logo-right {
            display: flex;
            justify-content: end;
        }

        .header {
            text-align: center;
        }

        .line {
            border-top: 2px solid black;
            margin-top: 12px;
            margin-bottom: 2px;
        }

        .hair-line {
            border-top: 1px solid black;
            margin-bottom: 5px;
        }

        #template {
            width: 100%;
        }

        .content {
            padding: 5px 0;
        }

        .colons {
            width: 10px;
        }

        p,
        td {
            font-size: 1rem;
        }

        td {
            vertical-align: top;
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="container">
        <table id="template">
            <tr>
                <td class="logo">
                    <div class="logo-left">
                        <img class="logo-image" src="{{ asset('img/LOGO.png') }}" alt="">
                    </div>
                </td>
                <td>
                    <div class="header">
                        <div style="text-transform: uppercase;">
                            KEMENTERIAN PENDIDIKAN <br>
                            KEBUDAYAAN, RISET, DAN TEKNOLOGI<br>
                            UNIVERSITAS ABDURACHMAN SALEH
                        </div>
                        <div style="font-weight: bold; text-transform: uppercase;">
                            {{ config('app.name') }}
                        </div>
                        <!-- <div>
                            NSS. 1 01 15 03 02 009 NPSN. 30301359 </div> -->
                        <small style="font-size: 12px;">JL.PB.Sudirman No.07 Telp./Fax. : 0338-671191 Situbondo 68312 </small> <br>
                        <small style="font-size: 12px;"> <small style="font-size: 12px;"> Web-site :www.unars.ac.id Email : unars_situbondo@yahoo.co.id Web-mail : unars_situbondo@unars.ac.id </small> </small>
                    </div>
                </td>
                <!-- <td class="logo">
                    <div class="logo-right">
                        <img class="logo-image" src="{{ asset('img/LOGO.png') }}" alt="">
                    </div>
                </td> -->
            </tr>
            <tr>
                <td colspan="3">
                    <div class="line"></div>
                    <div class="hair-line"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="content">
                        @yield('content')
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="display: flex; justify-content:end;">
                        <div style="text-align:center; margin-top:20px;">
                            @yield('signature')
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>