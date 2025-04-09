<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Link Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
        }
        button {
            margin: 10px 5px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .result, .history {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<h2>Ваша уникальная ссылка:</h2>
<p><strong>{{ $token }}</strong></p>

<form method="POST" action="{{ route('link.generateNew', ['token' => basename($token)]) }}">
    @csrf
    <button type="submit">Сгенерировать новый линк</button>
</form>

<form method="POST" action="{{ route('link.deactivate', ['token' => basename($token)]) }}">
    @csrf
    <button type="submit">Деактивировать линк</button>
</form>

<button onclick="feelingLucky()">Imfeelinglucky</button>
<button onclick="loadHistory()">History</button>

<div class="result" id="lucky-result" style="display:none;"></div>
<div class="history" id="history" style="display:none;"></div>

<script>
    async function feelingLucky() {
        const response = await fetch('{{ route("link.lucky", ["token" => basename($token)]) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content'),
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        document.getElementById('lucky-result').style.display = 'block';
        document.getElementById('lucky-result').innerHTML = `
                <strong>Результат:</strong> ${data.result}<br>
                <strong>Число:</strong> ${data.number}<br>
                <strong>Сумма выигрыша:</strong> ${data.win_amount}
            `;
    }

    async function loadHistory() {
        const response = await fetch('{{ route("link.history", ["token" => basename($token)]) }}');
        const history = await response.json();

        let html = `<strong>Последние 3 результата:</strong><ul>`;
        history.forEach(item => {
            html += `<li>${item.created_at}: Число ${item.number} — ${item.result} — Выигрыш: ${item.win_amount}</li>`;
        });
        html += `</ul>`;

        document.getElementById('history').style.display = 'block';
        document.getElementById('history').innerHTML = html;
    }
</script>
</body>
</html>
