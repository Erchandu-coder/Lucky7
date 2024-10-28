<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lucky 7 Game</title>
</head>
<body>
    <h1>Lucky 7 Game</h1>
    <p>Starting Amount: 100 Rs</p>

    @if(session()->has('amount'))
        <p>Current Amount: {{ session('amount') }} Rs</p>
    @endif

    <form action="{{ route('lucky7') }}" method="POST">
        @csrf
        <label>
            Bet Option:
            <select name="bet">
                <option value="below7">Below 7</option>
                <option value="lucky7">Lucky 7</option>
                <option value="above7">Above 7</option>
            </select>
        </label>
        <input type="hidden" name="amount" value="{{ session('amount', 100) }}">
        <button type="submit">Play</button>
    </form>

    @if(session()->has('sum'))
        <p>Dice Rolls: {{ session('dice1') }} and {{ session('dice2') }}</p>
        <p>Sum: {{ session('sum') }}</p>
        <p>Result: {{ session('winAmount') > 0 ? 'You won ' . session('winAmount') . ' Rs!' : 'You lost 10 Rs.' }}</p>
    @endif
</body>
</html>
