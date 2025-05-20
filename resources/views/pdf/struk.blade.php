<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      padding: 30px;
      color: #1f2937;
      background: #ffffff;
    }

    .struk {
      max-width: 600px;
      margin: auto;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 20px 30px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header h2 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
    }

    .line {
      border-top: 1px dashed #9ca3af;
      margin: 15px 0;
    }

    .info p {
      margin: 5px 0;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 12px;
      color: #6b7280;
    }
  </style>
</head>
<body>
  <div class="struk">
    <div class="header">
      <h2>STRUK PEMESANAN</h2>
      <p>PT. Bus Nusantara</p>
      <p>Jl. Transportasi No.1</p>
    </div>

    <div class="line"></div>

    <div class="info">
      <p><strong>Nama:</strong> {{ $booking->nama }}</p>
      <p><strong>Telepon:</strong> {{ $booking->telepon }}</p>
      <p><strong>Email:</strong> {{ $booking->email }}</p>
      <p><strong>Kursi:</strong> {{ $booking->kursi }}</p>
    </div>

    <div class="line"></div>

    <div class="info">
      <p><strong>Asal:</strong> {{ $rute->asal }}</p>
      <p><strong>Tujuan:</strong> {{ $rute->tujuan }}</p>
      <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rute->tanggal_berangkat)->translatedFormat('d F Y') }}</p>
      <p><strong>Bus:</strong> {{ $rute->merk_bus }} - {{ $rute->tipe_bus }}</p>
      <p><strong>Harga:</strong> Rp{{ number_format($rute->harga, 0, ',', '.') }}</p>
    </div>

    <div class="line"></div>

    <div class="footer">
      <p>Terima kasih telah memesan</p>
      <p>Semoga perjalananmu menyenangkan</p>
    </div>
  </div>
</body>
</html>
