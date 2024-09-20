<!doctype html>
<html lang="en">

<head>
    <style type="text/css">
        html {
            margin: 30px;
        }

        table.layout-table {
            width: 100%;
        }

        td.logo {
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
    <meta charset="utf-8">
    <title>{{ config('page.title') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <table class="layout-table">
        <tbody>
            <tr>
                <td class="logo">
                    <div class="logo-left">
                        <img class="logo-image" src="img/batola.png">
                    </div>
                </td>
                <td>
                    <div class="header">
                        <div style="text-transform: uppercase;">
                            PEMERINTAH Kabupaten Barito Kuala <br>
                            DINAS PENDIDIKAN
                        </div>
                        <div style="font-weight: bold; text-transform: uppercase;">
                            {{ config('app.name') }} </div>
                        <div>
                            NSS. 1 01 15 03 02 009 NPSN. 30301359 </div>
                        <small style="font-size: 12px;">Alamat: Jl. Trans Kalimantan Km 2.5 RT 08 No. 12 Kel. Handil
                            Bakti Kec. Alalak Kab. Batola. 70582</small>
                    </div>
                </td>
                <td class="logo">
                    <div class="logo-right">
                        <img class="logo-image" src="img/handayani.png">
                    </div>
                </td>
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
                        <div style="text-align:center;">
                            @yield('signature')
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

</body>

</html>
