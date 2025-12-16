<!DOCTYPE html>
<html>
<head>
    <title>Akta Ikrar Wakaf Uang</title>
    <style>
        /* Reset & Font Dasar */
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.0;
            margin: 0; 
            padding: 0;
            color: #000;
        }

        /* Header / Kop Surat */
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .title {
            font-size: 14pt;
            text-decoration: underline;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .nomor-surat {
            margin-bottom: 5px;
        }

        /* Utilitas Tabel Utama */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 5px; 
        }
        td { 
            vertical-align: top; 
            padding: 2px 0; 
        }
        
        /* Pengaturan Lebar Kolom agar Titik Dua Sejajar */
        .col-label { 
            width: 170px; /* Sesuaikan jika label terpotong */
        }
        .col-sep { 
            width: 20px; 
            text-align: center; 
        }

        /* Area Tanda Tangan */
        .signature-table { 
            margin-top: 40px; 
            width: 100%;
            text-align: center; 
            page-break-inside: avoid; /* Mencegah tabel terpotong beda halaman */
        }
        
        .signature-space { 
            height: 70px; /* Tinggi minimal baris tanda tangan */
            vertical-align: bottom; /* Gambar/TTD ada di bagian bawah cell */
            padding-bottom: 0px;
        }
        
        .signature-img { 
            height: 60px; 
            max-width: 140px; 
            object-fit: contain; 
        }
        
        /* Helper Text */
        .terbilang {
            font-style: italic;
            text-transform: capitalize;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">AKTA IKRAR WAKAF UANG</div>
        <div class="nomor-surat">Nomor: {{ $nomor_surat }}</div>
        <div style="font-weight: normal;">Tanggal: {{ $created_at }}</div>
    </div>

    <p>Yang bertanda tangan di bawah ini:</p>

    <table>
        <tr>
            <td class="col-label">Nama</td>
            <td class="col-sep">:</td>
            <td class="bold">{{ $donor_name }}</td>
        </tr>
        <tr>
            <td class="col-label">Email</td>
            <td class="col-sep">:</td>
            <td>{{ $donor_email }}</td>
        </tr>
    </table>

    <p>Selanjutnya disebut <span class="bold">WAKIF</span>, bermaksud memberikan Wakaf Uang.</p>

    <table>
        <tr>
            <td class="col-label">Jumlah Wakaf Uang</td>
            <td class="col-sep">:</td>
            <td class="bold">{{ $amount }}</td>
        </tr>
        <tr>
            <td class="col-label">Terbilang</td>
            <td class="col-sep">:</td>
            <td class="terbilang">{{ $terbilang }}</td>
        </tr>
        <tr>
            <td class="col-label">Jenis Wakaf</td>
            <td class="col-sep">:</td>
            <td>{{ $category }}</td>
        </tr>
        <tr>
            <td class="col-label">Peruntukan Wakaf</td>
            <td class="col-sep">:</td>
            <td>{{ $title }}</td>
        </tr>
    </table>

    <p>Kepada <span class="bold">NAZHIR</span>:</p>

    <table>
        <tr>
            <td class="col-label">Nama Nazhir</td>
            <td class="col-sep">:</td>
            <td>Universitas Andalas</td>
        </tr>
        <tr>
            <td class="col-label">Jenis Nazhir</td>
            <td class="col-sep">:</td>
            <td>Nazhir Organisasi</td>
        </tr>
        <tr>
            <td class="col-label">No. ID Nazhir</td>
            <td class="col-sep">:</td>
            <td>3.3.00474</td>
        </tr>
        <tr>
            <td class="col-label">No. Rekening</td>
            <td class="col-sep">:</td>
            <td>7321461837</td>
        </tr>
        <tr>
            <td class="col-label">Nama Bank</td>
            <td class="col-sep">:</td>
            <td>Bank Syariah Indonesia</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-sep">:</td>
            <td>Gedung Rektorat Universitas Andalas, Limau Manis, Kec. Pauh, Kota Padang, Sumatera Barat 25163. Telepon: 0751-71181</td>
        </tr>
    </table>

    <p>Dengan dihadiri saksi-saksi:</p>

    <table>
        <tr>
            <td class="col-label">Saksi I</td>
            <td class="col-sep">:</td>
            <td>{{ $saksi1_nama }}</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-sep">:</td>
            <td>Universitas Andalas</td>
        </tr>
        <tr>
            <td class="col-label">Saksi II</td>
            <td class="col-sep">:</td>
            <td>{{ $saksi2_nama }}</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-sep">:</td>
            <td>Universitas Andalas</td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td width="33%">Wakif</td>
            <td width="34%">Nazhir</td>
            <td width="33%">Pejabat Bank</td>
        </tr>
        
        <tr>
            <td class="signature-space">
                &nbsp; 
            </td>

            <td class="signature-space">
                @if(isset($ttd_nazhir) && $ttd_nazhir)
                    <img src="{{ $ttd_nazhir }}" class="signature-img" alt="TTD Nazhir">
                @endif
            </td>

            <td class="signature-space">
                @if(isset($ttd_bank) && $ttd_bank)
                    <img src="{{ $ttd_bank }}" class="signature-img" alt="TTD Bank">
                @endif
            </td>
        </tr>

        <tr>
            <td class="bold">({{ $donor_name }})</td>
            <td class="bold">({{ $nazhir_nama }})</td>
            <td>
                <span class="bold">({{ $bank_officer }})</span><br>
            </td>
        </tr>
    </table>

    <br>

    <table class="signature-table">
        <tr>
            <td width="50%">Saksi I</td>
            <td width="50%">Saksi II</td>
        </tr>

        <tr>
            <td class="signature-space">
                @if(isset($ttd_saksi1) && $ttd_saksi1)
                    <img src="{{ $ttd_saksi1 }}" class="signature-img" alt="TTD Saksi 1">
                @endif
            </td>

            <td class="signature-space">
                @if(isset($ttd_saksi2) && $ttd_saksi2)
                    <img src="{{ $ttd_saksi2 }}" class="signature-img" alt="TTD Saksi 2">
                @endif
            </td>
        </tr>

        <tr>
            <td class="bold">({{ $saksi1_nama }})</td>
            <td class="bold">({{ $saksi2_nama }})</td>
        </tr>
    </table>

</body>
</html>