<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Odliczanie czasu</title>
  <style>
    body { font-family: sans-serif; background: #f0f0f0; text-align: center; padding: 50px; }
    input, button { margin: 10px; padding: 10px; font-size: 16px; }
    #countdown { font-size: 24px; margin-top: 20px; }
  </style>
</head>
<body>
  <h1>⏳ Odliczanie</h1>

  <form id="timeForm">
    <label>
      Czas początkowy:
      <input type="datetime-local" id="start" required>
    </label><br>

    <label>
      Czas końcowy:
      <input type="datetime-local" id="end" required>
    </label><br>

    <button type="button" onclick="setEndToNow()">Ustaw koniec na teraz</button><br>
    <button type="submit">Rozpocznij odliczanie</button>
  </form>

  <div id="countdown"></div>

  <script>
    let countdownInterval;

    function setEndToNow() {
      const now = new Date().toISOString().slice(0, 16);
      document.getElementById('end').value = now;
    }

    function format(ms) {
      const sec = Math.floor(ms / 1000);
      const h = Math.floor(sec / 3600);
      const m = Math.floor((sec % 3600) / 60);
      const s = sec % 60;
      return `${h}h ${m}m ${s}s`;
    }

    document.getElementById('timeForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const start = new Date(document.getElementById('start').value);
      const end = new Date(document.getElementById('end').value);

      if (isNaN(start) || isNaN(end) || end <= start) {
        alert('Czas końcowy musi być po czasie początkowym.');
        return;
      }

      clearInterval(countdownInterval);
      countdownInterval = setInterval(() => {
        const now = new Date();
        if (now >= start) {
          const remaining = end - now;
          if (remaining <= 0) {
            document.getElementById('countdown').textContent = '⏰ Czas minął!';
            clearInterval(countdownInterval);
          } else {
            document.getElementById('countdown').textContent = 'Pozostało: ' + format(remaining);
          }
        } else {
          document.getElementById('countdown').textContent = 'Czekam na start...';
        }
      }, 1000);
    });
  </script>
</body>
</html>
