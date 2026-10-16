<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptic Sequence Generator</title>
</head>
<body>
    <h2>Cryptic Sequence Generator (Spring 2024 - Question 2)</h2>

    <form method="post" action="">
        <label>Seed value:</label>
        <input type="number" name="seed" required value="<?php echo isset($_POST['seed']) ? htmlspecialchars($_POST['seed']) : '7'; ?>"><br><br>

        <label>Terms:</label>
        <input type="number" name="terms" min="1" required value="<?php echo isset($_POST['terms']) ? htmlspecialchars($_POST['terms']) : '5'; ?>"><br><br>

        <button type="submit" name="generate">Generate Sequence</button>
    </form>

    <?php
    /**
     * Generates cryptic sequence using sum of digits (which strictly matches the sample outputs:
     * Seed 7 -> 7, 14, 19, 29, 40
     * Seed 4 -> 4, 8, 16, 23, 28, 38, 49, 62, 70)
     */
    function generateSequenceSumDigits($seed, $terms) {
        $seq = [];
        if ($terms < 1) return $seq;

        $seq[] = $seed;

        for ($i = 1; $i < $terms; $i++) {
            $prev = $seq[$i - 1];
            $digits = str_split((string)abs($prev));
            $sumDigits = array_sum($digits);
            $next = $prev + $sumDigits;
            $seq[] = $next;
        }

        return $seq;
    }

    /**
     * Alternatively generates using product of digits (literal text of question):
     */
    function generateSequenceProductDigits($seed, $terms) {
        $seq = [];
        if ($terms < 1) return $seq;

        $seq[] = $seed;

        for ($i = 1; $i < $terms; $i++) {
            $prev = $seq[$i - 1];
            $digits = str_split((string)abs($prev));
            $productDigits = 1;
            foreach ($digits as $d) {
                $productDigits *= (int)$d;
            }
            $next = $prev + $productDigits;
            $seq[] = $next;
        }

        return $seq;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $seed = (int)$_POST['seed'];
        $terms = (int)$_POST['terms'];

        $resultSequence = generateSequenceSumDigits($seed, $terms);
        echo "<h3>Generated Sequence (Matches Sample Output):</h3>";
        echo "<p style='font-size: 1.1rem; font-weight: bold;'>" . implode(", ", $resultSequence) . "</p>";

        $productSequence = generateSequenceProductDigits($seed, $terms);
        echo "<details><summary style='cursor:pointer; color:#666;'>Literal Product of Digits interpretation</summary>";
        echo "<p>" . implode(", ", $productSequence) . "</p></details>";
    }

    echo "<hr><h4>Sample Test Cases from Exam Question:</h4>";
    echo "Seed: 7, Terms: 5 &rarr; " . implode(", ", generateSequenceSumDigits(7, 5)) . " (Expected: 7, 14, 19, 29, 40)<br>";
    echo "Seed: 4, Terms: 9 &rarr; " . implode(", ", generateSequenceSumDigits(4, 9)) . " (Expected: 4, 8, 16, 23, 28, 38, 49, 62, 70)<br>";
    ?>
</body>
</html>
