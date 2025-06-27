<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiostix - Event Listings</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #fff;
            padding: 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        header .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: #007bff;
        }
        .filter-sort {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .filter-sort select,
        .filter-sort button {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            background-color: #fff;
            cursor: pointer;
        }
        .filter-sort button {
            background-color: #007bff;
            color: white;
            border: none;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .event-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .event-card {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .event-card:hover {
            transform: translateY(-5px);
        }
        .event-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background-color: #ddd; /* Placeholder for image */
        }
        .event-details {
            padding: 15px;
        }
        .event-details h3 {
            margin-top: 0;
            font-size: 1.2em;
            color: #007bff;
        }
        .event-details p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #555;
        }
        .event-details .price {
            font-weight: bold;
            color: #28a745;
            margin-top: 10px;
        }
        .event-details .availability {
            font-size: 0.85em;
            color: #007bff;
            font-weight: bold;
            margin-top: 5px;
        }
        .event-details .not-available {
            color: #dc3545;
        }
        .pagination {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .pagination span {
            font-weight: bold;
            margin-right: 10px;
        }
        .pagination a {
            text-decoration: none;
            color: #007bff;
            padding: 5px 10px;
            border: 1px solid #007bff;
            border-radius: 4px;
            margin: 0 5px;
        }
        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 30px;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    {{-- Header Section --}}
    <header>
        <div class="logo">Kiostix</div>
        <div class="filter-sort">
            <span>Juni 2025</span>
            <select>
                <option value="terbaru">Terbaru</option>
                <option value="termurah">Termurah</option>
                <option value="termahal">Termahal</option>
            </select>
            <button>Cari</button>
        </div>
    </header>

    {{-- Main Content Section --}}
    <main>
        <h2>Daftar Event</h2>
        <p>Menampilkan 1 - 20 dari 31 Event</p>
        <div class="event-list">
            {{-- Loop melalui data event dari controller (contoh data dummy) --}}
            @php
                $events = [
                    (object)['name' => 'NUANSA FESTIVAL', 'location' => 'Bekasi', 'date' => '14 - 15 November 2025', 'price' => '85000', 'available' => true],
                    (object)['name' => 'BYON COMBAT SHOWBIZ VOL.5: KKAJHE VS AZIZ', 'location' => 'Jakarta', 'date' => '25 Mei 2025', 'price' => '150000', 'available' => false],
                    (object)['name' => 'FUSSION 14', 'location' => 'Surabaya', 'date' => '10 Juli 2025', 'price' => '75000', 'available' => false],
                    (object)['name' => 'KONSER AMAL INDONESIA', 'location' => 'Bandung', 'date' => '20 Agustus 2025', 'price' => '100000', 'available' => true],
                ];
            @endphp

            @foreach($events as $event)
                <div class="event-card">
                    <img src="https://via.placeholder.com/300x180?text=Event+Image" alt="Event Image">
                    <div class="event-details">
                        <h3>{{ $event->name }}</h3>
                        <p>Lokasi: {{ $event->location }}</p>
                        <p>Tanggal: {{ $event->date }}</p>
                        <p class="price">Mulai dari Rp. {{ number_format($event->price, 0, ',', '.') }}</p>
                        <p class="availability @if(!$event->available) not-available @endif">
                            {{ $event->available ? 'Tiket Tersedia' : 'Tiket Tidak Tersedia' }}
                        </p>
                    </div>
                </div>
            @endforeach

            {{-- Jika menggunakan Laravel Paginator, Anda bisa mengganti ini: --}}
            {{-- {{ $events->links() }} --}}
        </div>

        <div class="pagination">
            <span>Halaman:</span>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">Selanjutnya</a>
        </div>
    </main>

    {{-- Footer Section --}}
    <footer>
        <nav>
            <a href="#">Apa itu Kiostix?</a> |
            <a href="#">Syarat dan Ketentuan</a> |
            <a href="#">Kebijakan Privasi</a>
        </nav>
        <p>&copy; 2025 Kiostix. All Rights Reserved.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>