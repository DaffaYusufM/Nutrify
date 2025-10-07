<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nutrify - Kalkulator Nutrisi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3ba55d;">
    <div class="container-fluid fw-bold">
      <a class="navbar-brand" href="#">Nutrify</a>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
      <div class="card-body">
        <h2 class="text-center mb-4 text-primary">Cek Nutrisi Makanan</h2>

        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('nutrition.analyze') }}">
          @csrf
          <div class="mb-3">
            <label for="food" class="form-label fw-semibold">Masukkan Makanan</label>
            <input type="text" name="food" id="food" class="form-control" placeholder="Contoh: 1 banana, 2 eggs" required>
          </div>

          <div class="d-grid">
            <button class="btn btn-success" type="submit">Hitung Nutrisi</button>
          </div>
        </form>

        {{-- Tampilkan hasil di bawah form --}}
        @if (!empty($result))
          <div class="mt-5 border-top pt-3">
            <h4 class="text-center mb-3 text-success">Hasil Analisis Nutrisi</h4>
            <p><strong>Makanan:</strong> {{ $result['food'] }}</p>
            <ul>
              <li><strong>Kalori:</strong> {{ round($result['calories'], 2) }} kcal</li>
              <li><strong>Protein:</strong> {{ round($result['protein'], 2) }} g</li>
              <li><strong>Lemak:</strong> {{ round($result['fat'], 2) }} g</li>
              <li><strong>Karbohidrat:</strong> {{ round($result['carbs'], 2) }} g</li>
              <li><strong>Serat:</strong> {{ round($result['fiber'], 2) }} g</li>
              <li><strong>Kalsium:</strong> {{ round($result['calcium'], 2) }} mg</li>
              <li><strong>Vitamin C:</strong> {{ round($result['vitaminC'], 2) }} mg</li>
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
